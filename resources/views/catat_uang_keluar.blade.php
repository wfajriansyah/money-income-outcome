@extends('layouts/auth')

@section('title') Monou @endsection
@section('title2') Catat Uang Masuk @endsection

@extends('layouts/navigation')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Catat Uang Masuk</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="{{ route('prosesCatatUangMasuk') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Nominal</label>
                        <input type="number" class="form-control" name="nominal" placeholder="Masukkan nominal yang anda akan masukkan." />
                    </div>
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea class="form-control" name="notes" placeholder="Masukkan catatan atau berita yang akan anda simpan. Seperti 'Dapat Gaji' atau 'Kembalian Pembelian Handphone'"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-flat btn-primary">Submit</button> <button type="reset" class="btn btn-flat btn-danger">Reset</button>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
<!-- /.row -->
@endsection
