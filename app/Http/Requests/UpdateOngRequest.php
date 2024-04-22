<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOngRequest extends FormRequest
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
            'uesr' => [
                'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password'  => ['required', 'string', 'min:8', 'confirmed'],
            ],

            'customer'  => [
                'name'         =>  ['required', 'string', 'max:255'],
                'description'  =>  ['required', 'string', 'max:255'],
                'cnpj'         =>  ['required', 'string', 'max:255', 'unique:ongs'],
            ]
        ];
    }
}
