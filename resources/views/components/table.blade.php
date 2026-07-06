@props([
'headers' => null,
'headerClasses' => [],
'title' => null
])

<div class="overflow-x-auto border-2 border-gray-300  rounded-box rounded-xl mt-6 shadow-md sm:rounded-lg bg-white">
    <table class="w-full table-auto flexbox text-sm text-left grow border-t-2 border-t-gray-300 p-4">
        <div class="p-4 lg:text-3xl float-left">
            {{ $title }}
        </div>

        <thead>
            <tr class="p-4">
                @foreach($headers as $index => $header)
                <th scope="col" class="px-4 py-3 uppercase font-semibold text-gray-500 {{ $headerClasses[$index] ?? '' }}">
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