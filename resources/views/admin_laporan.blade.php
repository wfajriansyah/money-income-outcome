@extends('layouts/auth')

@section('title') Monou @endsection
@section('title2') Laporan Keseluruhan @endsection

@extends('layouts/navigation')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Laporan Catatan Keseluruhan</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="{{ route('prosesLaporanKeseluruhan') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Periode Bulan</label>
                        <select name="periode" class="form-control">
                            <option value="99">Bulan Ini</option>
                            <option value="1">1 Bulan Kebelakang</option>
                            <option value="2">2 Bulan Kebelakang</option>
                            <option value="3">3 Bulan Kebelakang</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-flat btn-primary">Submit</button> <button type="reset" class="btn btn-danger btn-flat">Reset</button>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    @if($isPeriode)
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Laporan Catatan Periode  @if($isPeriode == 99) Bulan Ini @else {{ $isPeriode }} Bulan @endif</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    Periode : @if($isPeriode == 99) Bulan Ini @else {{ $isPeriode }} Bulan @endif<br>
                    Total Menabung : {{ convertRupiah($menabung) }}<br>
                    Total Pengeluaran : {{ convertRupiah($pengeluaran) }}<br>
                    Total Semuanya : {{ convertRupiah($menabung + $pengeluaran) }}<hr>
                    Maks Tabungan (Diambil dari keseluruhan dan dihitung rata rata): {{ convertRupiah($rata_tabungan) }}<br>
                    Maks Pengeluaran (Diambil dari keseluruhan dan dihitung rata rata): {{ convertRupiah($rata_pengeluaran) }}<br>
                    Profit : {{ $isProfit }}<br>
                    Rugi : {{ $isRugi }}<br>
                    Balance : {{ $isBalance }}<hr>
                    Kekurangan Tabungan : {{ $isKekurangan }}
                    <hr>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipe Catatan</th>
                                <th>Nominal</th>
                                <th>Catatan</th>
                                <th>Dibuat Pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($history as $items)
                                <tr>
                                    <td>{{ $items->idnya }}</td>
                                    <td>@if(preg_match('/INC/', $items->idnya) > 0) Masuk @else Keluar @endif</td>
                                    <td>{{ convertRupiah($items->nominal) }}</td>
                                    <td>{{ $items->notes }}</td>
                                    <td>{{ $items->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    @endif
</div>
<!-- /.row -->
@endsection
