@props([
'id',
'type'   => 'bar',
'label'  => '',
'labels' => [],
'data'   => [],
])

<div {{ $attributes->class(['h-100 flex justify-center mt-2 md:mt-6']) }}>
    <canvas id="{{ $id }}"
    data-type="{{ $type }}"
    data-label="{{ $label }}"
    data-labels="{{ json_encode($labels) }}"
    data-data="{{ json_encode($data) }}"
    >
    </canvas>
</div>