@extends('layouts.main')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md -row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Data Pengembalian</h3>
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

                            <div class="table-responsive">
                                <table class="table table-bordered" id="basic-datatables">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No.</th>
                                            <th>Penyewa</th>
                                            <th>Alat</th>
                                            <th>Jumlah</th>
                                            <th>Biaya</th>
                                            <th>Tanggal Kembali</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_pengembalian as $index => $item)
                                            <tr>
                                                <td> {{ $index + 1 }} </td>
                                                <td> {{ $item->pelanggan->name }} </td>
                                                <td> {{ $item->alat->nama_alat }} </td>
                                                <td> {{ $item->jumlah_peminjaman }} </td>
                                                <td> Rp. {{ number_format($item->total_biaya, 0, ',', '.') }} </td>
                                                <td> {{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('d F Y') }} </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#tolak-{{ $item->id }}">
                                                        <i class="fas fa-check"></i> selesai
                                                    </button>
                                                    <div class="modal fade" id="tolak-{{ $item->id }}" tabindex="-1" aria-labelledby="tolakLabel-{{ $item->id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="{{ route('data-pengembalian.store') }}" method="POST">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Konfirmasi Pengembalian</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="id_penyewaan" value="{{ $item->id }}">
                                                                        <div class="row">
                                                                            <div class="col-6 mb-3">
                                                                                <label class="form-label">Tanggal Pengembalian</label>
                                                                                <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control @error('tanggal_kembali') is-invalid @enderror shadow-none" value="{{ $item->tanggal_kembali }}" disabled>
                                                                                @error('tanggal_kembali') 
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div> 
                                                                                @enderror
                                                                            </div>
                                                                            <div class="col-6 mb-3">
                                                                                <label class="form-label">Tanggal Dikembalikan</label>
                                                                                <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" class="form-control @error('tanggal_pengembalian') is-invalid @enderror shadow-none" value="{{ old('tanggal_pengembalian', now()->toDateString()) }}" min="{{ now()->toDateString() }}">
                                                                                @error('tanggal_pengembalian') 
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div> 
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Total Denda (Rp. 10.000/hari)</label>
                                                                            <input type="number" name="denda" id="denda" class="form-control @error('jumlah_pengembalian') is-invalid @enderror shadow-none" value="0" readonly>
                                                                            @error('denda') 
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div> 
                                                                            @enderror
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="mb-3 col-6">
                                                                                <label class="form-label">Jumlah Alat Yang Dipinjam</label>
                                                                                <input type="number" name="jumlah_peminjaman" class="form-control @error('jumlah_peminjaman') is-invalid @enderror shadow-none" value="{{ $item->jumlah_peminjaman }}" disabled>
                                                                                @error('jumlah_peminjaman') 
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div> 
                                                                                @enderror
                                                                            </div>
                                                                            <div class="mb-3 col-6">
                                                                                <label class="form-label">Jumlah Alat Yang Dikembalikan</label>
                                                                                <input type="number" name="jumlah_pengembalian" class="form-control @error('jumlah_pengembalian') is-invalid @enderror shadow-none" value="{{ old('jumlah_pengembalian', $item->jumlah_peminjaman) }}" max="{{ $item->jumlah_peminjaman }}" min="0">
                                                                                @error('jumlah_pengembalian') 
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}
                                                                                    </div> 
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Kondisi Alat</label>
                                                                            <textarea name="kondisi_alat" rows="2" class="form-control @error('kondisi_alat') is-invalid @enderror shadow-none"> {{ old('kondisi_alat') }}</textarea>
                                                                            @error('kondisi_alat') 
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div> 
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-danger">Yakin</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const tanggalPengembalian = document.getElementById('tanggal_pengembalian');
        const dendaInput = document.getElementById('denda');
        const tanggalKembali = document.getElementById('tanggal_kembali').value;
        const dendaPerHari = 10000;

        tanggalPengembalian.addEventListener('change', function () {
            const pengembalianDate = new Date(tanggalPengembalian.value);
            const kembaliDate = new Date(tanggalKembali);

            // Jika tanggal pengembalian sebelum tanggal kembali, denda = 0
            if (pengembalianDate <= kembaliDate) {
                dendaInput.value = 0;
                return;
            }

            // Hitung selisih hari
            const diffTime = pengembalianDate - kembaliDate;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            // Hitung denda
            const denda = diffDays * dendaPerHari;
            dendaInput.value = denda;
        });
    });
    </script>

@endsection

