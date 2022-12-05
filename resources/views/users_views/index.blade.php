@extends('layout.layout')
@section('content')
<!-- <div class="po">
    <h2>Hi {{auth()->user()->name}}</h2>
    <p>Only for users</p>
</div> -->



<div class="container-fluid text-center text-dark grande">
    <div class="row menu">
        <div class="col-md-2 py-2 text-light l1 border">
            <h2>Hi {{auth()->user()->name}} </h2> <br><br>
            <a href="#" class="plans">My plan</a> <br><br>
            <a href="#" class="plans">Team</a><br><br>
            <a href="#" class="plans">Contact us</a><br><br>
            <a href="" class="plans">Documentation</a><br><br>
            <!-- <a href="#" class="plans">log out</a> <br><br> -->
            
        </div>
        <div class="col-md-8 mt-4 ms-4 l2">
            <div class="container">
                <div class="row mb-2 p-2 border rounded folder">
                    <div class="col-md-7 seachbar">
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> 
                        </form>
                    </div>
                    <div class="col-md-3  new folder">
                    <button type="button" class="btn btn-secondary">New Folder</button>
                    </div>
                    <div class="col-md-2  upload">
                    <button type="button" class="btn btn-primary">Upload</button> 
                    </div>
                </div>
                <div class="row mb-2 p-2 border rounded table-info">
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
                                @foreach($obj->children as $child)
                                    <tr>
                                        <!-- <i class="bi bi-files-primary p-1"> </i> -->
                                        <th scope="row">                                      
                                            @if($child->objectable_type === 'folder')
                                                <a href="{{route('home.user', ['uuid' => $child->uuid])}}"><i class="bi bi-folder p-1"></i>{{$child->objectable->name}}</a>
                                            @else 
                                                <a href=""><i class="bi bi-files p-1"> </i>{{$child->objectable->name}}</a>
                                            @endif
                                        </th>
                                            <td>
                                                @if($child->objectable_type === 'folder')
                                                    &minus;
                                                @else
                                                    {{$child->objectable->size}}
                                                @endif
                                            </td>
                                            <td>{{$child->objectable->created_at}}</td>
                                            <td> <button type="button" class="btn btn-secondary">Rename</button></td>
                                            <td> <button type="button" class="btn btn-danger">Delete</button></td>
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
    </div>
</div>
@endsection
