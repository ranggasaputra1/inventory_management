<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
     public function up()
     {
         Schema::create('data_barangs', function (Blueprint $table) {
             $table->id();
             $table->string('kode_barang')->unique();
             $table->unsignedBigInteger('data_ruangan_id')->nullable();
             $table->foreign('data_ruangan_id')
                   ->references('id')
                   ->on('data_ruangans')
                   ->onDelete('set null');
             $table->string('nama_barang');
             $table->string('merk_barang')->nullable();
             $table->string('jenis_barang');
             $table->string('satuan_barang');
             $table->string('foto_barang')->nullable();
             $table->integer('jumlah_barang');
             $table->string('kondisi_barang');
             $table->string('status_barang');
             $table->text('keterangan')->nullable();
             $table->timestamps();
         });
     }
     

    public function down()
    {
        Schema::dropIfExists('data_barangs');
    }
};
