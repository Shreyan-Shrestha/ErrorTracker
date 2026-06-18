@props([
'headers',
'title'
])

<div class="overflow-x-auto border border-gray-400 rounded-box mt-6 shadow-md sm:rounded-lg bg-white">
    <table class="w-full text-sm bg-gray-50 text-center border-t-2 border-t-gray-400 p-4">
        <div class="p-4 lg:text-3xl float-left">
            {{ $title }}
        </div>

        <thead>
            <tr class="bg-base-300">
                @foreach($headers as $header)
                <th scope="col" class="px-4 py-3 uppercase font-bold text-gray-500">
                    {{ $header }}
                </th>
                @endforeach
            </tr>
        </thead>

        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>