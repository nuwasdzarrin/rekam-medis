@extends('layout.apps')
@section('content')
    <div class="card rounded">
        <div class="card-body">
            <h5>Filter</h5>
            <hr/>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <div class="d-none d-md-flex align-items-center justify-content-between">
                            <input class="form-control" type="datetime-local" placeholder="start">
                            <div>&nbsp;-&nbsp;</div>
                            <input class="form-control" type="datetime-local" placeholder="end">
                        </div>
                        <div class="row d-md-none">
                            <div class="col-md-5">
                                <input class="form-control" type="datetime-local" placeholder="start">
                            </div>
                            <div class="col-md-2 text-center">&nbsp;-&nbsp;</div>
                            <div class="col-md-5">
                                <input class="form-control" type="datetime-local" placeholder="end">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Dokter</label>
                        <select class="form-control">
                            <option>All</option>
                            <option>Dokter 1</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-outline-success btn-rounded btn-sm">Filter</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card rounded">
        <div class="card-body">
            <h5>Data Transaksi</h5>
            <hr/>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td><b>No</b></td>
                        <td><b>Tanggal</b></td>
                        <td><b>Dokter</b></td>
                        <td><b>Biaya Tindakan</b></td>
                        <td><b>Biaya Resep</b></td>
                        <td><b>Diskon</b></td>
                        <td><b>Total</b></td>
                        <td><b>Tipe Pembayaran</b></td>
                    </tr>
                    @foreach($rekams as $key => $rekam)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$rekam->created_at}}</td>
                            <td>{{$rekam->cara_bayar}}</td>
                            <td>{{number_format($rekam->biaya_tindakan, 0, '', '.')}}</td>
                            <td>{{number_format($rekam->biaya_resep, 0, '', '.')}}</td>
                            <td>{{number_format($rekam->diskon, 0, '', '.')}}</td>
                            <td>{{number_format($rekam->biaya_tindakan + $rekam->biaya_resep - $rekam->diskon, 0, '', '.')}}</td>
                            <td>
                                {{$rekam->cara_bayar . ($rekam->cara_bayar == 'non_tunai' ? (' (' . $rekam->platform_pembayaran . ' )') : '')}}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
