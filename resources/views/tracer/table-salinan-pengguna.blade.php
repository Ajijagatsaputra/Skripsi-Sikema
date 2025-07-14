@extends('layouts.admin')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light border-bottom py-3">
        <div class="content d-flex flex-column flex-sm-row justify-content-between align-items-center">
            <div>
                <h1 class="h3 fw-bold mb-0 text-primary">
                    <i class="fa fa-clipboard-list me-2"></i> Data Salinan Tracer Pengguna
                </h1>
                <p class="text-muted fs-sm mb-0">Kelola data salinan tracer pengguna secara profesional dan mudah.</p>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="block block-rounded shadow-sm">
            <!-- Rekapan Data -->
            <div class="row g-3 py-3 px-4 align-items-center">
                <div class="col-md-4">
                    <div class="card card-body border-0 bg-gradient-primary text-white shadow-sm gradient-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fs-2 fw-bold">{{ $totalAlumni }}</div>
                                <div class="fs-sm">Total Alumni</div>
                            </div>
                            <div><i class="fa fa-users fa-2x opacity-50"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-body border-0 bg-gradient-success text-white shadow-sm gradient-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fs-2 fw-bold">{{ $sudahMengisi }}</div>
                                <div class="fs-sm">Sudah Mengisi</div>
                            </div>
                            <div><i class="fa fa-check-circle fa-2x opacity-50"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-body border-0 bg-gradient-warning text-dark shadow-sm gradient-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fs-2 fw-bold">{{ $belumMengisi }}</div>
                                <div class="fs-sm">Belum Mengisi</div>
                            </div>
                            <div><i class="fa fa-times-circle fa-2x opacity-50"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Rekapan Data -->

            <div class="block-header block-header-default bg-light d-flex align-items-center justify-content-between px-4 py-2">
                <h3 class="block-title fw-semibold text-primary mb-0">
                    <i class="fa fa-table me-2"></i> Tabel Salinan Pengguna
                </h3>
            </div>
            <div class="block-content block-content-full">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle js-dataTable-full w-100 mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Nama</th>
                                <th>Nama Perusahaan</th>
                                <th>Tanggal Mengisi</th>
                                <th class="d-none d-sm-table-cell">Prodi</th>
                                <th>Status</th>
                                <th>Jabatan</th>
                                <th class="text-center" style="width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->nama_perusahaan }}</td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ $item->created_at ? $item->created_at->format('d-m-Y') : '-' }}
                                    </td>
                                    <td>{{ $item->prodi_name }}</td>
                                    <td>
                                        @if ($item->created_at)
                                            <span class="badge bg-success">Sudah Mengisi</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Belum Mengisi</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->jabatan }}</td>

                                    @php $role = Auth::user()->role; @endphp

                                    <td class="text-center">
                                        @if ($role === 'superadmin')
                                            <a href="{{ route('listtracerpengguna.show', $item->id) }}"
                                                class="btn btn-sm btn-info rounded-pill" title="Detail">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        @else
                                            <div class="dropdown position-static">
                                                <button class="btn btn-sm btn-light border rounded-pill dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a href="{{ route('listtracerpengguna.show', $item->id) }}"
                                                            class="dropdown-item">
                                                            <i class="fa fa-eye me-1"></i> Detail
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('listtracerpengguna.edit', $item->id) }}"
                                                            class="dropdown-item">
                                                            <i class="fa fa-pencil-alt me-1"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <!-- Hapus pakai SweetAlert2 -->
                                                        <button type="button"
                                                            class="dropdown-item text-danger btn-hapus"
                                                            data-id="{{ $item->id }}"
                                                            data-nama="{{ $item->nama }}">
                                                            <i class="fa fa-trash-alt me-1"></i> Hapus
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            @if ($data->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada data.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <!-- Hidden form for delete (one for all rows, handled by JS) -->
                    <form id="form-hapus" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- DataTables with Buttons (Export) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css"/>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        jQuery(document).ready(function() {
            // DataTable
            jQuery('.js-dataTable-full').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
                autoWidth: false,
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 15, 20],
                    [5, 10, 15, 20]
                ],
                dom: "<'dt-toolbar row mb-3'<'col-12 col-md-6 d-flex align-items-center gap-2'B><'col-12 col-md-6 text-md-end mt-2 mt-md-0'f>>" +
                    "<'row'<'col-sm-12 table-responsive'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: [
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-sm btn-success rounded-pill me-1 mb-1',
                        text: '<i class="fa fa-file-excel me-1"></i> Excel',
                        exportOptions: { columns: ':not(:last-child)' }
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-sm btn-danger rounded-pill me-1 mb-1',
                        text: '<i class="fa fa-file-pdf me-1"></i> PDF',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: { columns: ':not(:last-child)' }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-sm btn-info rounded-pill mb-1',
                        text: '<i class="fa fa-print me-1"></i> Cetak',
                        exportOptions: { columns: ':not(:last-child)' }
                    }
                ]
            });

            // SweetAlert2 konfirmasi hapus
            $(document).on('click', '.btn-hapus', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                Swal.fire({
                    title: 'Hapus Data?',
                    html: `Yakin ingin menghapus <b>${nama}</b> dari daftar salinan tracer? <br><span class="text-danger small">Data yang dihapus <b>tidak dapat dikembalikan</b>.</span>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '<i class="fa fa-trash-alt me-1"></i> Ya, hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-danger rounded-pill px-4 fw-semibold me-2',
                        cancelButton: 'btn btn-light border rounded-pill px-4 fw-semibold'
                    },
                    buttonsStyling: false,
                    focusCancel: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Set form action
                        var url = "{{ route('listtracerpengguna.destroy', ':id') }}";
                        url = url.replace(':id', id);
                        $('#form-hapus').attr('action', url).submit();
                    }
                });
            });
        });
    </script>
    <style>
        .bg-gradient-primary { background: linear-gradient(92deg, #31c7ef 40%, #38d9c3 100%)!important; }
        .bg-gradient-success { background: linear-gradient(92deg, #32d484 30%, #75e095 100%)!important; }
        .bg-gradient-warning { background: linear-gradient(92deg, #ffed85 30%, #ffc371 100%)!important; }
        .card { min-height: 85px; border-radius: 1.3rem; }
        .block-title { font-size: 1.13rem;}
        .dataTables_wrapper .dt-toolbar { margin-bottom:0.7rem; }
        .dt-toolbar .btn { font-weight:600; }
        .badge { font-size: 0.93em; }
        .dropdown-toggle::after { display:none; }
        .btn-info, .btn-info:focus { background: linear-gradient(91deg, #37b3ed 70%, #5398e6 100%)!important; color:#fff!important;}
        .btn-info:hover { background: linear-gradient(91deg, #148ed6 80%, #3f6dd6 100%)!important;}
        .btn-hapus, .btn-hapus:focus { background: transparent; }
    </style>
@endsection
