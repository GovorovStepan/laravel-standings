<?php

namespace App\Models\Game;

class Result
{

    private const SCORE_WIN = 2;
    private const SCORE_DRAW = 1;
    private const SCORE_FAIL = 0;

    public function __construct(){

    }

  public function pointsForFirstTeam(): string
  {
      if ($this->firstTeamGoals === $this->secondTeamGoals) {
        return self::SCORE_DRAW;
      } elseif ($this->firstTeamGoals > $this->secondTeamGoals) {
        return self::SCORE_WIN;
      }

      return self::SCORE_FAIL;

  }

  public function pointsForSecondTeam(): string
  {

    if ($this->firstTeamGoals === $this->secondTeamGoals) {
      return self::SCORE_DRAW;
    } elseif ($this->firstTeamGoals > $this->secondTeamGoals) {
      return self::SCORE_WIN;
    }

    return self::SCORE_FAIL;
  }

  public function scoresForFirstTeam(): string
  {

      return sprintf('%d : %d', $this->goalsFirstTeam, $this->goalsSecondTeam);
  }

  public function scoresForSecondTeam(): string
  {

      return sprintf('%d : %d', $this->goalsSecondTeam, $this->goalsFirstTeam);
  }


}


 ?>
