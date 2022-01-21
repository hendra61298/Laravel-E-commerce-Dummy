<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a class="nav-link" data-slide="true" href="{{route('admin.logout')}}" role="button">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </li>
</ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
<!-- Brand Logo -->
<a href="#" class="brand-link">
    <img src="{{asset('adminpage/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Hendra</span>
</a>

<!-- Sidebar -->

<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="image">
            <img src="{{asset('adminpage/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        
        <div class="info">
            <a href="{{route('admin.admin')}}" class="d-block">Admin</a>
        </div>
        </div>
 
    <!-- Sidebar Menu -->
    <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        
    
        <li class="nav-item {{ (request()->is('product*')) ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                Master Product
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
           
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{route('admin.product.list')}}" class="nav-link {{ (request()->is('product/list')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>List Product</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{route('admin.category')}}" class="nav-link {{ (request()->is('admin/category')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Category Product</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{route('admin.addrole')}}" class="nav-link {{ (request()->is('admin/addrole*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Role </p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{route('admin.add')}}" class="nav-link {{ (request()->is('product/add')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Product</p>
                </a>
                </li>
            </ul>
        </li>
  

        <li class="nav-item {{ (request()->is('product*')) ? 'menu-is-opening menu-open' : '' }}">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
            Transaksi
            <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="{{route('admin.product.buy')}}" class="nav-link {{ (request()->is('product/buy')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Buy Product</p>
            </a>
            </li>
            </li>
            <li class="nav-item">
            <a href="{{route('admin.product.transaksi')}}" class="nav-link {{ (request()->is('product/transaksi')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Riwayat Transaksi</p>
            </a>
            </li>
        </ul>
        </li>
    </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
