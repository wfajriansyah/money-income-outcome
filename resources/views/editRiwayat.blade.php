@extends('layouts/auth')

@section('title') Monou @endsection
@section('title2') Edit Catatan @endsection

@extends('layouts/navigation')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Catatan #{{ $history->idnya }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(session('errors'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        {{ $message }}
                    </div>
                @endif
                <form method="POST" action="{{ route('prosesEditCatatan') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $history->idnya }}" />
                    <div class="form-group">
                        <label>ID</label>
                        <input type="text" class="form-control" value="{{ $history->idnya }}" disabled=disabled />
                    </div>
                    <div class="form-group">
                        <label>Nominal</label>
                        <input type="number" name="nominal" class="form-control" value="{{ $history->nominal }}" />
                    </div>
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea class="form-control" name="notes" placeholder="Masukkan catatan atau berita yang akan anda simpan. Seperti 'Dapat Gaji' atau 'Kembalian Pembelian Handphone'">{{ $history->notes }}</textarea>
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
