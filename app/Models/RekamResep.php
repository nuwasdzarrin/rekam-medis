<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamResep extends Model
{
    function rekam()
    {
        return $this->belongsTo(Rekam::class);
    }
    function obat()
    {
        return $this->belongsTo(Obat::class);
    }
    function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}
