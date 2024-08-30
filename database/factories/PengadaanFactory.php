<?php

namespace Database\Factories;

use App\Models\Pengadaan;
use App\Models\DataBarang;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengadaanFactory extends Factory
{
    protected $model = Pengadaan::class;

    public function definition()
    {
        return [
            'tgl_penerimaan' => $this->faker->date(),
            'kode_barang' => DataBarang::factory(), // Menghubungkan dengan factory DataBarang
            'jumlah' => $this->faker->numberBetween(1, 100),
        ];
    }
}
