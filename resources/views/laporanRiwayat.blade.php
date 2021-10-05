@extends('layouts/auth')

@section('title') Monou @endsection
@section('title2') Laporan Catatan @endsection

@extends('layouts/navigation')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Laporan Catatan</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Periode Bulan</label>
                        <select name="periode" class="form-control">
                        </select>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
<!-- /.row -->
@endsection
