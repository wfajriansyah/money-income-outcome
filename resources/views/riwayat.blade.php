@extends('layouts/auth')

@section('title') Monou @endsection
@section('title2') Riwayat Catatan @endsection

@extends('layouts/navigation')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Riwayat Catatan</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipe Catatan</th>
                                <th>Nominal</th>
                                <th>Catatan</th>
                                <th>Dibuat Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history as $items)
                                <tr>
                                    <td>{{ $items->idnya }}</td>
                                    <td>@if(preg_match('/INC/', $items->idnya) > 0) Masuk @else Keluar @endif</td>
                                    <td>{{ convertRupiah($items->nominal) }}</td>
                                    <td>{{ $items->notes }}</td>
                                    <td>{{ $items->created_at->format('d M Y H:i:s') }}</td>
                                    <td class="text-center"><a href="{{ route('editRiwayat', $items->idnya) }}"><button class="btn btn-primary btn-sm btn-flat"><i class="fa fa-pencil"></i></button></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
<!-- /.row -->
@endsection
