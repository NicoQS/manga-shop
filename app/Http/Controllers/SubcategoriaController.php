<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use App\Traits\HttpsResponse;
use App\Enums\HttpsResponseType;
use App\Http\Requests\Subcategoria\SubCategoriaStoreRequest;
use App\Http\Requests\Subcategoria\SubCategoriaUpdateRequest;
use App\Http\Resources\SubcategoriaResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class SubcategoriaController extends Controller
{
    use HttpsResponse;


    public function index() : JsonResponse
    {
        $subcategorias = Subcategoria::paginate(3);
        $subcategoriasResource = SubcategoriaResource::collection($subcategorias);

        // Debo agregar campos de links y meta para que el trait HttpsResponse pueda devolver la paginación correctamente
        return $this->success(
            [
                'items' => $subcategoriasResource,
                'links' => [
                    'first' => $subcategorias->url(1),
                    'last' => $subcategorias->url($subcategorias->lastPage()),
                    'prev' => $subcategorias->previousPageUrl(),
                    'next' => $subcategorias->nextPageUrl(),
                ],
                'meta' => [
                    'current_page' => $subcategorias->currentPage(),
                    'from' => $subcategorias->firstItem(),
                    'last_page' => $subcategorias->lastPage(),
                    'path' => $subcategorias->path(),
                    'per_page' => $subcategorias->perPage(),
                    'to' => $subcategorias->lastItem(),
                    'total' => $subcategorias->total(),
                ],
            ],
            'Listado de subcategorias obtenido correctamente.',
            HttpsResponseType::HTTP_OK->value
        );
    }


    public function store(SubCategoriaStoreRequest $request) : JsonResponse
    {
        try {
            DB::beginTransaction();
            $subcategoria = Subcategoria::create($request->validated());
            DB::commit();
            return $this->success(
                SubcategoriaResource::make($subcategoria),
                'Subcategoria creada correctamente.',
                HttpsResponseType::HTTP_CREATED->value
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), HttpsResponseType::HTTP_INTERNAL_SERVER_ERROR->value);
        }
    }


    public function show(Subcategoria $subcategoria) : JsonResponse
    {
        return $this->success(
            SubcategoriaResource::make($subcategoria),
            'Subcategoria obtenida correctamente.',
            HttpsResponseType::HTTP_OK->value
        );
    }


    public function update(SubCategoriaUpdateRequest $request, Subcategoria $subcategoria) : JsonResponse
    {
        try {
            DB::beginTransaction();
            $subcategoria->update($request->validated());
            DB::commit();
            return $this->success(
                SubcategoriaResource::make($subcategoria),
                'Subcategoria actualizada correctamente.',
                HttpsResponseType::HTTP_OK->value
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), HttpsResponseType::HTTP_INTERNAL_SERVER_ERROR->value);
        }
    }


    public function destroy(Subcategoria $subcategoria) : JsonResponse
    {
        $subcategoria->delete();
        return $this->success(null, 'Subcategoria eliminada correctamente.', HttpsResponseType::HTTP_OK->value);
    }
}
