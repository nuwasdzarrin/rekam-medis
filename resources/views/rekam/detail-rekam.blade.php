@extends('layout.apps')
@section('content')

{{-- DATA --}}
<div class="row">
    @if(session()->has('message'))
        <div class="alert alert-{{session()->get('status_type')}} alert-dismissible fade show w-100" role="alert">
            {{ session()->get('message') }}
            <button type="button" class="close" style="top: 5px;" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>
<div class="row">
    <div class="col-sm-12 col-sm-5 col-lg-5">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h4 class="fs-20 text-black mb-0">Detail Pasien</h4>
                <div class="dropdown">
                    RM#  {{$pasien->no_rm}}
                </div>
            </div>
            <div class="card-body">
                <div class="media mb-4 align-items-center">
                    <div class="media-body">
                        <input type="hidden" id="pasien_id" value="{{$pasien->id}}">
                        <input type="hidden" id="rekam_id" value="{{$rekamLatest ? $rekamLatest->id : '' }}">

                        <h3 class="fs-18 font-w600 mb-1"><a href="javascript:void(0)"
                             class="text-black">{{$pasien->nama}}</a></h3>
                        <h4 class="fs-14 font-w600 mb-1">{{$pasien->tmp_lahir.", ".$pasien->tgl_lahir}}</h4>
                        @php
                            $b_day = \Carbon\Carbon::parse($pasien->tgl_lahir); // Tanggal Lahir
                            $now = \Carbon\Carbon::now();
                        @endphp
                        <h4 class="fs-14 font-w600 mb-1">{{"Usia : ".$b_day->diffInYears($now) }}</h4>

                        <h4 class="fs-14 font-w600 mb-1">{{$pasien->jk.", ".$pasien->status_menikah}}</h4>
                        <span class="fs-14">{{$pasien->alamat_lengkap}}</span>
                        <span class="fs-14">{{$pasien->keluhan.", ".$pasien->kecamatan.", ".$pasien->kabupaten.", ".$pasien->kewarganegaraan}}</span>
                        {{-- <textarea name="analysis" class="form-control" id="editor" cols="30" rows="10"></textarea> --}}
                        <br>
                        @if ($pasien->isRekamGigi())
                            <a href="{{Route('rekam.gigi.odontogram',$pasien->id)}}" style="width: 120px"
                                class="btn-rounded btn-info btn-xs "><i class="fa fa-eye"></i> Odontogram</a>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-sm-12 col-sm-7 col-lg-7">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h4 class="fs-20 text-black mb-0">Info Pasien</h4>
                <div class="dropdown">
                     @if ($rekamLatest)
                        {!! $rekamLatest->status_display() !!}
                    @endif
                    @if (auth()->user()->role_display()=="Admin" || auth()->user()->role_display()=="Pendaftaran")
                    <a href="{{Route('pasien.edit',$pasien->id)}}" style="width: 120px"
                        class="btn-rounded btn-info btn-xs "><i class="fa fa-pencil"></i> Edit Pasien</a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row align-items-center">

                    <div class="col-xl-12 col-xxl-6 col-sm-6">
                        <div class="d-flex mb-3 align-items-center">
                            <span class="fs-12 col-6 p-0 text-black">
                                <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="19" height="19" fill="#5F74BF"/>
                                </svg>
                                No HP
                            </span>
                            <div class="col-8 p-0">
                               <p>{{$pasien->no_hp}}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <span class="fs-12 col-6 p-0 text-black">
                                <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="19" height="19" fill="#5FBF91"/>
                                </svg>
                                Pembayaran
                            </span>
                            <div class="col-8 p-0">
                               @if ($rekamLatest)
                                <p>{{$rekamLatest->cara_bayar}}</p>
                                <p>{{$pasien->no_bpjs}}</p>
                               @else
                                <p>{{$pasien->cara_bayar}}</p>
                                <p>{{$pasien->no_bpjs}}</p>
                               @endif

                            </div>
                        </div>
                        <div class="d-flex mb-3 align-items-center">
                            <span class="fs-12 col-6 p-0 text-black">
                                <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="19" height="19" fill="#5F74BF"/>
                                </svg>
                                Alergi
                            </span>
                            <div class="col-8 p-0">
                               <p>{{$pasien->alergi}}</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="fs-12 col-6 p-0 text-black">
                                <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="19" height="19" fill="#5FBF91"/>
                                </svg>
                                File General
                            </span>
                            <div class="col-8 p-0">
                              @if ($pasien->general_uncent != null)
                                <a style="width: 120px"
                                class="btn-rounded btn-info btn-xs " href="{{$pasien->getGeneralUncent()}}"
                                target="__BLANK" view>Lihat Data</a>

                              @else
                                Belum Tersedia
                              @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h4 class="fs-20 text-black mb-0">Rekam Medis Pasien</h4>
                @if ($rekamLatest)
                    @if ($rekamLatest->status==1)
                        @if (auth()->user()->role_display()=="Admin" ||
                             auth()->user()->role_display()=="Pendaftaran")
                            <a href="{{Route('rekam.status',[$rekamLatest->id,2])}}" class="btn btn-primary btn-sm">
                                Lanjutkan Ke Dokter
                                <span class="btn-icon-right"><i class="fa fa-check"></i></span>
                            </a>
                        @endif
                    @elseif ($rekamLatest->status==2)
                       @if (auth()->user()->role_display()=="Admin" || auth()->user()->role_display()=="Dokter")
                            <a href="{{Route('rekam.status',[$rekamLatest->id,3])}}" class="btn btn-primary btn-sm">
                                Selesaikan Pemeriksaan & Perawatan
                                <span class="btn-icon-right"><i class="fa fa-check"></i></span>
                            </a>
                       @endif
                    @elseif ($rekamLatest->status==4)
                       @if (auth()->user()->role_display()=="Admin" || auth()->user()->role_display()=="Pendaftaran")
                            <a href="{{Route('rekam.status',[$rekamLatest->id,5])}}" class="btn btn-primary btn-sm">
                                Selesaikan Pembayaran & Rekam Medis ini
                                <span class="btn-icon-right"><i class="fa fa-check"></i></span>
                            </a>
                       @endif
                    @elseif ($rekamLatest->status==3)
                       @if (auth()->user()->role_display()=="Admin")
                            <a href="{{Route('rekam.status',[$rekamLatest->id,5])}}" class="btn btn-primary btn-sm">
                                Selesaikan Rekam Medis Ini
                                <span class="btn-icon-right"><i class="fa fa-check"></i></span>
                            </a>
                       @endif
                    @endif
                @endif
            </div>
            <div class="card-body">
                @if(request()->filled('section'))
                <div class="py-3 w-100 overflow-auto">
                    <ul class="nav nav-tabs" style="flex-wrap: unset">
                        <li class="nav-item text-nowrap">
                            <a class="nav-link {{request()->section == 'general' ? 'active' : ''}}"
                               href="{{route(Route::currentRouteName(), ['id'=>request('id'), 'section'=>'general'])}}">Data Medis Umum</a>
                        </li>
                        <li class="nav-item text-nowrap">
                            <a class="nav-link {{request()->section == 'radiograph' ? 'active' : ''}}"
                               href="{{route(Route::currentRouteName(), ['id'=>request('id'), 'section'=>'radiograph'])}}">EO, IO, Radiografi</a>
                        </li>
                        <li class="nav-item text-nowrap">
                            <a class="nav-link {{request()->section == 'odontogram' ? 'active' : ''}}"
                               href="{{route(Route::currentRouteName(), ['id'=>request('id'), 'section'=>'odontogram'])}}">Odontogram</a>
                        </li>
                        <li class="nav-item text-nowrap">
                            <a class="nav-link {{request()->section == 'diagnosis' ? 'active' : ''}}"
                               href="{{route(Route::currentRouteName(), ['id'=>request('id'), 'section'=>'diagnosis'])}}">Diagnosis & Terapi</a>
                        </li>
                        <li class="nav-item text-nowrap">
                            <a class="nav-link {{request()->section == 'tindakan' ? 'active' : ''}}"
                               href="{{route(Route::currentRouteName(), ['id'=>request('id'), 'section'=>'tindakan'])}}">Tindakan</a>
                        </li>
                        <li class="nav-item text-nowrap">
                            <a class="nav-link {{request()->section == 'resep' ? 'active' : ''}}"
                               href="{{route(Route::currentRouteName(), ['id'=>request('id'), 'section'=>'resep'])}}">Resep Elektronik</a>
                        </li>
                        <li class="nav-item text-nowrap">
                            <a class="nav-link {{request()->section == 'payment' ? 'active' : ''}}"
                               href="{{route(Route::currentRouteName(), ['id'=>request('id'), 'section'=>'payment'])}}">Pembayaran</a>
                        </li>
                    </ul>
                </div>
                <div class="py-4">
                    @if(in_array(request()->section, ['general', 'radiograph', 'odontogram', 'diagnosis']))
                    <form method="post" action="{{$update_url}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$data_section ? $data_section['id'] : ''}}">
                        @foreach($fields as $field)
                            @if($field['field'] == 'subtitle')
                                <div class="form-group row">
                                    <div class="col-12">
                                        <hr />
                                        @if($field['label'])
                                            <h6>{{$field['label']}}</h6>
                                        @endif
                                    </div>
                                </div>
                            @else
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">
                                    {{$field['label']}}
                                    @if(isset($field['required']) && $field['required'])
                                        <span class='text-danger'>*</span>
                                    @endif
                                </label>
                                <div class="col-lg-10">
                                    <input
                                        type="{{$field['type']}}" name="{{$field['name']}}"
                                       {{isset($field['required']) && $field['required'] ? 'required' : ''}}
                                       value="{{old($field['name']) ?? ($data_section ? $data_section[$field['name']] : '')}}"
                                        class="form-control">
                                    @error($field['name'])
                                    <div class="invalid-feedback animated fadeInUp d-block">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            @endif
                        @endforeach
                        <div class="form-group mt-5">
                            <button class="btn btn-primary btn-sm btn-block">Submit</button>
                        </div>
                    </form>
                    @elseif(request()->section == 'tindakan')
                        <div class="row">
                            <div class="col-lg-4 mb-4">
                                <div class="border rounded-xl">
                                    <div class="card-header"><b>Daftar Tindakan</b></div>
                                    <div class="card-body">
                                        @foreach($data_options as $option)
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>{{$option->nama . ' (' . $option->kode . ')'}}</div>
                                                    <form method="post" action="{{$update_url}}">
                                                        @csrf
                                                        <input type="hidden" name="tindakan_id" value="{{$option->id}}">
                                                        <input type="hidden" name="kode" value="{{$option->kode}}">
                                                        <input type="hidden" name="nama" value="{{$option->nama}}">
                                                        <input type="hidden" name="harga" value="{{$option->harga}}">
                                                        <button type="submit" class="btn btn-success btn-rounded btn-sm">
                                                            Pilih
                                                        </button>
                                                    </form>
                                                </div>
                                                <hr/>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 mb-4">
                                <div class="border rounded-xl">
                                    <div class="card-header"><b>Tindakan Terpilih</b></div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <td><b>No</b></td>
                                                    <td><b>Name</b></td>
                                                    <td class="text-right"><b>Price</b></td>
                                                    <td class="text-right"><b>Remove</b></td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data_section as $key => $ds)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$ds->nama}}</td>
                                                        <td class="text-right">{{number_format($ds->harga, 0, '', '.')}}</td>
                                                        <td class="text-right">
                                                            <form method="post" action="{{route('rekam.destroy_tindakan', ['id' => $rekam->id,'redirect' => route('rekam.detail', ['id' => $rekam->id, 'section' => 'tindakan'])])}}">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{$ds->id}}">
                                                                <button
                                                                    class="btn btn-danger btn-rounded btn-sm"
                                                                    title="Delete" type="submit" name="_method"
                                                                    value="delete"
                                                                >
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif(request()->section == 'resep')
                        <div class="row">
                            <div class="col-lg-5 mb-4">
                                <div class="border rounded-xl">
                                    <div class="card-header"><b>Daftar Obat</b></div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <td><b>Nama</b></td>
                                                    <td><b>Stok</b></td>
                                                    <td class="text-center"><b>Qty</b></td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                @foreach($data_options as $option)
                                                <tr>
                                                    <td style="min-width: 100px;">{{$option->nama . ' (' . $option->kd_obat . ')'}}</td>
                                                    <td>{{$option->stok}}</td>
                                                    <td class="d-flex justify-content-center">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <button data-id="{{$option->id}}"
                                                                    class="btn btn-rounded btn-xs btn-outline-success minusQuantity">
                                                                -
                                                            </button>
                                                            <input
                                                                id="quantityViewer{{$option->id}}"
                                                                class="form-control text-center mx-2"
                                                                type="number" value="0" readonly
                                                                style="min-width: 58px;max-width: 80px;"
                                                            >
                                                            <button data-id="{{$option->id}}" data-stock="{{$option->stok}}"
                                                                class="btn btn-rounded btn-xs btn-outline-success plusQuantity" >
                                                                +
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">
                                                        <form method="post" action="{{$update_url}}">
                                                            @csrf
                                                            <input type="hidden" name="obat_id" value="{{$option->id}}">
                                                            <input type="hidden" name="nama" value="{{$option->nama}}">
                                                            <input type="hidden" name="harga_satuan" value="{{$option->harga}}">
                                                            <input type="hidden" name="satuan" value="{{$option->satuan}}">
                                                            <input type="hidden" name="quantity" id="inputQuantity{{$option->id}}" value="0">
                                                            <button type="submit" id="submitSelected{{$option->id}}" disabled
                                                                    class="btn btn-success btn-rounded btn-sm">
                                                                Pilih
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 mb-4">
                                <div class="border rounded-xl">
                                    <div class="card-header"><b>Obat Terpilih</b></div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <td><b>No</b></td>
                                                    <td><b>Name</b></td>
                                                    <td class="text-right"><b>Price (@)</b></td>
                                                    <td class="text-right"><b>Quantity</b></td>
                                                    <td class="text-right"><b>Sub Total</b></td>
                                                    <td class="text-right"><b>Remove</b></td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data_section as $key => $ds)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$ds->nama}}</td>
                                                        <td class="text-right">{{number_format($ds->harga_satuan, 0, '', '.')}}</td>
                                                        <td class="text-right">{{$ds->quantity}}</td>
                                                        <td class="text-right">{{number_format($ds->harga_satuan * $ds->quantity, 0, '', '.')}}</td>
                                                        <td class="text-right">
                                                            <form method="post" action="{{route('rekam.destroy_resep', ['id' => $rekam->id,'redirect' => route('rekam.detail', ['id' => $rekam->id, 'section' => 'resep'])])}}">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{$ds->id}}">
                                                                <button
                                                                    class="btn btn-danger btn-rounded btn-sm"
                                                                    title="Delete" type="submit" name="_method"
                                                                    value="delete"
                                                                >
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif(request()->section == 'payment')
                        @php
                        $total_tindakan = $data_options->sum('harga');
                        $total_resep = $data_section->sum(function ($ds) {return $ds->harga_satuan * $ds->quantity;});
                        @endphp
                        <div class="row">
                            <div class="col-lg-8 mb-4">
                                <div class="border rounded-xl">
                                    <div class="card-header"><b>Transaksi</b></div>
                                    <div class="card-body">
                                        <h5 class="mb-3">Tindakan</h5>
                                        <div class="table-responsive mb-5">
                                            <table class="table">
                                                <tr>
                                                    <td><b>No</b></td>
                                                    <td><b>Nama</b></td>
                                                    <td><b>Kode</b></td>
                                                    <td class="text-right"><b>Price</b></td>
                                                </tr>
                                                @foreach($data_options as $key => $ds)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$ds->nama}}</td>
                                                        <td>{{$ds->kode}}</td>
                                                        <td class="text-right">{{number_format($ds->harga, 0, '', '.')}}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><b>Sub Total</b></td>
                                                    <td>&nbsp;</td>
                                                    <td class="text-right">
                                                        <b>{{ number_format($total_tindakan, 0, '', '.') }}</b>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <h5 class="mb-3">Resep</h5>
                                        <div class="table-responsive mb-5">
                                            <table class="table">
                                                <tr>
                                                    <td><b>No</b></td>
                                                    <td><b>Nama</b></td>
                                                    <td class="text-right"><b>Harga(@)</b></td>
                                                    <td class="text-right"><b>Qty</b></td>
                                                    <td class="text-right"><b>Harga</b></td>
                                                </tr>
                                                @foreach($data_section as $key => $ds)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$ds->nama}}</td>
                                                        <td class="text-right">
                                                            {{number_format($ds->harga_satuan, 0, '', '.')}}
                                                        </td>
                                                        <td class="text-right">{{$ds->quantity}}</td>
                                                        <td class="text-right">
                                                            {{number_format($ds->harga_satuan * $ds->quantity, 0, '', '.')}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><b>Sub Total</b></td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td class="text-right">
                                                        <b>{{ number_format($total_resep, 0, '', '.') }}</b>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-4">
                                <div class="border rounded-xl">
                                    <div class="card-header"><b>Pembayaran</b></div>
                                    <div class="card-body">
                                        <form>
                                            @csrf
                                            <h5 class="mb-2">Tagihan</h5>
                                            <h2 class="text-success mb-4">
                                                <input type="hidden" class="form-control" id="tagihan"
                                                       value="{{$total_tindakan + $total_resep}}">
                                                Rp {{ number_format($total_tindakan + $total_resep, 0, '', '.') }}
                                            </h2>
                                            <div class="form-group mb-4">
                                                <label>Diskon</label>
                                                <input type="number" class="form-control formatNumber" name="diskon">
                                            </div>
                                            <h5 class="mb-2">Total Tagihan</h5>
                                            <h2 class="text-success mb-4" id="totalTagihan">Rp 0</h2>
                                            <h5 class="mb-2">Metode Pembayaran</h5>
                                            <div class="d-flex mb-4">
                                                <button class="btn btn-outline-success btn-rounded btn-sm mr-3 active">Tunai</button>
                                                <button class="btn btn-outline-success btn-rounded btn-sm">Non Tunai</button>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label>Jumlah Uang</label>
                                                <input type="number" class="form-control formatNumber" name="jumlah_uang">
                                            </div>
                                            <div class="form-group mb-5">
                                                <label>Kembalian</label>
                                                <input type="text" class="form-control" id="totalKembalian" disabled>
                                            </div>
                                            <button class="btn btn-success btn-rounded btn-block">Konfirmasi Pembayaran</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
    <script>
        $(document).on("click", ".plusQuantity", function () {
            let quantityViewer = $(`#quantityViewer${$(this).data("id")}`)
            if ($(this).data("stock") > parseInt(quantityViewer.val())){
                const qty = parseInt(quantityViewer.val())+1
                quantityViewer.val(qty)
                $(`#inputQuantity${$(this).data("id")}`).val(qty)
                $(`#submitSelected${$(this).data("id")}`).prop("disabled", false)
            }
        })
        $(document).on("click", ".minusQuantity", function () {
            let quantityViewer = $(`#quantityViewer${$(this).data("id")}`)
            const qty = parseInt(quantityViewer.val())
            if (qty > 0) {
                quantityViewer.val(qty - 1)
                $(`#inputQuantity${$(this).data("id")}`).val(qty - 1)
            }
            if (qty < 1) $(`#submitSelected${$(this).data("id")}`).prop("disabled", true)
        })

        let jumlahUang = 0
        let discount = 0
        let tagihan = Number($('#tagihan').val())
        let totalTagihan = $('#totalTagihan')
        totalTagihan.text(`Rp ${tagihan.toLocaleString('id')}`)
        $("input.formatNumber").each((i,ele)=>{
            let clone=$(ele).clone(false)
            clone.attr("type","text")
            clone.attr("name","")
            let ele1=$(ele)
            clone.val(Number(ele1.val()).toLocaleString("id"))
            $(ele).after(clone)
            $(ele).hide()
            clone.mouseenter(()=>{
                ele1.show()
                clone.hide()
            })
            let totalKembalian = $('#totalKembalian')
            setInterval(()=>{
                let newv=Number(ele1.val()).toLocaleString("id")
                if(clone.val()!=newv){
                    clone.val(newv)
                }
                if (ele1.attr('name') === 'diskon') {
                    discount = Number(ele1.val())
                    totalTagihan.text(`Rp ${(tagihan-discount).toLocaleString('id')}`)
                }
                if (ele1.attr('name') === 'jumlah_uang') jumlahUang = Number(ele1.val())
                console.log(ele1.attr('name'), discount, jumlahUang)
                if (Number(ele1.val()) > tagihan) {
                    totalKembalian.val((Number(ele1.val()) - tagihan).toLocaleString("id"))
                } else
                    totalKembalian.val('')
            },2000)
            $(ele).mouseleave(()=>{
                $(clone).show()
                $(ele1).hide()
            })
        })
    </script>
@endsection
