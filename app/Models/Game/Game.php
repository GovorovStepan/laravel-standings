<?php

namespace App\Models\Game;

use App\Models\Team;

class Game
{

  private Team $firstTeam;
  private Team $secondTeam;


  public function __construct(Team $firstTeam, Team $secondTeam)
  {
    $this->firstTeam = $firstTeam;
    $this->secondTeam = $secondTeam;
  }

  public static function generateGoals() : array
  {
    return ['firstTeam' => random_int(0, 5), 'secondTeam' =>random_int(0, 5) ];
  }

  public function getFirstTeam(){return $this->firstTeam;}
  public function getSecondTeam(){return $this->secondTeam;}
}
 ?>
