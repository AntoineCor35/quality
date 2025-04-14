<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Client;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->regexify('[A-Za-z0-9]{100}'),
            'prenom' => fake()->regexify('[A-Za-z0-9]{100}'),
            'date_naissance' => fake()->date(),
            'adresse' => fake()->regexify('[A-Za-z0-9]{255}'),
            'code_postal' => fake()->regexify('[A-Za-z0-9]{10}'),
            'ville' => fake()->regexify('[A-Za-z0-9]{100}'),
        ];
    }
}
