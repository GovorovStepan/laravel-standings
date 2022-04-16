@extends('layouts.app')

@section('title', "Main")

@section('content')
  @foreach($divisionsTables as $table)
    @component('inc.division', ['table'=>$table])@endcomponent
  @endforeach


@endsection
