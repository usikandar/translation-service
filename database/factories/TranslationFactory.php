<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Translation>
 */
class TranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'locale' => $this->faker->randomElement(['en', 'fr', 'es']),
            'key' => $this->faker->unique()->word,
            'value' => $this->faker->sentence,
            'tags' => json_encode([$this->faker->randomElement(['mobile', 'desktop', 'web'])]),
        ];
    }
}
