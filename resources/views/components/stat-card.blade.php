@props([
'title',
'value',
'change' => null,
'iconBg',
'iconColor',
'desc' => null,
])

<div {{ $attributes->class(['stat border-2 border-gray-300 bg-white shadow rounded-xl p-2 lg:p-6']) }}>
    <div class="stat-figure [grid-row:1] {{ $iconColor }} p-2 {{ $iconBg }} rounded self-start md:hidden lg:flex">
        <span class="float-end">
            {{ $icon }}
        </span>
    </div>

    <div class="stat-title uppercase font-bold md:text-xl tracking-wide"> {{ $title }} </div>

    <div class="flex items-baseline md:p-3">
        <div class="stat-value md:text-4xl font-semibold"> {{$value }} </div>

        @if($change)
        <div class="stat-desc ms-2"><span class="{{ $iconColor }} font-semibold"> {{ $change }} </span></div>
        @endif
    </div>

    @if($desc)
    <div class="stat-desc"> {{ $desc }} </div>
    @endif
</div>