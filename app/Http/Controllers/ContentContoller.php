<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{WeekWork, DayWork, Character};
use Kreait\Firebase\Messaging\CloudMessage;

class ContentContoller extends Controller
{
    /**
     * 주간 숙제
     *
     * @param Illuminate\Http\Request
     * @return void
     */
    public function week(Request $request)
    {
        $request->validate([
            'character' => 'required|integer',
            'content' => 'required|integer',
            'step' => 'required|integer',
        ]);
        $character = Character::find($request->character);
        if ($character->isHasScope()) {
            abort(400);
        }
        if ($request->step) {
            $work = WeekWork::now()
                ->where('target_id', $request->character)
                ->where('content_id', $request->content)
                ->where('type', 'account')
                ->first();
            if ($work) {
                $work->step = $request->step;
                $work->save();
            } else {
                WeekWork::create([
                    'content_id' => $request->content,
                    'target_id' => $request->character,
                    'type' => 'account',
                    'step' => $request->step,
                ]);
            }
        } else {
            WeekWork::now()
                ->where('target_id', $request->character)
                ->where('content_id', $request->content)
                ->where('type', 'account')
                ->delete();
        }
        app('firebase.messaging')->send(
            CloudMessage::fromArray([
                'topic' => 'all',
                'data' => [
                    'event_type' => 'week-work',
                    'work' => json_encode($request->only('character', 'content', 'step')),
                ],
            ])
        );
    }

    /**
     * 일간 숙제
     *
     * @param Illuminate\Http\Request
     * @return void
     */
    public function day(Request $request)
    {
        $request->validate([
            'character' => 'required|integer',
            'content' => 'required|string',
            'on' => 'required|boolean',
        ]);

        $character = Character::find($request->character);
        $restField = [
            '카던' => 'c_rest',
            '가디언' => 'g_rest',
            '에포나' => 'a_rest',
        ][$request->content] ?? null;

        $restCnt = [
            '카던' => 2,
            '가디언' => 2,
            '에포나' => 3,
        ][$request->content] ?? null;

        if ($restField == null || $restCnt == null) {
            abort(400);
        }

        if ($request->on) {
            DayWork::create([
                'character_id' => $request->character,
                'content' => $request->content,
                'before_rest' => $character->{$restField},
            ]);
            if ($character->isHasScope()) {
                abort(400);
            }
            if ($character->{$restField} > ($restCnt * 20)) {
                $character->{$restField} -= $restCnt * 20;
            } else {
                $character->{$restField} %= 20;
            }
        } else {
            $work = DayWork::where('character_id', $request->character)
                ->now()
                ->where('content', $request->content)
                ->first();

            if ($work == null) {
                abort(400);
            }

            if ($character->isHasScope()) {
                abort(400);
            }
            $character->{$restField} = $work->before_rest;
            $work->delete();
        }
        $character->save();

        dispatch(function () use ($character, $restField, $request) {
            app('firebase.messaging')->send(
                CloudMessage::fromArray([
                    'topic' => 'all',
                    'data' => [
                        'event_type' => 'day-work',
                        'rest' => $character->{$restField},
                        'work' => json_encode($request->only('character', 'content', 'on')),
                    ],
                ])
            );
        })->afterResponse();

        return [
            'rest' => $character->{$restField},
        ];
    }

    /**
     * 휴경 수정
     *
     * @param Illuminate\Http\Request
     * @return void
     */
    public function rest(Request $request)
    {
        $request->validate([
            'character' => 'required|integer',
            'content' => 'required|string',
            'val' => 'required|integer|between:0,100',
        ]);

        $restField = [
            '카던' => 'c_rest',
            '가디언' => 'g_rest',
            '에포나' => 'a_rest',
        ][$request->content] ?? null;

        if ($restField == null) {
            abort(400);
        }

        $character = Character::findOrFail($request->character);
        if ($character->isHasScope()) {
            abort(400);
        }
        $character->{$restField} = $request->val;
        $character->save();
    }
}
