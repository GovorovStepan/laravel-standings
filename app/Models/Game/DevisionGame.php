<?php

namespace App\Models\Game;


use App\Exceptions\TeamNotPlayInGameException ;
use App\Models\Team\Team;

class DevisionGame extends Game
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

  /**
    * Метод возвращает счет игры относительно команды
    *
    */
  public function getTeamScores(Team $team): string
  {
      if ($this->firstTeam->isEqual($team))
      {
          return Result::scoresForTeam(
            $this->firstTeamGoals, $this->secondTeamGoals);
      }

      if ($this->secondTeam->isEqual($team))
      {
        return Result::scoresForTeam(
          $this->secondTeamGoals, $this->firstTeamGoals);
      }

      throw new TeamNotPlayInGameException();

  }
}
