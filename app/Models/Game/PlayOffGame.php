<?php

namespace App\Models\Game;

use App\Models\Team\Team;

/**
 * Playoff stage game class
 */
class PlayOffGame extends Game
{
    private Team $winner;

    public function __construct(Team $firstTeam, Team $secondTeam)
    {
        // parent constructor call
        parent::__construct($firstTeam, $secondTeam);
        $this->winner = $this->findWinner();

    }

    /**
     * @return Team
     * Method for determining the winner. In playoff games, points are not important.
     * And goals cannot be equal
     */
    private function findWinner(): Team
    {
        return $this->firstTeamGoals > $this->secondTeamGoals ?
            $this->firstTeam : $this->secondTeam;
    }

    /**
     * @return Team
     * $this->winner getter
     */
    public function getWinner(): Team
    {
        return $this->winner;
    }

    /**
     * @return void
     * @throws \Exception
     * Overriding the main class generation method
     */
    protected function generateGoals(): void
    {
        $goals = [random_int(0, 5), random_int(0, 5)];
        if ($goals[0] === $goals[1]) $goals[array_rand($goals)]++;

        $this->firstTeamGoals = $goals[0];
        $this->secondTeamGoals = $goals[1];
    }
}
