<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekamTindakansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekam_tindakans', function (Blueprint $table) {
            $table->id();
            $table->integer('rekam_id');
            $table->integer('pasien_id');
            $table->integer('tindakan_id');
            $table->string('kode')->nullable();
            $table->string('nama')->nullable();
            $table->integer('harga')->default(0);
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
        Schema::dropIfExists('rekam_tindakans');
    }
}
