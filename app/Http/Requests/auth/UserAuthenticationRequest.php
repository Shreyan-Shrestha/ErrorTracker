<?php

namespace App\Http\Requests\auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class UserAuthenticationRequest extends FormRequest
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
            "name" => [ 'nullable','string', 'max: 50'],
            "email" => ['required', 'email:dns', 'max:100'],
            "password" => ['required', 'min:8']
        ];
    }

    public function messages() : array
    {
        return [
            "email.required" => "Email is required",
            "email.dns" => "Please enter a valid emial address",
            "password.required" => "Please enter password",
            "password.min" => "Password needs to be atleast 8 characters"
        ];
    }
}
