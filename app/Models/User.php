<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Auth;
use Illuminate\Support\Facades\Http;

class User extends Auth
{
    public $fillable = ['name', 'discord_id', 'access_token', 'refresh_token', 'expires', 'block'];
    protected $casts = [
        'block' => 'boolean',
        'expires' => 'date',
    ];
    const UPDATED_AT = null;

    protected function oauth2Client()
    {
        if ($this->isExpired()) {
            $this->refreshToken();
        }
        return Http::withOptions([
            'base_uri' => config('services.discord.root').'oauth2/',
        ])->withHeaders([
            'authorization' => 'Bearer '.$this->access_token,
        ]);
    }

    protected function botClient()
    {
        return Http::withOptions([
            'base_uri' => config('services.discord.root'),
        ])->withHeaders([
            'authorization' => 'Bot '.config('services.discord.bot'),
        ]);
    }

    protected function isExpired()
    {
        return time() > $this->date->timestamp;
    }

    protected function refreshToken()
    {
        return '';
    }

    public function sendMessage($message)
    {
        if (!is_array($message)) {
            $message = [
                'content' => $message,
            ];
        }
        $response = $this->botClient()->post('channels/'.$this->getDmChannelId().'/messages', $message);

        return json_decode($response, true);
    }

    public function getDmChannelId()
    {
        $response = $this->botClient()->post('users/@me/channels', [
            'recipient_id' => $this->discord_id,
        ]);

        $response = json_decode($response->getBody(), true);

        if (!isset($response['id'])) {
            throw new \Exception("fail open DM channel", 1);
        }

        return $response['id'];
    }

    public function character()
    {
        return $this->hasManyThrough(
            Character::class,
            Account::class,
            'user_id',
            'account_id',
            'id',
            'id'
        );
    }
}
