<?php

namespace App\Http\Controllers;


use App\Models\Division\Division;
use App\Models\Team\Team;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{


  private function generateDivision(string $title, string ...$teams): Division
  {
      $division = new Division($title);
      $division->addTeams(...array_map(fn(string $team) => new Team($team), $teams));
      $division->generateAllGames();

      return $division;
  }

  public function generate()
  {
    $divisions = [
        $this->generateDivision('Group A', 'ES', 'EE', 'BY', 'UA', 'KZ', 'UK'),
        $this->generateDivision('Group B', 'RU', 'LT', 'DE', 'IT', 'ND', 'FR'),
    ];


    $divisionsTables = array_map(
      fn(Division $division) => $division->generatePointsTable(), $divisions);

    /*Логика для плей-офф будет здесь*/


    return view('main',[
          'divisionsTables' => $divisionsTables,
      ] );
  }
}
