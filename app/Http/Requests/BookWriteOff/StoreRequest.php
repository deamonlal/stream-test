<?php

namespace App\Http\Requests\BookWriteOff;

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
            'book_id' => 'required|integer',
            'copies' => 'required|integer',
            'reason' => 'required|string',
            'date' => 'required|date'
        ];
    }

    public function messages(): array
    {
        return [
            'book_id.required' => 'This parameter must be filled in',
            'book_id.integer' => 'This parameter should be a integer',
            'copies.required' => 'This parameter must be filled in',
            'copies.integer' => 'This parameter should be a integer',
            'reason.required' => 'This parameter must be filled in',
            'reason.string' => 'This parameter should be an string',
            'date.required' => 'This parameter must be filled in',
            'date.date' => 'This parameter should be an date',
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
