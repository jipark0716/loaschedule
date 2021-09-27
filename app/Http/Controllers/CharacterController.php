<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;

class CharacterController extends Controller
{
    public function setDescription(Request $request, $id)
    {
        $c = Character::find($id);
        if ($c->isHasScope()) {
            abort(400);
        }
        $c->description = $request->content;
        $c->save();
    }
}
