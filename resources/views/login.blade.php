<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />

  <!-- Favicons -->
  <link href="{{ asset('login/assets/img/profile/Logo.jpg') }}" rel="icon" class="rounded-circle">
  <link href="{{ asset('login/assets/img/profile/Logo.jpg') }}" rel="apple-touch-icon" class="rounded-circle">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('model/css/login.css') }}">
  <link rel="stylesheet" href="{{ asset('model/vendor/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  <title>Login Sistem</title>
</head>
<body>
<section class="vh-100" style="background-image:url('{{ asset('landing/img/cta-bg.jpg') }}')">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-5">
        <div class="card text-black" style="border-radius: 1rem;">
          <div class="card-body p-4 p-lg-5 text-black">
            
            <!-- Logo -->
            <div class="text-center mb-4">
              <img src="{{ asset('landing/img/LogoIDKY.png') }}" alt="Logo" class="img-fluid mb-3" style="width: 150px;">
              <h4 class="name">Alat Berat</h4>
            </div>

            <!-- Menampilkan alert jika ada kesalahan -->
            @if(session('wrong'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i>
                {{ session('wrong') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="far fa-user"></i></span>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                </div>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-key"></i></span>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                </div>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-dark btn-lg mt-3">Login</button>
              </div>
            </form>

            <div class="text-center mt-3">
              <small>Belum punya akun? <a href="{{ route('register') }}">Register</a></small>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="{{ asset('model/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
