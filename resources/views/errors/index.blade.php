@php use App\Enums\ErrorStatus; @endphp

@extends('partials.layout', ['title' => 'WorldLink ErrorTracker | Errors'])

@section('content')
<x-skeletons.index></x-skeletons.index>

<div id="content" class="w-full p-6 hidden">

    <x-breadcrumbs>
        <li class="text-primary font-semibold"> Errors</li>
    </x-breadcrumbs>

    <a href="{{route('errors.add')}}">
        <x-buttons.primary>
            Report Error
        </x-buttons.primary>
    </a>

    <p class="text-2xl lg:text-4xl font-bold">Errors</p>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-16 mt-6">
        <x-stat-card class="border-primary" title="Errors Reported" value="{{$stats['reported']['value']}}" change="+{{$stats['reported']['change']}}%" desc="in last 24hrs" iconColor="text-primary" iconBg="bg-blue-100">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-bug" viewBox="0 0 16 16">
                    <path d="M4.355.522a.5.5 0 0 1 .623.333l.291.956A5 5 0 0 1 8 1c1.007 0 1.946.298 2.731.811l.29-.956a.5.5 0 1 1 .957.29l-.41 1.352A5 5 0 0 1 13 6h.5a.5.5 0 0 0 .5-.5V5a.5.5 0 0 1 1 0v.5A1.5 1.5 0 0 1 13.5 7H13v1h1.5a.5.5 0 0 1 0 1H13v1h.5a1.5 1.5 0 0 1 1.5 1.5v.5a.5.5 0 1 1-1 0v-.5a.5.5 0 0 0-.5-.5H13a5 5 0 0 1-10 0h-.5a.5.5 0 0 0-.5.5v.5a.5.5 0 1 1-1 0v-.5A1.5 1.5 0 0 1 2.5 10H3V9H1.5a.5.5 0 0 1 0-1H3V7h-.5A1.5 1.5 0 0 1 1 5.5V5a.5.5 0 0 1 1 0v.5a.5.5 0 0 0 .5.5H3c0-1.364.547-2.601 1.432-3.503l-.41-1.352a.5.5 0 0 1 .333-.623M4 7v4a4 4 0 0 0 3.5 3.97V7zm4.5 0v7.97A4 4 0 0 0 12 11V7zM12 6a4 4 0 0 0-1.334-2.982A3.98 3.98 0 0 0 8 2a3.98 3.98 0 0 0-2.667 1.018A4 4 0 0 0 4 6z" />
                </svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card class="border-success" title="Resolved Errors" value="{{$stats['resolved']['value']}}" desc="All time" iconColor="text-success-content" iconBg="bg-green-100">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                </svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card class="border-warning" title="Unresolved Errors" value="{{$stats['unresolved']['value']}}" desc="Needs attention" iconColor="text-warning-content" iconBg="bg-orange-100">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                    <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z" />
                    <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                </svg>
            </x-slot:icon>
        </x-stat-card>

        <div class="stat border-2 border-s-6 border-red-500 text-red-500 bg-red-50 shadow rounded-xl p-2 lg:p-4">
            <div class="stat-figure [grid-row:1] p-2 rounded bg-red-100 text-red-800">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-exclamation-diamond" viewBox="0 0 16 16">
                        <path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.48 1.48 0 0 1 0-2.098zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z" />
                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                    </svg>
                </span>
            </div>

            <div class="stat-title text-red-700 uppercase font-bold md:text-lg tracking-wide">Critical Errors</div>
            <div class="flex items-baseline">
                <div class="stat-value md:text-4xl font-semibold">{{$stats['critical']['value']}}</div>
            </div>

            <div class="stat-desc text-red-700">High priority esclation</div>
        </div>
    </div>

    @php
    $headers = ['Error', 'Severity', 'Reported At', 'Root Cause Analysis', 'Start Time', 'Impact', 'Status', 'Action'];
    $headerClasses = ['','','','','hidden md:table-cell','','',''];
    $count=count($headers);
    @endphp
    <x-table :headers="$headers" :headerClasses="$headerClasses" title="Error Log">
        @if($errorsdata->isEmpty())
        <tr class="bg-white hover:bg-base-300 p-4">
            <td colspan="{{ $count }}" class="px-4 py-3 text-center text-gray-500">
                No Errors Reported Yet.

                <a class="link link-primary link-hover" href="{{route('errors.add')}}">
                    Report An Error
                </a>
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
                <div class="rounded-full badge badege-soft badge-sm md:badge-md {{$errordata->category->severity->color()}}">
                    <div aria-label="severity" class="status {{$errordata->category->severity->status()}}"></div>
                    <span class="hidden md:inline font-semibold">{{ $errordata->category->severity->label() }}</span>
                </div>
            </td>

            <td class="text-sm md:text"> {{App\Helpers\DateHelper::formatTimestampToString($errordata->created_at)}} </td>

            <td> {{ $errordata->root_cause }} </td>

            <td class="hidden md:table-cell text-sm md:text"> {{App\Helpers\DateHelper::formatDateString($errordata->start_time)}}</td>

            <td> {{ $errordata->impact }} </td>

            <td>
                <div class="badge badge-soft rounded-full badge-sm md:badge-md {{$errordata->status->color()}}">
                    <span>{{ $errordata->status->label()}}</span>
                </div>
            </td>

            <td>
                <div tabindex="0" role="button" class="dropdown dropdown-end {{$loop->last || $loop->remaining < 2 ? 'dropdown-top' : 'dropdown-bottom'}} ">
                    <div tabindex="-1" role="button" class="btn btn-sm md:btn-md btn-primary btn-outline m-1"
                        onclick="this.closest('[tabindex=\'0\']').blur()">Actions
                    </div>

                    <ul class="dropdown-content menu rounded-box z-1 w-32 md:w-52 p-2 shadow-sm">
                        <li><a href="{{route('errors.edit', $errordata)}}" class="link link-sm link-hover tracking-wider font-bold">Update</a>
                        </li>

                        @if($errordata->status != ErrorStatus::Fixed && empty($errordata->assign_id))
                        <li>
                            <button class="link link-hover tracking-wider font-bold" onclick="OpenEditModal(this)"
                                data-modal="modal_assign"
                                data-action="{{ route('errors.assign', $errordata)}}"
                                data-assign=" {{ $errordata->assign_id }} ">Assign Error
                            </button>
                        </li>
                        @endif

                        <li><button class="link link-hover tracking-wider font-bold" onclick="OpenEditModal(this)"
                                data-modal="modal_create"
                                data-action="{{route('errors.analysis', $errordata)}}"
                                data-root_cause="{{$errordata->root_cause}}">
                                Root Cause Analysis</button>
                        </li>

                        @if($errordata->status != ErrorStatus::Fixed->value && !empty($errordata->root_cause))
                        <li>
                            <button type="submit" form="markFixed{{$errordata->id}}" class="link link-hover font-bold">Mark Fixed</button>

                            <form id="markFixed{{$errordata->id}}" action="{{route('errors.markFixed', $errordata)}}" method="POST" class="hidden">
                                @csrf
                                @method('PATCH')
                            </form>
                        </li>
                        @endif

                        <li>
                            <button class="delete-btn link link-hover tracking-wider font-bold"
                                data-action="{{ route('errors.delete', $errordata->id) }}">
                                Delete
                            </button>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
        <tr class="bg-white p-4 border-t-2 border-gray-300">
            <td colspan="{{$count}}" class="px-4 py-3 text-center text-primary md:text-lg">
                <a href="{{route('errors.logs')}}" class="link link-hover">View All Error Logs ({{$logCount}})</a>
            </td>
        </tr>
        @endif
    </x-table>

    <x-modal.create id="modal_assign" class="md:w-xl" creating="Assign Error" methodPatch="true">
        <div class="p-3 md:p-6 grid gap-4">
            <x-error-alert />
            <label class="fieldset" for="assign_id">
                <span class="label">ASSIGN ERROR</span>
                <select name="assign_id" id="assign_id" required class="select select-sm md:select-md validator w-full">
                    <option selected disabled value="">Assign Error Resolving to:</option>
                    <option value=""></option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}" @selected(old('assign_id')==$user->id)> {{$user->first_name}} {{$user->last_name}}</option>
                    @endforeach
                </select>
            </label>
        </div>
    </x-modal.create>

    <x-modal.create class="md:w-xl" creating="Root Cause Analysis" methodPatch="true">
        <div class="p-3 md:p-6 grid gap-4">
            <x-error-alert />
            <label class="fieldset" for="root_cause">
                <span class="label>">Root Cause Analysis. (10-1500 characters) *</span>
                <textarea class="textarea md:h-64 w-full validator" name="root_cause" id="root_cause" value="old('root_cause)"
                    placeholder="Enter the Root Cause Analysis. (Min:10, Max:1500 characters)"></textarea>
                <p class="validator-hint hidden">10-1500 characters limit.</p>
            </label>
        </div>
    </x-modal.create>
    <x-modal.delete></x-modal.delete>

    @if($errors->any())
    <div id="modal-error-target" data-modal="{{ session('modal_id', 'modal_create') }}" class="hidden"></div>
    @endif

    @push('scripts')
    @vite('resources/js/modal.js')
    @endpush
</div>
@endsection