<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterCosplayController extends Controller
{
    public function __invoke()
    {
        return view('master_cosplay');
    }

    public function search(Request $request)
    {

    }

    public function pin(Request $request)
    {
        
    }
}
