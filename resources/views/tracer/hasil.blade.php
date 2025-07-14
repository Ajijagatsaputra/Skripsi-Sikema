@extends('layouts.admin')

@section('content')
    <div class="container py-5 px-md-4">
        <!-- Statistics Cards -->
        <div class="row mb-5 g-4 flex-wrap">
            <div class="col-md-4">
                <div class="card border-0 shadow-lg gradient-card h-100 text-white"
                    style="background: linear-gradient(120deg,#536976 0,#292e49 100%);">
                    <div class="card-body p-4 d-flex align-items-center">
                        <div>
                            <div class="mb-2">
                                <i class="bi bi-people-fill fs-1"></i>
                            </div>
                            <h6 class="text-white-50 mb-1">Total Alumni</h6>
                            <h2 class="fw-bold counter" data-value="{{ $totalAlumni }}">{{ $totalAlumni }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-lg gradient-card h-100 text-white"
                    style="background: linear-gradient(120deg,#56ab2f 0,#a8e063 100%);">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="mb-2">
                                <i class="bi bi-check-circle-fill fs-1"></i>
                            </div>
                            <h6 class="text-white-50 mb-1">Sudah Mengisi</h6>
                            <h2 class="fw-bold counter" data-value="{{ $sudahMengisi }}">{{ $sudahMengisi }}</h2>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-light text-success fw-semibold fs-6 shadow-sm px-3">
                                {{ $totalAlumni > 0 ? round(($sudahMengisi / $totalAlumni) * 100, 1) : 0 }}%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-lg gradient-card h-100 text-white"
                    style="background: linear-gradient(120deg,#fdc830 0,#f37335 100%);">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="mb-2">
                                <i class="bi bi-clock-fill fs-1"></i>
                            </div>
                            <h6 class="text-white-50 mb-1">Belum Mengisi</h6>
                            <h2 class="fw-bold counter" data-value="{{ $belumMengisi }}">{{ $belumMengisi }}</h2>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-light text-warning fw-semibold fs-6 shadow-sm px-3">
                                {{ $totalAlumni > 0 ? round(($belumMengisi / $totalAlumni) * 100, 1) : 0 }}%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Survey Results Table -->
        <div class="card border-0 shadow-lg mb-3">
            <div class="card-header bg-white border-0 py-4">
                <div class="d-flex align-items-center">
                    <i class="bi bi-bar-chart-fill text-primary me-3 fs-3"></i>
                    <div>
                        <h4 class="fw-bold mb-1">Hasil Survei Kompetensi Alumni</h4>
                        <small class="text-muted">Tabel analisis berdasarkan indikator penilaian</small>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <!-- TOMBOL EXPORT OTOMATIS DARI DATATABLES -->
                    <table class="table table-hover mb-0 align-middle" id="table-hasil-survei">
                        <thead class="bg-gradient-primary text-white"
                            style="background: linear-gradient(90deg,#1e3c72 0,#2a5298 100%)">
                            <tr>
                                <th class="border-0 py-3 px-4 fw-semibold">Indikator
                                    <i class="bi bi-info-circle ms-1 text-warning" data-bs-toggle="tooltip"
                                        title="Penilaian aspek kompetensi"></i>
                                </th>
                                <th class="border-0 py-3 text-center fw-semibold">Tidak Baik<br><small>(1)</small></th>
                                <th class="border-0 py-3 text-center fw-semibold">Kurang Baik<br><small>(2)</small></th>
                                <th class="border-0 py-3 text-center fw-semibold">Cukup<br><small>(3)</small></th>
                                <th class="border-0 py-3 text-center fw-semibold">Baik<br><small>(4)</small></th>
                                <th class="border-0 py-3 text-center fw-semibold">Sangat Baik<br><small>(5)</small></th>
                                <th class="border-0 py-3 text-center fw-semibold">Responden</th>
                                <th class="border-0 py-3 text-center fw-semibold">Rata-Rata</th>
                                <th class="border-0 py-3 text-center fw-semibold">Nilai Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasil as $row)
                                <tr>
                                    <td class="py-4 px-4 fw-medium border-0">{{ $row['label'] }}</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td class="text-center py-4 border-0">
                                            <span class="badge bg-white text-dark shadow-sm px-3 py-2 fs-6">
                                                {{-- {{ $row['rekap'][$i] }} --}}
                                                 {{ $row['rekap'][$i] }} / {{ $row['jumlah_responden'] }}
                                                 ({{ $row['jumlah_responden'] > 0 ? round(($row['rekap'][$i] / $row['jumlah_responden']) * 100, 1) : 0 }}%)
                                            </span>
                                        </td>
                                    @endfor
                                    <td class="text-center py-4 border-0 fw-semibold">{{ $row['jumlah_responden'] }}</td>
                                    <td class="text-center py-4 border-0">
                                        <span
                                            class="badge rata-badge
                @if ($row['rata_rata'] >= 4.5) bg-success text-white
                @elseif($row['rata_rata'] >= 3.5) bg-primary text-white
                @elseif($row['rata_rata'] >= 2.5) bg-secondary text-white
                @elseif($row['rata_rata'] >= 1.5) bg-warning text-dark
                @else bg-danger text-white @endif
                shadow-sm px-3 py-2 fs-6"
                                            data-bs-toggle="tooltip" title="Rata-rata hasil survei">&#11088;
                                            {{ $row['rata_rata'] }}</span>
                                        <div class="small text-muted mt-1">{{ $row['keterangan'] }}</div>
                                    </td>
                                    <td class="text-center py-4 border-0">
                                        <span class="badge bg-info text-white px-3 py-2 fs-6">
                                            {{ $row['nilai_total'] }}%
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- END TABLE -->
                </div>
            </div>
        </div>

        <!-- Conclusion -->
        <div class="mt-4">
            <div class="alert alert-primary border-0 shadow-lg d-flex align-items-center py-4 px-3 bg-gradient-conclusion text-white"
                style="background: linear-gradient(90deg, #7f7fd5 0%, #91eac9 100%)">
                <i class="bi bi-info-circle-fill me-3 fs-2"></i>
                <div>
                    <h6 class="fw-bold mb-1 fs-5">Kesimpulan</h6>
                    <p class="mb-0 fs-6">
                        Berdasarkan hasil survei, alumni Politeknik tergolong
                        <span class="badge bg-light text-primary shadow-sm px-2 py-1 fs-6">{{ $kesimpulanKategori }}</span>
                        dengan rata-rata nilai
                        <span class="badge bg-light text-primary shadow-sm px-2 py-1 fs-6">{{ $kesimpulanRataRata }}</span>
                        dan persentase
                        <span
                            class="badge bg-light text-primary shadow-sm px-2 py-1 fs-6">{{ $kesimpulanPersentase }}%</span>.
                    </p>
                </div>
            </div>
        </div>

        <!-- Legend -->
        <div class="mt-3">
            <div class="card border-0 bg-light rounded-3 shadow-sm">
                <div class="card-body py-3">
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        <strong>Skala:</strong>
                        1 = Tidak Baik, 2 = Kurang Baik, 3 = Cukup, 4 = Baik, 5 = Sangat Baik
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" />

    <style>
        .bg-gradient-primary {
            background: linear-gradient(90deg, #1e3c72 0%, #2a5298 100%) !important;
        }

        .gradient-card {
            border-radius: 1.6rem;
            transition: transform .22s cubic-bezier(.42, 0, .34, 1.01), box-shadow .22s;
            box-shadow: 0 0.2rem 1rem rgba(44, 62, 80, .12) !important;
            opacity: 0;
            transform: scale(.96) translateY(15px);
            animation: cardFadeIn .8s forwards;
        }

        @keyframes cardFadeIn {
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .gradient-card:hover {
            transform: translateY(-5px) scale(1.028);
        }

        .table thead.bg-gradient-primary th {
            background: linear-gradient(90deg, #2563eb 60%, #a8e0ff 100%) !important;
            color: #fff !important;
            border: none;
        }

        .table tbody tr:nth-child(even) {
            background: #f7fafc;
        }

        .table tbody tr {
            border-bottom: 2.2px solid rgba(56, 76, 148, .08);
        }

        .table tbody tr:hover {
            background: #eaf4ff !important;
            transition: background 0.2s;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .rata-badge {
            background: linear-gradient(100deg, #a5f0e8 0, #2196f3 100%) !important;
            position: relative;
            font-weight: bold;
            box-shadow: 0 1px 6px rgba(30, 80, 200, 0.08);
            border-radius: 1em;
            animation: shimmer 2s infinite linear;
            background-size: 220% 100%;
            cursor: pointer;
            border: none !important;
        }

        .rata-badge:hover {
            background-position: 100% 0;
        }

        @keyframes shimmer {
            0% {
                background-position: -180px 0;
            }

            100% {
                background-position: 220px 0;
            }
        }

        .card-header.bg-white {
            background: linear-gradient(90deg, #fafdff 80%, #dbeafe 100%) !important;
            border-bottom: 1.7px solid #e3e6ef;
            border-radius: 1.6rem 1.6rem 0 0;
        }

        .alert.bg-gradient-conclusion {
            background: linear-gradient(90deg, #7f7fd5 0%, #91eac9 100%) !important;
            border-radius: 1.2rem;
            box-shadow: 0 2px 20px rgba(36, 36, 100, .10);
            color: #fff !important;
        }

        .alert .badge {
            font-size: 1.09em;
            border-radius: 0.9em;
        }

        .card.bg-light {
            border-radius: 1.1rem;
            background: linear-gradient(95deg, #f4f8fc 80%, #eaf6ff 100%) !important;
        }

        .display-5,
        h1.display-5 {
            letter-spacing: -1.1px;
        }

        @media (max-width: 768px) {
            .gradient-card {
                font-size: .96em;
            }

            .display-5 {
                font-size: 2rem;
            }

            .card-header h4 {
                font-size: 1.17rem;
            }

            .alert .fs-5,
            .alert h6 {
                font-size: 1rem !important;
            }
        }

        .dt-buttons .btn {
            font-weight: 600 !important;
        }
    </style>

    <!-- DataTables JS & Buttons -->
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

    <!-- Animated Counter & Bootstrap Tooltip -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animated Counter
            document.querySelectorAll('.counter').forEach(function(el) {
                let val = parseInt(el.getAttribute('data-value'));
                let current = 0;
                let speed = Math.max(16, 440 / (val || 1));
                let inc = Math.ceil(val / speed);
                let interval = setInterval(() => {
                    current += inc;
                    if (current >= val) {
                        current = val;
                        clearInterval(interval);
                    }
                    el.textContent = current;
                }, 17);
            });
            // Tooltip Bootstrap 5 (untuk badge info & rata-rata)
            if (window.bootstrap) {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                })
            }
            document.querySelectorAll('.rata-badge').forEach(function(el) {
                el.setAttribute('title', 'Rata-rata hasil survei');
                if (window.bootstrap) {
                    new bootstrap.Tooltip(el);
                }
            });

            // DataTables + Export Button
            $('#table-hasil-survei').DataTable({
                paging: false,
                searching: false,
                ordering: false,
                info: false,
                responsive: true,
                autoWidth: false,
                dom: "<'dt-toolbar row mb-3'<'col-12 d-flex align-items-center gap-2'B>>" +
                    "<'row'<'col-sm-12 table-responsive'tr>>",
                buttons: [{
                        extend: 'excelHtml5',
                        className: 'btn btn-sm btn-success rounded-pill me-1 mb-1',
                        text: '<i class="bi bi-file-earmark-excel"></i> Export Excel',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-sm btn-danger rounded-pill me-1 mb-1',
                        text: '<i class="bi bi-file-earmark-pdf"></i> Export PDF',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':visible'
                        },
                        customize: function(doc) {
                            doc.styles.tableHeader.alignment = 'center';
                            doc.defaultStyle.fontSize = 10;
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-sm btn-info rounded-pill mb-1',
                        text: '<i class="bi bi-printer"></i> Cetak',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });
        });
    </script>
@endsection
