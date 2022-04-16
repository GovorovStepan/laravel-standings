@extends('layouts.app')

@section('title', "Main")

@section('content')
  @foreach($devisionsTables as $table)
    @component('inc.devision', ['table'=>$table])@endcomponent
  @endforeach


@endsection
