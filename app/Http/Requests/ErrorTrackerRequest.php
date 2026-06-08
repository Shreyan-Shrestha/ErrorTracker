<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
        return [
            "region"             => ['required', 'string', 'max:25'],
            "branch"             => ['required', 'string', 'max:30'],
            "application_id"     => ['nullable', 'int'],
            "issue"              => ['required', 'string', 'max: 200'],
            "impact"             => ['nullable', 'string', 'max:300'],
            "root_cause"         => ['nullable', 'string', 'max:300'],
            "estimated_down"     => ['nullable', 'time'],
            "start_time"         => ['nullable', 'string'], // Changed to string to handle NepaliDate
            "end_time"           => ['nullable', 'string'],   //Changed from dateTime to string 
            "issue_triggered_by" => ['nullable', 'string', 'max:500'],
            "error_message"      => ['nullable', 'string', 'max:200'],
            "severity"           => ['required', 'string', 'max:10']
        ];
    }
}
