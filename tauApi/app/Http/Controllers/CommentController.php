<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use Laravel\Sanctum;
use App\Models\Post;
use Laravel\Sanctum\PersonalAccessToken;
class CommentController extends Controller
{
    public function postComment(Request $request){
        $request->validate([
            'post_id' => 'required',
            'comment' => 'required'
        ]);

        $token = PersonalAccessToken::findToken($request->bearerToken());
        $id = $token->tokenable->id;

        $user = User::where('id', $id)->first();

        if(!$user){
            return reponse([
                'message' => 'unauthorized'
            ], 401);
        }

        $post = Post::where('id', $request['post_id'])->first();

        if(!$post){
            return response([
                'message' => 'post not available'
            ], 401);
        }

        $comment = Comment::create([
            'user_id' => $id,
            'comment' => $request['comment'],
            'post_id' => $request['post_id'],
            
        ]);

        return response([
            'comment' => $comment,
            'user' => $user
        ], 200);
    }

    public function getPosts(){
        $posts = Posts::all();
        $response = array();
        foreach($posts as $postsItem){
            $postId = $postsItem['id'];
            $comments = Comment::where('post_id',$id)->get();

            $response[] = [
                'post' => $postsItem,
                'comments' => $comments
            ];
        }

        return response($response, 200);
    }
}
