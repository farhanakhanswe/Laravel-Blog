<?php

namespace App\Http\Requests\Web\Article;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
        $article = $this->route('article');

        return [
            'title' => ['required', 'string', 'max:255', Rule::unique('articles', 'title')->ignore($article->id)],
            'description' => ['required', 'string'],
            'summary' => ['required', 'string'],
            'status' => ['in:on'],
            'category' => ['required', 'integer', 'exists:categories,id'],
            'tag_id' => ['nullable', 'sometimes', 'array'],
            'tags.*' => ['integer', 'exists:tags,id']
        ];
    }
}
