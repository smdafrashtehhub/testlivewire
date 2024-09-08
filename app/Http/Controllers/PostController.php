<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use App\Jobs\TestJob;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PostController extends Controller
{
    public function filter(Request $request)
    {
        $filter=QueryBuilder::for(Post::class)
            ->join('users','users.id','=','posts.user_id')
            ->allowedFilters([
                AllowedFilter::exact('title')->ignore(null),
                AllowedFilter::exact('body')->ignore(null),
                AllowedFilter::exact('users.name')->ignore(null)
            ])->get();
        return response()->json([
            'status'=>true,
            'message'=>$filter
        ]);
    }
    public function store(Request $request)
    {
        $post=Post::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'user_id'=>auth()->user()->id,
        ]);
        TestJob::dispatch()->onQueue('post')->delay(now()->addSeconds(20));
        TestEvent::dispatch($post);
        return response()->json([
            'status'=>true,
            'message'=>'post saved'
        ]);
    }

    public function userPost()
    {
        return response()->json([
           'status'=>true,
           'posts'=>auth()->user()->posts()->get('title')
        ]);
    }

    public function relation()
    {
        $users=DB::table('users')
            ->join('posts','posts.user_id','=','users.id')
            ->get(['name','email','posts.title','posts.body as subject']);
        $comments=Comment::with('commentable')->get();
//        $comments=Post::with('comments')->get();

        //       $x= $users->map(function ($user){
//            return[
//                'name'=>$user->name,
//                'email'=>$user->email,
//                'posts'=>$user->posts->map(function($post){
//                    return[
//                        'title'=>$post->title,
//                        'body'=>$post->body
//                    ];
//                }),
//            ];
//        });
        return response()->json([
           'status'=>true,
           'message'=>$comments
        ]);
    }
}
