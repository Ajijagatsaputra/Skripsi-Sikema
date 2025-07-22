@include('components.admin.head')

<body class="bg-light">
    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
        @include('components.admin.admin-header')
        @include('components.admin.sidebar')
        @include('components.admin.side-overlay')

        <main id="main-container">
            <!-- Hero -->
            <div class="bg-white border-bottom shadow-sm py-4">
                <div class="content d-flex flex-column flex-sm-row justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 fw-bold text-primary mb-1">
                            <i class="fa fa-graduation-cap me-2"></i> Data Alumni
                        </h1>
                        <p class="text-muted fs-sm mb-0">Kelola data alumni aktif, DO, dan cuti dengan lebih mudah.</p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="content">
                <div class="card shadow-sm border-0 mb-4 rounded-4">
                    <div class="card-body">
                        <!-- Filter + Export -->
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-3">
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <label for="filter-tahun" class="form-label mb-0 fw-semibold">Tahun Angkatan:</label>
                                <select id="filter-tahun" class="form-select form-select-sm border-primary rounded-pill px-3 py-1 w-auto">
                                    @for ($i = 2025; $i >= 2019; $i--)
                                        <option value="{{ $i }}" {{ $i == 2024 ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <span class="badge bg-primary bg-opacity-75 px-3 py-2 rounded-pill shadow-sm fs-sm">
                                    Total: <span id="jumlah-alumni" class="fw-bold">0</span>
                                </span>
                            </div>
                            <div class="dt-buttons btn-group text-end"></div>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive rounded-4 border">
                            <table id="tabel-alumni" class="table table-bordered table-hover table-striped align-middle w-100 shadow-sm">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th class="d-none d-sm-table-cell">Prodi</th>
                                        <th class="d-none d-sm-table-cell">Alamat</th>
                                        <th>Kelas</th>
                                        <th class="d-none d-sm-table-cell">Jalur</th>
                                        <th class="d-none d-sm-table-cell">Masuk</th>
                                        <th>Lulus</th>
                                        <th class="d-none d-sm-table-cell">Status</th>
                                        <th class="d-none d-sm-table-cell">HP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @include('components.admin.footer')
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalViewMahasiswa" tabindex="-1" aria-labelledby="modalViewMahasiswaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header bg-primary text-white rounded-top">
                    <h5 class="modal-title"><i class="fa fa-user-graduate me-2"></i>Detail Alumni</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">NIM</dt><dd class="col-sm-8" id="view-nim"></dd>
                        <dt class="col-sm-4">Nama Lengkap</dt><dd class="col-sm-8" id="view-nama_lengkap"></dd>
                        <dt class="col-sm-4">Prodi</dt><dd class="col-sm-8" id="view-prodi"></dd>
                        <dt class="col-sm-4">Alamat</dt><dd class="col-sm-8" id="view-alamat"></dd>
                        <dt class="col-sm-4">No.Hp</dt><dd class="col-sm-8" id="view-no_hp"></dd>
                        <dt class="col-sm-4">Kelas</dt><dd class="col-sm-8" id="view-kelas"></dd>
                        <dt class="col-sm-4">Jalur</dt><dd class="col-sm-8" id="view-jalur"></dd>
                        <dt class="col-sm-4">Tahun Masuk</dt><dd class="col-sm-8" id="view-tahun_masuk"></dd>
                        <dt class="col-sm-4">Tahun Lulus</dt><dd class="col-sm-8" id="view-tahun_lulus"></dd>
                        <dt class="col-sm-4">Status</dt><dd class="col-sm-8" id="view-status_mahasiswa"></dd>
                        <dt class="col-sm-4">Terakhir Diubah</dt><dd class="col-sm-8" id="view-terakhir_diubah"></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="assets/js/lib/jquery.min.js"></script>
    <script src="assets/js/oneui.app.min.js"></script>
    <!-- DataTables -->
    <script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/js/plugins/datatables-buttons/dataTables.buttons.min.js"></script>
    <script src="assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="assets/js/plugins/datatables-buttons-jszip/jszip.min.js"></script>
    <script src="assets/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js"></script>
    <script src="assets/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js"></script>
    <script src="assets/js/plugins/datatables-buttons/buttons.html5.min.js"></script>
    <script src="assets/js/plugins/datatables-buttons/buttons.print.min.js"></script>

    <script>
        let table;

        function initDataTable(tahun) {
            if (table) {
                table.destroy();
                $('#tabel-alumni tbody').html('');
            }

            table = $('#tabel-alumni').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
                pageLength: 10,
                dom:
                    "<'row mb-3'" +
                        "<'col-sm-12 col-md-6'l>" +
                        "<'col-sm-12 col-md-6 text-end'B>" +
                    ">" +
                    "<'row'<'col-sm-12 table-responsive'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: [
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-sm btn-success rounded-pill me-1',
                        text: '<i class="fa fa-file-excel me-1"></i> Excel',
                        exportOptions: { columns: ':not(:last-child)' }
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-sm btn-danger rounded-pill me-1',
                        text: '<i class="fa fa-file-pdf me-1"></i> PDF',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: { columns: ':not(:last-child)' }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-sm btn-info rounded-pill',
                        text: '<i class="fa fa-print me-1"></i> Cetak',
                        exportOptions: { columns: ':not(:last-child)' }
                    }
                ],
                ajax: {
                    url: '{{ route('api.alumni') }}',
                    type: 'GET',
                    data: { tahun_angkatan: tahun },
                    dataSrc: function (json) {
                        $('#jumlah-alumni').text(json.data.length);
                        return json.data;
                    }
                },
                columns: [
                    { data: 'nim' },
                    { data: 'nama_lengkap' },
                    { data: 'prodi', className: 'd-none d-sm-table-cell' },
                    { data: 'alamat', className: 'd-none d-sm-table-cell' },
                    { data: 'kelas' },
                    { data: 'jalur', className: 'd-none d-sm-table-cell' },
                    { data: 'tahun_masuk', className: 'd-none d-sm-table-cell' },
                    { data: 'tahun_lulus' },
                    { data: 'status_mahasiswa', className: 'd-none d-sm-table-cell' },
                    { data: 'no_hp', className: 'd-none d-sm-table-cell' },
                    {
                        data: null,
                        orderable: false,
                        render: function (data) {
                            return `
                                <button class="btn btn-sm btn-outline-primary rounded-pill px-3 btn-view"
                                    data-bs-toggle="modal" data-bs-target="#modalViewMahasiswa"
                                    data-nim="${data.nim}"
                                    data-nama_lengkap="${data.nama_lengkap}"
                                    data-prodi="${data.prodi}"
                                    data-alamat="${data.alamat}"
                                    data-no_hp="${data.no_hp}"
                                    data-kelas="${data.kelas}"
                                    data-jalur="${data.jalur}"
                                    data-tahun_masuk="${data.tahun_masuk}"
                                    data-tahun_lulus="${data.tahun_lulus}"
                                    data-status_mahasiswa="${data.status_mahasiswa}"
                                    data-terakhir_diubah="${data.updated_at}">
                                    <i class="fa fa-eye me-1"></i> Detail
                                </button>
                            `;
                        }
                    }
                ]
            });
        }

        $(document).ready(function () {
            initDataTable($('#filter-tahun').val());

            $('#filter-tahun').on('change', function () {
                initDataTable($(this).val());
            });

            $(document).on('click', '.btn-view', function () {
                $('#view-nim').text($(this).data('nim'));
                $('#view-nama_lengkap').text($(this).data('nama_lengkap'));
                $('#view-prodi').text($(this).data('prodi'));
                $('#view-alamat').text($(this).data('alamat'));
                $('#view-no_hp').text($(this).data('no_hp'));
                $('#view-kelas').text($(this).data('kelas'));
                $('#view-jalur').text($(this).data('jalur'));
                $('#view-tahun_masuk').text($(this).data('tahun_masuk'));
                $('#view-tahun_lulus').text($(this).data('tahun_lulus'));
                $('#view-status_mahasiswa').text($(this).data('status_mahasiswa'));
                $('#view-terakhir_diubah').text($(this).data('terakhir_diubah'));
            });
        });
    </script>
</body>
</html>
