<?php

namespace App\Http\Requests\User;

use App\Enums\UserRole;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'document' => ['required', 'int', 'unique:users,document'],
            'phone' => ['required', 'int', 'min:9'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', Rule::in(UserRole::values())],

        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'document' => preg_replace('/\D/', '', $this->document),
            'phone' => preg_replace('/\D/', '', $this->phone),
            'status' => 'Ativo'
        ]);
    }
}