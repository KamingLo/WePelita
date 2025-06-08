<?php

// app/Http/Controllers/AnnouncementController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postingan;
use Illuminate\Support\Facades\Log;

class AnnouncementController extends Controller
{
    public function getAnnouncement($id)
    {
        Log::info('getAnnouncement called', ['announcement_id' => $id, 'user_id' => auth()->id(), 'session_role' => session('role')]);
        try {
            $announcement = Postingan::with('profile', 'kelasTahun.kelas', 'kelasTahun.tahunajar')->findOrFail($id);
            Log::info('Announcement fetched', ['announcement_id' => $id, 'data' => $announcement->toArray()]);
            return response()->json($announcement);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Announcement not found', ['id' => $id]);
            return response()->json(['error' => 'Announcement not found'], 404);
        } catch (\Exception $e) {
            Log::error('Error fetching announcement', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['error' => 'Server error'], 500);
        }
    }
}