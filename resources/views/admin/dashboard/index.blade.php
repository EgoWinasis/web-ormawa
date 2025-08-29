@extends('admin.layoutadmin.main')
@section('konten')
<div class="container mt-4">
    <canvas id="dashboardChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('dashboardChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($anggota->pluck('tahun')), // Tahun (X axis)
            datasets: [
                {
                    label: 'Anggota',
                    data: @json($anggota->pluck('total')),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: false,
                    tension: 0.3 // bikin garis agak melengkung
                },
                {
                    label: 'Kegiatan',
                    data: @json($kegiatan->pluck('total')),
                    borderColor: 'rgba(255, 206, 86, 1)',
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    fill: false,
                    tension: 0.3
                },
                {
                    label: 'News',
                    data: @json($news->pluck('total')),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: false,
                    tension: 0.3
                }
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false
            },
            plugins: {
                tooltip: {
                    enabled: true
                },
                legend: {
                    position: 'top'
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
</script>

@endsection
