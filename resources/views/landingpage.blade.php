<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Landing Page Alat Berat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-warning">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">SewaAlatBerat.id</a>
      <div class="d-flex">
        <a href="{{ route('login') }}" class="btn btn-outline-dark me-2">Login</a>
        <a href="/register" class="btn btn-dark">Registrasi</a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="bg-light text-center py-5">
    <div class="container">
      <h1 class="display-5 fw-bold">Sewa Alat Berat Terbaik & Terpercaya</h1>
      <p class="lead text-muted mb-4">Temukan excavator, bulldozer, crane, dan alat berat lainnya untuk semua kebutuhan proyek Anda.</p>
      <a href="/register" class="btn btn-warning btn-lg me-2">Mulai Daftar</a>
      <a href="/login" class="btn btn-outline-secondary btn-lg">Sudah Punya Akun?</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3">
    <small>© 2025 SewaAlatBerat.id - Semua Hak Dilindungi</small>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
