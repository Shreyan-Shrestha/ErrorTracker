@props([
'title',
'value',
'change' => null,
'iconBg',
'iconColor',
'desc' => null,
])

<div {{ $attributes->class(['stat border-2 border-s-6 shadow rounded-xl p-2 lg:p-4', 'bg-white']) }}>
    <div class="stat-figure [grid-row:1] {{ $iconColor }} p-2 {{ $iconBg }} rounded self-start md:hidden lg:flex">
        <span>
            {{ $icon }}
        </span>
    </div>

    <div class="stat-title uppercase font-bold md:text-xl"> {{ $title }} </div>

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