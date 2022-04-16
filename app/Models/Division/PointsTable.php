<?php

namespace App\Models\Division;

use App\Models\Division\Division;
use App\Models\Division\TableRow;
use App\Models\Team\Team;

class PointsTable
{
  private string $title;

  private array $rows = [];

  public function __construct(Division $division)
  {
      $this->title = $division->getTitle();

      foreach ($division->getTeams() as $team) {
          $this->rows[] = new TableRow($team, $division->findTeamGames($team));
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
