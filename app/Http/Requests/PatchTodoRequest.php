<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatchTodoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string',
            'content' => 'sometimes|required|string',
            'isCompleted' => 'boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Le titre est requis',
            'title.string' => 'Le titre doit être une chaine de caractère',
            'content.required' => 'Le contenu est requis',
            'content.string' => 'Le contenu doit être une chaine de caractère',
            'is_completed' => 'Ce champs doit être un booléen'
        ];
    }
}
