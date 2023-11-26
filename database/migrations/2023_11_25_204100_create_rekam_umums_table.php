<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekamUmumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekam_umums', function (Blueprint $table) {
            $table->id();
            $table->integer('rekam_id');
            $table->integer('pasien_id');
            $table->string('keluhan_utama')->nullable();
            $table->string('keluhan_tambahan')->nullable();
            $table->string('nadi')->nullable();
            $table->string('suhu')->nullable();
            $table->string('pernafasan')->nullable();
            $table->string('tekanan_darah')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('kelainan')->nullable();
            $table->string('penyakit_penyerta')->nullable();
            $table->string('alergi')->nullable();
            $table->string('oral_habit')->nullable();
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
        Schema::dropIfExists('rekam_umums');
    }
}
