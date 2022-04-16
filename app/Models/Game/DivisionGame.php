<?php

namespace App\Models\Game;

class DivisionGame extends Game
{
  private Result $result;

  public function __construct (Team $firstTeam, Team $secondTeam, $goals) {
		// Вызов базового конструктора
		parent::__construct($firstTeam, $secondTeam);
    $this->result = new Result($goals);

	}

  /**
    * Метод возвращает очки набранные командой в ходе игры дивизиона
    *
    */
  public function getTeamPoints(Team $team): int
  {
      if ($this->firstTeam->isEqual($team))
      {
          return $this->result->pointsForTeam();
      }

      elseif ($this->secondTeam->isEqual($team))
      {
          return $this->result->pointsForTeam(false);
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
          return $this->result->scoresForFirstTeam();
      }

      if ($this->secondTeam->isEqual($team))
      {
          return $this->result->scoresForSecondTeam();
      }

  }
}
