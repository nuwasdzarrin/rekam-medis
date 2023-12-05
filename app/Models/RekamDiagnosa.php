<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamDiagnosa extends Model
{
    protected $table = "rekam_diagnosis";

    function rekam(){
        return $this->belongsTo(Rekam::class);
    }

    function pasien(){
        return $this->belongsTo(Pasien::class);
    }

      // function diagnosis(){
    //     return $this->belongsTo(Icd::class,'diagnosa','code');
    // }

    function diagnosis(){
        return $this->belongsTo(Icd::class,'diagnosa','code');
    }
}
