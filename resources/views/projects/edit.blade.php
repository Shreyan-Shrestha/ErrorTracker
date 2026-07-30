<x-modal.create id="modal_edit_project" creating="Update Project" methodPatch="true">
        <x-error-alert />

        <div class="p-3 px-6 grid gap-4">
            <label class="fieldset" for="edit_project_name">
                <span class="label">PROJECT NAME * </span>
                <input type="text" class="input input-sm sm:input-md validator w-full"
                    value="{{old('project_name')}}" required name="project_name" id="edit_project_name" minlength="4" maxlength="50"
                    placeholder="Enter Project Name">
                <p class="validator-hint hidden">Required</p>
            </label>

            <label class="fieldset" for="edit_gitlab_id">
                <span class="label">GITLAB ID *</span>
                <input type="number" name="gitlab_id" id="edit_gitlab_id" class="input input-sm sm:input-md validator w-full"
                    value="{{old('gitlab_id')}}" required min="1" placeholder="Enter Project Gitlab Id">
                <p class="validator-hint hidden">Enter a valid gitlab id. Required</p>
            </label>

            <label class="fieldset" for="edit_user_record_id">
                <span class="label">ASSIGNED TO</span>
                <select required name="user_record_id" id="edit_user_record_id" class="select validator w-full"
                    value="{{old('user_record_id')}}">
                    <option value="" selected disabled>Project Assigned To</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                    @endforeach
                </select>
                <p class="validator-hint hidden">Required</p>
            </label>

            <label class="fieldset" for="edit_sub_projects">
                <div class="flex gap-x-2">
                    <span class="label md:text-md">SUB PROJECTS</span> <span class="flex-wrap gap-2" id="selected_projects"></span>
                </div>
                <details>
                    <summary id="edit_sub-projects" class="dropdown w-full select">Select Sub-Projects</summary>
                    <ul class="sub-projects-list dropdown-content rounded-box p-2 border border-gray-400 grid overflow-y-scroll h-60">
                        @foreach($projects_list as $project)
                        <li>
                            <label class="hover:bg-base-300 p-2 flex gap-x-2 content-center-safe cursor-pointer w-full">
                                <input name="sub_projects[]" type="checkbox" class="sub-project-checkbox checkbox checkbox-sm checkbox-warning"
                                    value="{{$project->id}}" data-name="{{$project->project_name}}">
                                <span class="text-sm tracking-wide">{{ $project->project_name }}</span>
                            </label>
                        </li>
                        @endforeach
                    </ul>
                    </option>
                </details>
            </label>

            <label class="fieldset" for="edit_status">
                <span class="label">STATUS</span>
                <select class="select select-md validator w-full" required name="status" id="edit_status" value="{{old('status')}}">
                    <option value="" disabled selected>Current Project Status</option>
                    @foreach(App\Enums\ProjectStatus::cases() as $status)
                    <option value="{{ $status?->value }}" @selected( old('status') === $status->value)> {{ $status?->label() }} </option>
                    @endforeach
                </select>
                <p class="validator-hint hidden">Required</p>
            </label>

            <label class="fieldset" for="edit_description">
                <span class="label">PROJECT DESCRIPTION</span>
                <textarea class="textarea w-full" name="description" id="edit_description"
                    placeholder="Enter Project Infomation">{{old('description')}}</textarea>
                <p class="validator-hint"></p>
            </label>
        </div>
    </x-modal.create>