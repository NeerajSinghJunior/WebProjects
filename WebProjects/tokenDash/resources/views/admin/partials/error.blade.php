

@if(session('error')) 
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif
@if(count($errors))

    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif