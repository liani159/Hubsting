@extends('layout.layout_due')
@section('content_due')

<div class="container-fluid text-center text-dark grande">

        <!-- livewire component che contiene la vista della team selezionata -->
        <livewire:file-team-browser :obj="$obj" :ancestors="$ancestors" :team_id="$team_id">
    
</div>
@endsection