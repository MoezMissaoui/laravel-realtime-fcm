<?php

namespace App\Http\Controllers;

use App\Models\FcmToken;

use Stevebauman\Location\Facades\Location;
use Jenssegers\Agent\Facades\Agent;
use Illuminate\Http\Request;

class FcmTokenController extends Controller
{


    public function store(Request $request)
    {
        $currentUserInfo = Location::get($request->ip());

        if(!FcmToken::where('token',$request->token)->exists()){
            $device_type = null;
            if (Agent::isMobile()) {
                $device_type = 'Yes, This is Mobile.';
            }else if (Agent::isDesktop()) {
                $device_type = 'Yes, This is Desktop.';
            }else if (Agent::isTablet()) {
                $device_type = 'Yes, This is Desktop.';
            }else if (Agent::isPhone()) {
                $device_type = 'Yes, This is Phone.';
            }

            $is_robot = "User is real!";
            if (Agent::isRobot()) {
                $is_robot = "Yes, User is Robot.";
            }

            $token = FcmToken::create([
                'token'           => $request->token ?? '',
                'browser'         => Agent::browser(),
                'browser_version' => Agent::version(Agent::browser()),
                'device'          => Agent::device(),
                'device_type'     => $device_type,
                'platform'        => Agent::platform(),
                'is_robot'        => $is_robot,
                'ip'              => $request->ip(),

                'country_name'    => $currentUserInfo->countryName ?? null,
                'country_code'    => $$currentUserInfo->countryCode ?? null,
                'region_name'     => $currentUserInfo->regionCode ?? null,
                'region_code'     => $currentUserInfo->regionName ?? null,
                'city_name'       => $currentUserInfo->cityName ?? null,
                'zip_code'        => $currentUserInfo->zipCode ?? null,
                'latitude'        => $currentUserInfo->latitude ?? null,
                'longitude'       => $currentUserInfo->longitude ?? null
            ]);
        }

        return response()->json([
            'data' => $token ?? [],
            'status' => 200,
            'message' => 'Success',
        ]);
    }

}
