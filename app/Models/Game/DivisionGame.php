<?php

namespace App\Models\Game;

use App\Models\Team\Team;

/**
 * Division stage game class
 */
class DivisionGame extends Game
{

    /**
     * @param Team $team
     * @return int|null
     * The method returns the points scored by the team during the division game.
     */
    public function getTeamPoints(Team $team): ?int
    {

        if ($team->isEqual($this->firstTeam)) {
            return Result::pointsForTeam(
                $this->firstTeamGoals, $this->secondTeamGoals);
        }

        if ($team->isEqual($this->secondTeam)) {
            return Result::pointsForTeam(
                $this->secondTeamGoals, $this->firstTeamGoals);
        }
        return null;
    }
}
