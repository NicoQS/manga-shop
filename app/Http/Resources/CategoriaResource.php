<?php

namespace App\Http\Resources;

use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // obtengo las subcategorias de una categoria en particular debo hacer la query
        $subcategorias = Subcategoria::where('categoria_id', $this->id)->get();
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'subcategoria' => SubcategoriaResource::collection($subcategorias),
        ];
    }
}
