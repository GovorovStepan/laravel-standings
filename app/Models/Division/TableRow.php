<?php

namespace App\Models\Division;

use App\Models\Game\DivisionGame;
use App\Models\Team\Team;

/**
 * Division scoreboard string class.
 * The line contains the team and all the games for it, as well as how many points the team scored for these games.
 */
class TableRow
{

    private Team $team;
    private array $games;
    private int $points = 0;

    public function __construct(Team $team, array $games)
    {
        $this->team = $team;
        $this->games = $games;

        foreach ($this->games as $game) {
            $this->points += $game->getTeamPoints($team);
        }
    }

    /**
     * @param Team $team
     * @return DivisionGame|null
     * The method is used when rendering a row. A team finds a game with another team.
     */
    public function findGameForTeam(Team $team): ?DivisionGame
    {
        if ($this->team->isEqual($team)) {
            return null;
        }

        foreach ($this->games as $game) {
            if ($game->hasTeam($team)) {
                return $game;
            }
        }

        return null;
    }


    /**
     * @return int
     * Getter for team points
     */
    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * @return array
     * Getter for row games
     */
    public function getGames(): array
    {
        return $this->games;
    }

    /**
     * @return Team
     * Getter for row team
     */
    public function getTeam(): Team
    {
        return $this->team;
    }


}
