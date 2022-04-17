<?php

namespace App\Http\Controllers;


use App\Models\Division\Division;
use App\Models\PlayOff\PlayOff;
use App\Models\Team\Team;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class AppController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * Display method for generated data.
     */
    public function generate()
    {
        $divisions = $this->generateDivisionsResults();
        $playOff = $this->generatePlayOff($divisions);


        $saveData = [
            ['table_name' => 'generation_id', 'fields' => []],
            ['table_name' => 'playoff', 'fields' => ['gamesSchedule' => serialize($playOff)]]
        ];
        foreach ($divisions as $division) {
            $saveData[] = ['table_name' => 'points_table', 'fields' => ['divisionResult' => serialize($division)]];
        }

        $this->save($saveData);


        return view('main', ['divisions' => $divisions, 'playOff' => $playOff]);
    }

    /**
     * @return array
     * Method for generating the divisions stage.
     */
    private function generateDivisionsResults(): array
    {
        $divisions = [
            $this->generateDivision('Group A', 'ES', 'EE', 'BY', 'UA', 'KZ', 'UK', 'PL'),
            $this->generateDivision('Group B', 'RU', 'LT', 'DE', 'IT', 'ND', 'FR', 'CR'),
        ];


        return array_map(fn(Division $division) => $division->generatePointsTable(), $divisions);
    }

    /**
     * @param string $title
     * @param string ...$teams
     * @return Division
     * Method for generating the division result.
     */
    private function generateDivision(string $title, string ...$teams): Division
    {
        $division = new Division($title);
        $division->addTeams(...array_map(fn(string $team) => new Team($team), $teams));
        $division->generateAllGames();

        return $division;
    }

    /**
     * @param $divisions
     * @return array
     * Method for generating the playoff stage.
     */
    private function generatePlayOff($divisions): array
    {
        $playOff = new PlayOff(
            $divisions[0]->getTeamsForPlayOff(),
            $divisions[1]->getTeamsForPlayOff()
        );


        return ['winner' => $playOff->getWinner(), 'schedule' => $playOff->getGamesSchedule()];
    }

    /**
     * @param $data
     * @return void
     * A method for saving data to a database.
     */
    private function save($data)
    {
        $generationId = uniqid();

        foreach ($data as $el) {
            $el['fields']['generationId'] = $generationId;
            DB::table($el['table_name'])->insert($el['fields']);
        }
    }
}
