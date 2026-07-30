<?php

namespace App\Http\Requests\Web;

use App\Enums\ProjectStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return match (true) {
            $this->routeIs('projects.create') => $this->storeRules(),
            $this->routeIs('projects.edit') => $this->updateRules(),
            $this->routeIs('projects.updateStatus') => $this->updateStatusRules(),
            default => $this->storeRules()
        };
    }

    private function storeRules(): array
    {
        return [
            "gitlab_id"      => ['required', 'integer', 'min:1', Rule::unique('projects', 'gitlab_id')],
            "project_name"   => ['required', 'string', 'min:4', 'max:50'],
            "user_record_id" => ['required', 'integer', 'min:1'],
            "status"         => ['required', Rule::enum(ProjectStatus::class)],
            "sub_projects"   => ['nullable', 'array'],
            "sub_projects.*" => ['integer', 'exists:projects,id'],
            "description"    => ['nullable', 'string', 'min:10', 'max:600'],
        ];
    }

    private function updateRules(): array
    {
        $project = $this->route('project');
        $projectId = $project instanceof \App\Models\Project
            ? $project->id
            : (int) $project;

        return [
            "gitlab_id"      => ['required', 'integer', 'min:1', Rule::unique('projects', 'gitlab_id')->ignore($projectId)],
            "project_name"   => ['required', 'string', 'min:4', 'max:50'],
            "user_record_id" => ['required', 'integer', 'min:1'],
            "status"         => ['required', Rule::enum(ProjectStatus::class)],
            "sub_projects"   => ['nullable', 'array'],
            "sub_projects.*" => ['integer', 'exists:projects,id', Rule::notIn([$projectId])],
            "description"    => ['nullable', 'string', 'min:10', 'max:600'],
        ];
    }

    private function updateStatusRules(): array
    {
        return [
            'status'       => ['required', Rule::enum(ProjectStatus::class)],
            'sub_projects' => 'array'
        ];
    }

    public function messages(): array
    {
        return [
            "gitlab_id.int" => "Gitlab ID must be an integer",
            "gitlab_id.required" => "Gitlab ID is required",
            "project_name.string" => "Project name must be a string",
            "project_name.required" => "Project name is required",
            "project_name.max" => "Project name must not exceed 100 characters",
            "status.enum" => "Status must be one of ['completed', 'ongoing', 'abandoned']",
            "status.required" => "Status is required",
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $modalId = match (true) {
            $this->routeIs('projects.edit') => 'modal_edit_project',
            default => 'modal_create',
        };

        session()->flash('modal_id', $modalId);
        parent::failedValidation($validator);
    }
}
