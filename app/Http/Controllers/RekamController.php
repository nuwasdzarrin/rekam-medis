<?php

namespace App\Http\Controllers;

use App\Events\StatusRekamUpdate;
use App\Models\Dokter;
use App\Models\KondisiGigi;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\PengeluaranObat;
use App\Models\Poli;
use App\Models\Rekam;
use App\Models\RekamDiagnosa;
use App\Models\RekamGigi;
use App\Models\RekamOdontogram;
use App\Models\RekamRadiologi;
use App\Models\RekamResep;
use App\Models\RekamTindakan;
use App\Models\RekamUmum;
use App\Models\Tindakan;
use App\Notifications\RekamUpdateNotification;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as Notification;
use Illuminate\Support\Str;

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
                    'upper' => [
                        [
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
                        ],
                        [
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
                        ],
                    ],
                    'lower' => [
                        [
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
                        ],
                        [
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
                ],
                "diagnosis" => [
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'diagnosa_utama', 'required' => true,
                        'label' => ucwords(str_replace('_', ' ', 'diagnosa_utama')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'diagnosa_sekunder',
                        'label' => ucwords(str_replace('_', ' ', 'diagnosa_sekunder')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'diagnosa_tambahan',
                        'label' => ucwords(str_replace('_', ' ', 'diagnosa_tambahan')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'terapi',
                        'label' => ucwords(str_replace('_', ' ', 'terapi')),
                    ],
                    [ 'field' => 'input', 'type' => 'text', 'name' => 'edukasi',
                        'label' => ucwords(str_replace('_', ' ', 'edukasi')),
                    ],
                ]
            ]
        ];
    }
    public static function rules(): array
    {
        return [
            'store' => [
                //'parent_id' => 'required|exists:parents,id',
                'name' => 'required|string|max:255',
                'noted' => 'string|max:255',
            ],
            'update' => [
                'parent' => [
                    'pasien_id' => 'numeric|exists:pasiens,id|nullable',
                    'dokter_id' => 'numeric|exists:dokters,id|nullable',
                    'poli_id' => 'numeric|exists:polis,id|nullable',
                    'tgl_rekam' => 'date|date_format:Y-m-d H:i:s|nullable',
                    'biaya_tindakan' => 'numeric|nullable',
                    'biaya_resep' => 'numeric|nullable',
                    'diskon' => 'numeric|nullable',
                    'jumlah_uang' => 'numeric|nullable',
                    'tipe_pasien' => 'string|max:255|nullable',
                    'cara_bayar' => 'string|max:255|nullable',
                    'status' => 'numeric|nullable',
                ],
                'general' => [
                    'keluhan_utama' => 'required|string|max:255',
                    'keluhan_tambahan' => 'string|max:255|nullable',
                    'nadi' => 'string|max:255|nullable',
                    'suhu' => 'string|max:255|nullable',
                    'pernafasan' => 'string|max:255|nullable',
                    'tekanan_darah' => 'string|max:255|nullable',
                    'tinggi_badan' => 'string|max:255|nullable',
                    'berat_badan' => 'string|max:255|nullable',
                    'kelainan' => 'string|max:255|nullable',
                    'penyakit_penyerta' => 'string|max:255|nullable',
                    'alergi' => 'string|max:255|nullable',
                    'oral_habit' => 'string|max:255|nullable',
                ],
                'radiograph' => [
                    'tipe_muka' => 'string|max:255|nullable',
                    'profil_muka' => 'string|max:255|nullable',
                    'relasi_bibir' => 'string|max:255|nullable',
                    'garis_median_ra' => 'string|max:255|nullable',
                    'garis_median_rb' => 'string|max:255|nullable',
                    'tmj_normal' => 'string|max:255|nullable',
                    'tmj_keluhan' => 'string|max:255|nullable',
                    'tmj_riwayat_tmd' => 'string|max:255|nullable',
                    'tmj_kelainan_lain' => 'string|max:255|nullable',
                    'tmj_oklusi' => 'string|max:255|nullable',
                    'tmj_torus_palatinus' => 'string|max:255|nullable',
                    'tmj_torus_mandibularis' => 'string|max:255|nullable',
                    'tmj_palatum' => 'string|max:255|nullable',
                    'tmj_diastema' => 'string|max:255|nullable',
                    'tmj_gigi_anomali' => 'string|max:255|nullable',
                    'tmj_dmf' => 'string|max:255|nullable',
                    'tmj_lain' => 'string|max:255|nullable',
                    'opg_jumlah_gigi' => 'string|max:255|nullable',
                    'opg_impaksi' => 'string|max:255|nullable',
                    'opg_posisi_m3' => 'string|max:255|nullable',
                    'opg_karies' => 'string|max:255|nullable',
                    'opg_tmj' => 'string|max:255|nullable',
                    'opg_lainnya' => 'string|max:255|nullable',
                    'sf_sna' => 'string|max:255|nullable',
                    'sf_snb' => 'string|max:255|nullable',
                    'sf_anb' => 'string|max:255|nullable',
                    'sf_relasi' => 'string|max:255|nullable',
                    'sf_ira_irb' => 'string|max:255|nullable',
                    'sf_ira_na' => 'string|max:255|nullable',
                    'sf_ira_sn' => 'string|max:255|nullable',
                    'sf_ira_mp' => 'string|max:255|nullable',
                    'sf_go_angle' => 'string|max:255|nullable',
                ],
                'odontogram' => [
                    'ur_11' => 'string|max:255|nullable',
                    'ur_12' => 'string|max:255|nullable',
                    'ur_13' => 'string|max:255|nullable',
                    'ur_14' => 'string|max:255|nullable',
                    'ur_15' => 'string|max:255|nullable',
                    'ur_16' => 'string|max:255|nullable',
                    'ur_17' => 'string|max:255|nullable',
                    'ur_18' => 'string|max:255|nullable',
                    'ul_21' => 'string|max:255|nullable',
                    'ul_22' => 'string|max:255|nullable',
                    'ul_23' => 'string|max:255|nullable',
                    'ul_24' => 'string|max:255|nullable',
                    'ul_25' => 'string|max:255|nullable',
                    'ul_26' => 'string|max:255|nullable',
                    'ul_27' => 'string|max:255|nullable',
                    'ul_28' => 'string|max:255|nullable',
                    'll_31' => 'string|max:255|nullable',
                    'll_32' => 'string|max:255|nullable',
                    'll_33' => 'string|max:255|nullable',
                    'll_34' => 'string|max:255|nullable',
                    'll_35' => 'string|max:255|nullable',
                    'll_36' => 'string|max:255|nullable',
                    'll_37' => 'string|max:255|nullable',
                    'll_38' => 'string|max:255|nullable',
                    'lr_41' => 'string|max:255|nullable',
                    'lr_42' => 'string|max:255|nullable',
                    'lr_43' => 'string|max:255|nullable',
                    'lr_44' => 'string|max:255|nullable',
                    'lr_45' => 'string|max:255|nullable',
                    'lr_46' => 'string|max:255|nullable',
                    'lr_47' => 'string|max:255|nullable',
                    'lr_48' => 'string|max:255|nullable',
                    'additional_file' => 'mimes:jpg,jpeg,png,pdf|nullable',
                    'additional_file_1' => 'mimes:jpg,jpeg,png,pdf|nullable',
                ],
                'diagnosis' => [
                    'diagnosa_utama' => 'required|string|max:255',
                    'diagnosa_sekunder' => 'string|max:255|nullable',
                    'diagnosa_tambahan' => 'string|max:255|nullable',
                    'terapi' => 'string|max:255|nullable',
                    'edukasi' => 'string|max:255|nullable',
                ],
                'tindakan' => [
                    'tindakan_id' => 'required|string|max:255',
                    'kode' => 'string|max:255|nullable',
                    'nama' => 'string|max:255|nullable',
                    'harga' => 'string|max:255|nullable',
                ],
                'resep' => [
                    'obat_id' => 'required|string|max:255',
                    'nama' => 'string|max:255|nullable',
                    'satuan' => 'string|max:255|nullable',
                    'harga_satuan' => 'string|max:255|nullable',
                ],
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


    public function detail(Request $request, $id)
    {
        $rekam = Rekam::query()->find($id);
        $pasien = Pasien::query()->find($rekam->pasien_id);

        $fields = [];
        $data_section = [];
        $data_options = [];
        $update_url = '';
        if ($request->filled('section')) {
            if ($request->section == 'general') {
                $fields = self::fields()['edit']['general'];
                $data_section = RekamUmum::query()->where('rekam_id', $id)->first();
                $update_url = route('rekam.update_general', [
                    'id' => $id,
                    'redirect' => route('rekam.detail', ['id' => $id, 'section' => 'general'])
                ]);
            }
            elseif ($request->section == 'radiograph') {
                $fields = self::fields()['edit']['radiograph'];
                $data_section = RekamRadiologi::query()->where('rekam_id', $id)->first();
                $update_url = route('rekam.update_radiograph', [
                    'id' => $id,
                    'redirect' => route('rekam.detail', ['id' => $id, 'section' => 'radiograph'])
                ]);
            }
            elseif ($request->section == 'odontogram') {
                $fields = self::fields()['edit']['odontogram'];
                $data_section = RekamOdontogram::query()->where('rekam_id', $id)->first();
                $update_url = route('rekam.update_odontogram', [
                    'id' => $id,
                    'redirect' => route('rekam.detail', ['id' => $id, 'section' => 'odontogram'])
                ]);
            }
            elseif ($request->section == 'diagnosis') {
                $fields = self::fields()['edit']['diagnosis'];
                $data_section = RekamDiagnosa::query()->where('rekam_id', $id)->first();
                $update_url = route('rekam.update_diagnosis', [
                    'id' => $id,
                    'redirect' => route('rekam.detail', ['id' => $id, 'section' => 'diagnosis'])
                ]);
            }
            elseif ($request->section == 'diagnosis') {
                $fields = self::fields()['edit']['diagnosis'];
                $data_section = RekamDiagnosa::query()->where('rekam_id', $id)->first();
                $update_url = route('rekam.update_diagnosis', [
                    'id' => $id,
                    'redirect' => route('rekam.detail', ['id' => $id, 'section' => 'diagnosis'])
                ]);
            }
            elseif ($request->section == 'tindakan') {
                $data_section = RekamTindakan::query()->select(['id', 'nama', 'harga'])->where('rekam_id', $id)
                    ->get();
                $data_options = Tindakan::query()->select(['id', 'kode', 'nama', 'harga'])->get();
                $update_url = route('rekam.update_tindakan', [
                    'id' => $id,
                    'redirect' => route('rekam.detail', ['id' => $id, 'section' => 'tindakan'])
                ]);
            }
            elseif ($request->section == 'resep') {
                $data_section = RekamResep::query()->select(['id', 'nama', 'harga_satuan', 'quantity'])
                    ->where('rekam_id', $id)->get();
                $data_options = Obat::query()->select(['id', 'kd_obat', 'nama', 'stok', 'harga', 'satuan'])->get();
                $update_url = route('rekam.update_resep', [
                    'id' => $id,
                    'redirect' => route('rekam.detail', ['id' => $id, 'section' => 'resep'])
                ]);
            }
            elseif ($request->section == 'payment') {
                $data_options = RekamTindakan::query()->select(['nama', 'harga', 'kode'])->where('rekam_id', $id)
                    ->get();
                $data_section = RekamResep::query()->select(['nama', 'harga_satuan', 'quantity'])
                    ->where('rekam_id', $id)->get();
                $update_url = route('rekam.update', [
                    'id' => $id,
                    'redirect' => route('rekam.detail', ['id' => $id, 'section' => 'payment'])
                ]);
            }
        }

        return view('rekam.detail-rekam', [
            'rekam' => $rekam,
            'pasien' => $pasien,
            'fields' => $fields,
            'data_section' => $data_section,
            'data_options' => $data_options,
            'update_url' => $update_url
        ]);
    }

    function store(Request $request){
        $this->validate($request,[
            'tgl_rekam' => 'required',
            'pasien_id' => 'required|exists:pasien,id',
            'poli_id' => 'required|exists:poli,id',
            'dokter_id' => 'required|exists:dokter,id',
            'tipe_pasien' => 'required',
        ]);
        $rekam_ada = Rekam::where('pasien_id',$request->pasien_id)
                            ->whereIn('status',[1,2,3,4])
                            ->first();
        if($rekam_ada){
            return redirect()->back()->withInput($request->input())
                ->withErrors(['pasien_id' => 'Pasien ini masih belum selesai periksa, harap selesaikan pemeriksaan
                sebelumnya, <a href="'. route('rekam.detail', [
                    'id' => $rekam_ada->id, 'section' => 'general']) .'" target="_blank">disini</a>'
                ]);
        }
        $request->merge([
            'no_rekam' => "REG#".date('Ymd').$request->pasien_id,
            'petugas_id' => auth()->user()->id
        ]);
        $rekam = Rekam::query()->create($request->all());
        return response()->redirectToRoute('rekam.detail', ['id' => $rekam->id, 'section' => 'general'])
                        ->with('sukses','Pendaftaran Berhasil,
                         Silakan lakukan pemeriksaan dan teruskan ke dokter terkait');

    }

    function update(Request $request,$id){
        $request->validate(self::rules()['update']['parent']);
        $rekam = Rekam::query()->find($id);
        $rekam->petugas_id = auth()->user()->id;
        $rekam->platform_pembayaran = $request->exists('cara_bayar') && ($request->cara_bayar == 'non_tunai') ?
            $request->platform_pembayaran : null;
        if ($request->jumlah_uang && $rekam->status < 5) $rekam->status = 5;
        foreach (self::rules()['update']['parent'] as $key => $value) {
            if ($request->exists($key)) {
                $rekam->{$key} = $request->{$key};
            }
        }
        $rekam->save();
        $response = $request->filled('redirect') ? response()->redirectTo($request->redirect)
            : response()->redirectToRoute('rekam.detail', ['id' => $rekam->id, 'section' => 'general']);
        return $response->with('message', __('Success update data'))->with('status_type', 'success');
    }

    function update_section($request, $rekam_id, $section): \Illuminate\Http\RedirectResponse
    {
        $request->validate(self::rules()['update'][$section]);
        $rekam = Rekam::query()->find($rekam_id);
        if (!$rekam)
            return back()->withInput()->with('message', "Rekam not found")->with('status_type', 'danger');
        try {
            DB::beginTransaction();
            if ($section == 'general') {
                if ($rekam->status < 2) $rekam->status = 2;
                $model = RekamUmum::query()->findOrNew($request->filled('id') ? $request->id : '');
            }
            elseif ($section == 'radiograph') {
                if ($rekam->status < 2) $rekam->status = 2;
                $model = RekamRadiologi::query()->findOrNew($request->filled('id') ? $request->id : '');
            }
            elseif ($section == 'odontogram') {
                if ($rekam->status < 2) $rekam->status = 2;
                $model = RekamOdontogram::query()->findOrNew($request->filled('id') ? $request->id : '');
            }
            elseif ($section == 'diagnosis') {
                if ($rekam->status < 2) $rekam->status = 2;
                $model = RekamDiagnosa::query()->findOrNew($request->filled('id') ? $request->id : '');
            }
            elseif ($section == 'tindakan') {
                if ($rekam->status < 3) $rekam->status = 3;
//                $model = RekamTindakan::query()->where('rekam_id', $rekam_id)->where('tindakan_id', $request->tindakan_id)->first();
//                if (!$model) $model = new RekamTindakan;
                $model = new RekamTindakan;
            }
            elseif ($section == 'resep') {
                if ($rekam->status < 4) $rekam->status = 4;
                $model = RekamResep::query()->where('rekam_id', $rekam_id)->where('obat_id', $request->obat_id)->first();
                if ($model) {
                    $model->quantity = $model->quantity + $request->quantity;
                } else {
                    $model = new RekamResep;
                    $model->quantity = $request->quantity;
                }
            }
            else
                $model = null;
            if (!$model)
                return back()->withInput()->with('message', "Error, Model not found")->with('status_type', 'danger');
            if (!($model->rekam_id && $model->pasien_id)) {
                $model->rekam_id = $rekam->id;
                $model->pasien_id = $rekam->pasien_id;
            }
            foreach (self::rules()['update'][$section] as $key => $value) {
                if (Str::contains($value, [ 'file', 'image', 'mimetypes', 'mimes' ])) {
                    if ($request->hasFile($key)) {
                        $model->{$key} = $request->file($key)->store($section, 'public');
                    } elseif ($request->exists($key)) {
                        $model->{$key} = $request->{$key};
                    }
                } elseif ($request->exists($key)) {
                    $model->{$key} = $request->{$key};
                }
            }
            $model->save();
            $rekam->save();
            if ($section == 'resep') {
                $obat = Obat::query()->find($request->obat_id);
                $obat->stok = $obat->stok - $request->quantity;
                $obat->save();
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->withInput()->with('message', $exception->getMessage())->with('status-type', 'danger');
        }
        $response = $request->filled('redirect') ? response()->redirectTo($request->redirect)
            : response()->redirectToRoute('rekam.detail', ['id' => $rekam_id, 'section' => 'general']);
        return $response->with('message', __('Success update data'))->with('status_type', 'success');
    }
    public function update_general(Request $request, $rekam_id){
        return self::update_section($request, $rekam_id, 'general');
    }
    public function update_radiograph(Request $request, $rekam_id){
        return self::update_section($request, $rekam_id, 'radiograph');
    }
    public function update_odontogram(Request $request, $rekam_id){
        return self::update_section($request, $rekam_id, 'odontogram');
    }
    public function update_diagnosis(Request $request, $rekam_id){
        return self::update_section($request, $rekam_id, 'diagnosis');
    }
    public function update_tindakan(Request $request, $rekam_id){
        return self::update_section($request, $rekam_id, 'tindakan');
    }
    public function destroy_tindakan(Request $request, $rekam_id){
        try {
            RekamTindakan::query()->find($request->id)->delete();
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->withInput()->with('message', $exception->getMessage())->with('status-type', 'danger');
        }
        $response = $request->filled('redirect') ? response()->redirectTo($request->redirect)
            : response()->redirectToRoute('rekam.detail', ['id' => $rekam_id, 'section' => 'general']);
        return $response->with('message', __('Success delete data'))->with('status_type', 'success');
    }
    public function update_resep(Request $request, $rekam_id){
        return self::update_section($request, $rekam_id, 'resep');
    }
    public function destroy_resep(Request $request, $rekam_id){
        try {
            $rekam_resep = RekamResep::query()->find($request->id);
            $obat = Obat::query()->find($rekam_resep->obat_id);
            $obat->stok = $obat->stok + $rekam_resep->quantity;
            $obat->save();
            $rekam_resep->delete();
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->withInput()->with('message', $exception->getMessage())->with('status-type', 'danger');
        }
        $response = $request->filled('redirect') ? response()->redirectTo($request->redirect)
            : response()->redirectToRoute('rekam.detail', ['id' => $rekam_id, 'section' => 'general']);
        return $response->with('message', __('Success delete data'))->with('status_type', 'success');
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
