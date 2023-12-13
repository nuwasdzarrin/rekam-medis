<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class DashboardQuery
{
    public function totalObat()
    {
        return Obat::count();
    }
    public function totalObatKeluar(){
        return PengeluaranObat::count();
    }
    public function totalObatKeluarSum(){
        return PengeluaranObat::sum('jumlah');
    }
    public function obatHariini(){
        return PengeluaranObat::whereDate('created_at',date('Y-m-d'))->count();
    }
    public function permintaanObat(){
        return Rekam::latest()
                    ->where('status',3)
                    ->get();
    }

    public function totalPasien()
    {
        return Pasien::whereNull('deleted_at')->count();
    }
    public function totalDoktor()
    {
        return Dokter::where('status',1)->count();
    }
    public function checkUpThisDay()
    {
        $user = auth()->user();
        $role = $user->role_display();
        return Rekam::whereDate('tgl_rekam',date('Y-m-d'))->when($role, function ($query) use ($role,$user){
            if($role=="Dokter"){
                $dokterId = Dokter::where('user_id',$user->id)->where('status',1)->first()->id;
                $query->where('dokter_id', '=', $dokterId);
            }
        })->count();
    }
    public function totalCheckUp()
    {
        $user = auth()->user();
        $role = $user->role_display();
        return Rekam::query()->whereMonth('tgl_rekam',date('m'))
            ->when($role, function ($query) use ($role, $user){
                if ($role=="Dokter") {
                    $dokterId = Dokter::query()->where('user_id', $user->id)->where('status',1)
                        ->first()->id;
                    $query->where('dokter_id', '=', $dokterId);
                }
            })->count();
    }
    public function pasienAntri(){
        $user = auth()->user();
        $role = $user->role_display();
        return Rekam::whereDate('tgl_rekam',date('Y-m-d'))
                        ->when($role, function ($query) use ($role,$user){
                            if($role=="Dokter"){
                                $dokterId = Dokter::where('user_id',$user->id)->where('status',1)->first()->id;
                                $query->where('dokter_id', '=', $dokterId);
                            }
                        })
                        ->whereIn('status',[1,2])
                        ->count();
    }
    function rekam_day(){
        $user = auth()->user();
        $role = $user->role_display();

        return Rekam::latest()
                ->whereDate('tgl_rekam',date('Y-m-d'))
                ->when($role, function ($query) use ($role,$user){
                    if($role=="Dokter"){
                        $dokterId = Dokter::where('user_id',$user->id)->where('status',1)->first()->id;
                        $query->where('dokter_id', '=', $dokterId);
                    }
                })
                ->get();
    }
}
