@extends('superadmin.layoutsuper.main')

@section('konten')
<div class="container py-4" style="margin-top: 2rem">
    <div class="row g-3">

        <!-- Card Anggota -->
        <div class="col-12 col-md-12 col-lg-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Grafik Anggota</h5>
                    <canvas id="anggotaChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Card Kegiatan -->
        <div class="col-12 col-md-12 col-lg-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Grafik Kegiatan</h5>
                    <canvas id="kegiatanChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Card News -->
        <div class="col-12 col-md-12 col-lg-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Grafik News</h5>
                    <canvas id="newsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Card Admin -->
        <div class="col-12 col-md-12 col-lg-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Grafik Admin</h5>
                    <canvas id="adminChart"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function buatChart(id, label, labels, data, borderColor, backgroundColor) {
        const ctx = document.getElementById(id).getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    borderColor: borderColor,
                    backgroundColor: backgroundColor,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }

    // Grafik Anggota
    buatChart(
        'anggotaChart',
        'Jumlah Anggota',
        @json($anggota->pluck('tanggal')),
        @json($anggota->pluck('total')),
        'rgba(54, 162, 235, 1)',
        'rgba(54, 162, 235, 0.5)'
    );

    // Grafik Kegiatan
    buatChart(
        'kegiatanChart',
        'Jumlah Kegiatan',
        @json($kegiatan->pluck('tanggal')),
        @json($kegiatan->pluck('total')),
        'rgba(255, 206, 86, 1)',
        'rgba(255, 206, 86, 0.5)'
    );

    // Grafik News
    buatChart(
        'newsChart',
        'Jumlah News',
        @json($news->pluck('tanggal')),
        @json($news->pluck('total')),
        'rgba(75, 192, 192, 1)',
        'rgba(75, 192, 192, 0.5)'
    );

    // Grafik Admin
    buatChart(
        'adminChart',
        'Jumlah Admin',
        @json($userTotal->pluck('tanggal')),
        @json($userTotal->pluck('total')),
        'rgba(153, 102, 255, 1)',
        'rgba(153, 102, 255, 0.5)'
    );
</script>
@endsection
