@php use App\Enums\ErrorSeverity; @endphp
@extends('partials.layout', ['title' => 'WorldLink ErrorTracker | Problems'])

@section('content')
<div id="skeleton" class="w-full p-2 md:p-6">
    <div class="skeleton h-4 w-32 rounded-xl mb-6"></div>

    <div class="mb-6 flex justify-between">
        <div class="h-10 w-40 skeleton rounded-xl"></div>

        <div class="grid justify-items-start gap-4">
            <div class="skeleton h-12 w-48 rounded-full"></div>
            <div class="skeleton h-12 w-48 rounded-full"></div>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-16 mt-6 p-2 lg:px-6">
        <div class="skeleton h-40"></div>
        <div class="skeleton h-40"></div>
        <div class="skeleton h-40"></div>
        <div class="skeleton h-40"></div>
    </div>

    <div class="grid gird-cols-1 md:grid-cols-3 gap-6 px-4 lg:px-6">
        <div class="col-1 skeleton rounded-box h-75 mt-6"></div>
        <div class="col-1 skeleton md:col-span-2 h-75 mt-6"></div>
    </div>
</div>

<div id="content" class="w-full p-2 md:p-6 hidden">
    <x-breadcrumbs>
        <li class="text-primary font-semibold">Problems</li>
    </x-breadcrumbs>

    <div class="mb-6 flex justify-between">
        <div>
            <p class="text-2xl lg:text-4xl font-bold">Problems</p>
        </div>
        <div class="grid justify-items-start gap-4">
            <x-buttons.primary onClick="OpenCreateModal(this.dataset.action, 'modal_problem')" dataAction="{{ route('problems.create') }}">Add Problem</x-buttons.primary>
            <x-buttons.primary onClick="OpenCreateModal(this.dataset.action, 'modal_category')" dataAction="{{ route('category.create') }}">Add Category</x-buttons.primary>
        </div>

    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-16 mt-6 p-2 lg:px-6">
        <x-stat-card class="border-primary" title="Active Problems" value="24" change="+4 this week" desc="open issues" iconColor="text-primary" iconBg="bg-blue-100">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                    <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5" />
                    <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96q.04-.245.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 1 1 12z" />
                </svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card class="border-success" title="Resolution Time" value="12h" change="Avg. time" desc="All time" iconColor="text-success-content" iconBg="bg-green-100">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2z" />
                    <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466" />
                </svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card class="border-warning" title="Team Efficiency" value="94%" change="" desc="5 teams" iconColor="text-warning-content" iconBg="bg-orange-100">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-radioactive" viewBox="0 0 16 16">
                    <path d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8" />
                    <path d="M9.653 5.496A3 3 0 0 0 8 5c-.61 0-1.179.183-1.653.496L4.694 2.992A5.97 5.97 0 0 1 8 2c1.222 0 2.358.365 3.306.992zm1.342 2.324a3 3 0 0 1-.884 2.312 3 3 0 0 1-.769.552l1.342 2.683c.57-.286 1.09-.66 1.538-1.103a6 6 0 0 0 1.767-4.624zm-5.679 5.548 1.342-2.684A3 3 0 0 1 5.005 7.82l-2.994-.18a6 6 0 0 0 3.306 5.728ZM10 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0" />
                </svg>
            </x-slot:icon>
        </x-stat-card>

        <div class="stat border-2 border-s-6 border-red-500 text-red-500 bg-red-50 shadow rounded-xl p-2 xl:p-6">
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
                <div class="stat-value md:text-4xl font-semibold"> 03 </div>
            </div>

            <div class="stat-desc text-red-700">High priority</div>
        </div>
    </div>

    <div class="grid gird-cols-1 md:grid-cols-3 gap-6 px-4 lg:px-6">
        <div class="col-1 rounded-box border border-gray-400 mt-6 p-2 md:p-4">
            <p class="text-3xl">Problem Categories</p>
            <div class="px-6">
                <ul class="mt-6 grid justify-center">
                    @if($categories->isEmpty())
                    <li>Not Added Yet</li>
                    @else
                    @foreach($categories as $category)
                    <li class="font-semibold text-xl">
                        <div aria-label="status" class="status {{ $category->severity->status() }}"></div> {{$category->name}}
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>

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
                            <span class="hidden md:inline">{{ $report->category->severity->label() }}</span>
                        </div>
                    </td>

                    <td>
                        <div class="py-2 flex gap-2 items-center-safe justify-center md:justify-start">
                            <div class="status {{$report->status->status()}}"></div>
                            <span class="hidden md:inline font-semibold">{{$report->status->label()}}</span>
                        </div>
                    </td>

                    <td>
                        <div class="flex gap-4 items-center-safe justify-center-safe">
                            <button class="link"
                                data-modal="modal_edit_problem"
                                data-action="{{route('problems.edit', $report->problem)}}"
                                onclick="OpenEditModal(this)"
                                data-name="{{ $report->problem->name }}">
                                Edit
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
                <tr class="bg-white p-4 border-t-2 border-t-gray-400">
                    <td colspan="{{$count}}" class="px-4 py-3 text-center text-primary md:text-lg">
                        <a href="{{route('problems.logs')}}" class="link link-hover">View All Problem Logs ({{$logCount}})</a>
                    </td>
                </tr>
                @endif
            </x-table>
        </div>
    </div>

    <x-modal.create id="modal_problem" creating="Add Problem">
        @if(session('modal_id') === 'modal_problem')
        <x-error-alert />
        @endif

        <div class="p-3 px-6 grid gap-4">
            <label class="fieldset">
                <span class="label">PROBLEM NAME</span>
                <input type="text" class="input input-sm sm:input-md validator" value="{{old('name')}}" required name="name" placeholder="Enter Problem Name">
                <p class="validator-hint hidden">Required</p>
            </label>
        </div>
    </x-modal.create>

    <x-modal.create id="modal_category" creating="Add Problem Category">
        @if(session('modal_id') === 'modal_category')
        <x-error-alert />
        @endif

        <div class="p-3 px-6 grid gap-4">
            <label class="fieldset">
                <span class="label">Category Name</span>
                <input type="text" class="input input-sm sm:input-md validator" value="{{old('name')}}"
                    name="name" validator required placeholder="Enter Problem Name">
                <div class="validator-hint hidden">Required</div>
            </label>
            <label class="fieldset">
                <span class="label">SEVERITY</span>
                <select class="select validator" required name="severity">
                    <option value="" disabled selected>Category Severity</option>
                    @foreach(App\Enums\ErrorSeverity::cases() as $severity)
                    <option value="{{$severity->value}}" @selected(old('severity')==$severity->value)> {{ $severity->label() }} </option>
                    @endforeach
                </select>
                <div class="validator-hint hidden">Required</div>
            </label>
        </div>
    </x-modal.create>

    <x-modal.create id="modal_edit_problem" creating="Edit Problem" methodPatch="true">
        <div class="p-3 px-6 grid gap-4">
            @if(session('modal_id') === 'modal_edit_problem')
            <x-error-alert />
            @endif

            <input type="hidden" name="problem_id" id="edit_problem_id">
            <label class="fieldset">
                <span class="label">PROBLEM NAME</span>
                <input type="text" class="input input-sm sm:input-md validator" required value=" {{old('name')}} "
                    name="name" id="edit_problem_name" placeholder="Enter Problem Name">
                <p class="validator-hint hidden">Required</p>
            </label>
        </div>
    </x-modal.create>
    <x-modal.delete toDelete="Problem"></x-modal.delete>

    @if($errors->any())
    <div id="modal-error-target" data-modal="{{ session('modal_id', 'modal_create') }}" class="hidden"></div>
    @endif
</div>
@endsection