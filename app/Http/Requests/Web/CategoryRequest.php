<?php

namespace App\Http\Requests\Web;

use App\Enums\ErrorSeverity;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'severity' => ['required', Rule::enum(ErrorSeverity::class)],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please provide a valid Category Name',
            'name.string' => 'Category Name can only be characters',
            'name.max' => 'Category Name must be under 100 characters',
            'severity.required' => 'Please select a Severity level',
            'severity.rule' => 'Invalid Category Severity ',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $modalId = match(true){
            $this->routeIs('category.create') => 'modal_category',
            default => 'modal_category',    
        };

        session()->flash('modal_id', $modalId);
        parent::failedValidation($validator);
    }
}
