@if ($errors->any())
    <div class="alert alert-error mx-auto w-md">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif