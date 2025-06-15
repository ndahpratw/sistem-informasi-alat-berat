@extends('layouts.main')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md -row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
            </div>
          
        </div>
        <div class="row">
            <div class="col-sm-4 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category"><b>Pelanggan</b></p>
                                    <h4 class="card-title">{{ $customer }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-money-bill"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category"><b>Pemasukan</b> {{ \Carbon\Carbon::create()->month($informasi->month)->translatedFormat('F') }} {{ $informasi->year }} </p>
                                    <h4 class="card-title">Rp. {{ number_format($pemasukan, 2, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="fas fa-money-bill"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category"><b>Denda</b> {{ \Carbon\Carbon::create()->month($informasi->month)->translatedFormat('F') }} {{ $informasi->year }}</p>
                                    <h4 class="card-title">Rp. {{ number_format($denda, 2, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-primary">
                    <div class="card-head-row">
                        <div class="card-title">Pemasukan</div>
                        <div class="card-tools">
                            <div class="dropdown">
                                <form method="GET">
                                    <select name="tahun" onchange="this.form.submit()" class="form-select">
                                        @for ($y = 2020; $y <= now()->year; $y++)
                                            <option value="{{ $y }}" {{ request('tahun', now()->year) == $y ? 'selected' : '' }}>
                                                {{ $y }}
                                            </option>
                                        @endfor
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center my-3">
                            <table style="width: 100%">
                                <tr>
                                    <td> <b>Total Pemasukan</b> </td>
                                    <td> : </td>
                                    <td> Rp. {{ number_format($totalPemasukan, 2, ',', '.') }} </td>
                                </tr>
                                <tr>
                                    <td> <b>Total Denda</b> </td>
                                    <td> : </td>
                                    <td> Rp. {{ number_format($totalDenda, 2, ',', '.') }} </td>
                                </tr>
                            </table>
                        </div>
                    <div class="chart-container">
                        <canvas id="statisticsChart"></canvas>
                    </div>
                    <div id="myChartLegend"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-primary">
                        <h4 class="card-title">Jumlah Peminjaman Alat {{ $informasi->year }}</h4>
                    </div>
                    <div class="card-body">
                        <div style="height: 375px; position: relative;">
                            <canvas id="peminjamanAlatBarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    
    {{-- chart pemasukan --}}
    <script>
        const ctx = document.getElementById('statisticsChart').getContext('2d');

        const formatRupiah = (angka) => {
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        };

        const statisticsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: {!! json_encode($totals) !!},
                        fill: false,
                        borderColor: 'rgba(75, 192, 192, 1)', // Biru
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                    },
                    {
                        label: 'Denda',
                        data: {!! json_encode($dendaTotals) !!},
                        fill: false,
                        borderColor: 'rgba(255, 99, 132, 1)', // Merah
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + formatRupiah(context.raw);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return formatRupiah(value);
                            }
                        }
                    }
                }
            }
        });
    </script>

    {{-- chart penyewaan --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctxBar = document.getElementById('peminjamanAlatBarChart').getContext('2d');

            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($alatLabels) !!},
                    datasets: [{
                        label: 'Jumlah Peminjaman',
                        data: {!! json_encode($jumlahPeminjaman) !!},
                        backgroundColor: '#36A2EB'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // ← penting biar gak mengecil
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            },
                            title: {
                                display: true,
                                text: 'Jumlah Peminjaman'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Nama Alat'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.raw + ' peminjaman';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>


@endsection