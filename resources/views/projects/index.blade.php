@extends('partials.layout', ['title', 'WorldLink ErrorTracker | Projects'])

@section('content')
<x-skeletons.index></x-skeletons.index>
<div id="content" class="w-full p-4 lg:p-6 hidden">
    <x-breadcrumbs>
        <li class="text-primary font-semibold">Projects</li>
    </x-breadcrumbs>

    <x-buttons.primary onClick="OpenCreateModal(this.dataset.action)" dataAction="{{ route('projects.create')}}">
        Add Project
    </x-buttons.primary>
    <p class="text-2xl lg:text-4xl font-bold">Projects</p>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-16 mt-6 lg:px-6">
        <x-stat-card class="border-primary" title="Active Projects" value="{{$stats['active']}}" change=" +8%" iconBg="bg-blue-100" iconColor="text-primary">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-rocket-takeoff" viewBox="0 0 16 16">
                    <path d="M9.752 6.193c.599.6 1.73.437 2.528-.362s.96-1.932.362-2.531c-.599-.6-1.73-.438-2.528.361-.798.8-.96 1.933-.362 2.532" />
                    <path d="M15.811 3.312c-.363 1.534-1.334 3.626-3.64 6.218l-.24 2.408a2.56 2.56 0 0 1-.732 1.526L8.817 15.85a.51.51 0 0 1-.867-.434l.27-1.899c.04-.28-.013-.593-.131-.956a9 9 0 0 0-.249-.657l-.082-.202c-.815-.197-1.578-.662-2.191-1.277-.614-.615-1.079-1.379-1.275-2.195l-.203-.083a10 10 0 0 0-.655-.248c-.363-.119-.675-.172-.955-.132l-1.896.27A.51.51 0 0 1 .15 7.17l2.382-2.386c.41-.41.947-.67 1.524-.734h.006l2.4-.238C9.005 1.55 11.087.582 12.623.208c.89-.217 1.59-.232 2.08-.188.244.023.435.06.57.093q.1.026.16.045c.184.06.279.13.351.295l.029.073a3.5 3.5 0 0 1 .157.721c.055.485.051 1.178-.159 2.065m-4.828 7.475.04-.04-.107 1.081a1.54 1.54 0 0 1-.44.913l-1.298 1.3.054-.38c.072-.506-.034-.993-.172-1.418a9 9 0 0 0-.164-.45c.738-.065 1.462-.38 2.087-1.006M5.205 5c-.625.626-.94 1.351-1.004 2.09a9 9 0 0 0-.45-.164c-.424-.138-.91-.244-1.416-.172l-.38.054 1.3-1.3c.245-.246.566-.401.91-.44l1.08-.107zm9.406-3.961c-.38-.034-.967-.027-1.746.163-1.558.38-3.917 1.496-6.937 4.521-.62.62-.799 1.34-.687 2.051.107.676.483 1.362 1.048 1.928.564.565 1.25.941 1.924 1.049.71.112 1.429-.067 2.048-.688 3.079-3.083 4.192-5.444 4.556-6.987.183-.771.18-1.345.138-1.713a3 3 0 0 0-.045-.283 3 3 0 0 0-.3-.041Z" />
                    <path d="M7.009 12.139a7.6 7.6 0 0 1-1.804-1.352A7.6 7.6 0 0 1 3.794 8.86c-1.102.992-1.965 5.054-1.839 5.18.125.126 3.936-.896 5.054-1.902Z" />
                </svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card class="border-success" title="Completion Rate" value="{{$stats['completion']}}%" change="Stable" iconColor="text-success-content" iconBg="bg-green-100">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                </svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card class="border-warning" title="In Review" value="{{$stats['review']}}" change="Pending" iconColor="text-warning-content" iconBg="bg-orange-100">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-text" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                    <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
                </svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card class="border-red-500 bg-red-50" title="Resource Load" value="88%" change="High" iconColor="text-red-600" iconBg="bg-red-100">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                    <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z" />
                    <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                </svg>
            </x-slot:icon>
        </x-stat-card>
    </div>

    @php
    $headers = ['Project', 'Assigned To', 'Gitlab Id', 'Status', 'Last Updated' ,'Actions'];
    $headerClasses = ['', '', '', '','hidden md:table-cell', 'text-center'];
    $count = count($headers);
    @endphp

    <div class="lg:px-6">
        <x-table :headers="$headers" :headerClasses="$headerClasses" title='Current Projects'>
            @if($projects->isEmpty())
            <tr class="bg-white hover:bg:base-300 p-4">
                <td colspan="{{ $count }}" class="px-4 py-3 text-center md:text-2xl text-gray-500">
                    No projects added yet.
                </td>
            </tr>
            @else
            @foreach($projects as $project)
            <tr class=" bg-white hover:bg-base-300 p-4">
                <td class="justify-center text-blue-600 font-semibold font-sans text-left text-md sm:text-xl"> {{ $project->project_name }}</td>
                <td class="text-sm md:text-lg"> {{ $project->user->first_name}} {{ $project->user->last_name }}</td>
                <td class="text-sm md:text-lg"> {{ $project->gitlab_id }}</td>
                <td class="text-sm md:text-lg">
                    <div class="rounded-full badge badge-soft badge-sm md:badge-lg capitalize {{ $project->status->color() }}">
                        <div aria-label="status" class="status {{ $project->status->status() }}"></div>
                        <span class="hidden sm:inline font-semibold">{{ $project->status->label() }}</span>
                    </div>
                </td>
                <td class="md:text-lg hidden lg:table-cell text-gray-500"> {{ \App\Helpers\NepaliDate\src\NepaliDate::fromAd($project->updated_at->toDateTime())->format('F d, y g:i A') }}</td>
                <td>
                    <div class="flex gap-2 lg:gap-6 items-center-safe justify-center-safe">
                        <button class="btn btn-primary btn-soft btn-sm md:btn-md md:button-lg" data-action="{{route('projects.edit', $project)}}"
                            onclick="OpenEditModal(this)"
                            data-modal="modal_edit_project"
                            data-project_name="{{$project->project_name}}"
                            data-gitlab_id="{{$project->gitlab_id}}"
                            data-user_record_id="{{$project->user_record_id}}"
                            data-status="{{$project->status->value}}"
                            data-description="{{$project->description}}">
                            Update
                        </button>

                        <button class="btn btn-sm btn-error btn-soft hover:text-white lg:btn-md delete-btn"
                            data-action="{{ route('projects.delete', $project->id) }}">
                            Delete
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
            @if(! $projects->links()->isEmpty)
            <tr class="bg-base-300 pagination">
                <td colspan="{{ $count }}">{{ $projects->links() }} </td>
            </tr>
            @endif
        </x-table>
    </div>

    <x-modal.create creating="Add Project">
        <x-error-alert />
        <div class="p-3 px-6 grid gap-4">
            <label class="fieldset" for="project_name">
                <span class="label">PROJECT NAME *</span>
                <input type="text" class="input input-sm sm:input-md validator w-full" required minlength="4" maxlength="50"
                    name="project_name" id="project_name" placeholder="Enter Project Name">
                <p class="validator-hint hidden">Please, Enter a valid name of atleast 4 and maximum 50 characters. Required.</p>
            </label>

            <label class="fieldset" for="gitlab_id">
                <span class="label">GITLAB ID *</span>
                <input type="number" class="input input-sm sm:input-md validator w-full" required min="1" name="gitlab_id"
                    id="gitlab_id" placeholder="Enter Project Gitlab Id">
                <p class="validator-hint hidden">Please, Enter a valid gitlab id. Required</p>
            </label>

            <label class="fieldset" for="user_record_id">
                <span class="label">ASSIGNED TO *</span>
                <select required name="user_record_id" id="user_record_id" class="select validator w-full">
                    <option value="" selected disabled>Project Assigned To</option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{ $user->first_name }} {{ $user->last_name }}</option>
                    @endforeach
                </select>
                <p class="validator-hint hidden">Please, Assign the project to a user. Required</p>
            </label>

            <label class="fieldset" for="status">
                <span class="label">STATUS *</span>
                <select class="select validator w-full" id="status" required name="status">
                    <option value="" disabled selected>Current Project Status</option>
                    @foreach(App\Enums\ProjectStatus::cases() as $status)
                    <option value="{{ $status->value }}"> {{ $status->label() }} </option>
                    @endforeach
                </select>
                <p class="validator-hint hidden">Please, Assign the Project's Status. Required</p>
            </label>

            <label class="fieldset" for="description">
                <span class="label">PROJECT DESCRIPTION</span>
                <textarea class="textarea w-full" name="description" id="description"
                    placeholder="Enter Project Infomation"></textarea>
            </label>
        </div>
    </x-modal.create>

    <x-modal.create id="modal_edit_project" creating="Edit Project" methodPatch="true">
        <x-error-alert />

        <div class="p-3 px-6 grid gap-4">
            <label class="fieldset" for="project_name">
                <span class="label">PROJECT NAME * </span>
                <input type="text" class="input input-sm sm:input-md validator"
                    value="{{old('name', $project->project_name)}}" required name="project_name" id="project_name" minlength="4" maxlength="50"
                    placeholder="Enter Project Name">
                <p class="validator-hint hidden">Required</p>
            </label>

            <label class="fieldset" for="gitlab_id">
                <span class="label">GITLAB ID *</span>
                <input type="number" name="gitlab_id" id="gitlab_id0" class="input input-sm sm:input-md validator"
                    value="{{old('gitlab_id', $project->gitlab_id)}}" required min="1" placeholder="Enter Project Gitlab Id">
                <p class="validator-hint hidden">Enter a valid gitlab id. Required</p>
            </label>

            <label class="fieldset" for="user_record_id">
                <span class="label">ASSIGNED TO</span>
                <select required name="user_record_id" id="user_record_id" class="select validator"
                    value="{{old('user_record_id', $project->user_record_id)}}">
                    <option value="" selected disabled>Project Assigned To</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                    @endforeach
                </select>
                <p class="validator-hint hidden">Required</p>
            </label>

            <label class="fieldset" for="status">
                <span class="label">STATUS</span>
                <select class="select" required name="status" id="status" value="{{old('status')}}">
                    <option value="" disabled selected>Current Project Status</option>
                    @foreach(App\Enums\ProjectStatus::cases() as $status)
                    <option value="{{ $status->value }}" @selected( old('status', $project->status->value) === $status->value)> {{ $status->label() }} </option>
                    @endforeach
                </select>
                <p class="validator-hint hidden">Required</p>
            </label>

            <label class="fieldset" for="description">
                <span class="label">PROJECT DESCRIPTION</span>
                <textarea class="textarea" name="description" id="description"
                    value="{{old('description',)}}" placeholder="Enter Project Infomation"></textarea>
                <p class="validator-hint"></p>
            </label>
        </div>
    </x-modal.create>

    <x-modal.delete toDelete="Project"></x-modal.delete>

    @if($errors->any())
    <div id="modal-error-target" data-modal="{{ session('modal_id', 'modal_create') }}" class="hidden"></div>
    @endif

    @push('scripts')
    @vite('resources/js/chart.js')
    @endpush
</div>
@endsection