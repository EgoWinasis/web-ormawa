@extends('superadmin.layoutsuper.main')

@section('konten')
    <div class="container py-5">

        <div class="row">

            <!-- Card Anggota -->
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Grafik Anggota</h5>
                        <canvas id="anggotaChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Card Kegiatan -->
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Grafik Kegiatan</h5>
                        <canvas id="kegiatanChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Card News -->
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Grafik News</h5>
                        <canvas id="newsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Card User -->
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Grafik Admin</h5>
                        <canvas id="adminChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Buat chart per data dengan label tahun dan data masing-masing
    function buatChart(id, label, labels, data, borderColor, backgroundColor) {
        const ctx = document.getElementById(id).getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    borderColor: borderColor,
                    backgroundColor: backgroundColor,
                    fill: false,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
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
        'Anggota',
        @json($anggota->pluck('tahun')),
        @json($anggota->pluck('total')),
        'rgba(54, 162, 235, 1)',
        'rgba(54, 162, 235, 0.2)'
    );

    // Grafik Kegiatan
    buatChart(
        'kegiatanChart',
        'Kegiatan',
        @json($kegiatan->pluck('tahun')),
        @json($kegiatan->pluck('total')),
        'rgba(255, 206, 86, 1)',
        'rgba(255, 206, 86, 0.2)'
    );

    // Grafik News
    buatChart(
        'newsChart',
        'News',
        @json($news->pluck('tahun')),
        @json($news->pluck('total')),
        'rgba(75, 192, 192, 1)',
        'rgba(75, 192, 192, 0.2)'
    );

    // Grafik User
    buatChart(
        'adminChart',
        'Admin',
        @json($userTotal->pluck('tahun')),
        @json($userTotal->pluck('total')),
        'rgba(40, 192, 192, 1)',
        'rgba(75, 192, 192, 0.2)'
    );
</script>

@endsection
