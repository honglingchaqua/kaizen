<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('nopol')->unique(); // NOPOL (Nomor Polisi)
            $table->string('no_rangka')->unique(); // Nomor Rangka
            $table->string('model'); // Model Kendaraan
            $table->string('warna'); // Warna Kendaraan
            $table->date('tgl_dec')->nullable(); // Tanggal DEC
            $table->string('bulan_dec')->nullable(); // Bulan DEC
            $table->integer('masa_pakai')->nullable(); // Masa Pakai
            $table->date('tanggal_last_service')->nullable(); // Tanggal Last Service
            $table->integer('km_sekarang')->nullable(); // Kilometer Sekarang
            $table->date('tanggal_next_service')->nullable(); // Tanggal Next Service
            $table->text('note')->nullable(); // Catatan
            $table->date('tgl_bp')->nullable(); // Tanggal BP
            $table->string('no_spk')->nullable(); // Nomor SPK
            $table->date('tgl_spk')->nullable(); // Tanggal SPK
            $table->decimal('harga', 15, 2)->nullable(); // Harga
            $table->decimal('diskon', 15, 2)->nullable(); // Diskon
            $table->string('customer')->nullable(); // Nama Customer
            $table->date('tgl_bpkb')->nullable(); // Tanggal BPKB
            $table->date('tgl_terima')->nullable(); // Tanggal Terima
            $table->date('tgl_spb')->nullable(); // Tanggal SPB
            $table->date('tgl_stnk')->nullable(); // Tanggal STNK
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
        Schema::dropIfExists('vehicles');
    }
}
