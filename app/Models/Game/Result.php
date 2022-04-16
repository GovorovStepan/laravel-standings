<?php

namespace App\Models\Game;

class Result
{

    private const SCORE_WIN = 2;
    private const SCORE_DRAW = 1;
    private const SCORE_FAIL = 0;


    public static function pointsForTeam($teamGoals, $opponentGoals): int
    {

        if ($teamGoals === $opponentGoals) {
          return self::SCORE_DRAW;
        }

        if ($teamGoals > $opponentGoals) {
          return self::SCORE_WIN ;
        }

        return self::SCORE_FAIL ;

    }


    public static function scoresForTeam($teamGoals, $opponentGoals): string
    {
        return sprintf('%d : %d', $teamGoals, $opponentGoals);
    }



}


 ?>
