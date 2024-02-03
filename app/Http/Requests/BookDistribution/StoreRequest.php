<?php

namespace App\Http\Requests\BookDistribution;

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
            'reader_id' => 'required|integer',
            'distribution_date' => 'required|date',
            'must_be_returned_at' => 'required|date',
            'return_date' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'book_id.required' => 'This parameter must be filled in',
            'book_id.integer' => 'This parameter should be a integer',
            'reader_id.required' => 'This parameter must be filled in',
            'reader_id.integer' => 'This parameter should be a integer',
            'distribution_date.required' => 'This parameter must be filled in',
            'distribution_date.date' => 'This parameter should be a date',
            'must_be_returned_at.required' => 'This parameter must be filled in',
            'must_be_returned_at.date' => 'This parameter should be a string',
            'return_date.date' => 'This parameter should be a date',
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
