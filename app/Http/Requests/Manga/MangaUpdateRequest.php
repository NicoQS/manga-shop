<?php

namespace App\Http\Requests\Manga;

use Illuminate\Foundation\Http\FormRequest;

class MangaUpdateRequest extends FormRequest
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
            'titulo' => 'sometimes|string|max:255',
            'portada' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categoria_id' => 'sometimes|exists:categorias,id',
            'subcategoria_id' => 'sometimes|exists:subcategorias,id',
        ];
    }
}
