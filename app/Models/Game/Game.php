<?php

namespace App\Models\Game;

use App\Models\Team\Team;

class Game
{

    protected Team $firstTeam;
    protected Team $secondTeam;
    protected int $firstTeamGoals;
    protected int $secondTeamGoals;


    public function __construct(Team $firstTeam, Team $secondTeam)
    {
        $this->firstTeam = $firstTeam;
        $this->secondTeam = $secondTeam;
        $this->generateGoals();
    }

    /**
     * @return void
     * @throws \Exception
     * The method generates goals (result) for the game.
     */
    protected function generateGoals(): void
    {
        $this->firstTeamGoals = random_int(0, 5);
        $this->secondTeamGoals = random_int(0, 5);
    }

    /**
     * @param Team $team
     * @return bool
     * The method checks if the team took part in the game.
     */
    public function hasTeam(Team $team): bool
    {
        return $team->isEqual($this->firstTeam) || $team->isEqual($this->secondTeam);
    }

    /**
     * @param Team $team
     * @return string|null
     * The method returns the score of the game relative to the team.
     */
    public function getTeamScores(Team $team): ?string
    {
        if ($this->firstTeam->isEqual($team)) {
            return Result::scoresForTeam(
                $this->firstTeamGoals, $this->secondTeamGoals);
        }

        if ($this->secondTeam->isEqual($team)) {
            return Result::scoresForTeam(
                $this->secondTeamGoals, $this->firstTeamGoals);
        }


        return null;

    }

    /**
     * @return Team
     * $this->firstTeam getter
     */
    public function getFirstTeam(): Team
    {
        return $this->firstTeam;
    }

    /**
     * @return Team
     * $this->secondTeam getter
     */
    public function getSecondTeam(): Team
    {
        return $this->secondTeam;
    }

    /**
     * @return int
     * $this->firstTeamGoals getter
     */
    public function getFirstTeamGoals(): int
    {
        return $this->firstTeamGoals;
    }

    /**
     * @return int
     * $this->secondTeamGoals getter
     */
    public function getSecondTeamGoals(): int
    {
        return $this->secondTeamGoals;
    }
}

