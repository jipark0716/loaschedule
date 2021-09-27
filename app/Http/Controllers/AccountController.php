<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Account, Content, Character};

class AccountController extends Controller
{
    public function __invoke(Request $request, Account $account)
    {
        return view('account', [
            'contents' => Content::where('type', 0)->get(),
            'account' => $account,
            'characters' => $account->character()->with('week')->get(),
        ]);
    }

    public function search(Request $request)
    {
        $character = Character::where('name', $request->q)->first();
        if ($character) {
            return redirect()->route('account', $character->account);
        }
        $account = Account::where('nick_name', $request->q)->first();
        if ($account) {
            return redirect()->route('account', $account);
        }
        abort(404);
    }
}
