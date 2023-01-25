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
        @auth 
            @if(auth()->user()->is_admin)
              <ul class="list-unstyled px-2 text-center ">
                <li class=""><a href="{{route('admin.show_user')}}" class="text-decoration-none plans">Users <i class="bi bi-people"></i></a></li>
                <li class=""><a href="{{route('admin.show_teams_user')}}" class="text-decoration-none plans">Users Teams <i class="bi bi-share text-white"></i></a> </li>
                <li class=""><a href="{{route('teams.index')}}" class="text-decoration-none plans">My teams <i class="bi bi-person-lines-fill text-white"></i></a> </li>
                <li class=""><a href="{{route('admin.space')}}" class="text-decoration-none plans"> My Space <i class="bi bi-bookmark text-white"></i></a> </li>
              </ul>
            @else
              <ul class="list-unstyled px-2 text-center">
                <li class=""><a href="{{route('myPlan')}}" class="text-decoration-none plans">My plan  <i class="bi bi-credit-card text-white"></i></a></li>
                <li class=""><a href="{{route('teams.index')}}" class="text-decoration-none plans">Team <i class="bi bi-share text-white"></i></a> </li>
                <li class=""><a href="mailto:zeusfarm64@gmail.com" class="text-decoration-none plans">Contact us <i class="bi bi-person-lines-fill text-white"></i></a> </li>
                <li class=""><a href="#" class="text-decoration-none plans">Documentation <i class="bi bi-bookmark text-white"></i></a> </li>
              </ul>
            @endif
        @endauth
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
<h2 class="float-start"><a class="back" href="{{route('teams.index')}}">back</a></h2>
<div class="container px-5 py-5">
            <div class="row ps-3 "> 
                <form class="d-flex" role="search" action="{{route('members.store')}}" method="POST">
                    @csrf
                    <div class="col md-10 col sm-10">
                        <input class="form-control me-2" name="mail" type="search" placeholder="Enter email address of the new member" aria-label="Search"> 
                        <div class="form-error">
                            @error('mail')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="col md-1 col sm-1">
                    <fieldset disabled>
                    <input type="text" data-id="{{$id_team}}" id="disabledTextInput" class="form-control" placeholder="team_id: {{$id_team}}">
                    </fieldset>
                    <!-- <input class="form-control me-2" id="disabledTextInput" name="id_team" type="search" placeholder="{{$id_team}}" aria-label="Search"> -->
                    </div>
                    <div class="col md-1 col sm-1">
                        <input type="submit" id="btn-aggiungi" value="add to the current team" class="btn btn-primary"/>
                    </div>
                </form>  
            </div>

            <div class="row mb-2 p-2 border rounded  my-3 overflow-auto">
                <table class="table ex">
                    <thead>
                        <tr>
                        <th scope="col">name</th>
                        <th scope="col">email</th>
                        <th scope="col">add the</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($members->users as $user)
                        <tr data-id="{{ $user->id }}">
                        <td> {{$user->name}} </td>
                        <td> {{$user->email}}</td>
                        <td> {{$user->created_at->format('d/m/Y')}}</td>
                        <td>
                            @if($user->id === $owner_id)
                               <p class="text-center"> — </p>                             
                            @else
                                <input type="button" value="Delete member" data-id="{{$user->id}}" data-id_team = "{{$id_team}}"  class="btn btn-danger elimina"/>
                            @endif
                             <!-- <form class="take" action="{{route('deleteMember', ['id_team' => $id_team, 'id' => $user->id])}}" method="POST">
                            @csrf
                            <input type="submit" data-id="{{$user->id}}" data-id_team = "{{$id_team}}" value="Delete member" class="btn btn-danger elimina"/>
                        </form> -->
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   
</div>

<script type="application/javascript">

$('#btn-aggiungi').bind('click', function(e){
    e.preventDefault();
    /* let table = $('.ex').DataTable(); */
    let mail = $('input[name="mail"]').val();
    //let id_team = $('input[name="id_team"]').val();
    let id_team = $('#disabledTextInput').attr('data-id');
    let token = $('input[name="_token"]').val();
    //console.log(id_team);
    

    $.ajax({
        url:"{{route('members.store')}}",
        type:"POST",
        dataType: 'json',
        data: {
            'mail' : mail,
            'id_team' : id_team,
            '_token': token    
        },
        success: function(response){
            $('input[name="mail"]').val('');
            $('input[name="id_team"]').val('');

                /* table.draw(); */
            var newColId = $('<td/>', { text: response.data.name });                
            var newColNome = $('<td/>', { text: response.data.email });
            var newColSede = $('<td/>', { text: response.data.created_at });
            var newColAzioni = $('<td>'+'<button data-id="'+response.data.id+'" data-id_team = "'+id_team+'" class="btn btn-danger elimin">Delete member</button>');
            /* var newColAzioni = $('<td>'+' <form class="take" action="route('+'deleteMember'+', ['+'id_team'+' => '+id_team+', '+'id'+' =>'+response.data.id+'])" method="POST"> @csrf '+
                            '<input type="submit" data-id="'+response.data.id+'" data-id_team = "'+id_team+'" value="Delete member" class="btn btn-danger elimina"/>'+
                        '</form>'); */               
            /* var newColAzioni = $('<td>'+'<button class=" btn btn-danger elimina" data-id="'+response.data.id+'" data-id_team = "'+id_team+'" > Delete member </button>'); */
            var newRow = $('<tr data-id="'+response.data.id+'">');
            newRow.append(newColId).append(newColNome).append(newColSede).append(newColAzioni);

            $('tbody').append(newRow);
            console.log(response.data);
        }, error: function(response, statsus){
            console.log('');
        }
    })
});

$('.elimina').bind('click', function(e){
    e.preventDefault();
    /* let table = $('.ex').DataTable(); */
    let id =  $(this).attr('data-id');
    let team_id = $(this).attr('data-id_team');
    let token = $('input[name="_token"]').val();
    console.log(team_id);
    console.log(id);

    $.ajax({
        url:"{{route('deleteMember', ['id' =>"+id+", 'id_team' =>"+team_id+"])}}",
        type:"GET",
        dataType: 'json',
        data: {
            'id': id,
            'id_team': team_id,
            '_token': token    
        },success: function(response){
            $('tr[data-id="'+id+'"]').remove();
            /* table.draw(); */
            console.log(response.data);
        }, error: function(response, status){
            console.log('error');
        }
    })

}); 

$(document).on('click','.elimin', function(e){
    e.preventDefault();
    /* let table = $('.ex').DataTable(); */
    let id =  $(this).attr('data-id');
    let team_id = $(this).attr('data-id_team');
    let token = $('input[name="_token"]').val();
    console.log(team_id);
    console.log(id);

    $.ajax({
        url:"{{route('deleteMember', ['id' =>"+id+", 'id_team' =>"+team_id+"])}}",
        type:"GET",
        dataType: 'json',
        data: {
            'id': id,
            'id_team': team_id,
            '_token': token    
        },success: function(response){
            $('tr[data-id="'+id+'"]').remove();
            /* table.draw(); */
            console.log(response.data);
        }, error: function(response, status){
            console.log('error');
        }
    })

}); 

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

@endsection