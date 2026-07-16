@php use App\Enums\ErrorStatus; @endphp

@extends('partials.layout', ['title' => 'Error Logs | ErrorTracker'])

@section('content')
<x-skeletons.logs></x-skeletons.logs>

<div id="content" class="p-6 w-full">
    <x-breadcrumbs>
        <li>
            <a href="{{route('errors.index')}}">Errors</a>
        </li>

        <li class="text-primary font-semibold"> Error Logs </li>
    </x-breadcrumbs>

    @php
    $headers = ['Error', 'Severity', 'Reported At', 'Cause', 'Start Time', 'Impact', 'Status', 'Action'];
    $headerClasses = ['','','','','hidden md:table-cell','','',''];
    $count=count($headers);
    @endphp
    <x-table :headers="$headers" :headerClasses="$headerClasses" title="Error Log">
        @if($errorsdata->isEmpty())
        <tr class="bg-white hover:bg-base-300 p-4">
            <td colspan="{{ $count }}" class="px-4 py-3 text-center text-gray-500">
                No Error reported yet.
            </td>
        </tr>
        @else
        @foreach($errorsdata as $errordata)
        <tr class=" bg-white hover:bg-base-300 text-gray-600 text-sm md:text-lg">
            <td>
                <div class="grid gap-1">
                    <p class="text-primary text-xl font-bold tracking-wide">{{ $errordata->problem->name }}</p>
                    <p class="text-grey-400 font-semibold">{{ $errordata->category->name }}</p>
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
                    <div tabindex="-1" role="button" class="btn btn-primary btn-outline m-1">Actions</div>
                    <ul class="dropdown-content menu rounded-box z-1 w-32 md:w-52 p-2 shadow-sm">
                        <li><a href="{{route('errors.edit', $errordata)}}" class="link link-hover tracking-wider font-bold"
                                onclick="document.activeElement.blur()">Update</a></li>

                        <li><button class="link link-hover tracking-wider font-bold" onclick="OpenEditModal(this), document.activeElement.blur()"
                                data-modal="modal_edit_root_cause"
                                data-action="{{route('errors.analysis', $errordata)}}"
                                data-root_cause="{{$errordata->root_cause}}">
                                Root Cause Analysis</button>
                        </li>

                        @if($errordata->status != ErrorStatus::Fixed->value && !empty($errordata->root_cause))
                        <li>
                            <button type="submit" form="markFixed{{$errordata->id}}" onclick="document.activeElement.blur()"
                                class="link link-hover font-bold">Mark Fixed</button>

                            <form id="markFixed{{$errordata->id}}" action="{{route('errors.markFixed', $errordata)}}" method="POST" class="hidden">
                                @csrf
                                @method('PATCH')
                            </form>
                        </li>
                        @endif

                        <li>
                            <button class="delete-btn link link-hover tracking-wider font-bold"
                                onclick="document.activeElement.blur()"
                                data-action="{{ route('errors.delete', $errordata->id) }}">
                                Delete
                            </button>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="{{$count}}" class="bg-white text-center font-semibold">
                {{$errorsdata->links()}}
            </td>
        </tr>
        @endif
    </x-table>

    <x-modal.create id="modal_edit_root_cause" creating="Root Cause Analysis" methodPatch="true">
        <div class="p-3 md:p-6 grid gap-4">
            <x-error-alert />
            <label class="fieldset" for="root_cause">
                <span class="label>">Root Cause Analysis. (10-1500 characters) *</span>
                <textarea class="textarea w-full validator" rows="3" name="root_cause" id="root_cause" value="old('root_cause)"
                    placeholder="Enter the Root Cause Analysis. (Min:10, Max:1500 characters)"></textarea>
                <p class="validator-hint hidden">10-1500 characters limit.</p>
            </label>

            @if($errors->any())
            <div id="modal-error-target" data-modal="{{ session('modal_id', 'modal_create') }}" class="hidden"></div>
            @endif
        </div>
    </x-modal.create>
    <x-modal.delete></x-modal.delete>
</div>
@endsection