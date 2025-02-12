<?php

namespace App\Http\Controllers;

use App\Events\StatusRekamUpdate;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\PengeluaranObat;
use App\Models\Rekam;
use App\Models\RekamResep;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\RekamUpdateNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification as Notification;

class PengeluaranObatController extends Controller
{
    public function resep(Request $request)
    {
        $datas = Rekam::query()->whereIn('status',[3,4,5])
            ->with([
                'pasien:id,nama,medical_record_id',
                'rekam_diagnosa:rekam_id,diagnosa_utama',
                'rekam_reseps:rekam_id,nama,harga_satuan,quantity',
            ])
            ->latest()->paginate(25);
//        dd($datas->toArray());
        return view('obat.resep',compact('datas'));
    }

    public function pengeluaran(Request $request,$rekam_id)
    {
        $rekam = Rekam::find($rekam_id);
        $pasien = Pasien::find($rekam->pasien_id);
        $pengeluaran = PengeluaranObat::where('rekam_id',$rekam_id)->whereNull('deleted_at')->get();
        if($rekam){
            auth()->user()->notifications->where('data.no_rekam',$rekam->no_rekam)->markAsRead();
        }
        return view('obat.pengeluaran',compact('rekam','pasien','pengeluaran'));
    }

    public function riwayat(Request $request)
    {
        $data = RekamResep::query()
            ->select(['rekam_id', 'obat_id', 'pasien_id', 'nama', 'harga_satuan', 'quantity', 'satuan', 'created_at'])
            ->when($request->keyword, function ($query) use ($request) {
                $query->where('created_at', 'LIKE', "%{$request->keyword}%")
                    ->orWhere('nama', 'LIKE', "%{$request->keyword}%");
            })
            ->with(['rekam:id,cara_bayar', 'pasien:id,nama,medical_record_id', 'obat:id,kd_obat'])->latest()->paginate(25);
        return view('obat.riwayat',compact('data'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            if ($request->obat_id) {
                foreach ($request->obat_id as $i => $obatId) {
                    PengeluaranObat::create([
                        'rekam_id' => $request->rekam_id,
                        'pasien_id' => $request->pasien_id,
                        'obat_id'  => $obatId,
                        'jumlah' => $request->jumlah[$i],
                        'harga' => $request->harga[$i],
                        'subtotal' => $request->subtotal[$i],
                        'keterangan' =>  $request->keterangan[$i] != "" ? $request->keterangan[$i] : ""
                    ]);

                    $obat = Obat::find($obatId);
                    $obat->update(
                        [
                        'stok' => $obat->stok - $request->jumlah[$i]
                    ]);
                }
            }
            DB::commit();
            $rekam = Rekam::find($request->rekam_id);
            $status = 5;
            // if ($rekam->cara_bayar=="Umum/Mandiri") {
            //     $status = 4;
                $user = User::where('role',2)->get();
                $message = "Pasien ".$rekam->pasien->nama.", sudah selesai berobat";
                Notification::send($user, new RekamUpdateNotification($rekam,$message));
                foreach ($user as $key => $item) {
                    $link = Route('rekam.detail',$rekam->pasien_id);
                    $waktu = Carbon::parse($rekam->created_at)->format('d/m/Y H:i:s');
                    event(new StatusRekamUpdate($item->id,$rekam->no_rekam,$message,$link,$waktu));
                }

            // }
            $rekam->update([
                'status' => $status
            ]);

            return redirect()->route('obat.pengeluaran',$request->rekam_id)->with('sukses','Obat Berhasil diberikan');

        } catch (\PDOException $e) {
            DB::rollback();
            return redirect()->route('obat.pengeluaran',$request->rekam_id)->with('gagal','Data Gagal ditambahkan '.$e);

        }
    }


}
