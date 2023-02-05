@if(count($files)>0)
    @foreach($files as f)
        <li class="list-group-item">
            {{f->name}}
        </li>
    @endforeach
@else
    <li class="list-group-item">No result found</li>
@endif