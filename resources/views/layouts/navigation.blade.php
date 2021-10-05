@section('navigation')
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li>
        <a href="{{ route('dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-pencil-square"></i>
            <span>Pencatatan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ route('catatUangMasuk') }}"><i class="fa fa-circle-o"></i> Catat Uang Masuk</a></li>
            <li><a href="{{ route('catatUangKeluar') }}"><i class="fa fa-circle-o"></i> Catat Uang Keluar</a></li>
        </ul>
    </li>
    <li>
        <a href="{{ route('riwayat') }}">
            <i class="fa fa-history"></i> <span>Riwayat</span>
        </a>
    </li>
    <li>
        <a href="{{ route('laporan') }}">
            <i class="fa fa-file-archive-o"></i> <span>Laporan</span>
        </a>
    </li>
    @if($my_data->level == "Admin")
        <li class="header">ADMIN MANAGEMENT</li>
        <li><a href="{{ route('perkembangan') }}"><i class="fa fa-bar-chart"></i> <span>Lihat Perkembangan</span></a></li>
        <li><a href="{{ route('laporan_keseluruhan') }}"><i class="fa fa-inbox"></i> <span>Lihat Laporan Keseluruhan</span></a></li>
    @endif
</ul>
@endsection
