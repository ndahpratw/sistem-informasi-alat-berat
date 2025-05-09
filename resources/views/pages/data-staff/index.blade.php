@extends('layouts.main')

@section('content')
    <div class="pagetitle">
    
    </div><!-- End Page Title -->

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
            <div class="page-inner">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md -row pt-2 pb-4">
                    <div>
                        <h3 class="fw-bold mb-3">Data Staff</h3>
                    </div>
                  
                </div>

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <div class="d-flex align-items-center justify-content-between m-3">
                            <h5 class="card-title">Total : {{ $karyawan }} Pelanggan | {{ $admin }} Admin</h5>
                            <a href="{{ route('data-staff.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus fa-sm text-white-50"></i> Data Baru
                            </a>
                        </div>
                         <!-- Add more cards as needed -->
                  <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>No Telpon</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Profile</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $data)
                            <tr>
                                <th>{{ $no++ }}</th>
                                <th>{{ $data->name }}</th>
                                <th>{{ $data->no_telepon }}</th>
                                <th>{{ $data->email }}</th>
                                <th>{{ $data->role }}</th>
                                <th>
                                    @if($data->profile)
                                        <img src="{{ asset('assets/img/profile/' . $data->profile) }}" alt="profile" width="50">
                                    @else
                                        Tidak Ada Profile
                                    @endif
                                </th>
                                <th>
                                    <a href="{{ route('data-staff.edit', $data->id) }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $data->id }}">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </th>
                            </tr>
                             <!-- Modal Hapus data staff-->
                             <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $data->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $data->id }}">Hapus Data Staff</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus Staff <strong>{{ $data->name }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('data-staff.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Hapus Perusahaan -->
                            @endforeach
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection


