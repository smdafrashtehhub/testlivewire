<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use App\Jobs\TestJob;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
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
//        dd($_POST['title']);
        $connection=new PDO("mysql:host=localhost;dbname=laravel","root","");
//        $result=$connection->query("select * from posts");
//        $result=$connection->query("insert into posts (title,body) values('pdo','first pdo test')");
//        $result=$connection->query("insert into posts set title='new',body='new way'");
//        $result=$connection->query("update posts set title='ok' where title='new'");
        $result=$connection->prepare("update posts set title = :title where title='pdo'");
        $result->bindParam(':title',$_POST['title']);
        $result->execute();
//        return print_r($result->fetch(PDO::FETCH_ASSOC));
        return $result->columnCount();
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
