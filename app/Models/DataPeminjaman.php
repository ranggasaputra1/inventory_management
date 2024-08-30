<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'data_peminjaman'; // Pastikan ini sesuai dengan nama tabel di database

    protected $fillable = [
        'tgl_peminjaman',
        'tgl_pengembalian',
        'nama_peminjam',
        'kode_barang',
        'kode_ruangan',
        'jumlah',
        'status',
    ];

    public function dataBarang()
{
    return $this->belongsTo(DataBarang::class, 'kode_barang');
}   
    public function dataRuangan()
    {
        return $this->belongsTo(DataRuangan::class, 'kode_ruangan');
    }
    
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
}
