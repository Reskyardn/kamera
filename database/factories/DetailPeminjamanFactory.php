<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailPeminjaman>
 */
class DetailPeminjamanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'peminjaman_id' => \App\Models\Peminjaman::factory(),
            'kamera_id' => \App\Models\Kamera::factory(),
            'jumlah' => $this->faker->numberBetween(1, 3),
        ];
    }
}
