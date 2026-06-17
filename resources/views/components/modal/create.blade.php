@props([
'methodPatch' =>null,
])

<dialog id="modal_create" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <div class="w-full p-4 mt-6">
            <form id="create_form" action="" method="POST">
                @csrf

                @if($methodPatch)
                @method('PATCH')
                @endif

                {{ $slot }}

                <div class="flex gap-6 justify-center-safe mt-6 p-4">
                    <button class="btn btn-primary" type="submit">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

@push('scripts')
<script>
    function OpenCreateModal(action) {
        document.getElementById('create_form').action = action;
        modal_create.showModal();
    }
</script>
@endpush