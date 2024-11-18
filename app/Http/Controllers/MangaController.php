<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Traits\HttpsResponse;
use App\Enums\HttpsResponseType;
use App\Http\Requests\Manga\MangaStoreRequest;
use App\Http\Requests\Manga\MangaUpdateRequest;
use App\Models\Subcategoria;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\MangaResource;
use Illuminate\Http\JsonResponse;

class MangaController extends Controller
{
    use HttpsResponse;


    public function index() : JsonResponse
    {
        $mangas = Manga::paginate(3);
        $mangasResource = MangaResource::collection($mangas);

        // Debo agregar campos de links y meta para que el trait HttpsResponse pueda devolver la paginación correctamente
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
            'Listado de mangas obtenido correctamente.',
            HttpsResponseType::HTTP_OK->value
        );
    }


    public function store(MangaStoreRequest $request) : JsonResponse
    {
        $data = $request->validated();
        try{
            DB::beginTransaction();
            //validar si la subcategoria pertenece a la categoria
            if (!Subcategoria::where('id', $data['subcategoria_id'])->where('categoria_id', $data['categoria_id'])->exists()) {
                return $this->error('La subcategoria no pertenece a la categoria.', HttpsResponseType::HTTP_BAD_REQUEST->value);
            }
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


    public function show(Manga $manga) : JsonResponse
    {
        return $this->success(
            MangaResource::make($manga),
            'Manga obtenido correctamente.',
            HttpsResponseType::HTTP_OK->value
        );
    }


    public function update(MangaUpdateRequest $request, Manga $manga) : JsonResponse
    {
        try {
            DB::beginTransaction();
            // Validar si la subcategoria pertenece a la categoria
            if (!Subcategoria::where('id', $request->subcategoria_id)->where('categoria_id', $request->categoria_id)->exists()) {
                return $this->error('La subcategoria no pertenece a la categoria.', HttpsResponseType::HTTP_BAD_REQUEST->value);
            }
            $manga->update($request->validated());
            DB::commit();
            return $this->success(
                MangaResource::make($manga),
                'Manga actualizado correctamente.',
                HttpsResponseType::HTTP_OK->value
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), HttpsResponseType::HTTP_INTERNAL_SERVER_ERROR->value);
        }

    }


    public function destroy(Manga $manga) : JsonResponse
    {
        $manga->delete();
        return $this->success(null, 'Manga eliminado correctamente.', HttpsResponseType::HTTP_OK->value);
    }
}
