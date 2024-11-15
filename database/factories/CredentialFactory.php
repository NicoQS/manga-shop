<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use App\Models\Credential;
use App\Enums\CredentialType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;


final class CredentialFactory extends Factory
{
    /**
     * Summary of model
     * @var class-string<Model>
     */
    protected $model = Credential::class;

    /**
     * Summary of definition
     * @return array<string,mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'type' => [
                'type' => CredentialType::Bearer_auth,
                'prefix' => 'Bearer',
            ],
            'value' => $this->faker->uuid(),
            'user_id' => User::factory()
        ];
    }
}
