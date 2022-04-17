@extends('layouts.app')

@section('title', "Standings")

@section('content')
    <a href="/" class="btn btn-outline-primary">Back to Start</a>
    @foreach($divisions as $division)
        @component('inc.division', ['table'=>$division])@endcomponent
    @endforeach

    @component('inc.playoff', ['data'=>$playOff])@endcomponent

@endsection
