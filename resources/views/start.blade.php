@extends('layouts.app')

@section('title', "Start")

@section('content')
<div class="wrapper">
    <div class="start_card">
        <h1>DIVISION AND PLAYOFF GAMES GENERATOR</h1>
        <div class="buttons">
            <a href="/main" class="btn btn-warning btn-lg">Generate New</a>
            <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle btn-lg" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    Watch previous generations
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    @if ($previousGenerations)
                        @foreach($previousGenerations as $generation)
                            <li><a class="dropdown-item" href="/generation/{{$generation->generationId}}"><h6>{{$generation->generationId}}</h6> from {{$generation->created_at}}</a></li>
                        @endforeach
                    @else
                        <li><p>Generate something first</p></li>
                    @endif
                </ul>
            </div>
        </div>



    </div>


</div>

@endsection
