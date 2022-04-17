<div class="container m3">
    <h2 class="text-center">Play OFF</h2>
    @foreach($data['schedule'] as $games)
        <?php $name = count($games) > 1 ? '1/' . count($games) : 'Final'; ?>
        <h3>{{$name}}</h3>
        <table class="table">
            @foreach($games as $game)
                <tr>
                    <th>{{ $game->getFirstTeam()->getTitle() }} - {{ $game->getSecondTeam()->getTitle()}}</th>
                    <td>{{ $game->getTeamScores($game->getFirstTeam()) }}</td>
                </tr>
            @endforeach
        </table>
    @endforeach

    <h1 class="text-center">The winner is {{$data['winner']->getTitle()}}</h1>
</div>
