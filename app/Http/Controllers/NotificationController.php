<?php

namespace App\Http\Controllers;

use App\Models\FcmToken;
use App\Models\Notification;
use Illuminate\Http\Request;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class NotificationController extends Controller
{

    public function fire()
    {
        $notifications = Notification::count();
        return view('notifications.fire', compact('notifications'));
    }

    public function store(Request $request)
    {
        $notif = Notification::create();
        $count = Notification::count();

        $this->broadcast($notif, $count);

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


    private function broadcast($notif, $count)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder("Notification $notif->id");
        $notificationBuilder->setBody($notif->content)
                            ->setSound('default')
                            ->setClickAction('http://127.0.0.1:8000//');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($notif->toArray() + ['count' => $count]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        // You must change it to get your tokens
        $tokens = FcmToken::pluck('token')->toArray();

        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);

        return $downstreamResponse->numberSuccess();
    }
}
