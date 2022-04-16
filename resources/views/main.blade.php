@extends('layouts.app')

@section('title', "Main")

@section('content')
  @foreach($divisions as $division)
    @component('inc.division', ['table'=>$division])@endcomponent
  @endforeach

  @component('inc.playoff', ['data'=>$playOff])@endcomponent

@endsection
