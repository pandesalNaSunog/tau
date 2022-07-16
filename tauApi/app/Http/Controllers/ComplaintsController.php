<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Laravel\Sanctum;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\User;
class ComplaintsController extends Controller
{
    public function getMyComplaints(Request $request){
        $token = PersonalAccessToken::findToken($request->bearerToken());
        $id = $token->tokenable->id;

        $complaints = Complaint::where('user_id', $id)->get();
        $response = array();
        foreach($complaints as $complaintItem){
            $id = $complaintItem->id;
            $userId = $complaintItem->user_id;
            $complaint = $complaintItem->complaint;
            $createdAt = $complaintItem->created_at->format('M d, Y h:i A');
            $updatedAt = $complaintItem->updated_at->format('M d, Y h:i A');
            $status = $complaintItem->status;
            $user = User::where('id', $userId)->first();

            $response[] = [
                'id' => $id,
                'user_id' => $userId,
                'complaint' => $complaint,
                'status' => $status,
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
                'user' => $user
            ];
        }

        return response($response, 200);
    }
}
