<?php

namespace App\Models\PlayOff;

use App\Models\Game\PlayOffGame;
use App\Models\Team\Team;
use Illuminate\Support\Collection;

/**
 * Class for generating the playoff stage
 */
class PlayOff
{

    private Collection $firstDivisionTeams;
    private Collection $secondDivisionTeams;
    private array $gamesSchedule;
    private Team $winner;

    public function __construct(array $firstDivisionTeams, array $secondDivisionTeams,)
    {
        $this->firstDivisionTeams = new Collection($firstDivisionTeams); //First division winners
        $this->secondDivisionTeams = new Collection($secondDivisionTeams); //Second division winners
        $this->generateGamesSchedule();
        $this->findWinner(end($this->gamesSchedule)[0]);
    }

    /**
     * @return void
     * The wrapper method calls two other generation methods in itself.
     * As a result, we get a "schedule" of games
     */
    private function generateGamesSchedule(): void
    {
        $this->generateFirstGames();
        while (count(end($this->gamesSchedule)) !== 1) {
            $lastKey = array_key_last($this->gamesSchedule);

            $this->generateRemainingLevels($lastKey + 1, $lastKey);
        }
    }

    /**
     * @return void
     * Method for generating team formations for the first games.
     * We put the strongest from one division with the weakest from another
     */
    private function generateFirstGames(): void
    {
        foreach ($this->firstDivisionTeams as $team) {
            $this->gamesSchedule[0][] = new PlayOffGame($team, $this->secondDivisionTeams->pop());
        }
    }

    /**
     * @param $level
     * @param $lastLevel
     * @return void
     * The method is used to generate games after receiving the results of the first series.
     * Thus, we go further with the 'Herringbone' and the winners of the previous stages play among themselves
     */
    private function generateRemainingLevels($level, $lastLevel): void
    {
        for ($i = 0; $i < count($this->gamesSchedule[$lastLevel]); $i += 2) {
            $this->gamesSchedule[$level][] = new PlayOffGame(
                $this->gamesSchedule[$lastLevel][$i]->getWinner(),
                $this->gamesSchedule[$lastLevel][$i + 1]->getWinner()
            );
        }

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
     * @param $lastGame
     * @return void
     * Method for finding a champion.
     * Just get the winner from the last game played
     */
    private function findWinner($lastGame): void
    {
        $this->winner = $lastGame->getWinner();
    }

    /**
     * @return array
     *  $this->gamesSchedule getter
     */
    public function getGamesSchedule(): array
    {
        return $this->gamesSchedule;
    }


}




