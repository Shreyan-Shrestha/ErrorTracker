@extends('partials.layout', ['title' => 'ErrorTracker | Report Error'])

@section('content')
<div class="w-full p-6">
    <p class="text-3xl">Report Error</p>
    <div class="p-3 lg:p-6  lg:w-6xl mx-auto">
        <form action="{{route('errors.create')}}" class="grid gap-2 md:gap-4 px-6" method="POST">
            @csrf
            <label class="fieldset">
                <legend class="fieldset-legend md:text-lg">Reported By *</legend>
                <input type="text" class="input input-sm md:input-md validator w-full" validator required
                    value="{{old('reporter')}}" name="" placeholder="Enter Your Full Name">
                <p class="hidden validator-hint">Required.</p>
            </label>

            <legend class="fieldset-legend px-2 md:px-6 bg-base-300 font-bold md:text-xl">LOCATION</legend>
            <label class="fieldset grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="grid gap-1">
                    <legend class="fieldset-legend md:text-lg">Region *</legend>
                    <input type="text" class="input input-sm md:input-md validator w-full" validator required
                        value="{{old('')}}" name="region" placeholder="Enter Your Region">
                    <p class="hidden validator-hint">Required.</p>
                </div>

                <div class="grid gap-1">
                    <legend class="fieldset-legend md:text-lg">Branch *</legend>
                    <input type="text" class="input input-sm md:input-md validator w-full" validator required
                        value="{{old('')}}" name="branch" placeholder="Enter your Branch">
                    <p class="hidden validator-hint">Required.</p>
                </div>

                <div class="grid gap-1">
                    <legend class="fieldset-legend md:text-lg">Project *</legend>
                    <select class="select select-sm md:select-md w-full" required name="project" value="{{old('project')}}">
                        <option selected disabled>Select the Project with the Error</option>
                        @foreach($projects as $project)
                        <option value="{{$project->id}}">{{ $project->project_name }}</option>
                        @endforeach
                    </select>
                    <p class="hidden validator-hint">*Required.</p>
                </div>
            </label>


            <fieldset class="p-3 md:px-6 fieldset grid grid-cols-1 md:grid-cols-2 gap-10 gap-y-4 rounded-box border-2 bg-base-100 border-gray-300">
                <legend class="fieldset-legend md:text-xl font-bold text-gray-600">ISSUE DETAILS</legend>

                <label class=" fieldset grid gap-1">
                    <legend class="fieldset-legend md:text-lg">Issue *</legend>
                    <select class="select validator md:select-md w-full" name="problem" required w-full>
                        <option selected disabled>Select the Issue</option>
                        @foreach($problems as $problem)
                        <option value="{{$problem->id}}"> {{$problem->name}} </option>
                        @endforeach
                    </select>
                    <p class="validator-hint hidden">*Required.</p>
                </label>

                <label class="fieldset grid gap-1">
                    <legend class="fieldset-legend md:text-lg">Issue Category *</legend>
                    <select class="select validator md:select-md w-full" required name="category">
                        <option selected disabled>Select the Issue Category</option>
                        @foreach($categories as $category)
                        <option value=" {{$category->id}} "> {{$category->name}}</option>
                        @endforeach
                    </select>
                    <p class="validator-hint">*Required</p>
                </label>

                <label class="fieldset grid gap-1">
                    <span class="label md:text-lg">Impact</span>
                    <input type="text" class="input input-sm md:input-md validator w-full" name="impact" 
                    placeholder="Describe who/what is affected" required value="{{old('impact')}}">
                    <p class="validator-hint hidden"></p>
                </label>

                <label class="fieldset grid gap-1">
                    <span class="label md:text-lg">Root Cause</span>
                    <input type="text" class="input input-sm md:input-md validator w-full" name="root_cause"
                    placeholder="Describe the indentified/possible root cause" value="{{old('root_cause')}}">
                    <p class="validator-hint hidden">Optional</p>
                </label>

                <label class="fieldset col-span-2 grid gap-1">
                    <legend class="fieldset-legend md:text-lg">Issue Triggered By</legend>
                    <input type="text" class="input input-sm md:input-md w-full" name="trigger" value="{{old('trigger')}}"
                    placeholder="eg. scheduled update, manual action, unknown....">
                    <p class="validator-hint hidden"></p>
                </label>

                <label class="fieldset col-span-2 grid gap-1">
                    <span class="label md:text-lg">Error Message</span>
                    <input type="text" class="input input-sm md:input-md validator w-full" name="message" value="{{old('message')}}"
                    placeholder="Past the Error Message here">
                    <p class="validator-hint hidden">Optional</p>
                </label>
            </fieldset>

            <fieldset class="p-3 md:px-6 fieldset grid grid-cols-1 md:grid-cols-2 gap-10 gap-y-4 rounded-box border-2 bg-base-200 border-gray-300">
                <legend class="fieldset-legend md:text-xl">TIMING</legend>

                <label class="fieldset grid gap-1">
                    <span class="label md:text-lg">Start Time *</span>
                    <input type="datetime" class="nepali-datepicker input input-sm md:input-md validator w-full" required name="start_time" value="{{old('start_time')}}"
                    placeholder="dd/mm/yyyy hh:mm">
                    <p class="validator-hint hidden"></p>
                </label>

                <label class="fieldset grid gap-1">
                    <span class="label text-lg">End Time *</span>
                    <input type="datetime" class="nepali-datepicker input input-sm md:input-md validator w-full" required name="start_time" value="{{old('start_time')}}"
                    placeholder="dd/mm/yyyy hh:mm">
                    <p class="validator-hint hidden"></p>
                </label>
            </fieldset>

            <div class="flex flex-row justify-end-safe gap-2 mt-4 md:gap-4">
                <a class="btn md:btn-lg border-2 rounded-full" href="{{route('errors.index')}}">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </span>Cancel</span>
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
    window.onload = function() {
            var miniEnglishDatesInput = document.getElementsByClassName(
                "nepali-datepicker"
            );
            miniEnglishDatesInput.NepaliDatePicker({
                "language": "english",
                "dateFormat": "DD/MM/YY",
                "disableDaysAfter": 1,
            });
        };
</script>
@endpush