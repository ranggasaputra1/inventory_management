<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBarang extends Model
{
    use HasFactory;
    protected $table = 'data_barangs';

    // Fillable fields
    protected $fillable = [
        'kode_barang', 'data_ruangan_id', 'nama_barang', 'merk_barang',
        'jenis_barang', 'satuan_barang', 'foto_barang', 'jumlah_barang',
        'kondisi_barang', 'status_barang', 'keterangan'
    ];


    public function dataRuangan()
    {
        return $this->belongsTo(DataRuangan::class, 'data_ruangan_id', 'id')->withDefault([
            'nama_ruangan' => '-',
        ]);
    }
    

        public function getFotoBarangUrlAttribute()
    {
        return $this->foto_barang ? asset('foto_barang/' . $this->foto_barang) : 'path/to/default/image.jpg';
    }
    public function pengadaans()
    {
        return $this->hasMany(Pengadaan::class, 'kode_barang', 'id');
    }
}
