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
    function formatTanggal(tanggal) {
        const date = new Date(tanggal);
        const dd = String(date.getDate()).padStart(2, '0');
        const mm = String(date.getMonth() + 1).padStart(2, '0');
        const yy = String(date.getFullYear()).slice(-2);
        return `${dd}-${mm}-${yy}`;
    }

    function buatChart(id, label, labels, data, borderColor, backgroundColor) {
        const formattedLabels = labels.map(tgl => formatTanggal(tgl));

        const ctx = document.getElementById(id).getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: formattedLabels,
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
                    },
                    tooltip: {
                        callbacks: {
                            title: function(context) {
                                return 'Tanggal: ' + context[0].label;
                            },
                            label: function(context) {
                                return label + ': ' + context.raw;
                            }
                        }
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

    // Grafik Kegiatan - tampilkan nama kegiatan
    buatChart(
        'kegiatanChart',
        'Nama Kegiatan',
        @json($kegiatan->pluck('tanggal')),
        @json($kegiatan->pluck('nama_kegiatan')),
        'rgba(255, 206, 86, 1)',
        'rgba(255, 206, 86, 0.5)'
    );

    // Grafik News - tampilkan nama news (lpj)
    buatChart(
        'newsChart',
        'Nama News',
        @json($news->pluck('tanggal')),
        @json($news->pluck('nama_news')),
        'rgba(75, 192, 192, 1)',
        'rgba(75, 192, 192, 0.5)'
    );

    // Grafik Admin - tetap pakai jumlah
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
