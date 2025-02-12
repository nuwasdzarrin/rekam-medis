<?php

namespace App\Models;

use Carbon\Carbon;
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
    public function checkUpThisMonth()
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
    public function rekamQueueByDate($start_at = '', $end_at = ''){
        $user = auth()->user();
        $role = $user->role_display();
        $from = $start_at ?? Carbon::now()->startOfDay()->format('Y-m-d H:i:s');
        $to = $end_at ?? Carbon::now()->endOfDay()->format('Y-m-d H:i:s');
        return Rekam::query()->whereBetween('tgl_rekam', [$from, $to])
            ->when($role, function ($query) use ($role,$user){
                if($role=="Dokter"){
                    $dokterId = Dokter::where('user_id', $user->id)->where('status',1)->first()->id;
                    $query->where('dokter_id', '=', $dokterId);
                }
            })->where('status', 1)->with(['pasien:id,nama', 'dokter:id,nama'])->latest()->get();
    }
    function rekamByDate($start_at = '', $end_at = ''){
        $user = auth()->user();
        $role = $user->role_display();
        $from = $start_at ?? Carbon::now()->startOfDay()->format('Y-m-d H:i:s');
        $to = $end_at ?? Carbon::now()->endOfDay()->format('Y-m-d H:i:s');

        return Rekam::query()->whereBetween('tgl_rekam', [$from, $to])
            ->when($role, function ($query) use ($role,$user){
                if($role=="Dokter"){
                    $dokterId = Dokter::where('user_id',$user->id)->where('status',1)->first()->id;
                    $query->where('dokter_id', '=', $dokterId);
                }
            })->whereIn('status',[2,3,4,5])->with(['pasien:id,nama', 'dokter:id,nama'])->latest()->get();
    }

    function mappingDate($params='')
    {
        if ($params == 'this_month')
            return [
                'start' => Carbon::now()->startOfMonth()->format('Y-m-d'),
                'end' => Carbon::now()->endOfMonth()->format('Y-m-d'),
                'label' => 'Bulan Ini'
            ];
        elseif ($params == 'this_week')
            return [
                'start' => Carbon::now()->startOfWeek()->format('Y-m-d'),
                'end' => Carbon::now()->endOfWeek()->format('Y-m-d'),
                'label' => 'Minggu Ini'
            ];
        elseif ($params == 'two_days_ago')
            return [
                'start' => Carbon::now()->subDays(2)->startOfDay()->format('Y-m-d'),
                'end' => Carbon::now()->subDays(2)->endOfDay()->format('Y-m-d'),
                'label' => 'Lusa'
            ];
        elseif ($params == 'tomorrow')
            return [
                'start' => Carbon::now()->subDays(1)->startOfDay()->format('Y-m-d'),
                'end' => Carbon::now()->subDays(1)->endOfDay()->format('Y-m-d'),
                'label' => 'Kemarin'
            ];
        else
            return [
                'start' => Carbon::now()->startOfDay()->format('Y-m-d'),
                'end' => Carbon::now()->endOfDay()->format('Y-m-d'),
                'label' => 'Hari Ini'
            ];

    }
}
