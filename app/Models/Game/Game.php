<?php

namespace App\Models\Game;

use App\Models\Team;

class Game
{

  private Team $firstTeam;
  private Team $secondTeam;
  private $firstTeamGoals;
  private $secondTeamGoals;


  public function __construct(Team $firstTeam, Team $secondTeam)
  {
    $this->firstTeam = $firstTeam;
    $this->secondTeam = $secondTeam;
    $this->generateGoals();
  }

  public static function generateGoals()
  {
    $this->firstTeamGoals = random_int(0, 5) ;
    $this->firstTeamGoals = random_int(0, 5) ;
  }

  public function hasTeam(Team $team): bool
  {
      return $team->isEqual($this->firstTeam) || $team->isEqual($this->secondTeam);
  }

  public function getFirstTeam(){return $this->firstTeam;}
  public function getSecondTeam(){return $this->secondTeam;}
  public function getFirstTeamGoals(){return $this->firstTeamGoals;}
  public function getSecondTeamGoals(){return $this->secondTeamGoals;}
}
 ?>
