<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userRegister(UserRegisterRequest $request)
    {
        try{
            User::create([
               'name'=>$request->name,
               'password'=>Hash::make($request->password),
               'email'=>$request->email
            ]);
            return response()->json([
               'status'=>true,
               'message'=>'user created successfully'
            ],200);
        }catch (\Throwable $throwable){
            return response()->json([
               'status'=>false,
               'message'=>$throwable->getMessage()
            ],500);
        }
    }

    public function userLogin(UserLoginRequest $request)
    {
        try{
            $user=User::where('email',$request->email)->first();
            if(!Auth::guard('web')->attempt($request->only('email','password'))){
                return  response()->json([
                   'status'=>false,
                   'message'=>'email and password are not match'
                ]);
            }
            $token=$user->createToken('API TOKEN')->plainTextToken;
            return response()->json([
                'status'=>true,
                'message'=>$user->name."با موفقیت وارد شد",
                'token'=>$token
            ]);
        }catch(\Throwable $throwable)
        {
            return response()->json([
               'status'=>false,
               'message'=>$throwable->getMessage(),
            ]);
        }
    }

    public function userLogout()
    {
        try{
            \auth()->user()->tokens()->delete();
            return response()->json([
                'status'=>true,
                'message'=>\auth()->user()->name."با موفقیت خارج شد"
            ]);
        }catch(\Throwable $throwable){
            return response()->json([
               'status'=>false,
               'message'=>$throwable->getMessage()
            ]);
        }
    }


}
