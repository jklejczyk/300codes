<?php

namespace App\Http\Requests\BookRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tytuł książki jest wymagany.',
            'title.string' => 'Tytuł książki musi być tekstem.',
            'title.max' => 'Tytuł książki nie może przekraczać 255 znaków.',
        ];
    }
}
