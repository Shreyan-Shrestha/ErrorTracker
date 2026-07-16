@php use App\Enums\ErrorSeverity; @endphp

@extends('partials.layout', ['title' => 'Problem Logs | ErrorTracker'])

@section('content')
<x-skeletons.logs></x-skeletons.logs>

<div id="content" class="p-6 w-full hidden">
    <x-breadcrumbs>
        <li>
            <a href="{{route('problems.index')}}">Problems</a>
        </li>

        <li class="text-primary font-semibold">Problem Logs</li>
    </x-breadcrumbs>

    @php
    $headers = ['Name', 'Impact Score', 'Severity', 'Status', 'Actions'];
    $count = count($headers);
    @endphp
    <div class="col-1 md:col-span-2">
        <x-table :headers="$headers" title="Problems">
            @if($errorReports->isEmpty())
            <tr class="bg-white hover:bg-base-300 p-4">
                <td colspan="{{ $count }}" class="px-4 py-3 text-center text-gray-500">
                    No Problems added yet.
                </td>
            </tr>
            @else
            @foreach( $errorReports as $report )
            <tr class="bg-white hover:bg-base-300 p-4">
                <td grid gap 1>
                    <p class="text-primary md:text-lg font-bold tracking-wide">{{ $report->problem->name }}</p>
                    <p class="text-gray-600 md:text-md font-semibold">{{ $report->category->name }}</p>
                </td>

                <td>
                    <progress class="progress w-16 md:w-32 {{$report->category->severity->impactColor()}}" value="{{$report->category->severity->impact()}}" max="10"></progress>
                    <p class="{{ $report->category->severity === ErrorSeverity::Critical ? 'text-error': '' }}">{{$report->category->severity->impact()}}/10</p>
                </td>

                <td class="text-center md:text-left">
                    <div class="md:rounded-full md:badge md:badge-soft md:badge-md {{$report->category->severity->color()}}">
                        <div aria-label="severity" class="status {{$report->category->severity->status()}}"></div>
                        <span class="hidden md:inline font-semibold">{{ $report->category->severity->label() }}</span>
                    </div>
                </td>

                <td>
                    <div class="py-2 flex gap-2 items-center-safe justify-center md:justify-start">
                        <div class="status {{$report->status->status()}}"></div>
                        <span class="hidden md:inline font-semibold">{{$report->status->label()}}</span>
                    </div>
                </td>

                <td>
                </td>
            </tr>
            @endforeach
            @endif
        </x-table>
    </div>
</div>
@endsection