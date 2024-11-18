<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        // Elimina y crea el directorio de portadas
        if (Storage::exists('public/portadas')){
            Storage::deleteDirectory('public/portadas');
        } else {
            Storage::makeDirectory('public/portadas');
        }

        // Crea un usuario de prueba
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        // Crea categorías y subcategorías
        Categoria::factory(5)
            ->has(Subcategoria::factory()->count(3))
            ->create();

    }
}
