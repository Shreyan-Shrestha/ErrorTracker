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
            $this->routeIs('users.create') => $this->storeRules(),
            $this->routeIs('users.edit') => $this->updateRules()
        };
    }

    private function storeRules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email:rfc,dns', 'unique:users,user_records'],
            'role' => ['required', Rule::enum(UserRole::class)],
            'region' => ['required', 'string'],
            'branch' => ['required', 'string']
        ];
    }

    private function updateRules(): array
    {
        return [
            'first_name' => ['sometimes', 'string', 'max:50'],
            'last_name' => ['sometimes', 'string', 'max:20'],
            'email' => ['sometimes', 'email:rfc,dns'],
            'role' => ['sometimes', Rule::enum(UserRole::class)],
            'region' => ['sometimes', 'string'],
            'branch' => ['sometimes', 'string']
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
