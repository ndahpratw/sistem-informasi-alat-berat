@extends('layouts.main')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md -row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Data Penyewaan</h3>
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
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Penyewa</th>
                                            <th>Alat</th>
                                            <th>Jumlah</th>
                                            <th>Biaya</th>
                                            <th>Tanggal Sewa</th>
                                            <th>Status Pembayaran</th>
                                            <th>Status Penyewaan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td> {{ $no++ }} </td>
                                                <td> {{ $item->pelanggan->name }} </td>
                                                <td> {{ $item->alat->nama_alat }} </td>
                                                <td> {{ $item->jumlah_peminjaman }} </td>
                                                <td> Rp. {{ number_format($item->total_biaya, 0, ',', '.') }} </td>
                                                <td> {{ $item->tanggal_sewa }} - {{ $item->tanggal_kembali }} </td>
                                                <td> {{ $item->status_pembayaran }} </td>
                                                <td> {{ $item->status_penyewaan }} </td>
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
@endsection

