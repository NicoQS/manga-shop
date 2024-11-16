<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Categoria extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriaFactory> */
    use HasFactory, HasUlids;

    protected $fillable = [
        'nombre'
    ];
    public function mangas()
    {
        return $this->hasMany(related: Manga::class, foreignKey: 'categoria_id');
    }

    public function subcategorias()
    {
        return $this->hasMany(related: Subcategoria::class, foreignKey: 'categoria_id');
    }
}

