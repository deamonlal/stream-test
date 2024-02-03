<?php

namespace App\Http\Requests\Reader;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'date_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'phone_number' => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'This parameter must be filled in',
            'first_name.string' => 'This parameter should be a string',
            'last_name.required' => 'This parameter must be filled in',
            'last_name.string' => 'This parameter should be a string',
            'date_birth.date' => 'This parameter should be a date',
            'address.string' => 'This parameter should be an string',
            'phone_number.required' => 'This parameter must be filled in',
            'phone_number.string' => 'This parameter should be an string',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message'   => 'Validation errors',
            'errors'      => $validator->errors()
        ]));
    }
}
