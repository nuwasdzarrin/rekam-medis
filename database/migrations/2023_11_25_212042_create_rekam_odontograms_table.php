<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekamOdontogramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekam_odontograms', function (Blueprint $table) {
            $table->id();
            $table->integer('rekam_id');
            $table->integer('pasien_id');
            $table->string('ur_11')->nullable();
            $table->string('ur_12')->nullable();
            $table->string('ur_13')->nullable();
            $table->string('ur_14')->nullable();
            $table->string('ur_15')->nullable();
            $table->string('ur_16')->nullable();
            $table->string('ur_17')->nullable();
            $table->string('ur_18')->nullable();
            $table->string('ul_21')->nullable();
            $table->string('ul_22')->nullable();
            $table->string('ul_23')->nullable();
            $table->string('ul_24')->nullable();
            $table->string('ul_25')->nullable();
            $table->string('ul_26')->nullable();
            $table->string('ul_27')->nullable();
            $table->string('ul_28')->nullable();
            $table->string('ll_31')->nullable();
            $table->string('ll_32')->nullable();
            $table->string('ll_33')->nullable();
            $table->string('ll_34')->nullable();
            $table->string('ll_35')->nullable();
            $table->string('ll_36')->nullable();
            $table->string('ll_37')->nullable();
            $table->string('ll_38')->nullable();
            $table->string('lr_41')->nullable();
            $table->string('lr_42')->nullable();
            $table->string('lr_43')->nullable();
            $table->string('lr_44')->nullable();
            $table->string('lr_45')->nullable();
            $table->string('lr_46')->nullable();
            $table->string('lr_47')->nullable();
            $table->string('lr_48')->nullable();
            $table->string('additional_file')->nullable();
            $table->string('additional_file_1')->nullable();
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
        Schema::dropIfExists('rekam_odontograms');
    }
}
