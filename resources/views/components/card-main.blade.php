<div class="container py-4">
    <div class="row g-4">
        {{-- Aktivitas Alumni --}}
        <div class="col-lg-6 col-md-12">
            <div class="card shadow-sm h-100">
                <div class="card-header fw-bold d-flex justify-content-between align-items-center">
                    <span>AKTIVITAS ALUMNI TERKINI</span>
                    <span class="text-muted small">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>FITUR</th>
                                <th>AKTIVITAS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kuesioner</td>
                                <td>Mengisi Kuesioner Tracer Study</td>
                            </tr>
                            <tr>
                                <td>Data Alumni</td>
                                <td>Melihat Data Alumni yang Sudah Melakukan Tracer Study</td>
                            </tr>
                            <tr>
                                <td>Total Alumni</td>
                                <td>Melihat Total Alumni yang Sudah Melakukan Tracer Study per Tahun Lulus</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Status Pengisian Tracer Study --}}
        <div class="col-lg-6 col-md-12">
            <div class="card shadow-sm h-100">
                <div class="card-header fw-bold text-center">
                    STATUS PENGISIAN TRACER STUDY
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                    @if ($statusTracer === 'sudah')
                        <i class="fa fa-check-circle fa-3x text-success mb-3"></i>
                        <h5 class="fw-bold text-success">Sudah Mengisi</h5>
                        <p class="text-muted mb-0">Terima kasih telah berpartisipasi dalam tracer study.</p>
                        <div class="dropdown mt-3">
                            <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Lihat Jawaban
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('tracer.showpengguna', Auth::user()->id) }}?tipe=pengguna">Tracer Pengguna</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('tracer.showstudy', auth()->user()->alumni->id) }}?tipe=tracer">Tracer Study</a>
                                </li>
                            </ul>
                        </div>
                    @else
                        <i class="fa fa-times-circle fa-3x text-danger mb-3"></i>
                        <h5 class="fw-bold text-danger">Belum Mengisi</h5>
                        <p class="text-muted mb-2">Silakan lengkapi kuesioner tracer study Anda.</p>
                        <a href="{{ route('tracer.kuesioner') }}" class="btn btn-outline-success btn-sm">Isi Sekarang</a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Data Rekap Alumni (Bar Chart) --}}
        <div class="col-12">
            <div class="card shadow-sm mt-2">
                <div class="card-header fw-bold">Data Rekap Alumni</div>
                <div class="card-body">
                    <canvas id="rekapAlumniChart" style="max-height: 420px; width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const tahun = @json($tahun);
    const totalAlumni = @json($alumniData);
    const totalKuesioner = @json($kuisonerData);

    const ctxBar = document.getElementById('rekapAlumniChart').getContext('2d');

    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: tahun,
            datasets: [
                {
                    label: 'Total Alumni',
                    data: totalAlumni,
                    backgroundColor: 'rgba(66, 133, 244, 0.8)'
                },
                {
                    label: 'Mengisi Kuesioner',
                    data: totalKuesioner,
                    backgroundColor: 'rgba(0, 200, 180, 0.8)'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });
</script>
