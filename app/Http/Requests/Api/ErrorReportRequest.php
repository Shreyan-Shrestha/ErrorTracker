<?php

namespace App\Http\Requests\Api;

use App\Enums\ErrorStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            $this->routeIs('errors.analysis') => $this->analysisRules(),
            $this->routeIs('errors.markfixed') => $this->markfixedRules(),
            default => $this->storeRules()
        };
    }

    private function storeRules()
    {
        return [
            "user_record_id"     => ['required', 'int', 'min:1'],
            "region"             => ['required', 'string', 'min:3', 'max:25'],
            "branch"             => ['required', 'string', 'min:3', 'max:30'],
            "project_id"         => ['required', 'int'],
            "problem_id"         => ['required', 'int'],
            "category_id"        => ['required', 'int'],
            "impact"             => ['nullable', 'string', 'min:5',  'max:150'],
            "root_cause"         => ['nullable', 'string', 'min:10', 'max:1500'],
            "trigger"            => ['nullable', 'string', 'min:5' , 'max:150'],
            "message"            => ['nullable', 'string', 'min:5', 'max:50'],
            "status"             => ['required', Rule::enum(ErrorStatus::class)],
            "start_time"         => ['required', 'string'],
            "end_time"           => [
                'nullable', 'string', Rule::requiredIf(fn() => $this->input('status') === ErrorStatus::Fixed->value),
            ],
        ];
    }

    private function analysisRules() : array 
    {
        return [
            "root_cause" => ['required', 'string', 'min:10', 'max:1500']
        ];    
    }

    private function markfixedRules(): void {}

    public function messages(): array
    {
        return [
            'user_record_id.required' => 'Please assign your Name from the list.',
            'region.required' => 'Please assign the name of your Region.',
            'branch.required' => 'Please assign the name of your Branch.',
            'project_id.required' => 'Please assign the Project with the Error.',
            'problem_id.required' => 'Please assign a Problem to the Error report',
            'category_id.required' => 'Please assign a Category to the Error report',
            'impact.min' => 'Impact field must be minimum 5 characters.',
            'impact.max' => 'Impact field cannot exceed 150 characters',
            'root_cause.min' => 'Root Cause Analysis field must be above 10 characters.',
            'root_cause.max' => 'Root Cause Analysis field cannot exceed 1500 characters',
            'trigger.min' => 'Trigerred By field must be above 5 characters.',
            'trigger.max' => 'Trigerred By field cannot exceed 150 characters.',
            'end_time.required' => 'Please assign a valid End Time to set the Error as Fixed',
        ];
    }

     protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        session()->flash('modal_id', 'modal_create');
        parent::failedValidation($validator);
    }
}
