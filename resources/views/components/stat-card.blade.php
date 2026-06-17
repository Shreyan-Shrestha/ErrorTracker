@props([
'title',
'value',
'change' => null,
'iconBg',
'iconColor',
'desc' => null,
])

<div {{ $attributes->class(['stat border border-gray-400 bg-white shadow rounded-md p-6']) }}>
    <div class="stat-figure {{ $iconColor }} p-2 {{ $iconBg }} rounded">
        <span class="float-end">
            {{ $icon }}
        </span>
    </div>

    <div class="stat-title uppercase font-bold"> {{ $title }} </div>

    <div class="flex items-baseline">
        <div class="stat-value"> {{$value }} </div>

        @if($change)
        <div class="stat-desc ms-2"><span class="{{ $iconColor }} font-semibold"> {{ $change }} </span></div>
        @endif
    </div>

    @if($desc)
    <div class="stat-desc"> {{ $desc }} </div>
    @endif
</div>