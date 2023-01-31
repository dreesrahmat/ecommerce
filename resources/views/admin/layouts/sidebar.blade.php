<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('kategoris.index')}}">Data Kategori</a>
                <a class="collapse-item" href="{{route('subkategoris.index')}}">Data SubKategori</a>
                <a class="collapse-item" href="{{route('sliders.index')}}">Data Slider</a>
                <a class="collapse-item" href="{{route('produks.index')}}">Data Barang</a>
                <a class="collapse-item" href="{{route('testimonis.index')}}">Data Testimoni</a>
                <a class="collapse-item" href="{{route('reviews.index')}}">Data Review</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pesanan" aria-expanded="true"
            aria-controls="pesanan">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Data Pesanan</span>
        </a>
        <div id="pesanan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('orders.index')}}">Pesanan Baru</a>
                <a class="collapse-item" href="{{route('order.dikonfirmasi')}}">Pesanan Dikonfirmasi</a>
                <a class="collapse-item" href="{{route('order.dikemas')}}">Pesanan Dikemas</a>
                <a class="collapse-item" href="{{route('order.dikirim')}}">Pesanan Dikirim</a>
                <a class="collapse-item" href="{{route('order.diterima')}}">Pesanan Diterima</a>
                <a class="collapse-item" href="{{route('order.selesai')}}">Pesanan Selesai</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
        <a class="nav-link" href="{{route('pembayaran.index')}}">
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Pembayaran</span></a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
        <a class="nav-link" href="{{route('reports.index')}}">
            <i class="fas fa-fw fa-book"></i>
            <span>Laporan Pesanan</span></a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
        <a class="nav-link" href="logout">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
