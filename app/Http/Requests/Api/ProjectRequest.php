<?php

namespace App\Http\Requests\Api;

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
        return match(true){
            $this->routeIs('project.store') => $this->storeRules(),
            $this->routeIs('project.update') => $this->updateRules(),
            $this->routeIs('project.updateStatus') => $this->updateStatusRules(),
            default => $this->storeRules()
        };
    }

    private function storeRules() : array
    {
        return [
            "gitlab_id" => "required|int",
            "project_name" => "required|string|max:100",
            "status" => "required", Rule::enum(ProjectStatus::class),
        ];
    }

    private function updateRules() : array
    {
        return [
            "gitlab_id" => "sometimes|int",
            "project_name" => "sometimes|string|max:100",
            "status" => "sometimes|", Rule::enum(ProjectStatus::class),
        ];
    }

    private function updateStatusRules() : array
    {
        return [
            "status" => "required|", Rule::enum(ProjectStatus::class),
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
            "status.string" => "Status must be a string",
            "status.required" => "Status is required",
            "status.max" => "Status must not exceed 20 characters",
        ];
    }
}