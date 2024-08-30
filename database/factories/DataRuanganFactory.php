<?php

namespace Database\Factories;

use App\Models\DataRuangan;
use Illuminate\Database\Eloquent\Factories\Factory;

class DataRuanganFactory extends Factory
{
    protected $model = DataRuangan::class;

    public function definition()
    {
        return [
            'kode_ruangan' => $this->faker->word,
            'nama_ruangan' => $this->faker->word,
            'kondisi_ruangan' => $this->faker->word,
            'keterangan' => $this->faker->sentence,
        ];
    }
}
