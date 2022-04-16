<?php

namespace App\Models\PlayOff;


class PlayOff
{

  private $firstDivisionTeams;
  private $secondDivisionTeams;
  private $winner;

  function __construct(array $firstDivisionTeams,  array $secondDivisionTeams)
  {
      $this->firstDivisionTeams = $firstDivisionTeams;
      $this->secondDivisionTeams = $secondDivisionTeams;
  }



}




 ?>
