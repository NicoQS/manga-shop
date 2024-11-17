<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;
use App\Traits\HttpsResponse;
use App\Enums\HttpsResponseType;
use App\Http\Requests\Manga\MangaStoreRequest;
use App\Http\Requests\Manga\MangaUpdateRequest;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\MangaResource;

class MangaController extends Controller
{
    use HttpsResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mangas = Manga::paginate(3);
        $mangasResource = MangaResource::collection($mangas);

        //para mostrar la paginacion adecuadamente
        return $this->success(
            [
                'items' => $mangasResource,
                'links' => [
                    'first' => $mangas->url(1),
                    'last' => $mangas->url($mangas->lastPage()),
                    'prev' => $mangas->previousPageUrl(),
                    'next' => $mangas->nextPageUrl(),
                ],
                'meta' => [
                    'current_page' => $mangas->currentPage(),
                    'from' => $mangas->firstItem(),
                    'last_page' => $mangas->lastPage(),
                    'path' => $mangas->path(),
                    'per_page' => $mangas->perPage(),
                    'to' => $mangas->lastItem(),
                    'total' => $mangas->total(),
                ],
            ],
            'Listado de categorías obtenido correctamente.',
            HttpsResponseType::HTTP_OK->value
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(MangaStoreRequest $request)
    {
        $data = $request->validated();
        try{
            DB::beginTransaction();
            $data['portada'] = $request->file('portada')->store('portadas', 'public');
            $manga = Manga::create(
                [
                    'titulo' => $data['titulo'],
                    'portada' => $data['portada'],
                    'categoria_id' => $data['categoria_id'],
                    'subcategoria_id' => $data['subcategoria_id'],
                ]);
            DB::commit();
            return $this->success(
                MangaResource::make($manga),
                'Manga creado correctamente.',
                HttpsResponseType::HTTP_CREATED->value
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), HttpsResponseType::HTTP_INTERNAL_SERVER_ERROR->value);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Manga $manga)
    {
        return $this->success(
            MangaResource::make($manga),
            'Manga obtenido correctamente.',
            HttpsResponseType::HTTP_OK->value
        );
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(MangaUpdateRequest $request, Manga $manga)
    {
        $manga->update($request->validated());
        return $this->success(
            MangaResource::make($manga),
            'Manga actualizado correctamente.',
            HttpsResponseType::HTTP_OK->value
        );
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
