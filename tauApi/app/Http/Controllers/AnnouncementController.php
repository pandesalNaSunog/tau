<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
class AnnouncementController extends Controller
{
    public function getAnnouncements(){
        $announcements = Announcement::all();

        return response($announcements, 200);
    }
}
