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
                                <table class="table table-bordered" id="basic-datatables">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No.</th>
                                            <th>Penyewa</th>
                                            <th>Alat</th>
                                            <th>Jumlah</th>
                                            <th>Biaya</th>
                                            <th>Tanggal Sewa</th>
                                            <th>Status Penyewaan</th>
                                            <th></th>
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
                                                <td class="text-center"> {{ \Carbon\Carbon::parse($item->tanggal_sewa)->translatedFormat('d F Y') }} <br> - <br> {{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('d F Y') }} </td>
                                                <td class="text-center"> 
                                                    @if ($item->status_penyewaan == 'menunggu pembayaran')
                                                        <p class="text-secondary">menunggu pembayaran</p>
                                                    @elseif ($item->status_penyewaan == 'diproses')
                                                        <!-- Tombol setuju -->
                                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#setujui-{{ $item->id }}">
                                                            setujui
                                                        </button>
                                                        <div class="modal fade" id="setujui-{{ $item->id }}" tabindex="-1" aria-labelledby="setujuiLabel-{{ $item->id }}" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form action="/update-status/{{ $item->id }}" method="POST">
                                                                        @csrf
                                                                        @method('put')
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Konfirmasi Peminjaman</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Apakah anda yakin <b>menyetujui</b> peminjaman alat {{ $item->alat->nama_alat }}?
                                                                            <input type="hidden" name="status_penyewaan" value="disetujui">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-danger">Yakin</button>
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Tombol tolak -->
                                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#tolak-{{ $item->id }}">
                                                            tolak
                                                        </button>
                                                        <div class="modal fade" id="tolak-{{ $item->id }}" tabindex="-1" aria-labelledby="tolakLabel-{{ $item->id }}" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form action="/update-status/{{ $item->id }}" method="POST">
                                                                        @csrf
                                                                        @method('put')
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Konfirmasi Penolakan</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Apakah anda yakin <b>menolak</b> peminjaman alat {{ $item->alat->nama_alat }}?
                                                                            <input type="hidden" name="status_penyewaan" value="ditolak">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-danger">Yakin</button>
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                    @elseif ($item->status_penyewaan == 'disetujui')
                                                        <p class="text-primary">disetujui</p>
                                                    @elseif ($item->status_penyewaan == 'ditolak')
                                                        <p class="text-danger">ditolak admin ({{ $item->admin->name}}) </p>
                                                    @elseif ($item->status_penyewaan == 'dibatalkan')
                                                        <p class="text-danger">dibatalkan pelanggan</p>
                                                    @elseif ($item->status_penyewaan == 'selesai')
                                                        <p class="text-success">selesai</p>
                                                        @if ($item->pengembalian)
                                                            <button type="button" class="btn btn-success btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#catatan{{ $item->id }}"><i class="fas fa-file"></i></button>
                                                            <div class="modal fade" id="catatan{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Catatan</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <table style="width: 100%">
                                                                                <tr>
                                                                                    <td> Tanggal pengembalian </td>
                                                                                    <td> : </td>
                                                                                    <td> {{ \Carbon\Carbon::parse($item->pengembalian->tanggal_dikembalikan)->translatedFormat('d F Y') }} </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td> Kondisi </td>
                                                                                    <td> : </td>
                                                                                    <td> {{ $item->pengembalian->kondisi_alat }} </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td> Denda </td>
                                                                                    <td> : </td>
                                                                                    <td>
                                                                                        @if ($item->pengembalian->denda)
                                                                                            Rp. {{ number_format($item->pengembalian->denda->jumlah_denda, 0, ',', '.') }}
                                                                                        @else
                                                                                        -
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif                                                
                                                </td>
                                                <td class="text-center">
                                                    @if($item->bukti_pembayaran != null)
                                                    <button type="button" class="btn btn-primary btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#tampil<?php echo $item->id?>"><i class="fas fa-camera"></i></button>
                                                    <div class="modal fade" id="tampil<?php echo $item->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Bukti Pembayaran</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                <img src="{{ asset('assets/img/bukti-pembayaran/'.$item->bukti_pembayaran) }}" alt="{{ $item->bukti_pembayaran }}" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @else
                                                        Bukti pembayaran belum diunggah
                                                    @endif
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
@endsection

