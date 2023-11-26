<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekamResepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekam_reseps', function (Blueprint $table) {
            $table->id();
            $table->integer('rekam_id');
            $table->integer('pasien_id');
            $table->integer('obat_id');
            $table->string('nama')->nullable();
            $table->integer('harga_satuan')->nullable();
            $table->string('satuan')->nullable();
            $table->integer('quantity')->nullable();
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
        Schema::dropIfExists('rekam_reseps');
    }
}
