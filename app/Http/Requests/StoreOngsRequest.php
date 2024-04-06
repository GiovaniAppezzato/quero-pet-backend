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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'cnpj' => ['required', 'string', 'max:255', 'unique:ongs'],
            'phone' => ['required', 'string', 'max:255'],
            'responsible_name' => ['nullable', 'string', 'max:255'],
            'responsible_phone' => ['nullable', 'string', 'max:255'],
            'responsible_cpf' => ['nullable', 'string', 'max:255'],
            'zip_code' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:255'],
            'neighborhood' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'complement' => ['nullable', 'string', 'max:255'],
            'reference_point' => ['nullable', 'string', 'max:255'],
        ];
    }
}
