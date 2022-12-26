@extends('layout.layout')
@section('content')
<!-- <div class="po">
    <h2>Hi {{auth()->user()->name}}</h2>
    <p>Only for users</p>
</div> -->



<div class="container-fluid text-center text-dark grande">

        <!-- livewire component che contiene la vista della team selezionata -->
        <livewire:file-team-browser :obj="$obj" :ancestors="$ancestors" :team_id="$team_id">
    
</div>
@endsection