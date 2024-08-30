<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_peminjaman');
            $table->date('tgl_pengembalian');
            $table->string('nama_peminjam');
            $table->foreignId('kode_barang')->nullable()->constrained('data_barangs')->onDelete('set null');
            $table->foreignId('kode_ruangan')->nullable()->constrained('data_ruangans')->onDelete('set null');
            $table->integer('jumlah')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_peminjaman');
    }
}
