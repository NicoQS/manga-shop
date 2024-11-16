<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mangas', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->string('titulo', 255)->unique();
            $table->string('portada', 255)->unique();

            $table->foreignUlid('categoria_id')
                ->nullable()
                ->index()
                ->constrained('categorias')
                ->cascadeOnDelete();

            $table->foreignUlid('subcategoria_id')
                ->nullable()
                ->index()
                ->constrained('subcategorias')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mangas');
    }
};
