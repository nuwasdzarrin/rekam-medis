<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        $datas = User::where('role','!=',3)->get();
        return view('petugas.index',compact('datas'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);
        $is_phone_available = User::query()->where('phone', $request->phone)->first();
        if ($is_phone_available)
            return redirect()->route('petugas')->with('gagal','Nomor HP telah terdaftar');
        DB::beginTransaction();
        try {
            User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'role' => $request->role,
                'status' => 1
            ]);

            DB::commit();
            return redirect()->route('petugas')->with('sukses','Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('petugas')->with('gagal','Data gagal ditambahkan '.$th->getMessage());
        }
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
        ]);
        $is_phone_available = User::query()->where('phone', $request->phone)
            ->where('id', '!=', $id)->first();
        if ($is_phone_available)
            return redirect()->route('petugas')->with('gagal','Nomor HP telah terdaftar');
        DB::beginTransaction();
        try {
            $user = User::find($id);
            $user->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'role' => $request->role,
                'status' => 1
            ]);

            DB::commit();
            return redirect()->route('petugas')->with('sukses','Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('petugas')->with('gagal','Data gagal ditambahkan'. $th->getMessage());
        }
    }

    public function delete(Request $request,$id)
    {
        User::find($id)->delete();
        return redirect()->route('petugas')->with('sukses','Data berhasil dihapus');
    }
}
