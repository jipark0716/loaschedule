<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Account};

class CrawController extends Controller
{
    /**
     * 캐릭터 정보 craw
     *
     * @param Illuminate\Http\Request $request
     * @return array
     */
    public function character(Request $request)
    {
        $request->validate([
            'nick_name' => 'string',
            'main_character' => 'required|string',
        ]);

        $account = Account::create([
            'nick_name' => $request->input('nick_name', null),
            'main_character' => $request->main_character,
        ]);

        $account->crawCharacter();

        return [
            'code' => 200,
            'message' => 'success',
            'account' => $account
        ];
    }
}
