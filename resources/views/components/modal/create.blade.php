@props([
'methodPatch' => null,
'creating' => null,
'id' => 'modal_create'
])

<dialog id="{{$id}}" class="modal">
    <div class="modal-box w-md sm:w-full">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-3">✕</button>
        </form>

        <div class="w-full border-b-2 border-b-gray-400 p-3 bg-base-300">
            <p class="text-xl sm:text-2xl md:test-3xl font-semibold">{{ $creating }}</p>
        </div>

        <div class="w-full mt-6">
            <form id="create_form_{{$id}}" action="" method="POST">
                @csrf
                @if($methodPatch)
                @method('PATCH')
                @endif
                {{ $slot }}
            </form>
        </div>
        <div class="flex gap-6 justify-end-safe mt-6 p-3 border-t-2 border-gray-400 bg-base-300 modal-action">
            <button class="btn btn-sm sm:btn-md shadow" onclick="document.getElementById('{{ $id }}').close()">Cancel</button>
            <button class="btn btn-primary shadow" type="submit" form="create_form_{{$id}}">{{ $creating }}</button>
        </div>
    </div>
    
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>