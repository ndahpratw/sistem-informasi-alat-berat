<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
      <div class="logo-header" data-background-color="dark">
          <a href="{{ url('/') }}" class="logo">
              <img src="{{ asset('assets/img/logo/logo.jpg') }}" alt="navbar brand" class="navbar-brand" height="20" />
          </a>
          <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
              </button>
          </div>
      </div>
  </div>

  @if (auth()->user()->role == 'Admin')
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
          <ul class="nav nav-secondary">
              <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                  <a class="sidebar-link" href="/dashboard" aria-expanded="false">
                      <i class="fas fa-home"></i>
                      <p>Dashboard</p>
                  </a>
              </li>
            @if (auth()->user()->role == 'Admin')
                <li class="nav-item {{ Request::is('data-staff*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="/data-staff" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        <p>Staff</p>
                    </a>
                </li>
            @endif
            <li class="nav-item {{ Request::is('data-karyawan*') ? 'active' : '' }}">            
                <a class="sidebar-link" href="/data-karyawan" aria-expanded="false">
                    <i class="fas fa-user"></i>
                    <p>Karyawan</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('data-alat*') ? 'active' : '' }}">            
                <a class="sidebar-link" href="/data-alat" aria-expanded="false">
                    <i class="fas fa-car"></i>
                    <p>Alat Berat</p>
                </a>
            </li>
              
            <li class="nav-item {{ Request::is('data-pengembalian*') ? 'active' : '' }}">
                <a class="sidebar-link" href="/data-pengembalian" aria-expanded="false">
                    <i class="fas fa-wallet"></i>
                    <p>Pengembalian</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('denda*') ? 'active' : '' }}">
                <a class="sidebar-link" href="/denda" aria-expanded="false">
                    <i class="fas fa-wallet"></i>
                    <p>Denda</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                <a class="sidebar-link" href="" aria-expanded="false">
                    <i class="fas fa-wallet"></i>
                    <p>Setting</p>
                </a>
            </li>
          </ul>
        </div>
    </div>

    @elseif(auth()->user()->role == 'Bendahara')
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
          <ul class="nav nav-secondary">
              <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                  <a class="sidebar-link" href="/dashboard" aria-expanded="false">
                      <i class="fas fa-home"></i>
                      <p>Dashboard</p>
                  </a>
              </li>
            <li class="nav-item {{ Request::is('data-penyewaan*') ? 'active' : '' }}">
                  <a class="sidebar-link" href="/data-penyewaan" aria-expanded="false">
                      <i class="fas fa-shopping-cart"></i>
                      <p>Penyewaan</p>
                  </a>
              </li>
          </ul>
      </div>
    </div>

  @elseif(auth()->user()->role=='Pelanggan')
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
          <ul class="nav nav-secondary">
              <li class="nav-item  {{ Request::is('profile') ? 'active' : '' }}">
                  <a class="sidebar-link" href="/profile" aria-expanded="false">
                      <i class="fas fa-user"></i>
                      <p>Profile</p>
                  </a>
              </li>
              <li class="nav-item {{ Request::is('sewa-alat') | Request::is('pembayaran*') ? 'active' : '' }}">
                  <a class="sidebar-link" href="/sewa-alat" aria-expanded="false">
                      <i class="fas fa-shopping-cart"></i>
                      <p>Riwayat Penyewaan</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="sidebar-link" href="/" aria-expanded="false">
                      <i class="fas fa-home"></i>
                      <p>Halaman Utama</p>
                  </a>
              </li>
          </ul>
      </div>
    </div>
  @endif
</div>
