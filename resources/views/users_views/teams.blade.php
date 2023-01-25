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
                        <th scope="col">Owner_name</th>
                        <th scope="col">Create at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teams->teams as $t)
                        
                            <tr data-id="{{ $t->id }}">
                                <th scope="row"> <a href="{{route('home.team',['team_id' => $t->id ])}}" class="nom-{{$t->id}}">{{$t->name}}</a> </th>
                                <td> {{$t->users[0]->name}}</td>
                                <td>{{$t->created_at->format('d/m/Y')}}</td>
                                <td><button type="button"class="btn btn-secondary"><a class="teams" href="{{route('teams.show', ['team' => $t->id])}}">Members </a></button></td>
                                <!-- <td> <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#cambia">Rename</button> -->
                                <td> <button type="button" data-name = "{{$t->name}}" data-id = "{{$t->id}}" class="btn btn-info cambia" >Rename</button>                    
                                <td><input type="button"  data-id_team ="{{$t->id}}" data-owner_id = "{{$t->owner_id}}" class="btn btn-danger delet" value="Delete"/></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal per rinominare una team -->
    <div class="modal fade" id="cambiamodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Rename Team</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{route('update')}}" method="post" id="editForm">
              @csrf
              <label for="name">Team name</label>
              <input type="text" name ="name" id="nome" placeholder="nuovo nome">
              <input type="hidden" name ="id" id="idd">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </form>
          </div>
        </div>
      </div> 
</div>
    <script>

        //modal edit
        $(document).on('click', '.cambia', function(e){
          e.preventDefault();

          let id = $(this).data('id');
          let name = $(this).data('name');

          $('#cambiamodal').modal('show');
          $('#nome').val(name);
          $('#idd').val(id);
        });

        //on submit modal, update the name
        $('#editForm').on('submit', function(e){
          e.preventDefault();

            let name = $('#nome').val();
            let id_team = $('input[name="id"]').val();
            let token = $('input[name="_token"]').val();
         
          /* console.log(id_team);
          console.log(name);
          console.log(token);
 */
          $.ajax({
            url:"{{route('update')}}",
            type:"POST",
            dataType: 'json',
            data: {
                'name' : name,
                'id_team' : id_team,
                '_token': token    
            },
            success: function(response){
                
              $('.nom-'+id_team).text(response.data);
              $('#cambiamodal').modal('hide');
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


      //ajax to cancel a team and old object relate to
      $(document).on('click', '.delet', function(e){
        e.preventDefault();

        let id_team = $(this).data("id_team");
        let owner_id = $(this).data("owner_id");
        let token = $('input[name="_token"]').val();

        //console.log(id_team);
        //console.log(owner_id);
        if(confirm("Do you really want to delete this team ?")){
          $.ajax({
              url:"{{route('deleteTeam', ['owner_id' =>"+owner_id+", 'id_team' =>"+id_team+"])}}",
              type:"POST",
              dataType: 'json',
              data: {
                  'id_team' : id_team,
                  'owner_id' : owner_id,   
                  '_token': token 
              },
              success: function(response){
                  
              $('tr[data-id="'+response.data+'"]').remove();
    
                //console.log(response.data);
              }, error: function(response, status){
                  console.log('error');
              }
            })
          }

      });

    </script>
   
</div>

@endsection