<?php

namespace Database\Factories;

use App\Models\DataBarang;
use App\Models\DataRuangan;
use Illuminate\Database\Eloquent\Factories\Factory;

class DataBarangFactory extends Factory
{
    protected $model = DataBarang::class;

    public function definition()
    {
        return [
            'kode_barang' => $this->faker->unique()->word,
            'data_ruangan_id' => DataRuangan::factory(),
            'nama_barang' => $this->faker->word,
            'merk_barang' => $this->faker->word,
            'jenis_barang' => $this->faker->word,
            'satuan_barang' => $this->faker->word,
            'foto_barang' => $this->faker->imageUrl(),
            'jumlah_barang' => $this->faker->numberBetween(1, 100),
            'kondisi_barang' => $this->faker->word,
            'status_barang' => $this->faker->word,
            'keterangan' => $this->faker->sentence,
        ];
    }
}
