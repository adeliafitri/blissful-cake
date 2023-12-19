<!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('dist/img/logo-login.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Blissful Cake House</span>
    </a>

    <!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            @php
                $image = Auth::user()->image;
            @endphp
            <img src="{{ asset('storage/image/'.$image) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            @php
                $id = Auth::user()->id;
            @endphp
            <a href="{{ route('profile', $id) }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item {{ request()->routeIs('dashboard') ? 'menu-open' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('productCategories') ? 'menu-open' : '' }}">
                <a href="{{ route('productCategories') }}" class="nav-link {{ request()->routeIs('productCategories') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Product Categories
                    </p>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('products') ? 'menu-open' : '' }}">
                <a href="{{ route('products') }}" class="nav-link {{ request()->routeIs('products') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-cheese"></i>
                    <p>
                        Product
                    </p>
                </a>
            </li>
            @if(auth()->check() && auth()->user()->role == 'superadmin')
                <li class="nav-item {{ request()->routeIs('users') ? 'menu-open' : '' }}">
                    <a href="{{ route('users') }}" class="nav-link {{ request()->routeIs('users') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Pengaturan User
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('testimoni') ? 'menu-open' : '' }}">
                    <a href="{{ route('testimoni') }}" class="nav-link {{ request()->routeIs('testimoni') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>
                            Testimonial
                        </p>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt text-start"></i>
                    <p class="text-start">
                        Logout
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->

  </aside>
