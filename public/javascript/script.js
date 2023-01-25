

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


