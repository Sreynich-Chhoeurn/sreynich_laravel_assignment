<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreAuthorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422)  // Use 422 Unprocessable Entity (you can change to 412 if needed)
        );
    }

    /**
     * Get the validation rules that apply to the request.
     * 
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:255',
            'bio' => 'nullable|string|max:1000',
            'nationality' => 'required|string|max:255',
        ];
    }
}
