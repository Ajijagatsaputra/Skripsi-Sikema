@extends('layouts.admin')

@section('content')
    @php
        $role = Auth::user()->role;
    @endphp

    <meta name="user-role" content="{{ $role }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="bg-primary bg-gradient py-4 mb-4 text-white">
        <div class="content d-flex flex-column flex-sm-row justify-content-between align-items-center">
            <div>
                <h1 class="h3 fw-bold"><i class="fa fa-clipboard-list me-2"></i> Data Salinan Tracer Alumni</h1>
                <p class="mb-0">Kelola data tracer alumni secara efisien dan profesional.</p>
            </div>
        </div>
    </div>

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
                <div class="card border-0 shadow-sm text-dark bg-warning">
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

        <div class="d-flex flex-wrap justify-content-between align-items-center mt-4 mb-3 gap-2">
            <div class="d-flex align-items-center gap-2">
                <label class="fw-semibold mb-0" for="filter-tahun">Filter Status Pekerjaan:</label>
                <select class="form-select form-select-sm w-auto" id="filter-status">
                    <option value="">Semua Status</option>
                    <option value="ya">Bekerja</option>
                    <option value="tidak">Tidak Bekerja</option>
                    <option value="wirausaha">Wirausaha</option>
                </select>

            </div>
            <div class="btn-group">
                <button class="btn btn-outline-success btn-sm" id="btnDownloadExcel"><i
                        class="fa fa-file-excel me-1"></i>Excel</button>
                <button class="btn btn-outline-danger btn-sm" id="btnDownloadPdf"><i
                        class="fa fa-file-pdf me-1"></i>PDF</button>
                <button class="btn btn-outline-primary btn-sm" id="btnDownloadPrint"><i
                        class="fa fa-print me-1"></i>Cetak</button>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center small align-middle" id="datatable">
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

    <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="modalDetailLabel">
                        <i class="fa fa-user-graduate me-1"></i> Detail Tracer Alumni
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm table-borderless mb-0">
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

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Script --}}
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
                dom: '<"row mb-2"<"col-sm-6"l><"col-sm-6 text-end"B>>frtip',
                buttons: [{
                        extend: 'excelHtml5',
                        className: 'btn btn-sm btn-success shadow-sm me-1 d-none',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        },
                        filename: 'Rekap_Tracer_Alumni',
                        title: 'Rekap Data Tracer Alumni'
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-sm btn-danger shadow-sm me-1 d-none',
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
                        className: 'btn btn-sm btn-secondary shadow-sm me-1 d-none',
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
                        name: 'alumni.nama_lengkap',
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
                        render: function(data) {
                            return data.alamat_pekerjaan || data.alamat_usaha || '-';
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return `
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-primary shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" class="dropdown-item btn-view" data-tanggal="${data.tanggal_isi}" data-nama="${data.alumni?.nama_lengkap ?? '-'}"
                                            data-perusahaan="${data.nama_perusahaan ?? '-'}" data-bekerja="${data.bekerja ?? '-'}"
                                            data-jabatan="${data.jabatan ?? '-'}" data-gaji="${data.gaji ?? '-'}"
                                            data-alamat="${data.alamat_pekerjaan ?? '-'}" data-relevansi="${data.relevansi_name ?? '-'}"
                                            data-usaha="${data.nama_usaha ?? '-'}" data-posisi="${data.posisi_usaha ?? '-'}"
                                            data-pendapatan-usaha="${data.pendapatan_usaha ?? '-'}" data-alamat-usaha="${data.alamat_usaha ?? '-'}"
                                            data-relevansi-pekerjaan="${data.relevansi_pekerjaan ?? '-'}"
                                            data-saran="${data.saran ?? '-'}">
                                            <i class="fa fa-eye text-info me-2"></i> Detail</a></li>
                                        <li><a href="/listtraceralumni/${data.id}/edit" class="dropdown-item">
                                            <i class="fa fa-edit text-warning me-2"></i> Edit</a></li>
                                        ${userRole === 'admin' ? `
                                                        <li><a href="#" class="dropdown-item btn-delete" data-id="${data.id}">
                                                            <i class="fa fa-trash-alt text-danger me-2"></i> Hapus</a></li>` : ''}
                                    </ul>
                                </div>`;
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
                    }, {
                        label: 'Relevansi Pekerjaan',
                        value: $(this).data('relevansiPekerjaan')
                    },
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
                $('#modalDetail').modal('show');
            });

            // Setup CSRF token untuk semua AJAX request
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Event delete
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
                            url: `/listtraceralumni/${id}`, // pastikan ini sesuai route
                            type: 'DELETE',
                            dataType: 'json',
                            success: function(res) {
                                // Reload DataTable
                                $('#datatable').DataTable().ajax.reload();

                                // Notifikasi sukses
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus!',
                                    text: res.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            },
                            error: function(xhr, status, error) {
                                // Cek respons error
                                console.error(xhr.responseText);

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
        .dataTables_wrapper .dataTables_filter input {
            float: right;
            margin-bottom: 1rem;
        }

        #datatable th {
            background: #f1f9ff;
            color: #1577c2;
            font-weight: 700;
            font-size: 14px;
        }

        #datatable td {
            vertical-align: middle;
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

        @media (max-width: 768px) {
            .dataTables_wrapper .dataTables_filter {
                float: none;
                text-align: left;
                margin-top: 1rem;
            }
        }
    </style>
@endsection
