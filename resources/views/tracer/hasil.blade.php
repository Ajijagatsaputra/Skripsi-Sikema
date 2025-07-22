@extends('layouts.admin')

@section('content')
<div class="container py-5 px-3 px-md-4">
    <!-- STATISTICS CARDS -->
    <div class="row g-4 mb-5">
        @php
            $stats = [
                ['label' => 'Total Alumni', 'icon' => 'bi-people-fill', 'value' => $totalAlumni, 'color' => '#7F7FD5, #86A8E7'],
                ['label' => 'Sudah Mengisi', 'icon' => 'bi-check-circle-fill', 'value' => $sudahMengisi, 'color' => '#43cea2, #185a9d'],
                ['label' => 'Belum Mengisi', 'icon' => 'bi-clock-fill', 'value' => $belumMengisi, 'color' => '#fceabb, #f8b500'],
            ];
        @endphp
        @foreach ($stats as $stat)
        <div class="col-12 col-md-4">
            <div class="card gradient-card text-white border-0 shadow-sm h-100"
                style="background: linear-gradient(135deg, {{ $stat['color'] }});">
                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fs-2 mb-2"><i class="bi {{ $stat['icon'] }}"></i></div>
                        <p class="mb-1 text-white-50">{{ $stat['label'] }}</p>
                        <h3 class="fw-bold counter" data-value="{{ $stat['value'] }}">{{ $stat['value'] }}</h3>
                    </div>
                    @if($stat['label'] !== 'Total Alumni')
                    <div class="text-end">
                        <span class="badge bg-white text-dark shadow-sm fw-semibold fs-6 px-3 py-1">
                            {{ $totalAlumni > 0 ? round(($stat['value'] / $totalAlumni) * 100, 1) : 0 }}%
                        </span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- SURVEY TABLE -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-0 py-3 px-4 d-flex align-items-center">
            <i class="bi bi-bar-chart-fill text-primary fs-4 me-3"></i>
            <div>
                <h5 class="mb-1 fw-semibold">Hasil Survei Kompetensi Alumni</h5>
                <small class="text-muted">Analisis penilaian berdasarkan indikator</small>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0" id="table-hasil-survei">
                    <thead class="text-white" style="background: linear-gradient(90deg,#1e3c72 0%,#2a5298 100%)">
                        <tr>
                            <th class="p-3">Indikator</th>
                            @for ($i = 1; $i <= 5; $i++)
                            <th class="text-center p-3">{{ ['Tidak Baik','Kurang Baik','Cukup','Baik','Sangat Baik'][$i-1] }}<br><small>({{ $i }})</small></th>
                            @endfor
                            <th class="text-center p-3">Responden</th>
                            <th class="text-center p-3">Rata-Rata</th>
                            <th class="text-center p-3">Nilai Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hasil as $row)
                        <tr>
                            <td class="px-4 py-3 fw-medium">{{ $row['label'] }}</td>
                            @for ($i = 1; $i <= 5; $i++)
                            <td class="text-center py-3">
                                <span class="badge bg-light text-dark fs-6 px-3 py-2">
                                    {{ $row['rekap'][$i] }} / {{ $row['jumlah_responden'] }}
                                    ({{ $row['jumlah_responden'] > 0 ? round(($row['rekap'][$i] / $row['jumlah_responden']) * 100, 1) : 0 }}%)
                                </span>
                            </td>
                            @endfor
                            <td class="text-center fw-semibold py-3">{{ $row['jumlah_responden'] }}</td>
                            <td class="text-center py-3">
                                <span class="badge text-white fw-semibold px-3 py-2" style="
                                    background: {{
                                        $row['rata_rata'] >= 4.5 ? '#38b000' :
                                        ($row['rata_rata'] >= 3.5 ? '#2196f3' :
                                        ($row['rata_rata'] >= 2.5 ? '#6c757d' :
                                        ($row['rata_rata'] >= 1.5 ? '#ffc107' : '#dc3545')))
                                    }};">
                                    {{ $row['rata_rata'] }}
                                </span>
                                <div class="small text-muted mt-1">{{ $row['keterangan'] }}</div>
                            </td>
                            <td class="text-center py-3">
                                <span class="badge bg-info text-white fs-6 px-3 py-2">{{ $row['nilai_total'] }}%</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- CONCLUSION -->
    <div class="alert alert-info shadow-sm bg-gradient-conclusion rounded-3 d-flex align-items-center px-4 py-3">
        <i class="bi bi-info-circle-fill fs-2 me-3"></i>
        <div>
            <h6 class="fw-bold mb-1">Kesimpulan</h6>
            <p class="mb-0">
                Berdasarkan hasil survei, alumni tergolong
                <span class="badge bg-light text-primary fw-semibold">{{ $kesimpulanKategori }}</span>
                dengan rata-rata
                <span class="badge bg-light text-primary fw-semibold">{{ $kesimpulanRataRata }}</span>
                dan persentase
                <span class="badge bg-light text-primary fw-semibold">{{ $kesimpulanPersentase }}%</span>.
            </p>
        </div>
    </div>

    <!-- LEGEND -->
    <div class="card mt-3 border-0 bg-light shadow-sm">
        <div class="card-body py-2">
            <small class="text-muted"><i class="bi bi-info-circle me-1"></i><strong>Skala:</strong> 1 = Tidak Baik, 2 = Kurang Baik, 3 = Cukup, 4 = Baik, 5 = Sangat Baik</small>
        </div>
    </div>
</div>

<!-- STYLES -->
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
<style>
    .gradient-card {
        border-radius: 1.4rem;
        transition: .3s ease;
        animation: fadeInUp 0.6s forwards;
    }
    .gradient-card:hover {
        transform: translateY(-6px) scale(1.01);
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

<!-- SCRIPTS -->
@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script>
    $(document).ready(function () {
        $('.counter').each(function () {
            const $this = $(this), countTo = $this.data('value');
            $({ countNum: 0 }).animate({ countNum: countTo }, {
                duration: 1200,
                easing: 'swing',
                step: function () {
                    $this.text(Math.floor(this.countNum));
                },
                complete: function () {
                    $this.text(this.countNum);
                }
            });
        });

        $('#table-hasil-survei').DataTable({
            paging: false,
            searching: false,
            ordering: false,
            info: false,
            responsive: true,
            dom: "<'row mb-3'<'col-12 d-flex gap-2'B>>" +
                "<'row'<'col-12't>>",
            buttons: [
                { extend: 'excelHtml5', className: 'btn btn-success btn-sm rounded-pill', text: '<i class="bi bi-file-earmark-excel"></i> Excel' },
                { extend: 'pdfHtml5', className: 'btn btn-danger btn-sm rounded-pill', text: '<i class="bi bi-file-earmark-pdf"></i> PDF', orientation: 'landscape', pageSize: 'A4' },
                { extend: 'print', className: 'btn btn-info btn-sm rounded-pill', text: '<i class="bi bi-printer"></i> Print' }
            ]
        });
    });
</script>
@endpush
@endsection
