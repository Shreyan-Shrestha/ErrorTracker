<?php

namespace App\Http\Requests\Web;

use App\View\Components\modal\create;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProblemRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Problem Name is Required',
            'name.string' => 'Problem Name must have only characters',
            'name.max' => 'Problem Name Must Be Less Than 100 Characters',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $modalId = match(true){
            $this->routeIs('problems.create') => 'modal_problem',
            $this->routeIs('problems.edit') => 'modal_edit_problem',
            default => 'modal_problem',
        };

        session()->flash('modal_id', $modalId);
        parent::failedValidation($validator);
    }
}
