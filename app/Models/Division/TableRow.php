<?php

namespace App\Models\Division;

use App\Models\Team\Team;
use App\Models\Game\DivisionGame;

class TableRow
{

  private Team $team;
  private array $games;
  private int $points = 0;

  public function __construct(Team $team, array $games)
  {
      $this->team = $team;
      $this->games = $games;

      foreach ($this->games as $game) {
          $this->points += $game->getTeamPoints($team);
      }
  }

  public function findGameForTeam(Team $team): ?DivisionGame
    {
        if ($this->team->isEqual($team)) {
            return null;
        }

        foreach ($this->games as $game) {
            if ($game->hasTeam($team)) {
                return $game;
            }
        }

        return null;
    }


  /**
    * Методы гетеры
    */
  public function getPoints()
  {
    return $this->points;
  }
  public function getGames()
  {
    return $this->games;
  }
  public function getTeam()
  {
    return $this->team;
  }


}

 ?>
