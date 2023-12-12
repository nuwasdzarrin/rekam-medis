@extends('layout.apps')
@section('header')
    <style>
        .divCardTotalReport {
            width: 350px;
        }
        .cardTotalReport {
            width: 320px;
        }
    </style>
@endsection
@section('content')
    <div class="card rounded">
        <div class="card-body">
            <h5>Filter</h5>
            <hr/>
            <form method="get" action="{{route('report')}}">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Tanggal</label>
                            @php
                            $default_from = request()->get('start_at') ?? \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d');
                            $default_to = request()->get('end_at') ?? \Carbon\Carbon::now()->lastOfMonth()->format('Y-m-d');
                            @endphp
                            <div class="d-none d-md-flex align-items-center justify-content-between">
                                <input class="form-control timeBig" type="date" placeholder="start" name="start_at" value="{{$default_from}}">
                                <div>&nbsp;-&nbsp;</div>
                                <input class="form-control timeBig" type="date" placeholder="end" name="end_at" value="{{$default_to}}">
                            </div>
                            <div class="row d-md-none">
                                <div class="col-md-5">
                                    <input class="form-control timeSmall" type="date" placeholder="start" name="start_at" value="{{request()->get('start_at')}}">
                                </div>
                                <div class="col-md-2 text-center">&nbsp;-&nbsp;</div>
                                <div class="col-md-5">
                                    <input class="form-control timeSmall" type="date" placeholder="end" name="end_at" value="{{request()->get('end_at')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Dokter</label>
                            <select class="form-control" name="doctor_id">
                                <option value="">All</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{$doctor->id}}" {{request()->get('doctor_id') == $doctor->id ? 'selected':''}}>{{$doctor->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-outline-success btn-rounded btn-sm">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="d-flex overflow-auto w-100 mb-4">
        <div class="divCardTotalReport">
            <div class="card rounded mr-3 cardTotalReport">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="media-body mr-3">
                            <h3 class="text-black font-w600">
                                {{$rekams->count()}}
                            </h3>
                            <span>Total Periksa</span>
                        </div>
                        <i class="fa fa-users" style="color: #007A64; font-size: 34px;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="divCardTotalReport">
            <div class="card rounded mr-3 cardTotalReport">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="media-body mr-3">
                            <h3 class="text-black font-w600">
                                Rp. {{number_format($rekams->sum(function ($rekam){return $rekam->biaya_tindakan + $rekam->biaya_resep - $rekam->diskon;}) ?? 0, 0, '', '.')}}
                            </h3>
                            <span>Total Pendapatan</span>
                        </div>
                        <i class="fa fa-money" style="color: #007A64; font-size: 34px;"></i>
                    </div>
                </div>
            </div>
        </div>
        @php
        $group_doctor = $rekams->groupBy('dokter_id');
        @endphp
        @foreach($group_doctor as $gd)
        <div class="divCardTotalReport">
            <div class="card rounded mr-3 cardTotalReport">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="media-body mr-3">
                            <h3 class="text-black font-w600">
                                Rp. {{number_format($gd->sum(function ($sgd){return $sgd->biaya_tindakan + $sgd->biaya_resep - $sgd->diskon;}) ?? 0, 0, '', '.')}}
                            </h3>
                            <span>{{$gd[0]->dokter->nama}}</span>
                        </div>
                        <i class="fa fa-money" style="color: #007A64; font-size: 34px;"></i>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
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
                        <td><b>Pasien</b></td>
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
                            <td>{{$rekam->pasien->nama}}</td>
                            <td>{{$rekam->pasien ? $rekam->pasien->nama : '-'}}</td>
                            <td>{{$rekam->dokter ? $rekam->dokter->nama : '-'}}</td>
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
@section('script')
    <script>
        let width = window.innerWidth;
        if(width < 750) {
            $(".timeBig").each((i,element)=>{
                $(element).attr('disabled', true)
            })
        } else {
            $(".timeSmall").each((i,element)=>{
                $(element).attr('disabled', true)
            })
        }
    </script>
@endsection
