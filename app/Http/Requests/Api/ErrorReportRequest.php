<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ErrorReportRequest extends FormRequest
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
            $this->routeIs('error.create') => $this->storeRules(),
            $this->routeIs('error.update') => $this->storeRules(),
            $this->routeIs('error.markfixed') => $this->markfixedRules(),
        };
    }

    private function storeRules()
    {
        return [
            "reporter"           => ['required', 'string', 'max:30'],
            "region"             => ['required', 'string', 'max:25'],
            "branch"             => ['required', 'string', 'max:30'],
            "project_id"         => ['required', 'int'],
            "problem_id"         => ['required', 'int'],
            "category_id"        => ['required', 'int'],
            "impact"             => ['sometimes', 'string', 'max:300'],
            "root_cause"         => ['sometimes', 'string', 'max:300'],
            "trigger"            => ['sometimes', 'string', 'max:500'],
            "message"            => ['sometimes', 'string', 'max:200'],
            "start_time"         => ['required', 'string'],
            "end_time"           => ['sometimes', 'string']
        ];
    }

    private function markfixedRules(): void {}

    public function messages(): array
    {
        return [];
    }
}
