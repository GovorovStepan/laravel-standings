<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class GenerationController extends BaseController
{

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * The method gets the last generation from the database by ID. And displays it in view.
     */
    public function show($id)
    {
        $divisions = DB::select('select * from points_table where generationId = :id ', ['id' => $id]);
        $playOff = DB::select('select * from playoff where generationId = :id', ['id' => $id]);

        $this->prepareForView($divisions);
        $this->prepareForView($playOff);


        return view('main', ['divisions' => $divisions, 'playOff' => $playOff[0]]);
    }

    /**
     * @param $listFromDB
     * @return void
     * The method deserialize the data stored in the database.
     */
    private function prepareForView(&$listFromDB)
    {
        foreach ($listFromDB as &$el) {
            if (isset($el->divisionResult)) {
                $el = unserialize($el->divisionResult);
            }
            if (isset($el->gamesSchedule)) {
                $el = unserialize($el->gamesSchedule);
            }
        }
    }
}
