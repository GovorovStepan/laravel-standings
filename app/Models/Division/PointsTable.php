<?php

namespace App\Models\Division;


class PointsTable
{
    private const  NUMBER_OF_PLAYOFF_TEAMS = 4; // The number of teams advancing from the division to the playoff. Must be a multiple of 4
    private string $title;
    private array $teamsForPlayOff; // The teams advancing from the division to the playoff.
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

    /**
     * @return string
     * Getter for table title
     */
    public function getTitle(): string
    {
        return $this->title;
    }


    /**
     * @return void
     * The method sorts the rows of the table depending on the score of the team.
     */
    private function sort(): void
    {
        usort($this->rows, fn(TableRow $a, TableRow $b) => $a->getPoints() > $b->getPoints() ? -1 : 1);
    }

    /**
     * @return void
     * The method determines from the table which teams made it to the playoff.
     */
    private function findTeamsForPlayOff(): void
    {
        $this->teamsForPlayOff = array_map(fn(TableRow $row) => $row->getTeam(),
            array_slice($this->rows, 0, self::NUMBER_OF_PLAYOFF_TEAMS));
    }

    /**
     * @return array
     * Getter for list of teams advancing from the division to the playoff
     */
    public function getTeamsForPlayOff(): array
    {
        return $this->teamsForPlayOff;
    }

    /**
     * @return array
     * Getter for table rows
     */
    public function getRows(): array
    {
        return $this->rows;
    }


}


