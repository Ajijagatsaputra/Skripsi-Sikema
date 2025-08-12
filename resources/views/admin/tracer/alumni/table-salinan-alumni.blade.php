@extends('layouts.admin')

@section('content')
    @php
        $role = Auth::user()->role;
    @endphp

    <meta name="user-role" content="{{ $role }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Header --}}
    <div class="bg-primary bg-gradient py-4 mb-4 text-white">
        <div class="content d-flex flex-column flex-sm-row justify-content-between align-items-center">
            <div>
                <h1 class="h3 fw-bold"><i class="fa fa-clipboard-list me-2"></i> Data Salinan Tracer Alumni</h1>
                <p class="mb-0">Kelola data tracer alumni secara efisien dan profesional.</p>
            </div>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="content">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-white bg-primary">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fs-3 fw-bold">{{ $totalAlumni }}</div>
                            <div>Total Alumni</div>
                        </div>
                        <i class="fa fa-users fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-white bg-success">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fs-3 fw-bold">{{ $sudahMengisi }}</div>
                            <div>Sudah Mengisi</div>
                        </div>
                        <i class="fa fa-check-circle fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-white bg-warning">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fs-3 fw-bold">{{ $belumMengisi }}</div>
                            <div>Belum Mengisi</div>
                        </div>
                        <i class="fa fa-times-circle fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter dan Export --}}
        <div class="row mt-4 mb-3 align-items-center">
            <div class="col-md-4 col-sm-12 mb-2 mb-md-0">
                <label class="fw-semibold me-2" for="filter-status">Filter Status Pekerjaan:</label>
                <select class="form-select form-select-sm w-auto d-inline-block" id="filter-status">
                    <option value="">Semua Status</option>
                    <option value="ya">Bekerja</option>
                    <option value="tidak">Tidak Bekerja</option>
                    <option value="wirausaha">Wirausaha</option>
                </select>
            </div>
            <div class="col-md-8 col-sm-12 text-md-end">
                <div class="btn-group">
                    <button class="btn btn-outline-success btn-sm" id="btnDownloadExcel"><i
                            class="fa fa-file-excel me-1"></i> Excel</button>
                    <button class="btn btn-outline-danger btn-sm" id="btnDownloadPdf"><i class="fa fa-file-pdf me-1"></i>
                        PDF</button>
                    <button class="btn btn-outline-primary btn-sm" id="btnDownloadPrint"><i class="fa fa-print me-1"></i>
                        Cetak</button>
                </div>
            </div>
        </div>

        {{-- Tabel --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover small align-middle" id="datatable">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th>#</th>
                                <th>Tanggal Mengisi</th>
                                <th>Nama Alumni</th>
                                <th>Status Pekerjaan</th>
                                <th>Jabatan</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Alumni -->
    <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailLabel">Detail Alumni</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody id="detailContent"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- DataTables & Export --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" />
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            const userRole = $('meta[name="user-role"]').attr('content');

            const table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('listtraceralumni.index') }}",
                    data: function(d) {
                        d.status = $('#filter-status').val();
                    }
                },
                dom: '<"row mb-3"' +
                    '<"col-md-4 col-sm-12"l>' +
                    '<"col-md-4 col-sm-12 text-center"f>' +
                    '<"col-md-4 col-sm-12 text-end"B>' +
                    '>' +
                    'rtip',
                buttons: [{
                        extend: 'excelHtml5',
                        className: 'btn btn-success btn-sm me-1 d-none',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        },
                        filename: 'Rekap_Tracer_Alumni',
                        title: 'Rekap Data Tracer Alumni'
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-danger btn-sm me-1 d-none',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        },
                        filename: 'Rekap_Tracer_Alumni',
                        title: 'Rekap Data Tracer Alumni'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-secondary btn-sm me-1 d-none',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        },
                        title: 'Rekap Data Tracer Alumni'
                    }
                ],
                columns: [{
                        data: 'id',
                        render: (data, type, row, meta) => meta.row + 1
                    },
                    {
                        data: 'tanggal_isi',
                        render: data => data ? new Date(data).toLocaleDateString('id-ID') : '-'
                    },
                    {
                        data: 'alumni.nama_lengkap',
                        render: data => data ?? '-'
                    },
                    {
                        data: 'bekerja',
                        render: data => data || '-'
                    },
                    {
                        data: 'jabatan',
                        render: data => data || '-'
                    },
                    {
                        data: null,
                        render: data => data.alamat_pekerjaan || data.alamat_usaha || '-'
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            let menu = `
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-primary shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <!-- Detail -->
                                        <li>
                                            <a href="#" class="dropdown-item btn-view"
                                                data-tanggal="${data.tanggal_isi}"
                                                data-nama="${data.alumni?.nama_lengkap ?? '-'}"
                                                data-perusahaan="${data.nama_perusahaan ?? '-'}"
                                                data-bekerja="${data.bekerja ?? '-'}"
                                                data-jabatan="${data.jabatan ?? '-'}"
                                                data-gaji="${data.gaji ?? '-'}"
                                                data-alamat="${data.alamat_pekerjaan ?? '-'}"
                                                data-relevansi="${data.relevansi_name ?? '-'}"
                                                data-usaha="${data.nama_usaha ?? '-'}"
                                                data-posisi="${data.posisi_usaha ?? '-'}"
                                                data-pendapatan-usaha="${data.pendapatan_usaha ?? '-'}"
                                                data-alamat-usaha="${data.alamat_usaha ?? '-'}"
                                                data-relevansi-pekerjaan="${data.relevansi_pekerjaan ?? '-'}"
                                                data-saran="${data.saran ?? '-'}">
                                                <i class="fa fa-eye text-info me-2"></i> Detail
                                            </a>
                                        </li>
        `;

                            // Kalau role admin, tambahkan Edit & Hapus
                            if (userRole === 'admin') {
                                menu += `

                                    <!-- Edit -->
                                    <li>
                                        <a href="/listtraceralumni/${data.id}/edit" class="dropdown-item">
                                            <i class="fa fa-edit text-warning me-2"></i> Edit
                                        </a>
                                    </li>

                                    <!-- Hapus -->
                                    <li>
                                        <a href="#" class="dropdown-item btn-delete" data-id="${data.id}">
                                            <i class="fa fa-trash-alt text-danger me-2"></i> Hapus
                                        </a>
                                    </li>
                                `;
                            } else if(userRole === 'superadmin') {
                                menu += `

                                    <!-- Edit -->
                                    <li>
                                        <a href="/listtraceralumni/${data.id}/edit" class="dropdown-item">
                                            <i class="fa fa-edit text-warning me-2"></i> Edit
                                        </a>
                                    </li>
                                `;
                            }

                            menu += `
                                    </ul>
                                </div>
                            `;

                            return menu;
                        }

                    }
                ],
                order: [
                    [0, 'desc']
                ]
            });

            $('#filter-status').on('change', function() {
                table.ajax.reload();
            });

            $('#btnDownloadExcel').click(() => table.button('.buttons-excel').trigger());
            $('#btnDownloadPdf').click(() => table.button('.buttons-pdf').trigger());
            $('#btnDownloadPrint').click(() => table.button('.buttons-print').trigger());

            // Detail Modal
            $('#datatable').on('click', '.btn-view', function() {
                const bekerja = ($(this).data('bekerja') || '').toString().toLowerCase().trim();
                const fields = [{
                        label: 'Tanggal',
                        value: $(this).data('tanggal')
                    },
                    {
                        label: 'Alumni',
                        value: $(this).data('nama')
                    },
                    {
                        label: 'Status Bekerja',
                        value: $(this).data('bekerja')
                    },
                    {
                        label: 'Relevansi Pekerjaan',
                        value: $(this).data('relevansi-pekerjaan')
                    }
                ];

                if (bekerja === 'ya') {
                    fields.push({
                        label: 'Perusahaan',
                        value: $(this).data('perusahaan')
                    }, {
                        label: 'Jabatan',
                        value: $(this).data('jabatan')
                    }, {
                        label: 'Gaji',
                        value: $(this).data('gaji')
                    }, {
                        label: 'Alamat Pekerjaan',
                        value: $(this).data('alamat')
                    }, {
                        label: 'Saran',
                        value: $(this).data('saran')
                    });
                } else if (bekerja.includes('wirausaha')) {
                    fields.push({
                        label: 'Nama Usaha',
                        value: $(this).data('usaha')
                    }, {
                        label: 'Posisi Usaha',
                        value: $(this).data('posisi')
                    }, {
                        label: 'Pendapatan Usaha',
                        value: $(this).data('pendapatan-usaha')
                    }, {
                        label: 'Alamat Usaha',
                        value: $(this).data('alamat-usaha')
                    }, {
                        label: 'Saran',
                        value: $(this).data('saran')
                    });
                } else {
                    fields.push({
                        label: 'Keterangan',
                        value: 'Tidak Bekerja'
                    }, {
                        label: 'Saran',
                        value: $(this).data('saran')
                    });
                }

                const html = fields.map(f => `
        <tr>
            <th class="text-start bg-light text-dark w-40">${f.label}</th>
            <td>${f.value || '-'}</td>
        </tr>
    `).join('');

                $('#detailContent').html(html);
                $('#modalDetail').appendTo('body').modal('show'); // FIX: pastikan modal muncul di body
            });


            // Hapus data
            $('#datatable').on('click', '.btn-delete', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: 'Data tidak bisa dikembalikan setelah dihapus!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/listtraceralumni/${id}`,
                            type: 'DELETE',
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(res) {
                                $('#datatable').DataTable().ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: res.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Tidak dapat menghapus data.',
                                    footer: xhr.status == 419 ?
                                        'Session CSRF Expired. Refresh halaman!' :
                                        ''
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>

    {{-- STYLE --}}
    <style>
        #datatable th,
        #datatable td {
            text-align: center;
            vertical-align: middle;
        }

        #datatable th {
            background: #f8faff;
            color: #0d6efd;
            font-weight: 600;
            font-size: 14px;
        }

        .dataTables_wrapper {
            overflow: visible !important;
        }


        .dataTables_wrapper .dataTables_filter input {
            margin-left: 0.5em;
            display: inline-block;
            width: auto;
        }

        .dt-buttons .btn {
            margin-bottom: 0.5rem;
        }

        .dropdown-menu {
            font-size: 0.95rem;
        }

        .btn-outline-primary {
            border-color: #0d6efd;
            color: #0d6efd;
        }

        .btn-outline-primary:hover {
            background-color: #0d6efd;
            color: #fff;
        }

        .modal {
            z-index: 1055 !important;
        }

        .modal-backdrop {
            z-index: 1050 !important;
        }


        @media (max-width: 768px) {
            .dataTables_wrapper .row>div {
                text-align: center !important;
                margin-bottom: 10px;
            }
        }
    </style>
@endsection
