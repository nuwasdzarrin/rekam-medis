@extends('layout.apps')
@section('content')
    <div class="card rounded">
        <div class="card-header">
            <h6>Detail Pasien</h6>
        </div>
        <div class="card-body">
            <div class="row">
                @if($pasien)
                    @php $paso = json_decode($pasien, TRUE) @endphp
                    @foreach($paso as $key => $pas)
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="text-capitalize mb-1">{{str_replace('_', ' ', $key)}}</div>
                            <h6>{{$pas ?? '-'}}</h6>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    @if($pasien)
    <div class="row">
        <div class="col-xl-12">
            <div class="card rounded">
                <div class="card-header">
                    <h6>Semua rekam medis {{$pasien->nama}}</h6>
                </div>
                <div class="card-body">
                    @if($rekams->count() == 0)
                        <div class="text-center">
                            <p class="mb-4">Belum ada rekam medis</p>
                            <a href="{{Route('rekam.add')}}" class="btn btn-primary btn-sm btn-rounded mr-3">
                                + Rekam Medis Baru
                            </a>
                        </div>
                    @else
                    <div class="table-responsive card-table">
                        <table class="table table-responsive-md">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Rekam Medis</th>
                                <th>No. ID Rekam</th>
                                <th>Nama Pasien</th>
                                <th>Dokter</th>
                                <th>Cara Bayar</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($rekams as $key => $row)
                                <tr>
                                    <td align="center">{{ $rekams->firstItem() + $key }}</td>
                                    <td>{{$row->medical_record_id}}</td>
                                    <td>{{$row->id_rekam}}</td>
                                    <td>
                                        <b>{{$row->nama}}</b>
                                        {!! $row->tipe_pasien ? ('<br/>('.$row->tipe_pasien.')') : ''!!}
                                    </td>
                                    <td><strong>{{$row->doctor_name}}</strong></td>
                                    <td>{{$row->cara_bayar ?  : '-'}}</td>
                                    <td>{!!$row->status_display()!!}</td>
                                    <td>{{$row->tgl_rekam}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{Route('rekam.detail', ['id'=>$row->id, 'section'=>'general'])}}"
                                               class="btn btn-primary shadow btn-xs sharp mr-1" target="_blank">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $rekams->appends(request()->except('page'))->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
