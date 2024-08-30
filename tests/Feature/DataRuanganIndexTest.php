<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\DataRuangan;
use Barryvdh\DomPDF\Facade\Pdf;

class DataRuanganControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function menampilkan_halaman_buat_ruangan()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/ruangan/create');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.ruangan.create');
        $response->assertViewHas('tittle', 'Tambah Ruangan');
        $response->assertViewHas('active_menu', 'ruangan');
    }

    /** @test */
    public function dapat_menyimpan_ruangan_baru()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $data = [
            'kode_ruangan' => '1',
            'nama_ruangan' => 'Ruang 1',
            'kondisi_ruangan' => 'Baik',
            'keterangan' => 'Keterangan ruangan 1',
        ];

        $response = $this->post('/ruangan', $data);

        $response->assertStatus(302);
        $this->assertDatabaseHas('data_ruangans', $data);
    }

    /** @test */
    public function menampilkan_halaman_edit_ruangan()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $ruangan = DataRuangan::factory()->create();

        $response = $this->get("/ruangan/{$ruangan->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.ruangan.edit');
        $response->assertViewHas('tittle', 'Edit Ruangan');
        $response->assertViewHas('active_menu', 'ruangan');
    }

    /** @test */
    public function dapat_memperbarui_ruangan()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $ruangan = DataRuangan::factory()->create();
        $data = [
            'kode_ruangan' => '001', // Pastikan field ini ada
            'nama_ruangan' => 'Ruang 1 Updated',
            'kondisi_ruangan' => 'Sangat Baik',
            'keterangan' => 'Keterangan ruangan 1 updated',
        ];

        $response = $this->put("/ruangan/{$ruangan->id}", $data);

        $response->assertStatus(302); // Redirect setelah pembaruan
        $this->assertDatabaseHas('data_ruangans', array_merge(['id' => $ruangan->id], $data));
    }

    /** @test */
    public function dapat_menghapus_ruangan()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $ruangan = DataRuangan::factory()->create();

        $response = $this->delete("/ruangan/{$ruangan->id}");

        $response->assertStatus(302); // Redirect setelah penghapusan
        $this->assertDatabaseMissing('data_ruangans', ['id' => $ruangan->id]);
    }

    /** @test */
    public function dapat_menghasilkan_pdf_data_ruangan()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        DataRuangan::factory()->count(5)->create();

        $response = $this->get('/ruangan/print/oldest'); // Ganti dengan route yang sesuai

        $response->assertStatus(200);
        $this->assertStringContainsString('application/pdf', $response->headers->get('Content-Type'));
        $this->assertStringContainsString('ruangan.pdf', $response->headers->get('Content-Disposition'));
    }
}
