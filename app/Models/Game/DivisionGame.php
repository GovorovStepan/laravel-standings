<?php

namespace App\Models\Game;


use App\Exceptions\TeamNotPlayInGameException ;
use App\Models\Team\Team;

class DivisionGame extends Game
{

  /**
    * Метод возвращает очки набранные командой в ходе игры дивизиона
    *
    */
  public function getTeamPoints(Team $team): int
  {

      if ($team->isEqual($this->firstTeam))
      {
          return Result::pointsForTeam(
            $this->firstTeamGoals, $this->secondTeamGoals);
      }

      if ($team->isEqual($this->secondTeam))
      {
          return Result::pointsForTeam(
            $this->secondTeamGoals, $this->firstTeamGoals);
      }

      throw new TeamNotPlayInGameException();

  }
}
