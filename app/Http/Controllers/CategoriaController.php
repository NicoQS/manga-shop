<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Traits\HttpsResponse;
use App\Enums\HttpsResponseType;
use App\Http\Requests\Categoria\CategoriaStoreRequest;
use App\Http\Requests\Categoria\CategoriaUpdateRequest;
use App\Http\Resources\CategoriaResource;

class CategoriaController extends Controller
{
    use HttpsResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::paginate(3);
        $categoriasResource = CategoriaResource::collection($categorias);

        //para mostrar la paginacion adecuadamente
        return $this->success(
            [
                'items' => $categoriasResource,
                'links' => [
                    'first' => $categorias->url(1),
                    'last' => $categorias->url($categorias->lastPage()),
                    'prev' => $categorias->previousPageUrl(),
                    'next' => $categorias->nextPageUrl(),
                ],
                'meta' => [
                    'current_page' => $categorias->currentPage(),
                    'from' => $categorias->firstItem(),
                    'last_page' => $categorias->lastPage(),
                    'path' => $categorias->path(),
                    'per_page' => $categorias->perPage(),
                    'to' => $categorias->lastItem(),
                    'total' => $categorias->total(),
                ],
            ],
            'Listado de categorías obtenido correctamente.',
            HttpsResponseType::HTTP_OK->value
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriaStoreRequest $request)
    {
        $categoria = Categoria::create($request->validated());
        return $this->success(
            $categoria,
            'Categoria creada correctamente.',
            HttpsResponseType::HTTP_CREATED->value
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        return $this->success(
            CategoriaResource::make($categoria),
            'Categoria obtenida correctamente.',
            HttpsResponseType::HTTP_OK->value
        );
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaUpdateRequest $request, Categoria $categoria)
    {
        $categoria->update($request->validated());
        return $this->success(
            CategoriaResource::make($categoria),
            'Categoria actualizada correctamente.',
            HttpsResponseType::HTTP_OK->value
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return $this->success(
            null,
            'Categoria eliminada correctamente.',
            HttpsResponseType::HTTP_OK->value
        );
    }
}
