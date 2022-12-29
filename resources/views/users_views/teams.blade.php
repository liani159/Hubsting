@extends('layout.layout_due')
@section('content_due')
<div class="main-container d-flex">
    <div class="sidebar" id=side_nav>
        <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
            <!-- <h1 class="fs-4">Hi {{auth()->user()->name}} </h1>  -->
            <h1 class="fs-3"> <span class="bg-white text-dark rounded shadow px-2 py-1 me-2">H_S</span>
            <span class="text-white"> <a href="{{route('home.index')}}" class="text-decoration-none text-white">HUBSTING </a></span>
            </h1>
            <button class="btn d-md-none d-block close-btn px-1 py-0 text-white fs-4"><i class="bi bi-list"></i></button>  
        </div>
        <ul class="list-unstyled px-2 text-center">
            <li class=""><a href="{{route('myPlan')}}" class="text-decoration-none plans">My plan  <i class="bi bi-credit-card text-white"></i></a></li>
            <li class=""><a href="{{route('teams.index')}}" class="text-decoration-none plans">Team <i class="bi bi-share text-white"></i></a> </li>
            <li class=""><a href="mailto:zeusfarm64@gmail.com" class="text-decoration-none plans">Contact us <i class="bi bi-person-lines-fill text-white"></i></a> </li>
            <li class=""><a href="#" class="text-decoration-none plans">Documentation <i class="bi bi-bookmark text-white"></i></a> </li>
        </ul>
    </div>

    <div class="content">
    <nav class="navbar navbar-expand-md bg-light">
      <div class="container-fluid">

        <div class="d-flex justify-content-between d-md-none d-block">
            <a href="{{route('home.index')}}" class="navbar-brand"> <span class="hub">hub</span><span class="text-warning">sting</span></a>
            <button class="btn px-1 py-0 open-btn"><i class="bi bi-list"></i></button> 
        </div>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto ">
          @auth 
            @if(auth()->user()->is_admin)
              <li class="nav-item">
                <a href="{{route('home.admin')}}" class="nav-link ps">{{__('Dashboard')}}</a>
              </li>
            @else
              <li class="nav-item">
                <a href="{{route('home.user')}}" class="nav-link">{{__('My section')}}</a>
              </li>
            @endif
              <li class="nav-item">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}</a>

                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                  </div>
                  </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="#">Profile</a>
            </li> -->
          @else
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="{{ route('login') }}">Log in</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('register')}}">Register</a>
            </li>
          @endauth
        </ul>
    </div>
  </div>
</nav>

<div class="container px-5 py-5">
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
            @if(session('message'))
              <div class="alert alert-danger py-4">
                {{ session('message') }}
              </div>
            @endif
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
    <script>
        $(".sidebar ul li").on('click', function(e){
            //e.preventDefault();
            $(".sidebar ul li.active").removeClass('active');
            $(this).addClass('active');
        });

        $(".open-btn").on("click", function(){
            $(".sidebar").addClass('active');
        });

        $(".close-btn").on("click", function(){
            $(".sidebar").removeClass('active');
        });
    </script>
   
</div>

@endsection