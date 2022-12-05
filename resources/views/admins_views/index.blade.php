@extends('layout.layout')
@section('content')
<div class="po">
    <h2>Hi {{auth()->user()->name}}</h2>
    <p>Only for admins</p>
</div>
@endsection