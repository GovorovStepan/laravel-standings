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

      // usort($this->rows, fn(ScoreTableRow $a, ScoreTableRow $b) => $a->points() > $b->points() ? -1 : 1);
  }


  public function getRows(): array
  {
      return $this->rows;
  }



}


 ?>
