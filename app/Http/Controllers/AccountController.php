<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Account, Content, Character};

class AccountController extends Controller
{
    /**
     *
     *
     *
     */
    public function __invoke(Request $request, Account $account)
    {
        return view('account', [
            'contents' => Content::where('type', 0)->get(),
            'account' => $account,
            'characters' => $account->character()->with('week')->get(),
        ]);
    }
}
