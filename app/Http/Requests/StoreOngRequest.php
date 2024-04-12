<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOngsRequest extends FormRequest
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
            'user' => [
                'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            'ong' => [
                'name'        => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:255'],
                'cnpj'        => ['required', 'string', 'max:255', 'unique:ongs'],
                'phone'       => ['required', 'string', 'max:255'],
                'status'      => ['required', 'string', Rule::in(['pending', 'approved', 'rejected'])],
                'responsible_name'  => ['required', 'string', 'max:255'],
                'responsible_phone' => ['required', 'string', 'max:255'],
                'responsible_cpf'   => ['required', 'string', 'max:255'],
            ]
        ];
    }
}
