<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\DataBarang;
use App\Models\DataRuangan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DataBarangControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function menampilkan_halaman_buat_barang()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/barang/create');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.barang.create');
        $response->assertViewHas('tittle', 'Tambah Barang');
        $response->assertViewHas('active_menu', 'barang');
    }

    /** @test */
    public function dapat_menyimpan_barang_baru()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $data = [
            'kode_barang' => 'B001',
            'kode_ruangan' => DataRuangan::factory()->create()->id,
            'nama_barang' => 'Barang 1',
            'merk_barang' => 'Merk 1',
            'jenis_barang' => 'Jenis 1',
            'satuan_barang' => 'Unit',
            'foto_barang' => \Illuminate\Http\UploadedFile::fake()->image('foto_barang.jpg'),
            'jumlah_barang' => 10,
            'kondisi_barang' => 'Baik',
            'status_barang' => 'Tersedia',
            'keterangan' => 'Keterangan barang 1',
        ];

        $response = $this->post('/barang', $data);

        $response->assertStatus(302);
        $this->assertDatabaseHas('data_barangs', [
            'kode_barang' => 'B001',
            'nama_barang' => 'Barang 1',
        ]);
        Storage::assertExists('public/foto_barang/' . $data['foto_barang']->hashName());
    }

    /** @test */
    public function melakukan_edit_barang()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $barang = DataBarang::factory()->create();

        $response = $this->get("/barang/{$barang->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.barang.edit');
        $response->assertViewHas('tittle', 'Edit Barang');
        $response->assertViewHas('active_menu', 'barang');
    }

//     /** @test */
//     public function test_update_barang()
// {
//     // Membuat data barang untuk diuji
//     $barang = \App\Models\DataBarang::factory()->create();

//     // Data yang akan dikirim untuk update
//     $data = [
//         'kode_barang' => 'B002',
//         'data_ruangan_id' => $barang->data_ruangan_id,
//         'nama_barang' => 'Barang 2',
//         'merk_barang' => 'Merk Baru',
//         'jenis_barang' => 'Jenis Baru',
//         'satuan_barang' => 'Unit',
//         'foto_barang' => UploadedFile::fake()->image('foto.jpg'),
//         'jumlah_barang' => 10,
//         'kondisi_barang' => 'Baik',
//         'status_barang' => 'Aktif',
//         'keterangan' => 'Keterangan Baru',
//     ];

//     $response = $this->put("/barang/{$barang->id}", $data);

//     $response->assertStatus(302); // Pastikan redirect ke halaman yang benar

//     // Periksa jika data benar-benar diperbarui
//     $this->assertDatabaseHas('data_barangs', [
//         'kode_barang' => 'B002',
//         'nama_barang' => 'Barang 2',
//     ]);

//     Storage::assertExists('public/foto_barang/' . $data['foto_barang']->hashName());    
// }


    /** @test */
    public function dapat_menghapus_barang()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $barang = DataBarang::factory()->create();

        $response = $this->delete("/barang/{$barang->id}");

        $response->assertStatus(302);
        $this->assertDatabaseMissing('data_barangs', ['id' => $barang->id]);
    }

    /** @test */
    public function dapat_menghasilkan_pdf_data_barang()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        DataBarang::factory()->count(5)->create();

        $response = $this->get('/barang/print/oldest'); // Ganti dengan route yang sesuai

        $response->assertStatus(200);
        $this->assertStringContainsString('application/pdf', $response->headers->get('Content-Type'));
        $this->assertStringContainsString('data_barang.pdf', $response->headers->get('Content-Disposition'));
    }
}
