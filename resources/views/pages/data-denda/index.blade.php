@extends('layouts.main')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md -row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Data Denda Pegembalian Terlamat</h3>
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
                                <table class="table table-bordered text-center" id="basic-datatables">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Penyewa</th>
                                            <th>Alat</th>
                                            <th>Tanggal Sewa</th>
                                            <th>Tanggal Dikembalikan</th>
                                            <th>Jumlah Denda</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($denda as $index => $item)
                                        <tr>
                                            <td> {{ $index + 1 }} </td>
                                            <td> {{ $item->pengembalian->penyewaan->pelanggan->name }} </td>
                                            <td> {{ $item->pengembalian->penyewaan->alat->nama_alat }} </td>
                                            <td> {{ $item->pengembalian->penyewaan->tanggal_sewa }} <br> - <br> {{ $item->pengembalian->penyewaan->tanggal_kembali }}  </td>
                                            <td> {{ $item->pengembalian->tanggal_dikembalikan }} </td>
                                            <td> Rp. {{ number_format($item->jumlah_denda, 0, ',', '.') }} </td>
                                            <td> {{ $item->alasan }} </td>
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

