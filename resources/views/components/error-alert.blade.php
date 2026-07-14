@if ($errors->any())
<div class="alert alert-error mx-auto bg-red-50 w-md" id="alert-form-error">
    <ul>
        @foreach ($errors->all() as $error)
        <li class="flex align-middle justify-items-start gap-3 md:text-md font-semibold">
            <span class="me-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="22" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                </svg>
            </span><span>{{ $error }}</span>
        </li>
        @endforeach
    </ul>
</div>
@endif