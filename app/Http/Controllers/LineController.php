<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DevelopLog;
class LineController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('line.index');
    }

    public function getMessage(Request $request){
        DevelopLog::create([
            'data'=>json_encode($request->all)
        ]);
        return [];
    }

    public function saveToken(){

    }
}
