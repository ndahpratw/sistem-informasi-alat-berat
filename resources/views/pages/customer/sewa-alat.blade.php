<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Penyewaan Alat Berat</title>
  <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    
    <main id="main" class="pb-5">
        <section id="product" class="pricing" style="margin-top: 75px; min-height: 100vh;">
            <h1 class="text-center">Penyewaan Alat Berat</h1>
            <div class="container" data-aos="fade-up">

                <div class="row gy-4 align-items-center justify-content-center">
        
                  <div class="col-lg-8" data-aos="zoom-in" data-aos-delay="600">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="pricing-item">
                
                                        <div class="img">
                                            <img src="{{ asset('assets/img/gambar/' . $alat_berat->gambar) }}" alt="{{ $alat_berat->gambar }}" class="img-fluid">
                                        </div>
                                        <div class="mx-3">
                                            <div class="text-center">
                                                <h3>{{ $alat_berat->nama_alat }}</h3>
                                                <i>" {{ $alat_berat->deskripsi }} "</i>
                                            </div>
                                            <hr>
                                            <table>
                                                <tr>
                                                    <th> Harga Sewa </th>
                                                    <td style="width: 75px; text-align:center"> : </td>
                                                    <td> Rp. {{ number_format($alat_berat->harga_sewa, 0, ',', '.') }} </td>
                                                </tr>
                                                <tr>
                                                    <th> Tersedia </th>
                                                    <td style="width: 75px; text-align:center"> : </td>
                                                    <td> {{ $alat_berat->stok }} alat berat</td>
                                                </tr>

                                                <tr>
                                                    <th> Tipe </th>
                                                    <td style="width: 75px; text-align:center"> : </td>
                                                    <td> {{ $alat_berat->tipe }} </td>
                                                </tr>
                                            </table>

                                            <hr>

                                            <p class="text-justify"> <b class="text-danger">Note :</b> <br> Waktu peminjaman per satu minggu, Jika melewati tanggal kembali alat yang telah ditentukan maka denda akan diberlakukan ! </p>

                                            <div class="d-flex justify-content-center align-items-center">
                                                <button style="margin: 25px 0px" type="button" class="btn btn-outline-secondary shadow-none" data-bs-toggle="modal" data-bs-target="#cancel-payment"> Kembali </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="pricing-item">
                
                                        <div class="mx-3">
                                            
                                            <h5 class="text-center m-3"> <b> Pembayaran Produk </b> </h5>
                    
                                            <div class="card">
                                                <div class="card-body">
                                                    <form action="/sewa-alat" method="post" name="autoSumForm">
                                                        @csrf

                                                        <input type="hidden" name="alat" class="form-control shadow-none" value="{{ $alat_berat->id }}">

                                                        <div class="row">
                                                            <div class="col-md-12 mb-3">
                                                                <label for="harga" class="form-label fw-bold">Harga Sewa</label>
                                                                {{-- <input type="number" name="harga" id="harga" class="form-control shadow-none" value="{{ number_format($alat_berat->harga_sewa, 0, ',', '.') }}" disabled> --}}
                                                                <input type="number" name="harga" id="harga" class="form-control shadow-none" value="{{ $alat_berat->harga_sewa }}" disabled>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="jumlah" class="form-label fw-bold">Jumlah</label>
                                                                <input type="number" name="jumlah" min="0" max="{{ $alat_berat->stok }}" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror shadow-none" value="{{ old('jumlah') }}" placeholder="tersedia {{ $alat_berat->stok }} item">
                                                                @error('jumlah') 
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div> 
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label fw-bold">Total</label>
                                                                <input type="number" name="total" id="total" class="form-control @error('total') is-invalid @enderror shadow-none" readonly value="{{ old('total') }}">
                                                                @error('total') 
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div> 
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label fw-bold">Tanggal Sewa</label>
                                                                <input type="date" name="tanggal_sewa" id="tanggal_sewa" class="form-control @error('tanggal_sewa') is-invalid @enderror shadow-none" value="{{ old('tanggal_sewa') }}">
                                                                @error('tanggal_sewa') 
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div> 
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label fw-bold">Tanggal Kembali</label>
                                                                <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control @error('tanggal_kembali') is-invalid @enderror shadow-none" readonly value="{{ old('tanggal_kembali') }}">
                                                                @error('tanggal_kembali') 
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div> 
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-12 mb-3">
                                                                <label for="metode_pembayaran" class="form-label fw-bold">Metode Pembayaran</label>
                                                                <select class="form-select @error('metode_pembayaran') is-invalid @enderror" aria-label="Default select example" name="metode_pembayaran">
                                                                    <option selected disabled>Pilih Metode Pembayaran</option>
                                                                    <option value="BNI" {{ old('metode_pembayaran') == 'BNI' ? 'selected' : '' }}>BNI</option>
                                                                    <option value="BCA" {{ old('metode_pembayaran') == 'BCA' ? 'selected' : '' }}>BCA</option>
                                                                </select>
                                                                @error('metode_pembayaran') 
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div> 
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-12 d-flex justify-content-between">
                                                                <button type="button" class="btn btn-outline-secondary shadow-none" data-bs-toggle="modal" data-bs-target="#cancel-payment"> Cancel </button>
                                                                <button type="submit" class="btn btn-outline-success shadow-none">Buat Pesanan</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                
                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div><!-- End Pricing Item -->
        
                </div>
        
              </div>
        </section>


        {{-- modal cancel --}}
        <div class="modal fade" id="cancel-payment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Batal Penyewaan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin untuk keluar dari halaman penyewaan? Data yang mungkin telah diinputkan akan hilang !
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Batal</button>
                        <a href="/" class="btn btn-success text-white shadow-none">Yakin</a>
                    </div>
                </div>
            </div>
        </div>

    </main>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-auto">
    <small>© 2025 SewaAlatBerat.id - Semua Hak Dilindungi</small>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hargaInput = document.getElementById('harga');
            const jumlahInput = document.getElementById('jumlah');
            const totalInput = document.getElementById('total');

            function calculateTotal() {
                const harga = parseFloat(hargaInput.value) || 0;
                const jumlah = parseInt(jumlahInput.value) || 0;
                const total = harga * jumlah;
                totalInput.value = total;
            }

            jumlahInput.addEventListener('input', calculateTotal);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tanggalSewa = document.getElementById('tanggal_sewa');
            const tanggalKembali = document.getElementById('tanggal_kembali');

            tanggalSewa.addEventListener('change', function() {
            const sewaDate = new Date(this.value);
            if (!isNaN(sewaDate)) {
                const kembaliDate = new Date(sewaDate);
                kembaliDate.setDate(sewaDate.getDate() + 1); // Tambah 1 hari

                // Format YYYY-MM-DD
                const year = kembaliDate.getFullYear();
                const month = String(kembaliDate.getMonth() + 1).padStart(2, '0');
                const day = String(kembaliDate.getDate()).padStart(2, '0');

                tanggalKembali.value = `${year}-${month}-${day}`;
            } else {
                tanggalKembali.value = '';
            }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tanggalSewa = document.getElementById('tanggal_sewa');
            const today = new Date().toISOString().split('T')[0];
            tanggalSewa.setAttribute('min', today);

            tanggalSewa.addEventListener('change', function() {
            if (this.value < today) {
                alert("Tanggal sewa tidak boleh kurang dari hari ini.");
                this.value = today;
            }
            });
        });
    </script>

</body>
</html>