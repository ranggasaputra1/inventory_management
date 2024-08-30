<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase; 
use App\Models\Pengadaan;
use App\Models\DataBarang;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PengadaanControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function halaman_index_pengadaan_tampil_dengan_benar()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/pengadaan');
        $response->assertStatus(200);
        $response->assertViewIs('dashboard.pengadaan.index');
    }

    /** @test */
    public function halaman_buat_pengadaan_tampil_dengan_benar()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/pengadaan/create');
        $response->assertStatus(200);
        $response->assertViewIs('dashboard.pengadaan.create');
    }

   /** @test */
public function menyimpan_pengadaan_baru()
{
    $user = User::factory()->create();
    $dataBarang = DataBarang::factory()->create(['jumlah_barang' => 50]);
    $data = [
        'tgl_penerimaan' => '2024-08-30',
        'kode_barang' => $dataBarang->id,
        'jumlah' => 10,
    ];

    $response = $this->actingAs($user)->post('/pengadaan', $data);

    $response->assertRedirect('/pengadaan');
    $this->assertDatabaseHas('pengadaans', $data);

    $dataBarang->refresh();
    $this->assertEquals(50 + 10, $dataBarang->jumlah_barang); // Sesuaikan jumlah barang sesuai dengan logika
}


    /** @test */
    public function menampilkan_rincian_pengadaan()
    {
        $user = User::factory()->create();
        $pengadaan = Pengadaan::factory()->create();
        $response = $this->actingAs($user)->get("/pengadaan/{$pengadaan->id}");
        $response->assertStatus(200);
        $response->assertViewIs('dashboard.pengadaan.show');
    }

    /** @test */
    public function halaman_edit_pengadaan_tampil_dengan_benar()
    {
        $user = User::factory()->create();
        $pengadaan = Pengadaan::factory()->create();
        $response = $this->actingAs($user)->get("/pengadaan/{$pengadaan->id}/edit");
        $response->assertStatus(200);
        $response->assertViewIs('dashboard.pengadaan.edit');
    }

    /** @test */
public function memperbarui_pengadaan_yang_ada()
{
    $user = User::factory()->create();
    $dataBarang = DataBarang::factory()->create(['jumlah_barang' => 50]);
    $pengadaan = Pengadaan::factory()->create([
        'kode_barang' => $dataBarang->id,
        'jumlah' => 10
    ]);
    $newDataBarang = DataBarang::factory()->create(['jumlah_barang' => 30]);

    $data = [
        'tgl_penerimaan' => '2024-08-31',
        'kode_barang' => $newDataBarang->id,
        'jumlah' => 20,
    ];

    $response = $this->actingAs($user)->put("/pengadaan/{$pengadaan->id}", $data);

    $response->assertRedirect('/pengadaan');
    $this->assertDatabaseHas('pengadaans', $data);

    // Verifikasi data barang lama berkurang
    $dataBarang->refresh();
    $this->assertEquals(50 - 10, $dataBarang->jumlah_barang);

    // Verifikasi data barang baru bertambah
    $newDataBarang->refresh();
    $this->assertEquals(30 + 20, $newDataBarang->jumlah_barang);
}

    /** @test */
public function menghapus_pengadaan()
{
    $user = User::factory()->create();
    $dataBarang = DataBarang::factory()->create(['jumlah_barang' => 50]);
    $pengadaan = Pengadaan::factory()->create([
        'kode_barang' => $dataBarang->id,
        'jumlah' => 15
    ]);

    $response = $this->actingAs($user)->delete("/pengadaan/{$pengadaan->id}");

    $response->assertRedirect('/pengadaan');
    $this->assertDatabaseMissing('pengadaans', ['id' => $pengadaan->id]);

    $dataBarang->refresh();
    $this->assertEquals(50 - 15, $dataBarang->jumlah_barang);
}

}
