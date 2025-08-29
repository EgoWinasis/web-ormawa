@extends('admin.layoutadmin.main')
@section('konten')
<div id="dashboard" class="container-dashboard d-flex active">
    <canvas id="dashboardChart" width="400" height="200"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('dashboardChart').getContext('2d');

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($anggota->pluck('tahun')), // ambil tahun dari anggota
            datasets: [
                {
                    label: 'Total Anggota',
                    data: @json($anggota->pluck('total')),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                },
                {
                    label: 'Total Arsip',
                    data: @json($kegiatan->pluck('total')),
                    backgroundColor: 'rgba(255, 206, 86, 0.6)',
                },
                {
                    label: 'Total News',
                    data: @json($news->pluck('total')),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                },
            ]
        },
        options: {
            responsive: true,
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
</script>
@endsection
