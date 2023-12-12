<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Rekam;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->filled('start_at') ? Carbon::parse($request->start_at)->format('Y-m-d H:i:s') : Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $to = $request->filled('end_at') ? Carbon::parse($request->end_at)->endOfDay()->format('Y-m-d H:i:s') : Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        $doktors = Dokter::query()->select(['id', 'nama'])->get();
        $rekams = Rekam::query()->select(['id', 'dokter_id', 'pasien_id', 'biaya_tindakan', 'biaya_resep', 'diskon',
            'created_at', 'cara_bayar', 'platform_pembayaran'])->whereBetween('created_at', [$from, $to]);
        if ($request->filled('doctor_id')) $rekams = $rekams->where('dokter_id', $request->doctor_id);
        $rekams = $rekams->with(['dokter:id,nama','pasien:id,nama'])->get();
        return response()->view('report.index', ['rekams'=>$rekams, 'doctors' => $doktors]);
    }
}
