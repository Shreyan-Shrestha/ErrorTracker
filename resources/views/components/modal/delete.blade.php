@props([
    'toDelete' => null
])

<dialog id="modal_delete" class="modal">
    <div class="modal-box w-md sm:w-full ">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-3">✕</button>
        </form>
        <div class="w-full border-b-2 border-b-gray-400 p-3 bg-base-300">
            <h3 class="text-xl md:text-2xl font-semibold">Delete {{ $toDelete }}</h3>
        </div>
        <p class="text-lg uppercase text-gray-600 text-center mt-3 text-muted">Confirm Delete? This action cannot be undone</p>
        <form id="delete_form" action="" method="POST">
                @csrf
                @method('DELETE')
            </form>
        <div class="flex gap-6 justify-center-safe mt-6 p-3 border-t-2 border-t-gray-400 bg-base-300">
            <button class="btn btn-sm sm:btn-md shadow" onclick="modal_delete.close()">Cancel</button>
            <button class="btn btn-error bg-red-500 text-base-100 hover:bg-red-800 hover:text-base-300 shadow" type="submit" form="delete_form">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" height="16" width="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                    Yes, Delete
            </button>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>