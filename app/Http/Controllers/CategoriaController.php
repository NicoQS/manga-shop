<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Traits\HttpsResponse;
use App\Enums\HttpsResponseType;
use App\Http\Requests\Categoria\CategoriaStoreRequest;
use App\Http\Requests\Categoria\CategoriaUpdateRequest;
use App\Http\Resources\CategoriaResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    use HttpsResponse;


    public function index() : JsonResponse
    {
        $categorias = Categoria::paginate(3);
        $categoriasResource = CategoriaResource::collection($categorias);

        // Debo agregar campos de links y meta para que el trait HttpsResponse pueda devolver la paginación correctamente
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


    public function store(CategoriaStoreRequest $request) : JsonResponse
    {
        try {
            DB::beginTransaction();
            $categoria = Categoria::create($request->validated());
            DB::commit();
            return $this->success(
                $categoria,
                'Categoria creada correctamente.',
                HttpsResponseType::HTTP_CREATED->value
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error(
                'Error al crear la categoria.',
                HttpsResponseType::HTTP_INTERNAL_SERVER_ERROR->value
            );
        }
    }


    public function show(Categoria $categoria) : JsonResponse
    {
        return $this->success(
            CategoriaResource::make($categoria),
            'Categoria obtenida correctamente.',
            HttpsResponseType::HTTP_OK->value
        );
    }


    public function update(CategoriaUpdateRequest $request, Categoria $categoria) : JsonResponse
    {
        try {
            DB::beginTransaction();
            $categoria->update($request->validated());
            DB::commit();
            return $this->success(
                CategoriaResource::make($categoria),
                'Categoria actualizada correctamente.',
                HttpsResponseType::HTTP_OK->value
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error(
                'Error al actualizar la categoria.',
                HttpsResponseType::HTTP_INTERNAL_SERVER_ERROR->value
            );
        }
    }


    public function destroy(Categoria $categoria) : JsonResponse
    {
        $categoria->delete();
        return $this->success(
            null,
            'Categoria eliminada correctamente.',
            HttpsResponseType::HTTP_OK->value
        );
    }
}
