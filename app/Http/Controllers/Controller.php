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

  private function generateDivisionsResults(){
      $divisions = [
          $this->generateDivision(
            'Group A', 'ES', 'EE', 'BY', 'UA', 'KZ', 'UK', 'PL'
          ),
          $this->generateDivision(
            'Group B', 'RU', 'LT', 'DE', 'IT', 'ND', 'FR', 'CR'
          ),
      ];

      return  array_map(
        fn(Division $division) => $division->generatePointsTable(), $divisions);
  }

  private function generatePlayOff(){
    /*Логика для плей-офф будет здесь*/

      return [];
  }

  public function generate()
  {
    return view('main',[
          'divisionsTables' => $this->generateDivisionsResults(),
          'playOff' => $this->generatePlayOff(),
      ] );
  }
}
