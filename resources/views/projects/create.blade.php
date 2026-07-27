<x-modal.create creating="Add Project">
        <x-error-alert />
        <div class="p-3 px-6 grid gap-4">
            <label class="fieldset" for="project_name">
                <span class="label md:text-md">PROJECT NAME *</span>
                <input type="text" class="input input-sm sm:input-md validator w-full" required minlength="4" maxlength="50"
                    name="project_name" id="project_name" placeholder="Enter Project Name">
                <p class="validator-hint hidden">Please, Enter a valid name of atleast 4 and maximum 50 characters. Required.</p>
            </label>

            <label class="fieldset" for="gitlab_id">
                <span class="label md:text-md">GITLAB ID *</span>
                <input type="number" class="input input-sm sm:input-md validator w-full" required min="1" name="gitlab_id"
                    id="gitlab_id" placeholder="Enter Project Gitlab Id">
                <p class="validator-hint hidden">Please, Enter a valid gitlab id. Required</p>
            </label>

            <label class="fieldset" for="user_record_id">
                <span class="label md:text-md">ASSIGNED TO *</span>
                <select required name="user_record_id" id="user_record_id" class="select validator w-full">
                    <option value="" selected disabled>Project Assigned To</option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{ $user->first_name }} {{ $user->last_name }}</option>
                    @endforeach
                </select>
                <p class="validator-hint hidden">Please, Assign the project to a user. Required</p>
            </label>

            <label class="fieldset" for="sub_projects">
                <div class="flex gap-x-2">
                    <span class="label md:text-md">SUB PROJECTS</span> <span class="flex-wrap gap-2" id="selected_projects"></span>
                </div>
                <details>
                    <summary class="dropdown w-full select" id="sub_projects">Assign Sub Projects</summary>
                    <ul class="sub-projects-list dropdown-content rounded-box p-2 border border-gray-400 grid overflow-y-scroll min-h-10 max-h-60">
                        @if($projects_list->isEmpty())
                        <li class="text-center text-sm tracking-wide">No Projects Added Yet.</li>

                        @else
                        @foreach($projects_list as $project)
                        <li>
                            <label class="hover:bg-base-300 p-2 flex gap-x-2 content-center-safe cursor-pointer w-full">
                                <input name="sub_projects[]" type="checkbox" class="sub-project-checkbox checkbox checkbox-sm checkbox-warning"
                                    value="{{$project->id}}" data-name="{{$project->project_name}}">
                                <span class="text-sm tracking-wide">{{ $project->project_name }}</span>
                            </label>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </details>
            </label>

            <label class="fieldset" for="status">
                <span class="label md:text-md">STATUS *</span>
                <select class="select validator w-full" id="status" required name="status">
                    <option value="" disabled selected>Current Project Status</option>
                    @foreach(App\Enums\ProjectStatus::cases() as $status)
                    <option value="{{ $status?->value }}"> {{ $status?->label() }} </option>
                    @endforeach
                </select>
                <p class="validator-hint hidden">Please, Assign the Project's Status. Required</p>
            </label>

            <label class="fieldset" for="description">
                <span class="label md:text-md">PROJECT DESCRIPTION</span>
                <textarea class="textarea w-full" name="description" id="description"
                    placeholder="Enter Project Infomation"></textarea>
            </label>
        </div>
    </x-modal.create>