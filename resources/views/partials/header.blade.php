<div class="main-header">
 
  <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
      <div class="container-fluid">
          <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
              <div class="input-group">
                 
                
              </div>
          </nav>
          <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
              <li class="nav-item topbar-icon dropdown hidden-caret">
                 
                  <ul class="dropdown-menu notif-box animated fadeIn">
                      <li>
                          <div class="dropdown-title">You have 4 new notifications</div>
                      </li>
                      <li>
                          <div class="notif-scroll scrollbar-outer">
                              <div class="notif-center">
                                  <a href="#">
                                      <div class="notif-icon notif-primary">
                                          <i class="fa fa-user-plus"></i>
                                      </div>
                                      <div class="notif-content">
                                          <span class="block"> New user registered </span>
                                          <span class="time">5 minutes ago</span>
                                      </div>
                                  </a>
                                  <!-- Add more notifications here -->
                              </div>
                          </div>
                      </li>
                      
                  </ul>
              </li>
              <li class="nav-item topbar-user dropdown hidden-caret">
                  <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                      <div class="avatar-sm">
                          <img src="{{ auth()->user()->profile ? asset('assets/img/profile/' . auth()->user()->profile) : asset('default-profile.png') }}" alt="..." class="avatar-img rounded-circle" />
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
                                <img src="{{ auth()->user()->profile ? asset('assets/img/profile/' . auth()->user()->profile) : asset('default-profile.png') }}" alt="image profile" class="avatar-img rounded" />
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
                    <li><a class="dropdown-item" href="./logout">Logout</a></li>
                </ul>
              </li>
          </ul>
      </div>
  </nav>
</div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

  <!-- Chart JS -->
  <script src="assets/js/plugin/chart.js/chart.min.js"></script>

  <!-- jQuery Sparkline -->
  <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

  <!-- Chart Circle -->
  <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

  <!-- Datatables -->
  <script src="assets/js/plugin/datatables/datatables.min.js"></script>


  <!-- jQuery Vector Maps -->
  <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
  <script src="assets/js/plugin/jsvectormap/world.js"></script>

  <!-- Sweet Alert -->
  <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

  <!-- Kaiadmin JS -->
  <script src="assets/js/kaiadmin.min.js"></script>

  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  <script src="assets/js/setting-demo.js"></script>
  <script src="assets/js/demo.js"></script>
