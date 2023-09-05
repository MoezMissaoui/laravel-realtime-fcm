<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
}
