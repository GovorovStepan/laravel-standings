<?php

namespace App\Models\PlayOff;

use Illuminate\Support\Collection;
use App\Models\Game\PlayOffGame;
use App\Models\Team\Team;

class PlayOff
{

   private Collection $firstDivisionTeams;
   private Collection $secondDivisionTeams;
   private array $gamesSchedule;
   private Team $winner;

   public function __construct(array $firstDivisionTeams,  array $secondDivisionTeams)
   {
       $this->firstDivisionTeams = new Collection($firstDivisionTeams);
       $this->secondDivisionTeams = new Collection($secondDivisionTeams);
       $this->generateGamesSchedule();
       $this->findWinner(end($this->gamesSchedule)[0]);
   }

    private function findWinner($lastGame): void
    {
        $this->winner = $lastGame->getWinner();
    }

   private function generateGamesSchedule(): void
   {
       $this->generateFirstGames();
       while(count(end($this->gamesSchedule)) !== 1){
           $lastKey = array_key_last($this->gamesSchedule);

           $this->generateRemainingLevels($lastKey+1, $lastKey);
       }
   }

   private function generateRemainingLevels($level, $lastLevel): void
   {
       for ($i = 0; $i < count($this->gamesSchedule[$lastLevel]); $i+=2)
       {
           $this->gamesSchedule[$level][] = new PlayOffGame(
               $this->gamesSchedule[$lastLevel][$i]->getWinner(),
               $this->gamesSchedule[$lastLevel][$i+1]->getWinner()
           );
       }

   }

    private function generateFirstGames(): void
    {
        foreach ($this->firstDivisionTeams as $team){
            $this->gamesSchedule[0][] = new PlayOffGame($team,$this->secondDivisionTeams->pop());
        }
    }



    /**
     * @return Collection
     */
    public function getFirstDivisionTeams(): Collection
    {
        return $this->firstDivisionTeams;
    }

    /**
     * @return Collection
     */
    public function getSecondDivisionTeams(): Collection
    {
        return $this->secondDivisionTeams;
    }

    /**
     * @return array
     */
    public function getGamesSchedule(): array
    {
        return $this->gamesSchedule;
    }

    /**
     * @return Team
     */
    public function getWinner(): Team
    {
        return $this->winner;
    }





}




