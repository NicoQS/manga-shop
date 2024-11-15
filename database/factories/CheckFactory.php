<?php

namespace Database\Factories;

use App\Models\Check;
use App\Models\Service;
use App\Models\Credential;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;


class CheckFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Model>
     */
    protected $model = Check::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'path' => $this->faker->filePath(),
            'method' => 'GET',
            'body' => null,
            'headers' => null,
            'parameters' => null,
            'credential_id' => $this->faker->boolean() ? Credential::factory() : null,
            'service_id' => Service::factory(),
        ];
    }
}
