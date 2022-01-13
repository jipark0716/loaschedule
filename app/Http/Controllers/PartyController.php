<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{PartyContentCategory, Party, User, Account, PartyMember};
use Carbon\Carbon;

class PartyController extends Controller
{
    public function __invoke(Request $request)
    {
        $categories = PartyContentCategory::with('content')->get();
        $parties = Party::with('content')->get();
        return view('party', compact('categories', 'parties'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'time' => 'required',
            'date' => 'required',
            'content_id' => 'required',
        ]);

        return Party::create([
            'content_id' => $request->content_id,
            'start_at' => Carbon::parse($request->date.$request->time),
            'title' => $request->input('title', null),
            'members' => $request->input('members', null),
        ]);
    }
    public function partyAccount(Request $request, Party $party)
    {
        return view('partials.account_select', [
            'party' => $party,
            'accounts' => User::where('guild_id', \Auth::user()->guild_id)->with('account')->get()->pluck('account')->flatten(1),
        ]);
    }
    public function partyCharacter(Request $request, Party $party, Account $account)
    {
        return view('partials.character_select', [
            'party' => $party,
            'characters' => $account->character()->where('item_level', '>=', $party->content->item_level)->get(),
        ]);
    }
    public function addMembers(Request $request, Party $party)
    {
        $request->validate([
            'account_id' => 'required|integer',
            'character_id' => 'required|integer',
        ]);

        if (
            PartyMember::where('party_id', $party->getKey())
                ->where('account_id', $request->account_id)
                ->count()
        ) {
            abort(422);
        }

        $account = Account::findOrFail($request->account_id);

        return PartyMember::create([
            'party_id' => $party->getKey(),
            'user_id' => $account->user_id,
            'character_id' => $request->character_id,
            'account_id' => $account->getKey(),
        ]);
    }
}
