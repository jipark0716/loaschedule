<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class FcmToken extends Controller
{
    public function put(Request $request)
    {
        app('firebase.messaging')->subscribeToTopic($request->topic, $request->token);
    }

    public function test(Request $request)
    {
        $topicResult = app('firebase.messaging')->send(
            CloudMessage::fromArray([
                'topic' => 'day-week',
                'data' => [
                    'event_type' => 'day-work-1',
                    'test' => 'test',
                ],
            ])
        );
        dd($topicResult);
    }
}
