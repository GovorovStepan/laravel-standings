<?php

namespace App\Models\Division;

use App\Models\Division\Division;
use App\Models\Division\TableRow;
use App\Models\Team\Team;

class PointsTable
{
    private string $title;
    private array $teamsForPlayOff;
    private const  NUMBER_OF_PLAYOFF_TEAMS = 4;

    private array $rows = [];

    public function __construct(Division $division)
    {
      $this->title = $division->getTitle();

      foreach ($division->getTeams() as $team) {
          $this->rows[] = new TableRow($team, $division->findTeamGames($team));
      }

      $this->sort();
      $this->findTeamsForPlayOff();
    }

    private function sort(): void
    {
    usort($this->rows, fn(TableRow $a, TableRow $b) => $a->getPoints() > $b->getPoints() ? -1 : 1);
    }

    public function getTeamsForPlayOff() : array
    {
        return $this->teamsForPlayOff;
    }

    private function findTeamsForPlayOff() : void
    {
      $this->teamsForPlayOff = array_map(
          fn(TableRow $row) => $row->getTeam(),
          array_slice($this->rows, 0, self::NUMBER_OF_PLAYOFF_TEAMS ));
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
