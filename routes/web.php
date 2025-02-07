<?php

use App\Events\StatusRekamUpdate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\IcdController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengeluaranObatController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\RekamController;
use App\Http\Controllers\RekamGigiController;
use App\Http\Controllers\RekamPemeriksaanController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\ReportController;

Route::get('/', [AuthController::class, 'page_login'])->name('login');
Route::post('/login', [AuthController::class, 'auth'])->name('login.auth');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('test', function () {
    StatusRekamUpdate::dispatch("5","REG002","INI TEST AJA","http://sss","25 05 1993");
	// event(new App\Events\StatusRekamUpdate("082240300501"));
	return "Event has been sent!";
});

Route::get('/odontogram/{id}', [RekamGigiController::class, 'odontogram'])->name('odontogram');

Route::get('/loaddata', [RekamPemeriksaanController::class, 'insertToTableNew'])->name('loaddata');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/poliklinik', [PoliController::class, 'index'])->name('poli');
    Route::post('/poliklinik', [PoliController::class, 'store'])->name('poli.store');
    Route::post('/poliklinik/{id}/update', [PoliController::class, 'update'])->name('poli.update');
    Route::get('/poliklinik/{id}/delete', [PoliController::class, 'delete'])->name('poli.delete');

    Route::get('/getDokter', [DokterController::class, 'getDokter'])->name('getDokter');

    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter');
    Route::post('/dokter/store', [DokterController::class, 'store'])->name('dokter.store');
    Route::post('/dokter/{id}/update', [DokterController::class, 'update'])->name('dokter.update');
    Route::get('/dokter/{id}/delete', [DokterController::class, 'delete'])->name('dokter.delete');
    Route::post('/dokter/{id}/gantipassword', [DokterController::class, 'updatepassword'])->name('dokter.gantipassword');

    Route::post('/gantipassword/{id}', [AuthController::class, 'updatepassword'])->name('gantipassword');
    Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas');
    Route::post('/petugas/store', [PetugasController::class, 'store'])->name('petugas.store');
    Route::post('/petugas/{id}/update', [PetugasController::class, 'update'])->name('petugas.update');
    Route::get('/petugas/{id}/delete', [DokterController::class, 'delete'])->name('petugas.delete');

    Route::get('/getNoRM', [PasienController::class, 'getLastRM'])->name('getNoRM');

    Route::get('/pasien', [PasienController::class, 'index'])->name('pasien');
    Route::get('/pasien/add', [PasienController::class, 'add'])->name('pasien.add');
    Route::get('/pasien/json', [PasienController::class, 'json'])->name('pasien.json');
    Route::get('/pasien/fill_medical_record', [PasienController::class, 'fill_medical_record'])->name('pasien.fill_medical_record');
    Route::get('/pasien/{id}', [PasienController::class, 'detail'])->name('pasien.detail');
    Route::get('/pasien/{id}/edit', [PasienController::class, 'edit'])->name('pasien.edit');
    Route::get('/pasien/{id}/delete', [PasienController::class, 'delete'])->name('pasien.delete');
    Route::get('/pasien/{id}/file', [PasienController::class, 'file'])->name('pasien.file');

    Route::post('/pasien/store', [PasienController::class, 'store'])->name('pasien.store');
    Route::post('/pasien/{id}/update', [PasienController::class, 'update'])->name('pasien.update');

    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');

    Route::get('/obat/json', [ObatController::class, 'data'])->name('obat.data');
    Route::get('/obat', [ObatController::class, 'index'])->name('obat');
    Route::post('/obat/store', [ObatController::class, 'store'])->name('obat.store');
    Route::post('/obat/{id}/update', [ObatController::class, 'update'])->name('obat.update');
    Route::get('/obat/{id}/delete', [ObatController::class, 'delete'])->name('obat.delete');

    Route::get('/icd/json', [IcdController::class, 'data'])->name('icd.data');
    Route::get('/icd', [IcdController::class, 'index'])->name('icd');
    Route::post('/icd/store', [IcdController::class, 'store'])->name('icd.store');
    Route::post('/icd/{id}/update', [IcdController::class, 'update'])->name('icd.update');
    Route::get('/icd/{id}/delete', [IcdController::class, 'delete'])->name('icd.delete');

    Route::get('/tindakan', [TindakanController::class, 'index'])->name('tindakan');
    Route::post('/tindakan/store', [TindakanController::class, 'store'])->name('tindakan.store');
    Route::post('/tindakan/{id}/update', [TindakanController::class, 'update'])->name('master.tindakan.update');
    Route::get('/tindakan/{id}/delete', [TindakanController::class, 'delete'])->name('tindakan.delete');


    Route::get('/rekam', [RekamController::class, 'index'])->name('rekam');
    Route::get('/rekam/add', [RekamController::class, 'add'])->name('rekam.add');
    Route::get('/rekam/{id}/edit', [RekamController::class, 'edit'])->name('rekam.edit');

    Route::post('/rekam', [RekamController::class, 'store'])->name('rekam.store');
    Route::get('/rekam/{id}', [RekamController::class, 'detail'])->name('rekam.detail');

    Route::get('/rekam/{id}/delete', [RekamController::class, 'delete'])->name('rekam.delete');
    Route::post('/rekam/{id}/update', [RekamController::class, 'update'])->name('rekam.update');
    Route::post('/rekam/{id}/update_general', [RekamController::class, 'update_general'])->name('rekam.update_general');
    Route::post('/rekam/{id}/update_radiograph', [RekamController::class, 'update_radiograph'])->name('rekam.update_radiograph');
    Route::post('/rekam/{id}/update_odontogram', [RekamController::class, 'update_odontogram'])->name('rekam.update_odontogram');
    Route::post('/rekam/{id}/update_diagnosis', [RekamController::class, 'update_diagnosis'])->name('rekam.update_diagnosis');
    Route::post('/rekam/{id}/update_tindakan', [RekamController::class, 'update_tindakan'])->name('rekam.update_tindakan');
    Route::delete('/rekam/{id}/destroy_tindakan', [RekamController::class, 'destroy_tindakan'])->name('rekam.destroy_tindakan');
    Route::post('/rekam/{id}/update_resep', [RekamController::class, 'update_resep'])->name('rekam.update_resep');
    Route::delete('/rekam/{id}/destroy_resep', [RekamController::class, 'destroy_resep'])->name('rekam.destroy_resep');

    Route::get('/rekam/gigi/{id}', [RekamGigiController::class, 'index'])->name('rekam.gigi.add');
    Route::post('/rekam/gigi/{id}/store', [RekamGigiController::class, 'store'])->name('rekam.gigi.store');
    Route::get('/rekam/gigi/{id}/delete', [RekamGigiController::class, 'delete'])->name('rekam.gigi.delete');
    Route::get('/rekam/gigi/{id}/odontogram', [RekamGigiController::class, 'odontogram'])->name('rekam.gigi.odontogram');

    Route::post('/rekam/pemeriksaan/update', [RekamPemeriksaanController::class, 'pemeriksaan'])->name('pemeriksaan.update');
    Route::post('/rekam/tindakan/update', [RekamPemeriksaanController::class, 'tindakan'])->name('tindakan.update');
    Route::post('/rekam/diagnosa/update', [RekamPemeriksaanController::class, 'diagnosa'])->name('diagnosa.update');
    Route::post('/rekam/resep-obat/update', [RekamPemeriksaanController::class, 'resep'])->name('resep.update');

    Route::get('/rekam/diagnosa/delete/{id}', [RekamPemeriksaanController::class, 'diagnosa_delete'])->name('rekam.diagnosa.delete');

    Route::get('/rekam/status/{id}/{status}/update', [RekamController::class, 'rekam_status'])->name('rekam.status');


    Route::get('/rekam/pasien/resep', [RekamController::class, 'detail'])->name('rekam.upload');

    Route::get('/obat/resep', [PengeluaranObatController::class, 'resep'])->name('obat.resep');
    Route::get('/obat/resep/pengeluaran/{id}', [PengeluaranObatController::class, 'pengeluaran'])->name('obat.pengeluaran');
    Route::post('/obat/pengeluaran/store', [PengeluaranObatController::class, 'store'])->name('obat.pengeluaran.store');
    Route::get('/obat/riwayat', [PengeluaranObatController::class, 'riwayat'])->name('obat.riwayat');

    Route::get('/rekam/file/{id}/{type}', [RekamPemeriksaanController::class, 'file'])->name('pem.file');

    Route::get('/report', [ReportController::class, 'index'])->name('report');
});


