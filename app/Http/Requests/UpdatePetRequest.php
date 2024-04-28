<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePetRequest extends FormRequest
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

            'pet'  => [
                'name'          => ['required', 'string', 'max:255'],
                'description'   => ['nullable', 'string', 'max:255'],
                'breed'         => ['required', 'string', 'max:255'],
                'age'           => ['required', 'string', 'max:255'],
                'weight'        => ['required', 'string', 'max:255'],
                'color'         => ['required', 'string', 'max:255'],
                'banner'        => ['required', 'string', 'max:255'],
                'sex'           => ['required', 'string', Rule::in(['M', 'F'])],
                'birth_date'    => ['required', 'date'],
                'is_vaccinated' => ['required', 'boolean'],
            ]
        ];
    }
}