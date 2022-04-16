<?php

namespace App\Models\Game;

class DivisionGame extends Game
{
  /**
    * Метод возвращает очки набранные командой в ходе игры дивизиона
    *
    */
  public function getTeamPoints(Team $team): int
  {
      if ($this->firstTeam->isEqual($team))
      {
          return Result::pointsForTeam(
            $this->firstTeamGoals, $this->secondTeamGoals);
      }

      if ($this->secondTeam->isEqual($team))
      {
          return Result::pointsForTeam(
            $this->secondTeamGoals, $this->firstTeamGoals);
      }

  }

  /**
    * Метод возвращает счет игры относительно команды
    *
    */
  public function getTeamScores(Team $team): string
  {
      if ($this->firstTeam->isEqual($team))
      {
          rreturn Result::scoresForTeam(
            $this->firstTeamGoals, $this->secondTeamGoals);
      }

      if ($this->secondTeam->isEqual($team))
      {
        return Result::scoresForTeam(
          $this->secondTeamGoals, $this->firstTeamGoals);
      }

  }
}
