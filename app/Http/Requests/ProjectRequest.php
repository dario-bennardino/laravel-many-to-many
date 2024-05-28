<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title' => 'required|min:2|max:100',
            'description' => 'required|min:10',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Devi inserire il nome del progetto',
            'title.min' => 'Il progetto deve avere almeno :min caratteri',
            'title.max' => 'Il progetto non deve avere piu di :max caratteri',
            'description.required' => 'Devi inserire la descrizione del progetto',
            'description.min' => 'La descrizione deve avere almeno :min caratteri',
        ];
    }
}
