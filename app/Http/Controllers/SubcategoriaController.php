<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use Illuminate\Http\Request;
use App\Traits\HttpsResponse;
use App\Enums\HttpsResponseType;
use App\Http\Requests\Subcategoria\SubCategoriaStoreRequest;
use App\Http\Requests\Subcategoria\SubCategoriaUpdateRequest;
use App\Http\Resources\SubcategoriaResource;

class SubcategoriaController extends Controller
{
    use HttpsResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategorias = Subcategoria::paginate(3);
        $subcategoriasResource = SubcategoriaResource::collection($subcategorias);

        //para mostrar la paginacion adecuadamente
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
            'Listado de categorías obtenido correctamente.',
            HttpsResponseType::HTTP_OK->value
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoriaStoreRequest $request)
    {
        $subcategoria = Subcategoria::create($request->validated());
        return $this->success(
            SubcategoriaResource::make($subcategoria),
            'Subcategoria creada correctamente.',
            HttpsResponseType::HTTP_CREATED->value
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategoria $subcategoria)
    {
        return $this->success(
            SubcategoriaResource::make($subcategoria),
            'Subcategoria obtenida correctamente.',
            HttpsResponseType::HTTP_OK->value
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoriaUpdateRequest $request, Subcategoria $subcategoria)
    {
        $subcategoria->update($request->validated());
        return $this->success(
            SubcategoriaResource::make($subcategoria),
            'Subcategoria actualizada correctamente.',
            HttpsResponseType::HTTP_OK->value
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategoria $subcategoria)
    {
        $subcategoria->delete();
        return $this->success(null, 'Subcategoria eliminada correctamente.', HttpsResponseType::HTTP_OK->value);
    }
}
