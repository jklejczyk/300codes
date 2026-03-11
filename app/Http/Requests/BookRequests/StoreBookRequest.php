<?php

namespace App\Http\Requests\BookRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'author_ids' => ['required', 'array', 'min:1'],
            'author_ids.*' => ['integer', 'exists:authors,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tytuł książki jest wymagany.',
            'title.string' => 'Tytuł książki musi być tekstem.',
            'title.max' => 'Tytuł książki nie może przekraczać 255 znaków.',
            'author_ids.required' => 'Lista autorów jest wymagana.',
            'author_ids.array' => 'Lista autorów musi być tablicą.',
            'author_ids.min' => 'Książka musi mieć co najmniej jednego autora.',
            'author_ids.*.exists' => 'Wybrany autor nie istnieje.',
        ];
    }
}
