<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;
use App\Traits\HttpsResponse;
use App\Enums\HttpsResponseType;
use App\Http\Requests\Manga\MangaStoreRequest;
use App\Http\Requests\Manga\MangaUpdateRequest;

class MangaController extends Controller
{
    use HttpsResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success(Manga::query()->simplePaginate(10), 'Listado de mangas obtenido correctamente.', HttpsResponseType::HTTP_OK->value);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(MangaStoreRequest $request)
    {
        $manga = Manga::create($request->validated());
        return $this->success($manga, 'Manga creado correctamente.', HttpsResponseType::HTTP_CREATED->value);
    }

    /**
     * Display the specified resource.
     */
    public function show(Manga $manga)
    {
        return $this->success($manga, 'Manga obtenido correctamente.', HttpsResponseType::HTTP_OK->value);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(MangaUpdateRequest $request, Manga $manga)
    {
        $manga->update($request->validated());
        return $this->success($manga, 'Manga actualizado correctamente.', HttpsResponseType::HTTP_OK->value);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manga $manga)
    {
        $manga->delete();
        return $this->success(null, 'Manga eliminado correctamente.', HttpsResponseType::HTTP_OK->value);
    }
}
