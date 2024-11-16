<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Subcategoria extends Model
{
    /** @use HasFactory<\Database\Factories\SubcategoriaFactory> */
    use HasFactory, HasUlids;

    protected $fillable = [
        'name',
        'categoria_id'
    ];

    public function mangas()
    {
        return $this->hasMany(Manga::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, foreignKey: 'categoria_id');
    }
}
