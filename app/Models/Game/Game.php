<?php

namespace App\Models\Game;

use App\Models\Team\Team;

class Game
{

  protected Team $firstTeam;
  protected Team $secondTeam;
  protected $firstTeamGoals;
  protected $secondTeamGoals;


  public function __construct(Team $firstTeam, Team $secondTeam)
  {
    $this->firstTeam = $firstTeam;
    $this->secondTeam = $secondTeam;
    $this->generateGoals();
  }

  public function generateGoals()
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
