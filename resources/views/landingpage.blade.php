<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome to Sistem Informasi Penyewaan Alat Berat</title>
  <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-warning">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">SewaAlatBerat.id</a>
      @guest          
        <div class="d-flex">
          <a href="{{ route('login') }}" class="btn btn-outline-dark me-2">Login</a>
          <a href="/register" class="btn btn-dark">Registrasi</a>
        </div>
      @endguest
      @auth
        <a class="btn btn-warning border border-black" href="/profile">Selamat Datang {{ auth()->user()->name }}</a>
      @endauth
    </div>
  </nav>

  <!-- Content Wrapper -->
  <div class="container pt-5">
    <!-- Hero Section -->
    <section class="bg-light text-center pt-5 pb-3">
      <h1 class="display-5 fw-bold">Sewa Alat Berat Terbaik & Terpercaya</h1>
      <p class="lead text-muted mb-4">Temukan excavator, bulldozer, crane, dan alat berat lainnya untuk semua kebutuhan proyek Anda.</p>
    </section>
  </div>

  <div class="container pb-5 pt-3">
    <div class="row">

      @foreach ($alat_berat as $item)          
        <div class="col-lg-4 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="img">
                <img src="{{ asset('assets/img/gambar/' . $item ->gambar) }}" alt="{{ $item->gambar }}" class="img-fluid" style="min-height: 375px;">
              </div>
              <div class="text-center">
                <h3>{{ $item->nama_alat }}</h3>
                <i> "{{ $item->deskripsi }}" </i>
              </div>
              <hr>
              <div class="d-flex justify-content-between align-items-center" >
                <p>Tipe : {{ $item->tipe }}</p> 
                <p>Stok : {{ $item->stok }} Alat</p>
              </div>
              <div class="d-flex justify-content-between align-items-center" >
                <b><p>Rp. {{ number_format($item->harga_sewa, 0, ',', '.') }}</p></b>
                <a class="btn btn-warning" href="/sewa-alat/{{ $item->id }}"> sewa sekarang </a>
              </div>
            </div>
          </div>
        </div>
      @endforeach

    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-auto">
    <small>© 2025 SewaAlatBerat.id - Semua Hak Dilindungi</small>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
