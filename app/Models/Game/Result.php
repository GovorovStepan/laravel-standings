<?php

namespace App\Models\Game;

class Result
{

    private const SCORE_WIN = 2;
    private const SCORE_DRAW = 1;
    private const SCORE_FAIL = 0;

    private $firstTeamGoals;
    private $secondTeamGoals;

    public function __construct($goals){
        $this->firstTeamGoals = $goals['firstTeam'];
        $this->secondTeamGoals = $goals['secondTeam'];
    }




    public function pointsForTeam($isFirstTeam = true): int
    {

        if ($this->firstTeamGoals === $this->secondTeamGoals) {
          return self::SCORE_DRAW;
        }

        elseif ($this->firstTeamGoals > $this->secondTeamGoals) {
          return $isFirstTeam ? self::SCORE_WIN : self::SCORE_FAIL ;
        }

        return $isFirstTeam ? self::SCORE_FAIL : self::SCORE_WIN;

    }


    public function scoresForTeam($isFirstTeam = true): string
    {
      if($isFirstTeam){
        return sprintf('%d : %d', $this->firstTeamGoals, $this->secondTeamGoals);
      } else {
        return sprintf('%d : %d', $this->secondTeamGoals, $this->firstTeamGoals);
      }
    }



}


 ?>
