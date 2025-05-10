<div class="main-header">
 
  <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
      <div class="container-fluid">
          <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
              <li class="nav-item topbar-user dropdown hidden-caret">
                  <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                      <div class="avatar-sm">
                          <img src="{{ auth()->user()->profile ? asset('assets/img/profile/' . auth()->user()->profile) : asset('profile-image.png') }}" alt="image" class="avatar-img rounded-circle" />
                      </div>
                      <span class="profile-username">
                          <span class="op-7">Hi,</span>
                          <span class="fw-bold">{{auth()->user()->name}}</span>
                      </span>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <li class="dropdown-user-scroll scrollbar-outer">
                        <div class="user-box">
                            <div class="avatar-lg">
                                <img src="{{ auth()->user()->profile ? asset('assets/img/profile/' . auth()->user()->profile) : asset('profile-image.png') }}" alt="image profile" class="avatar-img rounded" />
                            </div>
                            <div class="u-text">
                                <h4>{{auth()->user()->name}}</h4>
                                <p class="text-muted">{{auth()->user()->email}}</p>
                                {{-- <a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a> --}}
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    {{-- <li><a class="dropdown-item" href="#">My Profile</a></li> --}}
                    <li><a class="dropdown-item" href="/logout">Logout</a></li>
                </ul>
              </li>
          </ul>
      </div>
  </nav>
</div>
