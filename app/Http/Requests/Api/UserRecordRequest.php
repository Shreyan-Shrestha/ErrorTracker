<?php

namespace App\Http\Requests\Api;

use App\Enums\UserRole;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;

class UserRecordRequest extends FormRequest
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
        return match(true) {
            default =>$this->storeRules()
        };
    }

    private function storeRules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email:rfc,dns', 'unique:user_records,email'],
            'role' => ['required', Rule::enum(UserRole::class)],
            'region' => ['required', 'string'],
            'branch' => ['required', 'string']
        ];
    }


    public function messages(): array
    {
        return [
            "first_name.required" => "First Name is required.",
            "last_name.required" => "Last Name is required.",
            "role.required" => "Role field is required.",
            "role.enum" => "Invalid role selected",
            "region.required" => "Region is required.",
            "branch.required" => "Branch is required.",
            "email.required" => "Email is required.",
            "email.unique" => "Email is already linked to an existing User.",
            "first_name.string" => "Please Enter a valid First Name.",
            "last_name.string" => "Please Enter a valid Last Name.",
            "email.email:rfc,dns" => "Please Enter a valid Email Address",
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        session()->flash('modal_id', 'modal_create');
        parent::failedValidation($validator);
    }
}
