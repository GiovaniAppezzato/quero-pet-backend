<?php

namespace App\Http\Requests\Adopter;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdopterRequest extends FormRequest
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
            // ** User fields.
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'   => ['required', 'string', 'min:6'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],

            // ** Adopter fields.
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'cpf'        => ['required', 'string', 'max:255'],
            'phone'      => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],

            // ** Address fields.
            'zip_code'        => ['required', 'string', 'max:255'],
            'street'          => ['required', 'string', 'max:255'],
            'number'          => ['required', 'string', 'max:255'],
            'neighborhood'    => ['required', 'string', 'max:255'],
            'city'            => ['required', 'string', 'max:255'],
            'state'           => ['required', 'string', 'max:255'],
            'country'         => ['required', 'string', 'max:255'],
            'complement'      => ['nullable', 'string', 'max:255'],
            'reference_point' => ['nullable', 'string', 'max:255'],
        ];
    }
}