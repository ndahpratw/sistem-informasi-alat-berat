@extends('layouts.main')

@section('content')
     <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md -row pt-2 pb-2">
            <div>
                <h3 class="fw-bold mb-3">Pembayaran</h3>
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
                                                <div class="row">
                            <div class="col-md-6 my-3">
                                <div class="card">
                                <div class="card-body my-4">
                                    <div class="d-flex justify-content-between align-item-center">
                                    <p style="color: #254336">{{ $data_penyewaan->alat->nama_alat }}</p>
                                    <p style="color: red">{{ $data_penyewaan->status_penyewaan }}</p>
                                    </div>

                                    <div class="row">
                                    <div class="col-md-3">
                                        <img src="{{ asset('assets/img/gambar/'.$data_penyewaan->alat->gambar) }}" alt="{{ $data_penyewaan->alat->gambar }}" class="img-fluid">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="d-flex justify-content-between">
                                        <b>
                                            {{ $data_penyewaan->alat->nama_alat}}
                                        </b>
                                        
                                            x {{ $data_penyewaan->jumlah_peminjaman }}
                                        </div>
                                        <p class="d-flex justify-content-end"> 
                                        Rp. {{ number_format($data_penyewaan->alat->harga_sewa, 0, ',', '.') }} 
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <p> Total Pesanan : </p>
                                            <p> Rp. {{ number_format($data_penyewaan->total_biaya, 0, ',', '.') }}  </p>
                                        </div>
                                        </p>
                                    </div>
                                    <hr>
                                        <table style="width: 100%;" class="mx-4">
                                            <tr>
                                                <td> Tanggal peminjaman </td>
                                                <td> {{ \Carbon\Carbon::parse($data_penyewaan->tanggal_sewa)->translatedFormat('d F Y') }} </td>
                                            </tr>
                                            <tr>
                                                <td> Tanggal kembali </td>
                                                <td> {{ \Carbon\Carbon::parse($data_penyewaan->tanggal_kembali)->translatedFormat('d F Y') }} </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6 my-3">
                                <div class="card">
                                <div class="card-body my-4">
                                    <div class="d-flex justify-content-between">
                                    <p> Metode Pembayaran : </p>
                                    <p> {{ $data_penyewaan->metode_pembayaran }} </p>
                                    </div>
                                    <p> No. Rekening : </p>
                                    <div class="d-flex justify-content-center align-items-center" style="min-height: 18vh">
                                        @if ($data_penyewaan->metode_pembayaran == 'BNI')
                                        <h1 style="color: red"> 162 {{ auth()->user()->phone_number }} </h1>
                                        @else
                                        <h1 style="color: red"> 126 {{ auth()->user()->phone_number }} </h1>
                                        @endif
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#upload-payment<?php echo $data_penyewaan->id?>"> Bayar Sekarang </button>
                            <div class="modal fade" id="upload-payment<?php echo $data_penyewaan->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="/upload-bukti-pembayaran/{{ $data_penyewaan->id }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Upload Bukti Pembayaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                    <div style="margin-top: 5px">
                                        <input type="file" name="bukti_pembayaran" class="form-control @error('bukti_pembayaran') is-invalid @enderror shadow-none" id="bukti_pembayaran" value="{{ old('bukti_pembayaran') }}" accept="image/*">
                                        @error('bukti_pembayaran') 
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div> 
                                        @enderror
                                    </div>            
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Kembali</button>
                                    <button type="submit" class="btn btn-success text-white shadow-none">Kirim</button>
                                </div>
                                </div>
                            </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

     </div>
@endsection
