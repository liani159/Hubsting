
<div class="main-container d-flex">
    <div class="sidebar" id=side_nav>
        <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
            <!-- <h1 class="fs-4">Hi {{auth()->user()->name}} </h1>  -->
            <h1 class="fs-3"> <span class="bg-white text-dark rounded shadow px-2 py-1 me-2">H_S</span>
            <span class="text-white"> <a href="{{route('home.index')}}" class="text-decoration-none text-white">HUBSTING </a></span>
            </h1>
            <button class="btn d-md-none d-block close-btn px-1 py-0 text-white fs-4"><i class="bi bi-list"></i></button>  
        </div>
        <ul class="list-unstyled px-2 ">
            <li class=""><a href="#" class="text-decoration-none plans">My plan</a> <i class="bi bi-credit-card text-white"></i></li>
            <li class=""><a href="{{route('teams.index')}}" class="text-decoration-none plans">Team <i class="bi bi-share text-white"></i></a> </li>
            <li class=""><a href="#" class="text-decoration-none plans">Contact us <i class="bi bi-person-lines-fill text-white"></i></a> </li>
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

    <!-- <h2 class="float-start"><a class="back" href="{{route('home.team', ['team_id' => $team_id])}}">back</a></h2> -->
        <div class="container px-5 py-5">
            <div class="row mb-2 p-2 border rounded folder">
                <div class="col-md-7 seachbar">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> 
                    </form>
                </div>
                <div class="col-md-3  new folder">
                    <button wire:click = "$set('creatingNewFolder', true)" type="button" class="btn btn-secondary">New Folder</button>
                </div>
                <div class="col-md-2  upload">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Upload</button> 
                </div>
            </div>
            <div class="row mb-2 p-2 border rounded table-info">
                @foreach($ancestors as $an)
                    <div class="text-primary">
                        <a class = "mx-3 float-start cump" href="{{route('home.team', ['team_id' => $team_id, 'uuid' => $an->uuid])}}">
                            {{$an->objectable->name}}    @if(!$loop->last)> @endif
                        </a> 
                    </div>
                @endforeach

                <div class="col md-12 overflow-auto">
                    <table class="table ">
                        <thead>
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Size</th>
                            <th scope="col">Created</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @if($creatingNewFolder)
                                <tr>
                                    <td>
                                        <form wire:submit.prevent="createFolder" class="d-flex" role="search">   
                                            
                                            <input wire:model="newFolderState.name"  class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> 
                                            <button type="submit" class="btn btn-primary">Create</button> 
                                            <button wire:click = "$set('creatingNewFolder', false)" type="button" class="btn btn-secondary">Cancel</button> 
                                        </form>
                                    </td>
                                </tr>
                            @endif

                            @foreach($obj->children as $child)
                                <tr>
                                    <!-- <i class="bi bi-files-primary p-1"> </i> -->
                                    <th scope="row">    
                                    <!-- {{json_encode($renamingObjectState) }} -->
                                        @if($renamingObject === $child->id ) 
                                            <form wire:submit.prevent="renameObject" class="d-flex" role="search">   
                                                
                                                <input wire:model="renamingObjectState.name"  class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> 
                                                <button type="submit" class="btn btn-primary">Rename</button> 
                                                <button wire:click = "$set('renamingObject', '')" type="button" class="btn btn-secondary">Cancel</button> 
                                            </form>
                                        @else                                
                                            @if($child->objectable_type === 'folder')
                                                <a href="{{route('home.team', ['team_id' => $team_id, 'uuid' => $child->uuid])}}"><i class="bi bi-folder p-1"></i>{{$child->objectable->name}}</a>
                                            @else 
                                                <a href="{{route('download', $child->objectable)}}"><i class="bi bi-files p-1"> </i>{{$child->objectable->name}}</a>
                                            @endif
                                        @endif
                                    </th>
                                        <td>
                                            @if($child->objectable_type === 'folder')
                                                &minus;
                                            @else
                                                {{$child->objectable->sizeForHumans()}}
                                            @endif
                                        </td>
                                        <td>{{$child->objectable->created_at->format('d/m/Y')}}</td>
                                        <td> <button wire:click = "$set('renamingObject', {{$child->id}})" type="button" class="btn btn-secondary">Rename</button></td>
                                        <td> <button wire:click = "$set('confirmObjectDeletion', {{$child->id}})" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete">Delete</button></td>
                                        
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($obj->children->count()===0)
                        <div class="empty">
                            This folder is empty
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <br>
        <p> Only for users view</p>
    </div>

<!-- deletion -->
<!-- Button trigger modal -->
    <div wire:ignore.self class="modal fade" id="delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" >Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you really want to delete this ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button wire:click = "deleteObject" type="button" data-bs-dismiss="modal" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
<!-- fine deletion -->

    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload File</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" wire:ignore
                        x-data="{
                            initFilepond(){
                            const pond = FilePond.create(this.$refs.filepond, {
                                server:{
                                        process:(fieldName, file, metdata, load, error, progress, abort,
                                        transfer, options) => {
                                            @this.upload('upload', file, load, error, progress)

                                        }
                                }
                            })
                            }
                            }"
                        x-init="initFilepond">

                    <div><input type="file" x-ref="filepond" multiple></div>
        
                </div>
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
