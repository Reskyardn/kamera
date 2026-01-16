<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kamera>
 */
class KameraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kamera' => $this->faker->words(3, true),
            'merk' => $this->faker->randomElement(['Canon', 'Nikon', 'Sony', 'Fujifilm']),
            'tipe' => $this->faker->word(),
            'spesifikasi' => $this->faker->sentence(),
            'stok' => $this->faker->numberBetween(1, 10),
            'kondisi' => $this->faker->randomElement(['Baik', 'Rusak Ringan']),
            'status_ketersediaan' => $this->faker->randomElement(['Tersedia', 'Dipinjam', 'Perawatan']),
        ];
    }
}
