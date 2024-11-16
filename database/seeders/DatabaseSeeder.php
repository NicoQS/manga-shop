<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Manga;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Elimina y crea el directorio de portadas
        Storage::deleteDirectory('public/portadas');
        Storage::makeDirectory('public/portadas');

        // Crea un usuario de prueba
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Crea categorías y subcategorías
        Categoria::factory(5)
            ->has(Subcategoria::factory()->count(3))
            ->create();
        // Crea mangas y asigna categorías y subcategorías
        /* Manga::factory(5)->create()->each(function ($manga) {
            $categoria = Categoria::inRandomOrder()->first();
            $subcategoria = $categoria->subcategorias()->inRandomOrder()->first();
            $manga->categoria_id = $categoria->id;
            $manga->subcategoria_id = $subcategoria->id;
            $manga->save();
        }); */
    }
}
