<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopPreset;

class ShopController extends Controller
{
    public function __invoke()
    {
        return view('shop_monitoring');
    }

    public function create(Request $request)
    {
        // name: asd
        // cate:
        // grade:
        // quality:
        // etc[0]:
        // etcmin[0]:
        // etcmax[0]:
        // etc[1]:
        // etcmin[1]:
        // etcmax[1]:
        // etc[2]:
        // etcmin[2]:
        // etcmax[2]:
        // etc[3]:
        // etcmin[3]:
        // etcmax[3]:
        return ShopPreset::create([
            'name' => $request->name,
            'cate' => $request->cate,
            'grade' => $request->grade,
            'quality' => $request->quality,
            'etc1' => $request->etc[0].'|'.$request->etcmin[0].'|'.$request->etcmax[0],
            'etc2' => $request->etc[1].'|'.$request->etcmin[1].'|'.$request->etcmax[1],
            'etc3' => $request->etc[2].'|'.$request->etcmin[2].'|'.$request->etcmax[2],
            'etc4' => $request->etc[3].'|'.$request->etcmin[3].'|'.$request->etcmax[3],
        ]);
    }
}
