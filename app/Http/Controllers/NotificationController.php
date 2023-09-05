<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function fire()
    {
        $notifications = Notification::count();
        return view('notifications.fire', compact('notifications'));
    }

    public function store(Request $request)
    {
        Notification::create();
        return response()->json([
            'data' => ['notif' => true],
            'status' => 200,
            'message' => 'Success',
        ]);
    }

    public function show(Request $request)
    {
        $notifications = Notification::latest()->get();
        return view('notifications.show', compact('notifications'));
    }
}
