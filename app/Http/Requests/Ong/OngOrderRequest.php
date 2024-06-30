<?php

namespace App\Http\Requests\Ong;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OngOrderRequest extends FormRequest
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
            'status'     => ['required', 'string', Rule::in(['approved', 'canceled'])],
            'cancel_at'  => ['nullable', 'datetime'],
            'adopted_at' => ['nullable', 'datetime'],
            'pet_id'     => ['required', 'exists:pets,id'],
            'ong_id'     => ['required', 'exists:ongs,id'],
        ];
    }
}
