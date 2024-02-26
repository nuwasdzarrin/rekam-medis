<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
// use Image;
use App\Models\Rekam;
use App\Models\RekamGigi;
use App\Models\PengeluaranObat;

class PasienController extends Controller
{
    public function json(Request $request)
    {
        return DataTables::of(Pasien::query())->addColumn('action',function($data) {
            $button = '<a href="javascript:void(0)"
                data-id="'.$data->id.'"
                data-nama="'.$data->nama.'"
                data-no="'.$data->no_rm.'"
                data-metode="'.$data->cara_bayar.'"
                class="btn btn-primary shadow btn-xs pilihPasien">
                Pilih</a>';
            return $button;
        })->rawColumns(['action'])->toJson();
    }

    public function index(Request $request)
    {
        $datas = Pasien::query()->whereNull('deleted_at')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('medical_record_id', 'LIKE', "%{$request->keyword}%")
                        ->orWhere('nama', 'LIKE', "%{$request->keyword}%")
                        ->orWhere('no_bpjs', 'LIKE', "%{$request->keyword}%")
                        ->orWhere('no_hp', 'LIKE', "%{$request->keyword}%")
                        ->orWhere('alamat_lengkap', 'LIKE', "%{$request->keyword}%");
                })->orderByDesc('id')->paginate(10);
        return view('pasien.index',compact('datas'));
    }

    public function detail($id)
    {
        $pasien = Pasien::query()
            ->select(['medical_record_id as no_rekam_medis', 'nama', 'tmp_lahir as tempat_lahir', 'tgl_lahir as tanggal_lahir',
                'jk as Jenis Kelamin', 'alamat_lengkap', 'kelurahan', 'kecamatan', 'kabupaten', 'kodepos as kode_pos',
                'agama', 'status_menikah as status_pernikahan', 'pendidikan', 'pekerjaan', 'kewarganegaraan', 'no_hp',
                'no_bpjs'])
            ->find($id);
        $rekams = Rekam::query()
            ->select([
                'rekam.id', 'rekam.dokter_id', 'rekam.pasien_id', 'rekam.tgl_rekam', 'rekam.cara_bayar',
                'rekam.tipe_pasien', 'rekam.status', 'pasien.nama', 'pasien.no_bpjs', 'pasien.medical_record_id',
                'dokter.nama as doctor_name'
            ])
            ->selectRaw('(SELECT CONCAT("RM/", DATE_FORMAT(rekam.tgl_rekam,"%d/%m/%y"), "/",
            LPAD((count(*) + 1), 3, "0"))
            FROM rekam rek_2
            WHERE rek_2.tgl_rekam >= date(rekam.tgl_rekam)
            AND rek_2.tgl_rekam < date_add(date(rekam.tgl_rekam), INTERVAL 1 DAY) AND rek_2.id < rekam.id)
            AS no_id_rekam')
            ->leftJoin('pasien', 'rekam.pasien_id', '=', 'pasien.id')
            ->leftJoin('dokter', 'rekam.dokter_id', '=', 'dokter.id')
            ->where('rekam.pasien_id', $id)->paginate(20);
        return view('pasien.detail', ['pasien' => $pasien, 'rekams' => $rekams]);
    }

    function add(Request $request){
        return view('pasien.add');
    }

    function edit(Request $request,$id){
        $data = Pasien::find($id);
        return view('pasien.edit',compact('data'));
    }

    function file(Request $request,$id){
        $data = Pasien::find($id);
        return view('pasien.file',compact('data'));
    }

    function getFirstWords($sentence = ''): string
    {
        $words = preg_split("/\s+/", $sentence);
        $acronym = "";
        foreach ($words as $w) {
            $acronym .= mb_substr($w, 0, 1);
        }
        return $acronym;
    }

    function store(Request $request){
        $this->validate($request,[
            'nama' => 'required',
            'no_hp' => 'required',
            'code' => 'required',
            'tipe_pasien' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        // RM-01/02/24/001
        $pasien = Pasien::query()->create($request->all());
        Pasien::query()->find($pasien->id)->update([
            'jk' => $request->jenis_kelamin, 'cara_bayar' => $request->tipe_pasien,
            'no_rm' => $request->code . str_pad($pasien->id, 4, '0', STR_PAD_LEFT),
            'medical_record_id' => $this->getFirstWords($pasien->name)."/".date('dmy'),
//            'medical_record_id' => "RM-".date('d/m/y').'/'.str_pad($pasien->id, 4, '0', STR_PAD_LEFT),
        ]);
        if ($request->hasFile('file')) {
            $originName = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileName = $fileName.'_'.$pasien->no_rm.'.'.$extension;
            $request->file('file')->move('images/pasien/',$fileName);
            $pasien->general_uncent = $fileName;
            $pasien->save();
        }
        return redirect()->route('pasien')->with('sukses','Data berhasil ditambahkan');
    }

    public function fill_medical_record()
    {
        $patients = Pasien::query()->select('id', 'no_rm', 'nama')->get();
        foreach ($patients as $pasien) {
            Pasien::query()->find($pasien->id)->update([
                'no_rm' => substr($pasien->no_rm, 0, 1) . str_pad($pasien->id, 4, '0', STR_PAD_LEFT),
                'medical_record_id' => $this->getFirstWords($pasien->nama)."/".Carbon::parse($pasien->created_at)->format('dmy'),
//                'medical_record_id' => "RM-".date('d/m/y').'/'.str_pad($pasien->id, 4, '0', STR_PAD_LEFT),
            ]);
        }
        return redirect()->route('pasien')->with('sukses','Data berhasil diperbarui');
    }

    function update(Request $request,$id){
        $this->validate($request,[
            'nama' => 'required',
            'no_hp' => 'required',
            'jk' => 'required',
            'cara_bayar' => 'required',
            'file' => 'mimes:jpg,png,jpeg'
        ]);
        $data = Pasien::find($id);
        $data->update($request->all());
        if ($request->hasFile('file')) {
            $originName = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileName = $fileName.'_'.$data->no_rm.'.'.$extension;
            $request->file('file')->move('images/pasien/',$fileName);
            $data->update([
                'general_uncent' => $fileName
            ]);
        }
        return redirect()->route('pasien')->with('sukses','Data berhasil diperbaharui');

    }

    function delete(Request $request,$id)
    {
        // Pasien::find($id)->update(['deleted_at'=>Carbon::now()]);
       $suk = Pasien::find($id)->delete();
       if($suk){
            Rekam::where('pasien_id',$id)->delete();
            RekamGigi::where('pasien_id',$id)->delete();
            PengeluaranObat::where('pasien_id',$id)->delete();
       }
        return redirect()->route('pasien')->with('sukses','Data berhasil dihapus');
    }

    function getLastRM(Request $request)
    {
        if ($code = $request->get('code')){
            $data = Pasien::orderBy('no_rm','desc')
                        ->where('no_rm','LIKE',"%{$code}%")
                        ->first();
            if ($data) {
                $last_no = substr($data->no_rm,2,3);
                $noLast = (int)$last_no;
                $newNo = $noLast+1;
                $nomorBaru = $newNo;
                if($newNo < 10){
                    $nomorBaru = "00".$newNo;
                }else if($newNo < 100){
                    $nomorBaru = "0".$newNo;
                }
                $no_rm_baru = $code.$nomorBaru;
                return response()->json([
                    'success' => true,
                    'data' => $no_rm_baru
                ],200);
            }else{
                return response()->json([
                    'success' => false,
                ],400);
            }
        }

        return response()->json([ 'success' => false],400);
    }
}
