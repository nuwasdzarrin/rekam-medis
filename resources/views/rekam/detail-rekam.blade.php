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
                    {!! $rekam->status_display() !!}
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
                                <p>{{$pasien->cara_bayar}}</p>
                                <p>{{$pasien->no_bpjs}}</p>
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
                                <a style="width: 120px" class="btn-rounded btn-info btn-xs "
                                   href="{{$pasien->getGeneralUncent()}}" target="_blank">Lihat Data</a>
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
                    @if(in_array(request()->section, ['general', 'radiograph', 'diagnosis']))
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
                    @elseif(request()->section == 'odontogram')
                        <form method="post" action="{{$update_url}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$data_section ? $data_section['id'] : ''}}">
                            @if($fields['upper'])
                                <div class="row">
                                    @foreach($fields['upper'] as $columns)
                                        <div class="col-md-6 mb-3">
                                            @foreach($columns as $key => $field)
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
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <img src="{{asset('images/odontogram/master_odontogram.jpeg')}}" alt="odontogram" class="img-fluid" />
                            @if($fields['lower'])
                                <div class="row">
                                    @foreach($fields['lower'] as $columns)
                                        <div class="col-md-6 mb-3">
                                            @foreach($columns as $key => $field)
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
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <hr />
                            <div class="form-group">
                                <label>File tambahan</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="additional_file" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                @error('additional_file')
                                <div class="invalid-feedback animated fadeInUp d-block">{{$message}}</div>
                                @enderror
                                @if($data_section['additional_file'])
                                    <div class="text-right mt-1">
                                        <a href="{{asset('app/public/'.$data_section['additional_file'])}}" target="_blank"
                                           class="text-primary">Show</a>
                                    </div>
                                @endif
                            </div>
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
                                        <form method="post" action="{{$update_url}}">
                                            @csrf
                                            <input type="hidden" name="biaya_tindakan" value="{{$total_tindakan}}">
                                            <input type="hidden" name="biaya_resep" value="{{$total_resep}}">
                                            <h5 class="mb-2">Tagihan</h5>
                                            <h2 class="text-success mb-4">
                                                <input type="hidden" class="form-control" id="tagihan"
                                                       value="{{$total_tindakan + $total_resep}}">
                                                Rp {{ number_format($total_tindakan + $total_resep, 0, '', '.') }}
                                            </h2>
                                            <div class="form-group mb-4">
                                                <label>Diskon</label>
                                                <input type="number" class="form-control formatNumber" id="totalDiscount" name="diskon" value="{{$rekam->diskon}}">
                                            </div>
                                            <h5 class="mb-2">Total Tagihan</h5>
                                            <h2 class="text-success mb-4" id="totalTagihan">Rp 0</h2>
                                            <h5 class="mb-2">Metode Pembayaran</h5>
                                            <div class="d-flex mb-4">
                                                <input type="hidden" name="cara_bayar" value="{{$rekam->cara_bayar == 'non_tunai' ? 'non_tunai' : 'tunai'}}" id="caraBayar">
                                                <button type="button" class="btn btn-outline-success btn-rounded btn-sm mr-3 {{$rekam->cara_bayar == 'non_tunai' ? '' : 'active'}}" id="btnTunai">Tunai</button>
                                                <button type="button" class="btn btn-outline-success btn-rounded btn-sm {{$rekam->cara_bayar == 'non_tunai' ? 'active' : ''}}" id="btnNonTunai">Non Tunai</button>
                                            </div>
                                            <div class="form-group mb-4" id="componentNonTunai" style="{{$rekam->cara_bayar == 'non_tunai' ? 'display: block' : 'display: none'}}">
                                                <label>Platform Pembayaran</label>
                                                <input type="text" class="form-control" id="platformPembayaran"
                                                       name="platform_pembayaran"
                                                       value="{{$rekam->platform_pembayaran}}">
                                                <span class="text-secondary" style="font-size: 11px;">Contoh: QRIS, Dana, TF BRI</span>
                                            </div>
                                            <div id="componentTunai" style="{{$rekam->cara_bayar == 'non_tunai' ? 'display: none' : ''}}">
                                                <div class="form-group mb-4">
                                                    <label>Jumlah Uang</label>
                                                    <input type="number" class="form-control formatNumber" id="jumlahUang" name="jumlah_uang" value="{{$rekam->jumlah_uang}}">
                                                </div>
                                                <div class="form-group mb-5">
                                                    <label>Kembalian</label>
                                                    <input type="text" class="form-control" id="totalKembalian" disabled>
                                                </div>
                                            </div>
                                            <button class="btn btn-success btn-rounded btn-block" id="btnPaymentConfirm">Konfirmasi Pembayaran</button>
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

        $(document).on("click", `#btnTunai`, function () {
            $(`#btnTunai`).toggleClass('active')
            $(`#btnNonTunai`).toggleClass('active')
            $(`#componentNonTunai`).hide()
            $(`#componentTunai`).show()
            $(`#caraBayar`).val('tunai')
        })
        $(document).on("click", `#btnNonTunai`, function () {
            $(`#btnTunai`).toggleClass('active')
            $(`#btnNonTunai`).toggleClass('active')
            $(`#componentNonTunai`).show()
            $(`#componentTunai`).hide()
            $(`#jumlahUang`).val(Number($(`#tagihan`).val()) - Number($(`#totalDiscount`).val()))
            $(`#caraBayar`).val('non_tunai')
        })

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
            let btnPaymentConfirm = $('#btnPaymentConfirm')
            setInterval(()=>{
                let newv=Number(ele1.val()).toLocaleString("id")
                if(clone.val()!=newv){
                    clone.val(newv)
                }
                if (ele1.attr('name') === 'diskon') {
                    discount = Number(ele1.val())
                    totalTagihan.text(`Rp ${(tagihan-discount).toLocaleString('id')}`)
                }
                if (ele1.attr('name') === 'jumlah_uang') {
                    let jumlahUang = Number(ele1.val())
                    if (jumlahUang >= (tagihan - discount)) {
                        totalKembalian.val((jumlahUang - (tagihan - discount)).toLocaleString("id"))
                        btnPaymentConfirm.attr('disabled', false)
                    } else {
                        totalKembalian.val('0')
                        btnPaymentConfirm.attr('disabled', true)
                    }
                }
            },1500)
            $(ele).mouseleave(()=>{
                $(clone).show()
                $(ele1).hide()
            })
        })
    </script>
@endsection
