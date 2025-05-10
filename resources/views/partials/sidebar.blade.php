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
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
          <ul class="nav nav-secondary">
              <li class="nav-item active">
                  <a class="sidebar-link" href="./dashboard" aria-expanded="false">
                      <i class="fas fa-home"></i>
                      <p>Dashboard</p>
                  </a>
                  @if (auth()->user()->role == 'Admin')
                  <a class="sidebar-link" href="./data-staff" aria-expanded="false">
                    <i class="fas fa-person"></i>
                    <p>Staff</p>
                </a>
                @else
                @endif
                <a class="sidebar-link" href="./data-karyawan" aria-expanded="false">
                    <i class="fas fa-person"></i>
                    <p>Karyawan</p>
                </a>
                <a class="sidebar-link" href="./data-alat" aria-expanded="false">
                    <i class="fas fa-car"></i>
                    <p>Alat Berat</p>
                </a>

                <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                    <i class="fas fa-shopping-cart"></i>
                    <p>penyewaan</p>
                </a>
                <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                    <i class="fas fa-wallet"></i>
                    <p>pembayaran</p>
                </a>
               
              <!-- Add other sidebar items here -->
          </ul>
      </div>
  </div>
</div>