<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DataPeminjaman;
use App\Models\DataBarang;
use App\Models\DataRuangan;

class DataPeminjamanFactory extends Factory
{
    protected $model = DataPeminjaman::class;

    public function definition()
    {
        // Menggunakan factory untuk membuat DataBarang dan DataRuangan
        $dataBarang = DataBarang::factory()->create();
        $dataRuangan = DataRuangan::factory()->create();

        return [
            'tgl_peminjaman' => $this->faker->date(),
            'tgl_pengembalian' => $this->faker->date(),
            'nama_peminjam' => $this->faker->name(),
            'kode_barang' => $dataBarang->id,
            'kode_ruangan' => $dataRuangan->id,
            'jumlah' => $this->faker->numberBetween(1, $dataBarang->jumlah_barang),
            'status' => $this->faker->randomElement(['Dipinjam', 'Dikembalikan']),
        ];
    }
}
