<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekamRadiologisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekam_radiologis', function (Blueprint $table) {
            $table->id();
            $table->integer('rekam_id');
            $table->integer('pasien_id');
            $table->string('tipe_muka')->nullable();
            $table->string('profil_muka')->nullable();
            $table->string('relasi_bibir')->nullable();
            $table->string('garis_median_ra')->nullable();
            $table->string('garis_median_rb')->nullable();
            $table->string('tmj_normal')->nullable();
            $table->string('tmj_keluhan')->nullable();
            $table->string('tmj_riwayat_tmd')->nullable();
            $table->string('tmj_kelainan_lain')->nullable();
            $table->string('tmj_oklusi')->nullable();
            $table->string('tmj_torus_palatinus')->nullable();
            $table->string('tmj_torus_mandibularis')->nullable();
            $table->string('tmj_palatum')->nullable();
            $table->string('tmj_diastema')->nullable();
            $table->string('tmj_gigi_anomali')->nullable();
            $table->string('tmj_dmf')->nullable();
            $table->string('tmj_lain')->nullable();
            $table->string('opg_jumlah_gigi')->nullable();
            $table->string('opg_impaksi')->nullable();
            $table->string('opg_posisi_m3')->nullable();
            $table->string('opg_karies')->nullable();
            $table->string('opg_tmj')->nullable();
            $table->string('opg_lainnya')->nullable();
            $table->string('sf_sna')->nullable();
            $table->string('sf_snb')->nullable();
            $table->string('sf_anb')->nullable();
            $table->string('sf_relasi')->nullable();
            $table->string('sf_ira_irb')->nullable();
            $table->string('sf_ira_na')->nullable();
            $table->string('sf_ira_sn')->nullable();
            $table->string('sf_ira_mp')->nullable();
            $table->string('sf_go_angle')->nullable();
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
        Schema::dropIfExists('rekam_radiologis');
    }
}
