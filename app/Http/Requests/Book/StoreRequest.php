<?php

namespace App\Http\Requests\Book;

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
            'title' => 'required|string|max:255',
            'publication_year' => 'required|date',
            'copies' => 'required|integer',
            'authors' => "required|array"
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'This parameter must be filled in',
            'title.string' => 'This parameter should be a string',
            'publication_year.date' => 'This parameter should be a date',
            'copies.required' => 'This parameter must be filled in',
            'copies.integer' => 'This parameter should be a integer',
            'authors.required' => 'This parameter must be filled in',
            'authors.array' => 'This parameter should be an array',
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
