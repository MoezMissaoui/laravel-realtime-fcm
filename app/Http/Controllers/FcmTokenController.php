<?php

namespace App\Http\Controllers;

use App\Models\FcmToken;
use Illuminate\Http\Request;

class FcmTokenController extends Controller
{
    



    public function store(Request $request)
    {
        if(!FcmToken::where('token',$request->token)->exists()){
            $token = FcmToken::create([
                'token' => $request->token ?? ''
            ]);
        }

        return response()->json([
            'data' => $token ?? [],
            'status' => 200,
            'message' => 'Success',
        ]);
    }

}
