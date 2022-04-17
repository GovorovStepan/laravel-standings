<?php


namespace App\Models\Division;


use App\Models\Game\DivisionGame;
use App\Models\Team\Team;
use Illuminate\Support\Collection;

/**
 * Class for generating the divisions stage
 */
class Division
{

    private string $title;
    private Collection $teams;
    private Collection $games;

    public function __construct(string $title)
    {
        $this->title = $title;
        $this->games = new Collection();
        $this->teams = new Collection();
    }

    /**
     * @return PointsTable
     * The method generates the resulting table for division games.
     */
    public function generatePointsTable(): PointsTable
    {
        return new PointsTable($this);
    }

    /**
     * @return void
     * The method generates all games of this division.
     * Cyclically calls the game generation method for the team.
     */
    public function generateAllGames(): void
    {
        $this->teams->map(fn(Team $team) => $this->generateTeamGames($team));
    }

    /**
     * @param Team $team
     * @return void
     * The method generates games for one division team.
     */
    private function generateTeamGames(Team $team): void
    {
        foreach ($this->teams as $divisionTeam) {

            /*
             * If we are trying to generate a game with ourselves or a game that already exists,
             * then we skip the iteration.
             */
            if ($team->isEqual($divisionTeam) ||
                $this->findGameForTeams($team, $divisionTeam)) continue;

            $this->games->push(new DivisionGame($team, $divisionTeam));
        }
    }

    /**
     * @param Team $firstTeam
     * @param Team $secondTeam
     * @return DivisionGame|null
     * The method among all the games of the division finds the games in which two teams took part.
     */
    private function findGameForTeams(Team $firstTeam, Team $secondTeam): ?DivisionGame
    {
        $filteredGames = $this->games->filter(
            function ($game) use ($firstTeam, $secondTeam) {
                return $game->hasTeam($firstTeam) && $game->hasTeam($secondTeam);
            });

        return $filteredGames->isNotEmpty() ? $filteredGames->first() : null;
    }

    /**
     * @param Team $team
     * @return bool
     * The method checks if the team is included in the list of teams of the division.
     */
    private function hasTeam(Team $team): bool
    {
        foreach ($this->teams as $divisionTeam) {
            if ($team->isEqual($divisionTeam)) return true;
        }
        return false;
    }

    /**
     * @return array
     *  Getter for that divisions teams array
     */
    public function getTeams(): array
    {
        return $this->teams->all();
    }

    /**
     * @return string
     *  Getter for that divisions title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param Team $team
     * @return array
     * The method among all the games of the division finds the games in which the team took part.
     */
    public function findTeamGames(Team $team): array
    {
        return array_values(
            array_filter($this->games->all(), fn(DivisionGame $game) => $game->hasTeam($team))
        );
    }

    /**
     * @param Team ...$teams
     * @return void
     * Method for adding teams to the list of division teams.
     * Cyclically calls the add one command method.
     */
    public function addTeams(Team  ...$teams): void
    {
        foreach ($teams as $team) $this->addTeam($team);
    }

    /**
     * @param Team $team
     * @return void
     * Method for adding team to the list of division teams.
     */
    private function addTeam(Team $team): void
    {
        if ($this->hasTeam($team)) return;
        $this->teams->push($team);
    }


}

