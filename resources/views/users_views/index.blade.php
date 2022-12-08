@extends('layout.layout')
@section('content')
<!-- <div class="po">
    <h2>Hi {{auth()->user()->name}}</h2>
    <p>Only for users</p>
</div> -->



<div class="container-fluid text-center text-dark grande">
    
        <!-- livewire component che contiene la vista dell'user -->
        <livewire:file-browser :obj="$obj" :ancestors="$ancestors" />
    
</div>
@endsection
