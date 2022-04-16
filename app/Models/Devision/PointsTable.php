<?php

namespace App\Models\Devision;

use App\Models\Devision\Devision;
use App\Models\Devision\TableRow;
use App\Models\Team\Team;

class PointsTable
{
  private string $title;

  private array $rows = [];

  public function __construct(Devision $devision)
  {
      $this->title = $devision->getTitle();

      foreach ($devision->getTeams() as $team) {
          $this->rows[] = new TableRow($team, $devision->findTeamGames($team));
      }

      $this->sort();
  }

  private function sort(){
    usort($this->rows, fn(TableRow $a, TableRow $b) => $a->getPoints() > $b->getPoints() ? -1 : 1);
  }


  public function getRows(): array
  {
      return $this->rows;
  }

  public function getTitle(): string
  {
      return $this->title;
  }



}


 ?>
