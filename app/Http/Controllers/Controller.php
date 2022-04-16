<?php

namespace App\Http\Controllers;


use App\Models\Devision\Devision;
use App\Models\Team\Team;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{


  private function generateDevision(string $title, string ...$teams): Devision
  {
      $devision = new Devision($title);
      $devision->addTeams(...array_map(fn(string $team) => new Team($team), $teams));
      $devision->generateAllGames();

      return $devision;
  }

  private function generateDevisionsResults(){
      $devisions = [
          $this->generateDevision(
            'Group A', 'ES', 'EE', 'BY', 'UA', 'KZ', 'UK', 'PL'
          ),
          $this->generateDevision(
            'Group B', 'RU', 'LT', 'DE', 'IT', 'ND', 'FR', 'CR'
          ),
      ];

      return  array_map(
        fn(Devision $devision) => $devision->generatePointsTable(), $devisions);
  }

  private function generatePlayOff(){
    /*Логика для плей-офф будет здесь*/

      return [];
  }

  public function generate()
  {
    return view('main',[
          'devisionsTables' => $this->generateDevisionsResults(),
          'playOff' => $this->generatePlayOff(),
      ] );
  }
}
