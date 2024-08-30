<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'pengadaans';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'tgl_penerimaan',
        'kode_barang',
        'jumlah',
    ];
    protected $casts = [
        'tgl_penerimaan' => 'date',
    ];


    public function dataBarang()
    {
        return $this->belongsTo(DataBarang::class, 'kode_barang', 'id');
    }
}
