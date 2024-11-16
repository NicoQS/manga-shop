<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Manga extends Model
{
    /** @use HasFactory<\Database\Factories\MangaFactory> */
    use HasFactory, HasUlids;

    protected $fillable = [
        'titulo',
        'portada',
        'categoria_id',
        'subcategoria_id'
    ];

    public function categorias()
    {
        return $this->belongsTo(related: Categoria::class, foreignKey: 'categoria_id');
    }

    public function subcategorias()
    {
        return $this->belongsTo(related: Subcategoria::class, foreignKey: 'subcategoria_id');
    }
}
