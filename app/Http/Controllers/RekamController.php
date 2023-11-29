<?php

namespace App\Http\Controllers;

use App\Events\StatusRekamUpdate;
use App\Models\Dokter;
use App\Models\KondisiGigi;
use App\Models\Pasien;
use App\Models\PengeluaranObat;
use App\Models\Poli;
use App\Models\Rekam;
use App\Models\RekamGigi;
use App\Models\Tindakan;
use App\Notifications\RekamUpdateNotification;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as Notification;

class RekamController extends Controller
{
    public static function fields(): array
    {
        return [
            "edit" => [
                "general" => [
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'keluhan_utama',
                        'label' => ucwords(str_replace('_', ' ', 'keluhan_utama')),
                        'required' => true ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'keluhan_tambahan',
                        'label' => ucwords(str_replace('_', ' ', 'keluhan_tambahan')) ],
                    [ 'field' => 'subtitle', 'label' => ucwords(str_replace('_', ' ', 'keadaan_umum')) ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'nadi',
                        'label' => ucwords(str_replace('_', ' ', 'nadi')) ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'suhu',
                        'label' => ucwords(str_replace('_', ' ', 'suhu')) ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'pernafasan',
                        'label' => ucwords(str_replace('_', ' ', 'pernafasan')) ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'tekanan_darah',
                        'label' => ucwords(str_replace('_', ' ', 'tekanan_darah')) ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'tinggi_badan',
                        'label' => ucwords(str_replace('_', ' ', 'tinggi_badan')) ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'berat_badan',
                        'label' => ucwords(str_replace('_', ' ', 'berat_badan')) ],
                    [ 'field' => 'subtitle', 'label' => '' ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'kelainan',
                        'label' => ucwords(str_replace('_', ' ', 'kelainan')) ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'penyakit_penyerta',
                        'label' => ucwords(str_replace('_', ' ', 'penyakit_penyerta')) ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'alergi',
                        'label' => ucwords(str_replace('_', ' ', 'alergi')) ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'oral_habit',
                        'label' => ucwords(str_replace('_', ' ', 'oral_habit')) ],
                ],
                "radiograph" => [
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'tipe_muka',
                        'label' => ucwords(str_replace('_', ' ', 'tipe_muka')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'profil_muka',
                        'label' => ucwords(str_replace('_', ' ', 'profil_muka')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'relasi_bibir',
                        'label' => ucwords(str_replace('_', ' ', 'relasi_bibir')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'garis_median_ra',
                        'label' => ucwords(str_replace('_', ' ', 'garis_median_ra')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'garis_median_rb',
                        'label' => ucwords(str_replace('_', ' ', 'garis_median_rb')),
                    ],
                    [ 'field' => 'subtitle', 'label' => 'TMJ' ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'tmj_normal',
                        'label' => ucwords('Normal / Clicking / Deviasi'),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'tmj_keluhan',
                        'label' => ucwords(str_replace('_', ' ', 'keluhan')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'tmj_riwayat_tmd',
                        'label' => ucwords(str_replace('_', ' ', 'riwayat TMD')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'tmj_kelainan_lain',
                        'label' => ucwords(str_replace('_', ' ', 'kelainan_lain')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'tmj_oklusi',
                        'label' => ucwords(str_replace('_', ' ', 'oklusi')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'tmj_torus_palatinus',
                        'label' => ucwords(str_replace('_', ' ', 'torus_palatinus')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'tmj_torus_mandibularis',
                        'label' => ucwords(str_replace('_', ' ', 'torus_mandibularis')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'tmj_palatum',
                        'label' => ucwords(str_replace('_', ' ', 'palatum')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'tmj_diastema',
                        'label' => ucwords(str_replace('_', ' ', 'diastema (Lokasi, Ukuran)')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'tmj_gigi_anomali',
                        'label' => ucwords(str_replace('_', ' ', 'gigi_anomali')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'tmj_dmf',
                        'label' => ucwords(str_replace('_', ' ', 'D/M/F')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'tmj_lain',
                        'label' => ucwords(str_replace('_', ' ', 'lain-lain')),
                    ],
                    [ 'field' => 'subtitle', 'label' => 'OPG' ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'opg_jumlah_gigi',
                        'label' => ucwords(str_replace('_', ' ', 'jumlah_gigi')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'opg_impaksi',
                        'label' => ucwords(str_replace('_', ' ', 'impaksi')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'opg_posisi_m3',
                        'label' => ucwords(str_replace('_', ' ', 'posisi_M3')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'opg_karies',
                        'label' => ucwords(str_replace('_', ' ', 'karies')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'opg_tmj',
                        'label' => ucwords(str_replace('_', ' ', 'TMJ')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'opg_lainnya',
                        'label' => ucwords(str_replace('_', ' ', 'lainnya')),
                    ],
                    [ 'field' => 'subtitle', 'label' => 'Sefalometri' ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'sf_sna',
                        'label' => ucwords(str_replace('_', ' ', 'SNA')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'sf_snb',
                        'label' => ucwords(str_replace('_', ' ', 'SNB')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'sf_anb',
                        'label' => ucwords(str_replace('_', ' ', 'ANB')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'sf_relasi',
                        'label' => ucwords(str_replace('_', ' ', 'relasi_skeletal')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'sf_ira_irb',
                        'label' => ucwords(str_replace('_', ' ', 'I RA - I RB')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'sf_ira_na',
                        'label' => ucwords(str_replace('_', ' ', 'I RA - NA')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'sf_ira_sn',
                        'label' => ucwords(str_replace('_', ' ', 'I RB - SN')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'sf_ira_mp',
                        'label' => ucwords(str_replace('_', ' ', 'I RB - MP')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'sf_go_angle',
                        'label' => ucwords(str_replace('_', ' ', 'go_angle')),
                    ]
                ],
                "odontogram" => [
                    [ 'field' => 'subtitle', 'label' => 'Upper Right' ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'ur_11',
                        'label' => ucwords(str_replace('_', ' ', '11 [51]')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'ur_12',
                        'label' => ucwords(str_replace('_', ' ', '12 [52]')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'ur_13',
                        'label' => ucwords(str_replace('_', ' ', '13 [53]')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'ur_14',
                        'label' => ucwords(str_replace('_', ' ', '14 [54]')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'ur_15',
                        'label' => ucwords(str_replace('_', ' ', '15 [55]')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'ur_16',
                        'label' => ucwords(str_replace('_', ' ', '16')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'ur_17',
                        'label' => ucwords(str_replace('_', ' ', '17')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'ur_18',
                        'label' => ucwords(str_replace('_', ' ', '18')),
                    ],
                    [ 'field' => 'subtitle', 'label' => 'Upper Left' ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'ul_21',
                        'label' => ucwords(str_replace('_', ' ', '21 [61]')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'ul_22',
                        'label' => ucwords(str_replace('_', ' ', '22 [62]')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'ul_23',
                        'label' => ucwords(str_replace('_', ' ', '23 [63]')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'ul_24',
                        'label' => ucwords(str_replace('_', ' ', '24 [64]')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'ul_25',
                        'label' => ucwords(str_replace('_', ' ', '25 [65]')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'ul_26',
                        'label' => ucwords(str_replace('_', ' ', '26')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'ul_27',
                        'label' => ucwords(str_replace('_', ' ', '27')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'ul_28',
                        'label' => ucwords(str_replace('_', ' ', '28')),
                    ],
                    [ 'field' => 'subtitle', 'label' => 'Lower Left' ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'll_31',
                        'label' => ucwords(str_replace('_', ' ', '31 [71]')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'll_32',
                        'label' => ucwords(str_replace('_', ' ', '32 [72]')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'll_33',
                        'label' => ucwords(str_replace('_', ' ', '33 [73]')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'll_34',
                        'label' => ucwords(str_replace('_', ' ', '34 [74]')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'll_35',
                        'label' => ucwords(str_replace('_', ' ', '35 [75]')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'll_36',
                        'label' => ucwords(str_replace('_', ' ', '36')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'll_37',
                        'label' => ucwords(str_replace('_', ' ', '37')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'll_38',
                        'label' => ucwords(str_replace('_', ' ', '38')),
                    ],
                    [ 'field' => 'subtitle', 'label' => 'Lower Right' ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'lr_41',
                        'label' => ucwords(str_replace('_', ' ', '41 [81]')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'lr_42',
                        'label' => ucwords(str_replace('_', ' ', '42 [82]')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'lr_43',
                        'label' => ucwords(str_replace('_', ' ', '43 [83]')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'lr_44',
                        'label' => ucwords(str_replace('_', ' ', '44 [84]')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'lr_45',
                        'label' => ucwords(str_replace('_', ' ', '45 [85]')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'lr_46',
                        'label' => ucwords(str_replace('_', ' ', '46')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'lr_47',
                        'label' => ucwords(str_replace('_', ' ', '47')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'lr_48',
                        'label' => ucwords(str_replace('_', ' ', '48')),
                    ]
                ]
            ]
        ];
    }
    public function index(Request $request)
    {
        $user = auth()->user();
        $role = $user->role_display();
        $rekams = Rekam::latest()
                    ->select('rekam.*')
                    ->leftJoin('pasien', function($join) {
                        $join->on('rekam.pasien_id', '=', 'pasien.id');
                    })
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('rekam.tgl_rekam', 'LIKE', "%{$request->keyword}%")
                                ->orwhere('rekam.cara_bayar', 'LIKE', "%{$request->keyword}%")
                                ->orwhere('pasien.nama', 'LIKE', "%{$request->keyword}%")
                                ->orwhere('pasien.no_bpjs', 'LIKE', "%{$request->keyword}%")
                                ->orwhere('pasien.no_rm', 'LIKE', "%{$request->keyword}%");
                    })
                    ->when($role, function ($query) use ($role,$user){
                        if($role=="Dokter"){
                            $dokterId = Dokter::where('user_id',$user->id)->where('status',1)->first()->id;
                            $query->where('dokter_id', '=', $dokterId);
                        }
                    })
                    ->when($request->tab, function ($query) use ($request) {
                        if(auth()->user()->role_display()=="Dokter" && $request->tab==5){
                            $query->whereIn('status', [3,4,5]);
                        }else{
                            if($request->tab==5){
                                $query->whereIn('status',[4,5]);
                            }else{
                                $query->where('status', '=', "$request->tab");
                            }
                        }
                    })
                    ->paginate(10);
        return view('rekam.index',compact('rekams'));
    }

    public function add(Request $request)
    {
        $poli = Poli::all();
        $dokter = Dokter::all();
        return view('rekam.add',compact('poli', 'dokter'));
    }

    public function edit(Request $request,$id)
    {
        $poli = Poli::all();
        $data = Rekam::find($id);
        return view('rekam.edit', [
            'poli' => $poli,
            'data' => $data,
        ]);
    }


    public function detail(Request $request,$pasien_id)
    {
        $pasien = Pasien::find($pasien_id);

        $rekamLatest = Rekam::latest()
                                ->where('status','!=',5)
                                ->where('pasien_id',$pasien_id)
                                ->first();

        $rekams = Rekam::latest()
                    ->where('pasien_id',$pasien_id)
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('tgl_rekam', 'LIKE', "%{$request->keyword}%");
                    })
                    ->when($request->poli, function ($query) use ($request) {
                        $query->where('poli', 'LIKE', "%{$request->poli}%");
                    })
                    ->paginate(5);

        if($rekamLatest){
           auth()->user()->notifications->where('data.no_rekam',$rekamLatest->no_rekam)->markAsRead();
        }
        $poli = Poli::where('status',1)->get();
        $fields = [];
        if ($request->filled('section')) {
            if ($request->section == 'general') $fields = $this->fields()['edit']['general'];
            if ($request->section == 'radiograph') $fields = $this->fields()['edit']['radiograph'];
            if ($request->section == 'odontogram') $fields = $this->fields()['edit']['odontogram'];
        }

        return view('rekam.detail-rekam', [
            'pasien' => $pasien,
            'rekams' => $rekams,
            'rekamLatest' => $rekamLatest,
            'poli' => $poli,
            'fields' => $fields
        ]);
    }

    function store(Request $request){
        $this->validate($request,[
            'tgl_rekam' => 'required',
            'pasien_id' => 'required|exists:pasien,id',
            'poli_id' => 'required|exists:poli,id',
            'dokter_id' => 'required|exists:dokter,id',
            'cara_bayar' => 'required',
        ]);
        $rekam_ada = Rekam::where('pasien_id',$request->pasien_id)
                            ->whereIn('status',[1,2,3,4])
                            ->first();
        if($rekam_ada){
            return redirect()->back()->withInput($request->input())
                                ->withErrors(['pasien_id' => 'Pasien ini masih belum selesai periksa,
                                 harap selesaikan pemeriksaan sebelumnya']);
        }
        // $dokter = Dokter::where('poli',$request->poli)->first();
        // if($dokter){
        //     $request->merge([
        //         'dokter_id' => $dokter->id
        //     ]);
        // }
        $request->merge([
            'no_rekam' => "REG#".date('Ymd').$request->pasien_id,
            'petugas_id' => auth()->user()->id
        ]);
        Rekam::query()->create($request->all());
        return redirect()->route('rekam.detail',$request->pasien_id)
                        ->with('sukses','Pendaftaran Berhasil,
                         Silakan lakukan pemeriksaan dan teruskan ke dokter terkait');

    }

    function update(Request $request,$id){
        $this->validate($request,[
            'tgl_rekam' => 'required',
            'pasien_id' => 'required',
            'pasien_nama' => 'required',
            'keluhan' => 'required',
            'poli' => 'required',
            'cara_bayar' => 'required',
            'dokter_id' => 'required'
        ]);
        $pasien = Pasien::where('id',$request->pasien_id)->first();
        if(!$pasien){
            return redirect()->back()->withInput($request->input())
                                ->withErrors(['pasien_id' => 'Data Pasien Tidak Ditemukan']);
        }

        $rekam = Rekam::find($id);
        $rekam->update($request->all());
        return redirect()->route('rekam.detail',$request->pasien_id)
                        ->with('sukses','Berhasil diperbaharui,
                         Silakan lakukan pemeriksaan dan teruskan ke dokter terkait');

    }

    public function rekam_status(Request $request, $id, $status)
    {
        $rekam = Rekam::find($id);
        if($status==2 && $rekam->poli != "Poli Gigi"){
            if($rekam->pemeriksaan==null){
                return redirect()->route('rekam.detail',$rekam->pasien_id)
                ->with('gagal','Pemeriksaan Isi lebih dulu');
            }
        }
        if($status==3){
            if($rekam->poli=="Poli Gigi"){
                if(RekamGigi::where('rekam_id',$id)->count() == 0){
                    return redirect()->route('rekam.detail',$rekam->pasien_id)
                    ->with('gagal','Pemeriksaan, Diagnosa, Tindakan Wajib diisi');
                }

            }else if($rekam->tindakan==null ){
                return redirect()->route('rekam.detail',$rekam->pasien_id)
                ->with('gagal','Tindakan dan Diagnosa Belum diisi');
            }
        }
        $rekam->update([
            'status' => $status
        ]);

        $waktu = Carbon::parse($rekam->created_at)->format('d/m/Y H:i:s');
        if($status==2){
            $dokter = Dokter::find($rekam->dokter_id);
            $user = User::find($dokter->user_id);
            $message = "Pasien ".$rekam->pasien->nama.", silahkan diproses";
            Notification::send($user, new RekamUpdateNotification($rekam,$message));
            $link = Route('rekam.detail',$rekam->pasien_id);
            event(new StatusRekamUpdate($user->id,$rekam->no_rekam,$message,$link,$waktu));

        }else  if($status==3){
            $user = User::where('role',4)->get();
            $message = "Obat a\n Pasien ".$rekam->pasien->nama.", silahkan diproses";
            Notification::send($user, new RekamUpdateNotification($rekam,$message));
            foreach ($user as $key => $item) {
                $link = Route('rekam.detail',$rekam->pasien_id);
                // StatusRekamUpdate::dispatch($item->id,$rekam->no_rekam,$message,$link,$waktu);
                event(new StatusRekamUpdate($item->id,$rekam->no_rekam,$message,$link,$waktu));

            }
        }else  if($status==4){
            $user = User::where('role',2)->get();
            $message = "Pembayaran a\n Pasien ".$rekam->pasien->nama.", silahkan diproses";
            Notification::send($user, new RekamUpdateNotification($rekam,$message));
            foreach ($user as $key => $item) {
                $link = Route('rekam.detail',$rekam->pasien_id);
                // StatusRekamUpdate::dispatch($item->id,$rekam->no_rekam,$message,$link,$waktu);
                event(new StatusRekamUpdate($item->id,$rekam->no_rekam,$message,$link,$waktu));
            }
        }

        return redirect()->route('rekam.detail',$rekam->pasien_id)
                ->with('sukses','Status Rekam medis selesai diperbaharui ');
    }

    public function delete(Request $request,$id)
    {
        Rekam::find($id)->delete();
        PengeluaranObat::where('rekam_id',$id)->update([
            'deleted_at'=> Carbon::now()
        ]);
        return redirect()->route('rekam')->with('sukses','Data berhasil dihapus');
    }


}
