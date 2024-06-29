<?php

namespace App\Http\Requests\Ong;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOngRequest extends FormRequest
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
                'password' => ['required', 'string', 'min:6'],
                'photo_path' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
            ],
            'ong' => [
                'name'        => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:255'],
                'cnpj'        => ['required', 'string', 'max:255', 'unique:ongs'],
                'phone'       => ['required', 'string', 'max:255'],
                'responsible_name'  => ['required', 'string', 'max:255'],
                'responsible_phone' => ['required', 'string', 'max:255'],
                'responsible_cpf'   => ['required', 'string', 'max:255'],
            ],
            'address' => [
                'zip_code'        => ['required', 'string', 'max:255'],
                'street'          => ['required', 'string', 'max:255'],
                'number'          => ['required', 'string', 'max:255'],
                'neighborhood'    => ['required', 'string', 'max:255'],
                'city'            => ['required', 'string', 'max:255'],
                'state'           => ['required', 'string', 'max:255'],
                'country'         => ['required', 'string', 'max:255'],
                'complement'      => ['nullable', 'string', 'max:255'],
                'reference_point' => ['nullable', 'string', 'max:255'],
            ]
        ];
    }
}
