<?php

namespace App\Http\Controllers;

use App\Events\EmailEvent;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class CommentController extends Controller
{
    public function postStore(Request $request)
    {
//        dd(auth()->user());
        $comment=Post::find($request->post_id)->comments()->create([
           'content'=>$request->content1
        ]);
        $data=[
            'subject'=>'test event-listener',
            'body'=>'best way'
        ];
        Event::dispatch(new EmailEvent($data,'smd.afrashteh1@gmail.com'));
        return response()->json([
           'status'=>true,
           'message'=>Post::find($request->post_id)->comments()->get(['id','content','created_at'])
        ]);
    }

    public function imageStore(Request $request)
    {
        Image::find($request->image_id)->comments()->create([
           'content'=>$request->content1
        ]);
        return response()->json([
            'status'=>true,
            'message'=>Image::find($request->image_id)->comments()->get(['id','content','created_at'])
        ]);
    }
}
