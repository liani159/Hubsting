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
    <h2 class="float-start"><a class="back" href="{{route('teams.index')}}">back</a></h2>
        <div class="container float-end">
            <div class="row ps-3 ">  
                <form class="d-flex" role="search" action="{{route('members.store')}}" method="POST">
                    @csrf
                    <div class="col md-10">
                        <input class="form-control me-2" name="mail" type="search" placeholder="Enter email address of the new member" aria-label="Search"> 
                        <div class="form-error">
                            @error('mail')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="col md-1">
                    <fieldset disabled>
                    <input type="text" data-id="{{$id_team}}" id="disabledTextInput" class="form-control" placeholder="team_id: {{$id_team}}">
                    </fieldset>
                    <!-- <input class="form-control me-2" id="disabledTextInput" name="id_team" type="search" placeholder="{{$id_team}}" aria-label="Search"> -->
                    </div>
                    <div class="col md-1">
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
                            <input type="button" value="Delete member" data-id="{{$user->id}}" data-id_team = "{{$id_team}}"  class="btn btn-danger elimina"/>
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

</script>

@endsection