@extends('layout.layout_due')
@section('content_due')
<div class="container-fluid text-center text-dark grande">

        <!-- livewire component che contiene la vista dell'user -->
        <livewire:file-browser :obj="$obj" :ancestors="$ancestors">
    
</div>
@endsection
