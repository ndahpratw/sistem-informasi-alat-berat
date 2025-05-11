@extends('layouts.main')

@section('content')

    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md -row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Riwayat Penyewaan</h3>
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

                            @if (count($riwayat_penyewaan))            
                                <div class="row">
                                    @foreach ($riwayat_penyewaan as $item)
                                        <div class="col-md-6 my-3">
                                            <div class="card">
                                                <div class="card-body my-4">
                                                <div class="d-flex justify-content-between align-item-center">
                                                    <p style="color: #254336">{{ $item->alat->nama_alat}}</p>
                                                    @if ($item->status_penyewaan == 'dibatalkan')
                                                        <p class="text-danger">{{ $item->status_penyewaan }}</p>
                                                    @elseif($item->status_penyewaan == 'menunggu pembayaran')
                                                        <p class="text-secondary">menunggu pembayaran</p>
                                                    @elseif ($item->status_penyewaan == 'selesai')
                                                        <p class="text-success">{{ $item->status_penyewaan }}</p>
                                                    @elseif ($item->status_penyewaan == 'diproses')
                                                        <p class="text-warning">{{ $item->status_penyewaan }}</p>
                                                    @elseif ($item->status_penyewaan == 'disetujui')
                                                        <p class="text-primary">{{ $item->status_penyewaan }}</p>
                                                    @endif
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                    <img src="{{ asset('assets/img/gambar/'.$item->alat->gambar) }}" alt="{{ $item->gambar }}" class="img-fluid">
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="d-flex justify-content-between">
                                                            <b>
                                                            {{ $item->alat->nama_alat }}
                                                            </b>
                                                            
                                                            x {{ $item->jumlah_peminjaman }}
                                                        </div>
                                                        <p class="d-flex justify-content-end"> 
                                                            Rp. {{ number_format($item->alat->harga_sewa, 0, ',', '.') }}
                                                            <hr>
                                                            <div class="d-flex justify-content-between">
                                                            <p> Total Pesanan : </p>
                                                            <p> Rp {{ number_format($item->total_biaya, 0, ',', '.') }} </p>
                                                            </div>
                                                        </p>
                                                    </div>
                                                    <p class="text-center"><b>Tanggal Penyewaan</b> : {{ \Carbon\Carbon::parse($item->tanggal_sewa)->translatedFormat('d F Y') }} sampai {{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('d F Y') }}</p>
                                                <hr>
                                                </div>
                                                @if ($item->status_penyewaan == 'dibatalkan')
                                                    <p class="text-danger text-center">penyewaan alat berat dibatalkan</p> 
                                                @else
                                                    @if ($item->status_penyewaan === 'menunggu pembayaran' )
                                                    <div class="d-flex justify-content-between">
                                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#payment-cancel<?php echo $item->id?>"> Batalkan Pesanan </button>
                                                        <div class="modal fade" id="payment-cancel<?php echo $item->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Konfirmasi Batal Pemesanan</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Apakah anda yakin untuk membatalkan pesanan yang telah anda buat?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Batal</button>
                                                                        <a href="/batalkan-sewa-alat/{{ $item->id }}" class="btn btn-success text-white shadow-none">Yakin</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if ($item->bukti_pembayaran == null)
                                                            <a class="btn btn-danger" href="/pembayaran/{{ $item->id }}">Bayar Sekarang</a>
                                                        @endif
                                                        </div>
                                                    @endif
                                                    @if ($item->status_pesanan === 'dikirim' )
                                                        <div class="d-flex justify-content-center">
                                                        <a class="btn btn-success my-3" href="/pesanan-terima/{{ $item->id }}">Terima</a>
                                                        </div>
                                                    @endif
                                                    {{-- @if ($item->status_pesanan === 'selesai' )
                                                        @if ($item->ratingProduk === null)        
                                                        <div class="d-flex justify-content-center">
                                                            <a style="background-color: #254336; padding:5px 50px; border-radius: 5px" href="/rating/{{ $item->id }}">Rating</a>
                                                        </div>
                                                        @endif
                                                    @endif --}}
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="d-flex justify-content-center align-items-center" style="min-height: 50vh">
                                <div>
                                    <p class="text-center text-danger"> <b><i>Belum ada riwayat penyewaan</i></b> </p>
                                </div>
                                </div> 
                            @endif

                        </div>
                    </div>
                </div>
            </div>


        </section>

    </div>
@endsection