@props([
    'onClick' => null,
    'dataAction' => null
])

<div class="inline-block float-end">
    <button class="btn btn-sm  md:btn-lg pe-5 md:pe-6 rounded-full bg-blue-700 shadow-sm md:shadow-md shadow-blue-200 text-white hover:bg-blue-800 active:bg-blue-900 gap-0.5" 
    onclick="{{ $onClick }}" data-action="{{ $dataAction }}">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-plus size-6" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
            </svg>
        </span>
        {{$slot}}
    </button>
</div>