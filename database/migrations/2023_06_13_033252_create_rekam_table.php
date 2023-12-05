<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekam', function (Blueprint $table) {
            $table->id();
            $table->string('no_rekam');
            $table->integer('pasien_id')->unsigned();
            $table->integer('dokter_id')->unsigned();
            $table->integer('petugas_id')->unsigned();
            $table->integer('poli_id');
            $table->string('tgl_rekam');
            $table->integer('biaya_tindakan')->default(0);
            $table->integer('biaya_resep')->default(0);
            $table->integer('diskon')->default(0);
            $table->integer('jumlah_uang')->default(0);
            $table->string('tipe_pasien')->nullable();
            $table->string('cara_bayar')->nullable();
            $table->string('platform_pembayaran')->nullable();
            $table->integer('status')->default(1);

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
        Schema::dropIfExists('rekam');
    }
}
