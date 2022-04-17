<?php

namespace App\Models\Game;

/**
 * Class for finding team scores and division scores
 */
abstract class Result
{

    private const SCORE_WIN = 2;
    private const SCORE_DRAW = 1;
    private const SCORE_FAIL = 0;


    /**
     * @param $teamGoals
     * @param $opponentGoals
     * @return int
     * Method for finding points received by a team for a match, depending on the outcome of the match
     */
    public static function pointsForTeam($teamGoals, $opponentGoals): int
    {

        if ($teamGoals === $opponentGoals) {
            return self::SCORE_DRAW;
        }

        if ($teamGoals > $opponentGoals) {
            return self::SCORE_WIN;
        }

        return self::SCORE_FAIL;

    }

    /**
     * @param $teamGoals
     * @param $opponentGoals
     * @return string
     * The method displays the score for the game relative to the team.
     * Used to render the score in the division scoreboard
     */
    public static function scoresForTeam($teamGoals, $opponentGoals): string
    {
        return sprintf('%d : %d', $teamGoals, $opponentGoals);
    }


}


?>
