@extends('admin.layoutadmin.main')

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

    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function formatTanggal(tanggal) {
        const dateObj = new Date(tanggal);
        const dd = String(dateObj.getDate()).padStart(2, '0');
        const mm = String(dateObj.getMonth() + 1).padStart(2, '0');
        const yy = String(dateObj.getFullYear()).slice(-2);
        return `${dd}-${mm}-${yy}`;
    }

    function buatChart(id, label, labels, data, detailLabels, borderColor, backgroundColor) {
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
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            title: function(context) {
                                return 'Tanggal: ' + context[0].label;
                            },
                            label: function(context) {
                                const idx = context.dataIndex;
                                let detail = detailLabels[idx] || 'Tidak ada detail';

                                // Pastikan detail berupa string, jika array gabungkan jadi string
                                if (Array.isArray(detail)) {
                                    detail = detail.join('\n');
                                } else if (typeof detail === 'string') {
                                    // Ganti koma + spasi jadi newline agar multiline tooltip
                                    detail = detail.replace(/, /g, '\n');
                                }

                                return context.dataset.label + ': ' + context.parsed.y + '\nDetail:\n' + detail;
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
                    },
                    x: {
                        ticks: {
                            autoSkip: true,
                            maxTicksLimit: 10
                        }
                    }
                }
            }
        });
    }

    // Grafik Anggota (jumlah biasa, detail kosong)
    buatChart(
        'anggotaChart',
        'Jumlah Anggota',
        @json($anggota->pluck('tanggal')),
        @json($anggota->pluck('total')),
        @json(array_fill(0, $anggota->count(), '')),
        'rgba(54, 162, 235, 1)',
        'rgba(54, 162, 235, 0.5)'
    );

    // Grafik Kegiatan (jumlah + tooltip nama kegiatan)
    buatChart(
        'kegiatanChart',
        'Jumlah Kegiatan',
        @json($kegiatan->pluck('tanggal')),
        @json($kegiatan->pluck('total')),
        @json($kegiatan->pluck('nama_kegiatan')),
        'rgba(255, 206, 86, 1)',
        'rgba(255, 206, 86, 0.5)'
    );

    // Grafik News (jumlah + tooltip nama news)
    buatChart(
        'newsChart',
        'Jumlah News',
        @json($news->pluck('tanggal')),
        @json($news->pluck('total')),
        @json($news->pluck('nama_news')),
        'rgba(75, 192, 192, 1)',
        'rgba(75, 192, 192, 0.5)'
    );
</script>


@endsection
