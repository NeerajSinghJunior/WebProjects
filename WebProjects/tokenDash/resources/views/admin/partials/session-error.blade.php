@if(session('error'))

    <div class="alert alert-info">
        <ul>



            <li>{{ session('error') }}</li>



        </ul>


    </div>

@endif