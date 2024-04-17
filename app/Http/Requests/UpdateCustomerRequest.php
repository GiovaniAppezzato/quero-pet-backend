<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  =>  ['required', 'string', 'max:255'],
            'cpf'        =>  ['required', 'string', 'max:255'],
            'phone'      =>  ['required', 'string', 'max:255'],
            'birth_date' =>  ['required', 'string', 'max:255'],
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */

    // protected function failedValidation(Validator $validator): void
    // {
    //     $response = new JsonResponse([
    //         'success' => false,
    //         'errors' => $validator->errors(),
    //     ], 422);

    //     throw new HttpResponseException($response);
    // }
}
