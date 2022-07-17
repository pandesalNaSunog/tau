<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Sanctum;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\Message;
use App\Models\User;
class MessageController extends Controller
{
    //

    public function getConversation(Request $request){
        $request->validate([
            'user_id' => 'required'
        ]);

        $token = PersonalAccessToken::findToken($request->bearerToken());
        $id = $token->tokenable->id;

        $messages = Message::where('sender_id', $id)->where('receiver_id', $request['user_id'])->orWhere('sender_id', $request['user_id'])->where('receiver_id', $id)->get();

        $response = array();
        foreach($messages as $messageItem){
            $messageId = $messageItem->id;
            $senderId = $messageItem->sender_id;
            $receiverId = $messageItem->receiver_id;
            $message = $messageItem->message;
            $read = $messageItem->read;
            $createdAt = $messageItem->created_at->format('M d, Y h:i A');
            $updatedAt = $messageItem->updated_at->format('M d, Y h:i A');

            if($senderId == $id){
                $mine = true;
            }else{
                $mine = false;
            }

            $response[] = [
                'id' => $messageId,
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
                'message' => $message,
                'read' => $read,
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
                'mine' => $mine
            ];
        }

        return response($response, 200);
    }

    public function getUsers(Request $request){
        $token = PersonalAccessToken::findToken($request->bearerToken());
        $id = $token->tokenable->id;

        $users = User::where('id','<>',$id)->where('user_type','<>','admin')->get();

        return response($users, 200);
    }
}
