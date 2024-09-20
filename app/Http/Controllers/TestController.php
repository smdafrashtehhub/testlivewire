<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function test()
    {
        return view('livewire.test');
    }

    public function store(TestRequest $request)
    {

        User::create([
           'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        return redirect()->route('test.index');
    }

    public function create()
    {

    }

    public function index()
    {
        $users=User::all();
        return view('livewire.index',['users'=>$users]);

    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }

    public function edit(User $user)
    {
        return view('livewire.edit',['user'=>$user]);
    }

    public function update(Request $request,User $user)
    {
        $user->update([
           'name'=>$request->name,
           'email'=>$request->email
        ]);
        return redirect()->route('test.index');
    }
}
