<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekam extends Model
{
    protected $table = "rekam";
    protected $fillable = ["pasien_id","dokter_id","petugas_id","poli_id","tgl_rekam","biaya_tindakan",
        "biaya_resep","diskon","jumlah_uang","tipe_pasien","cara_bayar","platform_pembayaran","status"];
    /**
     * @var mixed
     */


    function rekam_diagnosa()
    {
        return $this->hasOne(RekamDiagnosa::class);
    }
    function rekam_tindakans()
    {
        return $this->hasMany(RekamTindakan::class);
    }
    function rekam_reseps()
    {
        return $this->hasMany(RekamResep::class);
    }
    function getFilePemeriksaan(){
        return $this->pemeriksaan_file != null ? asset('images/pemeriksaan/'.$this->pemeriksaan_file) : null;
    }

    function getFileTindakan(){
        return $this->tindakan_file != null ? asset('images/pemeriksaan/'.$this->tindakan_file) : null;
    }

    function gigi(){
      return  RekamGigi::where('rekam_id',$this->id)->get();
    }

    function diagnosa(){
        return  RekamDiagnosa::where('rekam_id',$this->id)->get();
    }
    function pasien(){
        return $this->belongsTo(Pasien::class);
    }
    function dokter(){
        return $this->belongsTo(Dokter::class);
    }
    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }
    function status_rekams(){
        switch ($this->status) {
            case 1:
                return "<span class='badge badge-rounded badge-danger'>Belum Diperiksa</span>";
                break;
            case 2:
                return "<span class='badge badge-rounded badge-danger'>Belum Diperiksa</span>";
                break;
            case 3:
                return "<span class='badge badge-rounded badge-primary'>Sudah Diperiksa</span>";
                break;
            case 4:
                return "<span class='badge badge-rounded badge-primary'>Selesai</span>";
                break;
            case 5:
                return "<span class='badge badge-rounded badge-primary'>Selesai</span>";
                break;
            default:
                # code...
                break;
        }
    }

    function status_display(){
        switch ($this->status) {
            case 1:
                return '<span class="badge badge-rounded badge-outline-warning">
                            <i class="fa fa-circle text-warning mr-1"></i>
                             Antrian
                        </span>';
            break;
            case 2:
                return '<span class="badge badge-rounded badge-info light">
                            <i class="fa fa-circle text-info mr-1"></i>
                            Pemeriksaan
                        </span>';
            break;
            case 3:
                return '<span class="badge badge-rounded badge-warning light" style="width:100px">
                           Di Apotek
                        </span>';
            break;
            case 4:
                return '<span class="badge badge-rounded badge-danger light">
                            <i class="fa fa-circle text-danger mr-1"></i>
                            Pembayaran
                        </span>';
            break;
            case 5:
                return '<span class="badge badge-rounded badge-primary light" style="width:100px">
                            <i class="fa fa-check text-primary mr-1"></i>
                            Selesai
                        </span>';
            break;
            default:
                # code...
                break;
        }
    }
}
