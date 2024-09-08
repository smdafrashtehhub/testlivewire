<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $imgname=$request->address->getClientOriginalName();
        $request->address->move(public_path('./file/images'),$imgname);
        Image::create([
           'address'=>$imgname
        ]);
        return response()->json([
           'status'=>true,
           'message'=>$request->address->getClientOriginalName()
        ]);
    }
}
