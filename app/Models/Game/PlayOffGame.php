<?php

namespace App\Models\Game;

class PlayOffGame extends Game
{
    private Team $winner;

    public function __construct (Team $firstTeam, Team $secondTeam, $goals) {
      // Вызов базового конструктора
      parent::__construct($firstTeam, $secondTeam);
      $this->winner = $this->findWinner($goals);

    }

    /**
      * Метод поиска победителя, так как в играх плей офф не важны очки и счет * не может быть равным
      */
    private function findWinner(){

    }
}
