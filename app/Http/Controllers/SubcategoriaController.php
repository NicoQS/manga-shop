<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use Illuminate\Http\Request;
use App\Traits\HttpsResponse;
use App\Enums\HttpsResponseType;
use App\Http\Requests\Subcategoria\SubCategoriaStoreRequest;
use App\Http\Requests\Subcategoria\SubCategoriaUpdateRequest;

class SubcategoriaController extends Controller
{
    use HttpsResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success(Subcategoria::query()->simplePaginate(5), 'Listado de subcategorias obtenido correctamente.', HttpsResponseType::HTTP_OK->value);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoriaStoreRequest $request)
    {
        $subcategoria = Subcategoria::create($request->validated());
        return $this->success($subcategoria, 'Subcategoria creada correctamente.', HttpsResponseType::HTTP_CREATED->value);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategoria $subcategoria)
    {
        return $this->success($subcategoria, 'Subcategoria obtenida correctamente.', HttpsResponseType::HTTP_OK->value);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoriaUpdateRequest $request, Subcategoria $subcategoria)
    {
        $subcategoria->update($request->validated());
        return $this->success($subcategoria, 'Subcategoria actualizada correctamente.', HttpsResponseType::HTTP_OK->value);
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
