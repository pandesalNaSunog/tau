<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
class AnnouncementController extends Controller
{
    public function getAnnouncements(){
        $announcements = Announcement::all();

        $response = array();

        foreach($announcements as $announcementsItem){
            $id = $announcementsItem->id;
            $title = $announcementsItem->title;
            $description = $announcementsItem->description;
            $createdAt = $announcementsItem->created_at->format('M d, Y h:i A');
            $updatedAt = $announcementsItem->updated_at->format('M d, Y h:i A');

            $response[] = [
                'id' => $id,
                'title' => $title,
                'description' => $description,
                'created_at' => $createdAt,
                'updated_at' => $updatedAt
            ];
        }

        return response($response, 200);
    }
}
