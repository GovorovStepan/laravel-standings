<?php

namespace App\Models\Game;

use App\Models\Team\Team;

class PlayOffGame extends Game
{
    private Team $winner;

    public function __construct (Team $firstTeam, Team $secondTeam) {
      // Вызов базового конструктора
      parent::__construct($firstTeam, $secondTeam);
      $this->winner = $this->findWinner();

    }

    /**
      * Переопределяем метод генерации основного класса
      *
      */
    protected function generateGoals() : void
    {
        $goals = [random_int(0, 5), random_int(0, 5)];
        if ($goals[0] === $goals[1]) $goals[array_rand($goals)]++;

        $this->firstTeamGoals = $goals[0] ;
        $this->secondTeamGoals = $goals[1] ;
    }

    /**
      * Метод поиска победителя, так как в играх плей офф не важны очки и счет
      * не может быть равным
      */
    private function findWinner(): Team
    {
        return $this->firstTeamGoals > $this->secondTeamGoals ?
        $this->firstTeam : $this->secondTeam;
    }


    public function getWinner(): Team
    {
        return $this->winner;
    }
}
