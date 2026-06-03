<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
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
            $this->routeIs('application.store') => $this->storeRules(),
            $this->routeIs('application.update') => $this->updateRules(),
            default => $this->storeRules()
        };
    }

    private function storeRules() : array
    {
        return [
            'name' => 'required|string|max:100',
            'gitlab_id' => 'required|integer|unique:applications',
        ];
    }

    private function updateRules(): array
    {
        return [
            'name' => 'sometimes|string|max:100',
            'gitlab_id' => 'sometimes|integer|unique:applications',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name field required',
            'name.string' => 'Name must be of type string',
            'name.max' => 'Name cannot be more than 100 characters',
            'gitlab_id.required' => 'gitlab_id required',
            'gitlab_id.integer' => 'gitlab_id must be an integer',
            'gitlab_id.unique' => 'gitlab_id already exits. It must be unique',
        ];
    }
}
