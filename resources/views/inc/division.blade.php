<div class="container m3">
    <h2 class="text-center">{{ $table->getTitle() }}</h2>
    <table class="table table-striped">
        <tr>
            <th>Team</th>
            @foreach($table->getRows() as $row)
                <th>{{ $row->getTeam()->getTitle() }}</th>
            @endforeach
            <th>Score</th>
        </tr>
        @foreach($table->getRows() as $row)
            <tr>
                <th>{{ $row->getTeam()->getTitle() }}</th>
                @foreach($table->getRows() as $col)
                    <?php $game = $row->findGameForTeam($col->getTeam()) ?>
                    @if ($game)
                        <td>{{$game->getTeamScores($row->getTeam())}}</td>
                    @else
                        <td>-</td>
                    @endif
                @endforeach
                <th>{{ $row->getPoints() }}</th>
            </tr>

        @endforeach

    </table>
</div>
