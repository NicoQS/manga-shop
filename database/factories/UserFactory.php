<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

final class UserFactory extends Factory
{
    /**
     * Summary of model
     * @var class-string<Model>
     */
    protected $model =  User::class;

    /**
     * Summary of definition
     * @return array<string,mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }


    public function unverified(): UserFactory
    {
        return $this->state(state: fn (array $attributes):array => [
            'email_verified_at' => null,
        ]);
    }
}
