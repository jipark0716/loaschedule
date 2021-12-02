<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $state = \Str::random(40);

        $request->session()->put('discord_state', $state);

        return redirect(config('services.discord.root').'oauth2/authorize?'.http_build_query([
            'response_type' => 'code',
            'client_id' => config('services.discord.client_id'),
            'scope' => 'email identify',
            'state' => $state,
            'redirect_uri' => route('oauth.discord.redirect'),
        ]));
    }

    public function discordRedirect(Request $request)
    {
        $response = Http::asForm()->post(config('services.discord.root').'oauth2/token', [
            'client_id' => config('services.discord.client_id'),
            'client_secret' => config('services.discord.secret'),
            'grant_type' => 'authorization_code',
            'code' => $request->code,
            'redirect_uri' => route('oauth.discord.redirect'),
        ]);

        $token = json_decode($response->getBody(), true);

        if (!isset($token['access_token'])) {
            abort(401);
        }

        $response = Http::withHeaders([
                'authorization' => 'Bearer '.$token['access_token'],
            ])->get(config('services.discord.root').'oauth2/@me');
        $user = json_decode($response->getBody(), true);

        $model = User::where('discord_id', $user['user']['id'])->first();
        if ($model) {
            $model->fill([
                'name' => $user['user']['username'],
                'access_token' => $token['access_token'],
                'refresh_token' => $token['refresh_token'],
                'expires' => Carbon::parse(time() + $token['expires_in']),
            ]);
            $model->save();
        } else {
            $model = User::create([
                'name' => $user['user']['username'],
                'discord_id' => $user['user']['id'],
                'access_token' => $token['access_token'],
                'refresh_token' => $token['refresh_token'],
                'expires' => Carbon::parse(time() + $token['expires_in']),
            ]);
            return abort(400, '관리자의 승인 대기중입니다.');
        }
        if ($model->block) {
            return abort(400, '관리자의 승인 대기중입니다.');
        }

        \Auth::login($model);

        return redirect('/');
    }
}
