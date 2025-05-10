@extends('layouts.main')

@section('content')
     <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md -row pt-2 pb-2">
            <div>
                <h3 class="fw-bold mb-3">Profile Saya</h3>
            </div>
        </div>
        <section class="section profile">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center text-center">
                            @if ($data->profile != null)
                                <img id="profileImage" src="{{ asset('assets/img/profile/' . $data->profile) }}" alt="Profile" class="rounded-circle border" width="150">
                            @else
                                <img id="profileImage" src="{{ asset('assets/img/profile/profile-image.jpg') }}" alt="Profile" class="rounded-circle border" width="150">
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-6">

                <div class="card">
                    <div class="card-body pt-3">
                        <h5 class="card-title text-center">Detail Informasi</h5>

                        <table style="width: 100%">
                            <tr>
                                <td> Nama </td>
                                <td> : </td>
                                <td> {{ $data->name }} </td>
                            </tr>
                            <tr>
                                <td> Email </td>
                                <td> : </td>
                                <td> {{ $data->email }} </td>
                            </tr>
                            <tr>
                                <td> Tanggal Lahir </td>
                                <td> : </td>
                                <td> {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y') }} </td>
                            </tr>
                            <tr>
                                <td> Bergabung Sejak </td>
                                <td> : </td>
                                <td> {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }} </td>
                            </tr>
                        </table>
                    </div>
                </div>

                </div>
            </div>

        </section>
     </div>
@endsection
