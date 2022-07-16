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
            'comment_id' => $comment->id,
            'comment' => $comment->comment,
            'name' => $user
        ], 200);
    }

    public function getPosts(){
        $posts = Post::all();
        $postArray = array();
        
        foreach($posts as $postItem){

            $postId = $postItem->id;
            $userId = $postItem->user_id;
            $user = User::where('id', $userId)->first();
            $name = $user->name;
            $profilePicture = $user->profile_picture;
            $date = $postItem->created_at->format('M d, Y h:i A');
            $description = $postItem->description;

            
            $comments = Comment::where('post_id', $postId)->get();
            $commentArray = array();
            foreach($comments as $commentItem){
                $commentId = $commentItem->id;
                $commenterId = $commentItem->user_id;
                $commenter = User::where('id', $commenterId)->first();
                $commenterName = $commenter->name;
                $commentItself = $commentItem->comment;
                $commentArray[] = [
                    'comment_id' => $commentId,
                    'name' => $commenterName,
                    'comment' => $commentItself
                ];
                
            }
            

            $postArray[] = [
                'post_id' => $postId,
                'name' => $name,
                'profile_picture' => $profilePicture,
                'date' => $date,
                'description' => $description,
                'comments' => $commentArray
            ];
        }

        return response($postArray, 200);
    }
}
