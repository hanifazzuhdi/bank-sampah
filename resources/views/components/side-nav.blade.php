<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-fire"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SAMMPAH</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item{{ request()->is("home") ? ' active' : '' }}">
        <a class="nav-link" href="{{route('home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Admin
    </div>

    <!-- Nav Item - Kelola User -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#toggleUser" aria-expanded="true"
            aria-controls="toggleUser">
            <i class="fas fa-fw fa-users"></i>
            <span>Kelola User</span>
        </a>
        <div id="toggleUser" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kelola User</h6>
                <a class="collapse-item{{ request()->is("karyawan") ? ' active' : '' }}"
                    href="{{route('karyawan.index')}}">Daftar Karyawan</a>
                <a class="collapse-item{{ request()->is("nasabah") ? ' active' : '' }}"
                    href="{{route('nasabah.index')}}">Daftar Nasabah</a>
                <a class="collapse-item{{ request()->is("nasabah/blacklist") ? ' active' : '' }}"
                    href="{{route('nasabah.blacklist')}}">Daftar Blacklist</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Kelola Sampah -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#toggleSampah" aria-expanded="true"
            aria-controls="toggleSampah">
            <i class="fas fa-fw fa-warehouse"></i>
            <span>Kelola Sampah</span>
        </a>
        <div id="toggleSampah" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kelola Sampah</h6>
                <a class="collapse-item{{ request()->is("sampah") ? ' active' : '' }}"
                    href="{{route('sampah.index')}}">List Jenis</a>
                <a class="collapse-item{{ request()->is("gudang") ? ' active' : '' }}"
                    href="{{route('gudang.index')}}">Gudang Sampah</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Bendahara
    </div>

    <!-- Nav Item - Permintaan -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#permintaan" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-money-check"></i>
            <span>Penarikan</span>
        </a>
        <div id="permintaan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Penarikan Saldo</h6>
                <a class="collapse-item{{ request()->is("penarikan/tunai") ? ' active' : '' }}"
                    href="{{route('keuangan.penarikan')}}">Tarik Via Teller</a>
                <a class="collapse-item{{ request()->is("penarikan/permintaan") ? ' active' : '' }}"
                    href="{{route('keuangan.permintaan')}}">Permintaan Tarik
                    Saldo</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Keuangan -->
    <li class="nav-item{{ request()->is('keuangan') ? ' active' : '' }}"">
        <a class=" nav-link" href="{{route('keuangan.index')}}">
        <i class="fas fa-fw fa-chart-line"></i>
        <span>Keuangan</span></a>
    </li>

    <!-- Nav Item - Penyetoran -->
    <li class="nav-item{{ request()->is('penyetoran') ? ' active' : '' }}">
        <a class="nav-link" href="{{route('bendahara.penyetoran')}}">
            <i class="fas fa-fw fa-hand-holding-water"></i>
            <span>Penyetoran</span></a>
    </li>

    <!-- Nav Item - Penjualan -->
    <li class="nav-item{{ request()->is('penjualan') ? ' active' : '' }}">
        <a class="nav-link" href="{{route('bendahara.penjualan')}}">
            <i class="fas fa-fw fa-file-invoice-dollar"></i>
            <span>Penjualan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->