<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Character;

class SettingController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('setting_home')->with([
            'characters' => Auth::user()->character,
        ]);
    }

    public function accessory(Request $request, Character $character)
    {
        return view('setting_accessory')->with([
            'character' => $character,
            'buffs' => $character->buff,
            'activeBuff' => $character->activeBuffSort(),
        ]);
    }
}
