<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use App\Models\DataPeminjaman;
use App\Models\DataBarang;
use App\Models\DataRuangan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DataPeminjamanControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function halaman_index_data_peminjaman_tampil_dengan_benar()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/peminjaman');
        $response->assertStatus(200);
        $response->assertViewIs('dashboard.peminjaman.index');
    }

    /** @test */
    public function halaman_buat_data_peminjaman_tampil_dengan_benar()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/peminjaman/create');
        $response->assertStatus(200);
        $response->assertViewIs('dashboard.peminjaman.create');
    }

   /** @test */
public function testStorePeminjaman()
{
    $user = User::factory()->create();
    $dataBarang = DataBarang::factory()->create(['jumlah_barang' => 10]);
    $dataRuangan = DataRuangan::factory()->create();

    $response = $this->actingAs(User::factory()->create())->post(route('peminjaman.store'), [
        'tgl_peminjaman' => now()->toDateString(),
        'tgl_pengembalian' => now()->addDays(7)->toDateString(),
        'nama_peminjam' => 'John Doe',
        'kode_barang' => $dataBarang->id,
        'kode_ruangan' => $dataRuangan->id,
        'jumlah' => 5,
        'status' => 'Dipinjam',
    ]);

    $response->assertRedirect(route('peminjaman.index'));
    $response->assertSessionHas('success', 'Data Peminjaman berhasil ditambahkan dan Jumlah Barang Berhasil Diperbarui.');

    $this->assertDatabaseHas('data_peminjaman', [
        'nama_peminjam' => 'John Doe',
        'kode_barang' => $dataBarang->id,
        'jumlah' => 5,
        'status' => 'Dipinjam',
    ]);

    $dataBarang->refresh();
    $this->assertEquals(5, $dataBarang->jumlah_barang); // Barang berkurang sebanyak 5
}
    /** @test */
    public function menampilkan_rincian_data_peminjaman()
    {
        $user = User::factory()->create();
        $dataPeminjaman = DataPeminjaman::factory()->create();
        $response = $this->actingAs($user)->get("/peminjaman/{$dataPeminjaman->id}");
        $response->assertStatus(200);
        $response->assertViewIs('dashboard.peminjaman.show');
    }

    /** @test */
    public function halaman_edit_data_peminjaman_tampil_dengan_benar()
    {
        $user = User::factory()->create();
        $dataPeminjaman = DataPeminjaman::factory()->create();
        $response = $this->actingAs($user)->get("/peminjaman/{$dataPeminjaman->id}/edit");
        $response->assertStatus(200);
        $response->assertViewIs('dashboard.peminjaman.edit');
    }

   /** @test */
public function testUpdatePeminjaman()
{
    $user = User::factory()->create();
    $dataBarang = DataBarang::factory()->create(['jumlah_barang' => 10]);
    $dataPeminjaman = DataPeminjaman::factory()->create([
        'kode_barang' => $dataBarang->id,
        'jumlah' => 3,
        'status' => 'Dipinjam',
    ]);

    $response = $this->actingAs(User::factory()->create())->put(route('peminjaman.update', $dataPeminjaman->id), [
        'tgl_peminjaman' => now()->toDateString(),
        'tgl_pengembalian' => now()->addDays(7)->toDateString(),
        'nama_peminjam' => 'John Doe Updated',
        'kode_barang' => $dataBarang->id,
        'kode_ruangan' => $dataPeminjaman->kode_ruangan,
        'jumlah' => 5,
        'status' => 'Dipinjam',
    ]);

    $response->assertRedirect(route('peminjaman.index'));
    $response->assertSessionHas('success', 'Data peminjaman berhasil diperbarui.');

    $this->assertDatabaseHas('data_peminjaman', [
        'id' => $dataPeminjaman->id,
        'nama_peminjam' => 'John Doe Updated',
        'jumlah' => 5,
    ]);

    $dataBarang->refresh();
    $this->assertEquals(10 - 5 + 3, $dataBarang->jumlah_barang); // Awalnya 10, lalu dipinjam 3, sekarang jadi 5.
}


/** @test */
public function menghapus_data_peminjaman()
{
    $user = User::factory()->create();
    $dataBarang = DataBarang::factory()->create(['jumlah_barang' => 50]);
    $dataPeminjaman = DataPeminjaman::factory()->create([
        'kode_barang' => $dataBarang->id,
        'jumlah' => 15,
    ]);

    $response = $this->actingAs($user)->delete("/peminjaman/{$dataPeminjaman->id}");

    $response->assertRedirect('/peminjaman');
    $this->assertDatabaseMissing('data_peminjaman', ['id' => $dataPeminjaman->id]);

    $dataBarang->refresh();
    $this->assertEquals(50 + 15, $dataBarang->jumlah_barang); // Jumlah barang bertambah kembali setelah penghapusan peminjaman
}


}
