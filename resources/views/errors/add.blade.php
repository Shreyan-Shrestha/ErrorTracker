@php use App\Enums\ErrorStatus; @endphp
@extends('partials.layout', ['title' => 'ErrorTracker | Report Error'])

@section('content')
<div class="w-full p-6">
    <x-breadcrumbs>
        <li class="font-semibold">
            <a href="{{route('errors.index')}}">Errors</a>
        </li>

        <li class="text-primary font-semibold">Report Error</li>
    </x-breadcrumbs>

    <p class="text-3xl">Report Error</p>
    <div class="p-3 lg:p-6 lg:w-6xl mx-auto">
        <form action="{{route('errors.create')}}" class="grid gap-2 md:gap-4 px-6" method="POST">
            @csrf

            <x-error-alert />

            <label class="fieldset">
                <legend class="fieldset-legend md:text-lg">Reported By *</legend>
                <select name="user_record_id" required class="select select-sm md:select-md validator w-full">
                    <option selected disabled value="">Select Yourself</option>
                    @foreach($users as $user) 
                    <option value="{{$user->id}}" @selected(old('user_record_id') == $user->id)> {{$user->first_name}} {{$user->last_name}}</option>
                    @endforeach
                </select>
                <p class="hidden validator-hint">Please select yourself. Required</p>
            </label>

            <legend class="fieldset-legend px-2 md:px-6 bg-base-300 font-bold md:text-xl">LOCATION</legend>
            <label class="fieldset grid grid-cols-1 lg:grid-cols-2 gap-10">
                <div class="grid">
                    <legend class="fieldset-legend md:text-lg">Region *</legend>
                    <input type="text" name="region" class="input input-sm md:input-md validator w-full" validator required
                        minlength="3" maxlength="25" value="{{old('region')}}" placeholder="Enter Your Region">
                    <p class="hidden validator-hint">Required.</p>
                </div>

                <div class="grid">
                    <legend class="fieldset-legend md:text-lg">Branch *</legend>
                    <input type="text" name="branch" class="input input-sm md:input-md validator w-full" validator required
                        minlength="3" maxlength="30" value="{{old('branch')}}" placeholder="Enter your Branch">
                    <p class="hidden validator-hint">Required.</p>
                </div>
            </label>


            <fieldset class="p-3 md:px-6 fieldset grid grid-cols-1 md:grid-cols-2 gap-10 gap-y-4 rounded-box border-2 bg-base-100 border-gray-300">
                <legend class="fieldset-legend md:text-xl font-bold text-gray-600">ISSUE DETAILS</legend>
                <label class="fieldset grid">
                    <legend class="fieldset-legend md:text-lg">Project *</legend>
                    <select name="project_id" class="select select-sm md:select-md w-full validator" required>
                        <option selected disabled>Assign the Project with the Error</option>
                        @foreach($projects as $project)
                        <option value="{{$project->id}}" @selected(old('project_id')==$project->id)>{{ $project->project_name }}</option>
                        @endforeach
                    </select>
                    <p class="hidden validator-hint">*Required.</p>
                </label>

                <label class="fieldset grid">
                    <legend class="fieldset-legend md:text-lg">Status*</legend>
                    <select class="select md:select-md validator w-full" name="status" required>
                        <option value="" selected disabled>Assign the Error's Current Status</option>
                        @foreach(App\Enums\ErrorStatus::cases() as $status)
                        <option value="{{$status->value}}" @selected(old('status') == $status->value)>{{$status->label()}}</option>
                        @endforeach
                    </select>
                </label>

                <label class=" fieldset grid">
                    <legend class="fieldset-legend md:text-lg">Issue *</legend>
                    <select name="problem_id" class="select validator md:select-md w-full" required w-full>
                        <option selected disabled>Assign the Issue </option>
                        @foreach($problems as $problem)
                        <option value="{{$problem->id}}" @selected(old('problem_id')==$problem->id)> {{$problem->name}} </option>
                        @endforeach
                    </select>
                    <p class="validator-hint hidden">*Required.</p>
                </label>

                <label class="fieldset grid">
                    <legend class="fieldset-legend md:text-lg">Issue Category *</legend>
                    <select name="category_id" class="select validator md:select-md w-full" required>
                        <option selected disabled>Assign the Issue Category</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}" @selected(old('category_id')==$category->id)> {{$category->name}}</option>
                        @endforeach
                    </select>
                    <p class="validator-hint">*Required</p>
                </label>

                <label class="fieldset col-span-2 grid">
                    <legend class="fieldset-legend md:text-lg">Issue Triggered By</legend>
                    <input type="text" class="input input-sm md:input-md w-full" name="trigger" value="{{old('trigger')}}"
                        minlength="5" maxlength="150" placeholder="eg. scheduled update, manual action, unknown....">
                    <p class="validator-hint hidden"></p>
                </label>

                <label class="fieldset col-span-2 grid">
                    <span class="label md:text-lg">Error Message</span>
                    <input type="text" class="input input-sm md:input-md validator w-full" name="message" value="{{old('message')}}"
                        minlength="5" maxlength="150" placeholder="Past the Error Message here">
                    <p class="validator-hint hidden">Optional</p>
                </label>

                <label class="fieldset col-span-2 grid">
                    <span class="label md:text-lg">Impact</span>
                    <input type="text" name="impact" class="input input-sm md:input-md validator w-full"
                        minlength="5" maxlength="150" placeholder="Describe who/what is affected" required value="{{old('impact')}}">
                    <p class="validator-hint hidden"></p>
                </label>

                <label class="fieldset grid col-span-2">
                    <span class="label md:text-lg">Root Cause Analysis:</span>
                    <textarea name="root_cause" class="input input-sm md:input-md validator h-16 md:h-36 w-full"
                    minlength="10" maxlength="1500" placeholder="Write the Root Cause Analysis for the Issue." value="{{old('root_cause')}}"></textarea>
                    <p class="validator-hint hidden">Optional. ( 10-1500 characters limit)</p>
                </label>

                
            </fieldset>

            <fieldset class="p-3 md:px-6 fieldset grid grid-cols-1 md:grid-cols-2 gap-10 gap-y-4 rounded-box border-2 bg-base-200 border-gray-300">
                <legend class="fieldset-legend md:text-xl">TIMING</legend>

                <label class="fieldset grid">
                    <span class="label md:text-lg">Start Time (DD/MM/YYYY) *</span>
                    <input type="text" class="nepali-datepicker input input-sm md:input-md validator w-full" id="start_time"
                        required name="start_time" pattern="^[0-9]{2}/[0-9]{2}/[0-9]{4}\s[0-9]{2}:[0-9]{2}\s[AM-PM]{2}"
                        value="{{old('start_time')}}" placeholder="30/05/2083 10:00 AM">
                    <p class="validator-hint hidden">Format: 30/05/2083 10:00 AM</p>
                </label>

                <label class="fieldset grid">
                    <span class="label text-lg">End Time (DD/MM/YYYY)*</span>
                    <input type="datetime" class="nepali-datepicker input input-sm md:input-md validator w-full" name="end_time" id="end_time"
                        value="{{old('end_time')}}" pattern="^[0-9]{2}/[0-9]{2}/[0-9]{4}\s[0-9]{2}:[0-9]{2}\s[AM-PM]{2}" placeholder="01/06/2083 01:00">
                    <p class="validator-hint hidden"></p>
                </label>
            </fieldset>

            <div class="flex flex-row justify-end-safe gap-2 mt-4 md:gap-4">
                <a class="btn md:btn-lg border-2 rounded-full" href="{{route('errors.index')}}">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </span>Cancel
                </a>

                <button type="submit" class="btn btn-primary text-white rounded-full md:btn-lg">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5" />
                        </svg>
                    </span> Submit Report
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startTimeInput = document.getElementById('start_time');
        const endTimeInput = document.getElementById('end_time');

        if (!startTimeInput || !endTimeInput) return;

        const today = NepaliFunctions.BS.GetCurrentDate();

        function initStartPicker(maxDate = today) {
            startTimeInput.NepaliDatePicker("destroy");
            startTimeInput.NepaliDatePicker({
                language: "english",
                dateFormat: "DD/MM/YYYY",
                maxDate: maxDate,
                onSelect: function(date) {
                    initEndPicker({
                        year: date.year,
                        month: date.month,
                        day: date.day
                    });
                }
            });
        }

        function initEndPicker(minDate = null) {
            endTimeInput.NepaliDatePicker("destroy");
            const options = {
                language: "english",
                dateFormat: "DD/MM/YYYY",
                maxDate: today,
                onSelect: function(date) {
                    initStartPicker({
                        year: date.year,
                        month: date.month,
                        day: date.day
                    });
                }
            };
            if (minDate) options.minDate = minDate;
            endTimeInput.NepaliDatePicker(options);
        }

        startTimeInput.addEventListener('input', function() {
            if (this.value === '') initEndPicker();
        });

        endTimeInput.addEventListener('input', function() {
            if (this.value === '') initStartPicker();
        });

        initStartPicker();
        initEndPicker();
    });
</script>
@endpush