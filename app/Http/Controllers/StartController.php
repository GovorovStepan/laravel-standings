<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class StartController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * The method receives from the database a list of generations that have already been. And displays them in view.
     */
    public function getList()
    {
        $previousGenerations = DB::select('select * from generation_id');

        return view('start', ['previousGenerations' => array_reverse($previousGenerations)]);
    }
}
