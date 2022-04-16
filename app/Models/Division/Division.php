<?php


namespace App\Models\Division;


use Illuminate\Support\Collection;
use App\Models\Game\DivisionGame;
use App\Models\Team\Team;

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

    public function generatePointsTable()
    {
        return new PointsTable($this);
    }

    public function generateAllGames() : void
    {
        $this->teams->map(fn(Team $team) => $this->generateTeamGames($team));
    }

    public function getGames(){
        return $this->games->all();
    }

    public function getTeams(){
        return $this->teams->all();
    }

    public function getTitle(){
        return $this->title;
    }

    public function findTeamGames(Team $team): array
    {
        return array_values(
            array_filter($this->games->all(), fn(DivisionGame $game) => $game->hasTeam($team))
        );
    }


    private function generateTeamGames(Team $team) : void
    {
        foreach ($this->teams as $divisionTeam) {

            if ($team->isEqual($divisionTeam)||
                $this->findGameForTeams($team, $divisionTeam)) continue;

            $this->games->push(new DivisionGame($team, $divisionTeam ));
        }
    }


    private function findGameForTeams(Team $firstTeam, Team $secondTeam): ?DivisionGame
    {
        $filteredGames = $this->games->filter(
          function ($game) use ($firstTeam, $secondTeam) {
            return $game->hasTeam($firstTeam) && $game->hasTeam($secondTeam);
        });

        return $filteredGames->isNotEmpty() ? $filteredGames->first() : null;
    }


    public function addTeams(Team  ...$teams): void
    {
        foreach ($teams as $team) $this->addTeam($team);
    }

    private function addTeam(Team $team): void
    {
        if ($this->hasTeam($team)) return;
        $this->teams->push($team);
    }

    private function hasTeam(Team $team): bool
    {
        foreach ($this->teams as $divisionTeam) {
            if ($team->isEqual($divisionTeam)) return true;
        }
        return false;
    }


}

 ?>
