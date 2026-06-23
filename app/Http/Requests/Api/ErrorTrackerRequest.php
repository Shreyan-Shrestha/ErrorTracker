<?php

namespace App\Http\Requests\Api;

use App\Enums\ErrorSeverity;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ErrorTrackerRequest extends FormRequest
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
            $this->routeIs('error.create') => $this->storeRules(),
            $this->routeIs('error.update') => $this->updateRules(),
            $this->routeIs('error.markfixed') => $this->markfixedRules(),
        };
    }

    private function storeRules(){
        return [
            "region"             => ['required', 'string', 'max:25'],
            "branch"             => ['required', 'string', 'max:30'],
            "application_id"     => ['required', 'int'],
            "issue"              => ['required', 'string', 'max: 200'],
            "impact"             => ['sometimes', 'string', 'max:300'],
            "root_cause"         => ['sometimes', 'string', 'max:300'],
            "start_time"         => ['required', 'string'],
            "issue_triggered_by" => ['sometimes', 'string', 'max:500'],
            "error_message"      => ['sometimes', 'string', 'max:200'],
            "severity"           => ['required', Rule::enum(ErrorSeverity::class) ]
        ];
    }

    private function updateRules(){
       return [
            "region"             => ['sometimees', 'string', 'max:25'],
            "branch"             => ['sometimes', 'string', 'max:30'],
            "application_id"     => ['sometimes', 'int'],
            "issue"              => ['sometimes', 'string', 'max: 200'],
            "impact"             => ['sometimes', 'string', 'max:300'],
            "root_cause"         => ['sometimes', 'string', 'max:300'],
            "start_time"         => ['sometimes', 'string'],
            "issue_triggered_by" => ['sometimes', 'string', 'max:500'],
            "error_message"      => ['sometimes', 'string', 'max:200'],
            "severity"           => ['sometimes', Rule::enum(ErrorSeverity::class) ]
        ];
    }

    private function markfixedRules() : void {
        
    }
}
