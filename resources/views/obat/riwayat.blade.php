@extends('layout.apps')
@section('content')
<div class="mr-auto">
    <h2 class="text-black font-w600">Riwayat Obat Keluar</h2>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group col-lg-6 mb-4" style="float: right">
                    <form method="get" action="{{ url()->current() }}">
                        <div class="input-group">
                            <input type="text" class="form-control gp-search" name="keyword" value="{{request('keyword')}}" placeholder="Cari" value="" autocomplete="off">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default no-border btn-sm gp-search">
                                <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table  class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl Keluar</th>
                                <th>Kd Obat</th>
                                <th>Nama Obat</th>
                                <th>Kuantitas</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Sub Total</th>
                                <th>Cara Bayar</th>
                                <th>Penggunaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key=>$row)
                                <tr>
                                    <td>{{ $data->firstItem() + $key }}</td>
                                    <td>{{$row->created_at}}</td>
                                    <td>{{$row->obat ? $row->obat->kd_obat : '-'}}</td>
                                    <td>{{$row->nama}}</td>
                                    <td>{{$row->quantity}}</td>
                                    <td>{{$row->satuan}}</td>
                                    <td>{{number_format($row->harga_satuan)}}</td>
                                    <td>{{number_format($row->harga_satuan * $row->quantity)}}</td>
                                    <td>{{$row->rekam ? $row->rekam->cara_bayar : '-'}}</td>
                                    <td>
                                        <a
                                            href="{{$row->rekam ? Route('rekam.detail', ['id'=>$row->rekam->id, 'section'=>'resep']) : '#'}}"
                                            target="_blank">
                                            {{$row->pasien ? $row->pasien->nama : '-'}}<br/>
                                            {{$row->rekam ? ('rekam: ' . $row->rekam->no_rekam) : ''}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="dataTables_info" id="example_info" role="status"
                     aria-live="polite">Showing {{$data->firstItem()}} to {{$data->perPage() * $data->currentPage()}} of {{$data->total()}} entries</div>
                    {{ $data->appends(request()->except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
