<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function fire_notification()
    {
        return view('fire-notifications');
    }

    public function get_notification(Request $request)
    {
        return response()->json([
            'data' => ['notif' => true],
            'status' => 200,
            'message' => 'Success',
        ]);
    }

    public function show_notification(Request $request)
    {
        return view('show-notifications');
    }
}
