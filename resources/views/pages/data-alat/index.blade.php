@extends('layouts.main')

@section('content')
     <div class="page-inner">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md -row pt-2 pb-4">
                    <div>
                        <h3 class="fw-bold mb-3">Data Alat Berat</h3>
                    </div>
                  
                </div>

    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>

           

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <div class="d-flex align-items-center justify-content-between m-3">
                            <h5 class="card-title">Total:  Karyawan</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                                <i class="fas fa-plus fa-sm text-white-50"></i> Data Baru
                            </button>
                        </div>

                        <div class="table-responsive">
                           <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Alat</th>
                                    <th>Tipe</th>
                                    <th>Stock</th>
                                    <th>Harga Sewa</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                                 <tbody>
                                    @foreach ($data as $index => $alat)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $alat->nama_alat }}</td>
                                        <td>{{ $alat->tipe }}</td>
                                        <td>{{ $alat->stok }}</td>
                                        <td>Rp {{ number_format($alat->harga_sewa, 2, ',', '.') }}</td>
                                        <td>{{ $alat->deskripsi }}</td>
                                        <th>
                                            @if($alat->gambar)
                                                <img src="{{ asset('assets/img/gambar/' . $alat ->gambar) }}" alt="gambar" width="50">
                                            @else
                                                Tidak Ada gambar
                                            @endif
                                        </th>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal-{{ $alat->id }}">
                                                <i class="fas fa-pen"></i>
                                            </button>

                                            <!-- Tombol Hapus -->
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $alat->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal-{{ $alat->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $alat->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('data-alat.update', $alat->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Alat</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form isi mirip create -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Alat</label>
                                                            <input type="text" name="nama_alat" class="form-control" value="{{ $alat->nama_alat }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Tipe</label>
                                                            <input type="text" name="tipe" class="form-control" value="{{ $alat->tipe }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Stok</label>
                                                            <input type="number" name="stok" class="form-control" value="{{ $alat->stok }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Harga Sewa</label>
                                                            <input type="number" step="0.01" name="harga_sewa" class="form-control" value="{{ $alat->harga_sewa }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Deskripsi</label>
                                                            <textarea name="deskripsi" class="form-control" required>{{ $alat->deskripsi }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Gambar (opsional)</label>
                                                            <input type="file" name="gambar" class="form-control">
                                                            @if ($alat->gambar)
                                                                <img src="{{ asset('storage/' . $alat->gambar) }}" alt="Gambar" width="60" class="mt-2">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="deleteModal-{{ $alat->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $alat->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('data-alat.destroy', $alat->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus Alat</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Yakin ingin menghapus alat <strong>{{ $alat->nama_alat }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach
                                    </tbody>

                            </table>
                            <div class="mt-3">
                                {{ $data->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Alat -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('data-alat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Tambah Data Alat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama_alat" class="form-label">Nama Alat</label>
                                <input type="text" name="nama_alat" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="tipe" class="form-label">Tipe</label>
                                <input type="text" name="tipe" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="stok" class="form-label">Stok</label>
                                <input type="number" name="stok" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="harga_sewa" class="form-label">Harga Sewa</label>
                                <input type="number" step="0.01" name="harga_sewa" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" name="gambar" class="form-control" accept="image/*">
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal Tambah Alat -->

    </section>
@endsection


@section('scripts')

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

  <!-- Bootstrap Notify -->
  <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

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
  

@endsection