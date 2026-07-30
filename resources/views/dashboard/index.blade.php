@extends('partials.layout', ['title' => 'ErrorTracker | Dashboard'])

@section('content')
<x-skeletons.index></x-skeletons.index>

<div id="content" class="w-full p-3 md:p-6">
    <div class="grid gap-4 mt-6 md:gap-16 is-drawer-open:gap-10 grid-cols-2 lg:grid-cols-4 p-2 md:p-6">
        <x-stat-card class="border-primary" title="Projects" value="{{ $cardData['projectCount'] }}" change="Total" iconColor="text-primary" iconBg="bg-blue-100">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-diagram-2 size-5" viewBox="0 0 16 16">
                    <g transform="rotate(-90 8 8)">
                        <path fill-rule="evenodd" stroke-width="1.5" d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H11a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 5 7h2.5V6A1.5 1.5 0 0 1 6 4.5zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5zM3 11.5A1.5 1.5 0 0 1 4.5 10h1A1.5 1.5 0 0 1 7 11.5v1A1.5 1.5 0 0 1 5.5 14h-1A1.5 1.5 0 0 1 3 12.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1A1.5 1.5 0 0 1 9 12.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                    </g>
                </svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card class="border-success" title="Users" value="{{ $cardData['userCount'] }}" change="All Time" iconColor="text-success-content" iconBg="bg-green-100">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-people size-5" viewBox="0 0 16 16">
                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                </svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card class="border-warning" title="Errors Reported" value="{{ $cardData['errorCount'] }}" change="Last 24 hrs" iconBg="bg-orange-100" iconColor="text-warning-content">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-exclamation-triangle size-5" viewBox="0 0 16 16">
                    <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z" />
                    <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                </svg>
            </x-slot:icon>
        </x-stat-card>

        <div class="stat border-2 border-s-6 border-red-500 text-red-500 bg-red-50 shadow rounded-xl p-2 lg:p-4">
            <div class="stat-figure [grid-row:1] p-2 rounded bg-red-100 text-red-800 self-start md:hidden lg:flex">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-diamond" viewBox="0 0 16 16">
                        <path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.48 1.48 0 0 1 0-2.098zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z" />
                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                    </svg>
                </span>
            </div>

            <div class="stat-title text-red-600 uppercase font-bold md:text-xl">Critical Errors</div>
            <div class="flex items-baseline md:p-3">
                <div class="stat-value md:text-4xl font-semibold"> {{$cardData['criticalCount']}} </div>
                <div class="stat-desc text-red-700 ms-2">High priority</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6 p-2 md:p-6">
        <div class="col-span-4 rounded-box border-2 border-gray-400 p-2 md:p-4 gap-2 md:gap-4">
            <p class="text-md md:text-3xl font-semibold">Errors Reported</p>
            <p class="text-sm md:text-md text-gray-500">Last 24 hours</p>
            <div class="responsive h-72 p-2 md:p-4">
                <canvas id="errorTrendChart"></canvas>
            </div>
        </div>

        <div class="col-span-4 rounded-box border-2 border-gray-400 p-2 md:p-4 gap-2 md:gap-4">
            <p class="text-md md:text-3xl font-semibold">Errors Reported</p>
            <p class="text-sm md:text-md text-gray-500">By Region</p>
            <div class="responsive h-72 p-2 md:p-4">
                <canvas id="errorRegionChart"></canvas>
            </div>
        </div>

        <div class="col-span-4 md:col-span-2 rounded-box border-2 border-gray-400 p-2 md:p-4 gap-2 md:gap-4">
            <p class="text-md md:text-3xl font-semibold">Errors Reported</p>
            <p class="text-sm md:text-md text-gray-500">By Projects</p>
            <div class="responsive h-72 p-2 md:p-4">
                <canvas id="errorByProjectChart"></canvas>
            </div>
        </div>

        <div class="col-span-4 md:col-span-2">
            @php
            $headers = ['Error', 'Project', 'Severity', 'Status'];
            $count = count($headers);
            @endphp

            <x-table :headers="$headers" title="Priority Pending Errors">
                @if($errorsdata->isEmpty())
                <tr class="bg-white hover:bg-base-300 p-4">
                    <td colspan="{{ $count }}" class="px-4 py-3 text-center text-gray-500">
                        No Pending Critical Errors Right Now.
                    </td>
                </tr>
                @else
                @foreach($errorsdata as $errordata)
                <tr class=" bg-white hover:bg-base-300 text-gray-600 text-sm md:text-lg">
                    <td>
                        <div class="grid gap-1">
                            <p class="text-primary text-md md:text-xl font-bold tracking-wide">{{ $errordata->problem->name }}</p>
                            <p class="text-grey-400 font-semibold text-xs md:text-md">{{ $errordata->category->name }}</p>
                        </div>
                    </td>

                    <td class="text-center md:text-left">
                        <span class="text-md md:text-lg font-semibold">{{ $errordata->project->project_name }}</span>
                    </td>

                    <td class="text-center md:text-left">
                        <div class="rounded-full badge badege-soft badge-sm md:badge-md {{$errordata->category->severity->color()}}">
                            <div aria-label="severity" class="status {{$errordata->category->severity->status()}}"></div>
                            <span class="hidden md:inline font-semibold">{{ $errordata->category->severity->label() }}</span>
                        </div>
                    </td>

                    <td>
                        <div class="badge badge-soft rounded-full badge-sm md:badge-md {{$errordata->status->color()}}">
                            <span>{{ $errordata->status->label()}}</span>
                        </div>
                    </td>
                </tr>
                @endforeach

                @if($errorsdata->hasPages())
                <tr class="bg-base-300">
                    <td colspan="{{$count}}" class="p-4">
                        {{$errorsdata->links()}}
                    </td>
                </tr>
                @endif

                @endif
            </x-table>
        </div>
    </div>



    @push('scripts')
    @vite('resources/js/chart.js')
    @endpush
</div>
@endsection