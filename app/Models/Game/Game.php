<?php

namespace App\Models\Game;

use App\Exceptions\TeamNotPlayInGameException;
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

    protected function generateGoals(): void
    {
    $this->firstTeamGoals = random_int(0, 5) ;
    $this->secondTeamGoals = random_int(0, 5) ;
    }

    public function hasTeam(Team $team): bool
    {
      return $team->isEqual($this->firstTeam) || $team->isEqual($this->secondTeam);
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

    public function getFirstTeam(): Team
    {
      return $this->firstTeam;
    }
    public function getSecondTeam(): Team
    {
      return $this->secondTeam;
    }
    public function getFirstTeamGoals(): int
    {
      return $this->firstTeamGoals;
    }
    public function getSecondTeamGoals(): int
    {
      return $this->secondTeamGoals;
    }
}

