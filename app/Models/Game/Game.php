<?php

namespace App\Models\Game;

use App\Models\Team;

class Game extends AnotherClass
{

  private Team $firstTeam;
  private Team $secondTeam;
  private Result $result;

  function __construct(Team $firstTeam, Team $secondTeam)
  {
    $this->firstTeam = $firstTeam;
    $this->secondTeam = $secondTeam;
    $this->result = new Result();
  }

  private function generateGoals() : array
  {
    return ['firstTeam' => random_int(0, 5), 'secondTeam' =>random_int(0, 5) ];
  }

  public function getResult(){return $this->result;}
  public function getFirstTeam(){return $this->firstTeam;}
  public function getSecondTeam(){return $this->secondTeam;}
}
 ?>
