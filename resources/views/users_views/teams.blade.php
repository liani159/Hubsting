@extends('layout.layout')
@section('content')
<div class="row menu">
    <div class="col-md-2 py-2 text-center text-light l1 border">
                <h2>Hi {{auth()->user()->name}} </h2> <br><br>
                <a href="#" class="plans">My plan</a> <br><br>
                <a href="{{route('teams.index')}}" class="plans">Team</a><br><br>
                <a href="#" class="plans">Contact us</a><br><br>
                <a href="" class="plans">Documentation</a><br><br>
                <!-- <a href="#" class="plans">log out</a> <br><br> -->
                
    </div>
    <div class="col text-center my-4 md-10">
        <div class="container">
            <div class="row ps-3 ">
                <div class="col md-11">
                    <form method="POST" action="{{route('teams.store')}}" class="d-flex" role="search">
                        @csrf
                        <input type="text" name="name" class="form-control me-2" type="search" placeholder="Enter Team name" aria-label="Search"> 
                        <div class="form-error">
                            @error('name')
                                {{$message}}
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Create new team</button>
                    </form>
                </div>
                <!-- <div class="col md-1"> <div class="btn btn-primary">Create new team</div> -->
            </div>

            <div class="row mb-2 p-2 border rounded  my-3 overflow-auto">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Team Name</th>
                        <th scope="col">Owner_id</th>
                        <th scope="col">Create at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teams->teams as $t)
                        
                            <tr>
                                <th scope="row"> <a href="{{route('home.team',['team_id' => $t->id ])}}">{{$t->name}}</a> </th>
                                <td>{{$t->owner_id}}</td>
                                <td>{{$t->created_at->format('d/m/Y')}}</td>
                                <td><button type="button"class="btn btn-secondary"><a class="teams" href="{{route('teams.show', ['team' => $t->id])}}">Members </a></button></td>
                                <td> <button type="button" class="btn btn-info">Rename</button> </td>
                                <td><button type="button" class="btn btn-danger">Delete</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   
</div>

@endsection