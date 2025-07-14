<!DOCTYPE html>
<html lang="id">
<head>
    @include('components.admin.head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <style>
        /* Table styling */
        .table-custom tbody tr:nth-child(odd) { background-color: #f5f8fa; }
        .table-custom tbody tr:nth-child(even) { background: #fdfdfd; }
        .table-custom tbody tr:hover { background: #e3f2fd; transition: background 0.3s; }
        .table-custom th, .table-custom td { vertical-align: middle; }
        /* Export button style */
        .dt-toolbar .btn { border-radius: 1.5rem; box-shadow: 0 2px 8px rgba(60,60,100,.07);}
        /* Badge style */
        .badge-status {
            padding: .38em 1.1em; border-radius: 1rem; font-size: .95em;
            font-weight: 500; box-shadow: 0 1px 5px rgba(44,62,80,.09);
            display: inline-block;
        }
        .badge-aktif { background: linear-gradient(90deg, #e0fbe2 70%, #c7ffe0 100%); color: #25946e;}
        .badge-cuti  { background: linear-gradient(90deg,#fff7e0 70%,#ffefd6 100%); color: #ff9800;}
        .badge-do    { background: linear-gradient(90deg,#ffe0e0 70%,#ffd2d2 100%); color: #e53935;}
        /* View Button */
        .btn-view {
            background: linear-gradient(90deg, #e3f0fc 70%, #e8eaf6 100%);
            color: #19568d; border-radius: 1.2em; transition: all .2s;
        }
        .btn-view:hover { background: #dbeafe; color: #0b3861;}
        /* Modal style & animation */
        .modal.fade .modal-dialog {
            transform: translateY(50px) scale(.98); transition: all .3s cubic-bezier(.42,0,.34,1.01);
            opacity: 0;
        }
        .modal.show .modal-dialog {
            transform: translateY(0) scale(1); opacity: 1;
        }
        .modal-content {
            border-radius: 1.6rem;
            box-shadow: 0 10px 48px 8px rgba(44,62,80,.14);
            border: none;
            background: linear-gradient(120deg,#fafdff 85%, #f6fbff 100%);
        }
        .modal-header {
            border: none;
            border-radius: 1.6rem 1.6rem 0 0;
            background: linear-gradient(90deg,#dbeafd 80%,#fafdff 100%);
        }
        .modal-title {
            font-weight: 600; color: #2373b7; letter-spacing: .5px;
        }
        .btn-close {
            background: none; opacity: .7;
        }
        .btn-close:hover { opacity: 1; }
        /* Avatar dengan gradient border */
        .modal-avatar {
            width: 90px; height: 90px; object-fit: cover;
            border-radius: 50%;
            border: 3px solid transparent;
            background: linear-gradient(#fff,#fff) padding-box, linear-gradient(135deg,#48bb78 50%,#2563eb 100%) border-box;
            box-shadow: 0 2px 18px 2px rgba(44,62,80,.10);
            margin-bottom: 1em;
        }
        /* Profile title */
        .modal-profile-title { font-weight: 700; font-size: 1.3rem; margin-bottom:.25em;}
        .modal-profile-subtitle { color:#929292;font-size:.96em; margin-bottom:.75em; }
        /* Detail grid dengan icon */
        .dl-grid {
            display: grid; grid-template-columns: 1fr 2.5fr; row-gap: .42em; column-gap:.8em;
        }
        .dl-grid .ico {
            width:22px;text-align:center;opacity:.80;
        }
        @media (max-width: 575px) {
            .dl-grid { grid-template-columns: 1fr; }
            .modal-profile-title { font-size: 1.1rem; }
            .modal-content { border-radius:1rem;}
        }
        /* Select2 style tweak */
        .select2-container .select2-selection--single {
            height: 38px !important; padding: 6px 12px; border-radius: 0.375rem;
        }
    </style>
</head>

<body>
<div id="page-container"
     class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
    @include('components.admin.admin-header')
    @include('components.admin.sidebar')
    @include('components.admin.side-overlay')

    <main id="main-container">
        <div class="bg-body-light border-bottom py-3">
            <div class="content d-flex flex-column flex-sm-row justify-content-between align-items-center">
                <div>
                    <h1 class="h3 fw-bold mb-0">Data Mahasiswa</h1>
                    <p class="text-muted fs-sm">Kelola data mahasiswa aktif, DO dan cuti.</p>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="block block-rounded shadow-sm">
                <div class="block-content block-content-full">
                    <!-- Filter Tahun Angkatan -->
                    <div class="mb-3">
                        <label for="filter-tahun" class="form-label fw-semibold">Tahun Angkatan:</label>
                        <select id="filter-tahun" class="form-select w-auto d-inline-block" style="min-width:120px">
                            <option value="2025">2025</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                            <option value="2021" selected>2021</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                        </select>
                    </div>
                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-custom table-bordered table-striped table-hover align-middle js-dataTable-full w-100">
                            <thead class="table-light">
                            <tr>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th class="d-none d-sm-table-cell">Prodi</th>
                                <th>Semester</th>
                                <th class="d-none d-sm-table-cell">Kelas</th>
                                <th class="d-none d-sm-table-cell">Jalur</th>
                                <th>Tahun Masuk</th>
                                <th class="d-none d-sm-table-cell">Status Mahasiswa</th>
                                <th class="d-none d-sm-table-cell">No. Telp</th>
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

<!-- Modal View Mahasiswa -->
<div class="modal fade" id="modalViewMahasiswa" tabindex="-1" aria-labelledby="modalViewMahasiswaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="modalViewMahasiswaLabel">
                    <i class="fa-solid fa-id-badge me-2"></i> Detail Mahasiswa
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center px-4 pt-4 pb-3">
                <img src="" id="view-avatar" class="modal-avatar" alt="Avatar Mahasiswa">
                <div class="modal-profile-title mb-1" id="view-nama"></div>
                <div class="modal-profile-subtitle" id="view-prodi"></div>
                <div class="dl-grid text-start mt-4">
                    <div class="ico"><i class="fa-solid fa-id-card"></i></div> <div id="view-nim"></div>
                    <div class="ico"><i class="fa-solid fa-layer-group"></i></div> <div id="view-kelas"></div>
                    <div class="ico"><i class="fa-solid fa-route"></i></div> <div id="view-jalur"></div>
                    <div class="ico"><i class="fa-solid fa-calendar-check"></i></div> <div id="view-tahun"></div>
                    <div class="ico"><i class="fa-solid fa-graduation-cap"></i></div> <div id="view-semester"></div>
                    <div class="ico"><i class="fa-solid fa-badge-check"></i></div> <div id="view-status"></div>
                    <div class="ico"><i class="fa-brands fa-whatsapp"></i></div> <div id="view-telp"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS Libs -->
<script src="assets/js/lib/jquery.min.js"></script>
<script src="assets/js/oneui.app.min.js"></script>
<script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/js/plugins/datatables-buttons/dataTables.buttons.min.js"></script>
<script src="assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
<script src="assets/js/plugins/datatables-buttons-jszip/jszip.min.js"></script>
<script src="assets/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js"></script>
<script src="assets/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js"></script>
<script src="assets/js/plugins/datatables-buttons/buttons.html5.min.js"></script>
<script src="assets/js/plugins/datatables-buttons/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
let table;

function initDataTable(tahunAngkatan) {
    if (table) {
        table.destroy();
        $('.js-dataTable-full').empty();
        $('.js-dataTable-full').html(`
            <thead class="table-light">
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th class="d-none d-sm-table-cell">Prodi</th>
                    <th>Semester</th>
                    <th class="d-none d-sm-table-cell">Kelas</th>
                    <th class="d-none d-sm-table-cell">Jalur</th>
                    <th>Tahun Masuk</th>
                    <th class="d-none d-sm-table-cell">Status Mahasiswa</th>
                    <th class="d-none d-sm-table-cell">No. Telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        `);
    }
    table = $('.js-dataTable-full').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        responsive: true,
        pageLength: 20,
        dom: "<'dt-toolbar row mb-3'" +
            "<'col-12 col-md-6 d-flex align-items-center gap-2'B>" +
            "<'col-12 col-md-6 text-md-end mt-2 mt-md-0'f>" +
            ">" +
            "<'row'<'col-sm-12 table-responsive'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            { extend: 'excelHtml5', className: 'btn btn-sm btn-success', text: '<i class="fa fa-file-excel me-1"></i> Excel', exportOptions: { columns: ':not(:last-child)' }},
            { extend: 'pdfHtml5', className: 'btn btn-sm btn-danger', text: '<i class="fa fa-file-pdf me-1"></i> PDF', orientation: 'landscape', pageSize: 'A4', exportOptions: { columns: ':not(:last-child)' }},
            { extend: 'print', className: 'btn btn-sm btn-info', text: '<i class="fa fa-print me-1"></i> Cetak', exportOptions: { columns: ':not(:last-child)' }}
        ],
        ajax: {
            url: '{{ route('api.mahasiswa') }}',
            type: 'GET',
            data: { tahun_angkatan: tahunAngkatan },
            dataSrc: function(json) {
                return (json.status && json.data) ? json.data.map(item => ({
                    nim: item.nim,
                    nama_lengkap: `
                        <div class="d-flex align-items-center">
                            <img src="${item.avatar_url ?? 'https://ui-avatars.com/api/?name=' + encodeURIComponent(item.nama_lengkap)}"
                                 alt="Avatar"
                                 style="width:32px;height:32px;object-fit:cover;border-radius:50%;margin-right:8px;border:2px solid #e3e3e3;">
                            <span>${item.nama_lengkap}</span>
                        </div>`,
                    prodi: item.prodi?.nama || '',
                    semester: item.semester,
                    kelas: item.kelas,
                    jalur: item.jalur,
                    tahun_masuk: item.tahun_masuk,
                    status_mahasiswa: `<span class="badge-status ${item.status_mahasiswa == 'Aktif' ? 'badge-aktif' : item.status_mahasiswa == 'Cuti' ? 'badge-cuti' : 'badge-do'}">
                                        ${item.status_mahasiswa}
                                       </span>`,
                    no_whatsapp: item.no_whatsapp ? `<a href="https://wa.me/${item.no_whatsapp}" target="_blank" rel="noopener">
                                                        <i class="fa-brands fa-whatsapp"></i> ${item.no_whatsapp}
                                                    </a>` : '',
                    aksi: `<button class="btn btn-view btn-sm" title="Lihat Detail"
                            data-nim="${item.nim}"
                            data-nama="${item.nama_lengkap.replace(/(<([^>]+)>)/gi, "")}"
                            data-prodi="${item.prodi?.nama || ''}"
                            data-semester="${item.semester}"
                            data-kelas="${item.kelas}"
                            data-jalur="${item.jalur}"
                            data-tahun="${item.tahun_masuk}"
                            data-status="${item.status_mahasiswa}"
                            data-telp="${item.no_whatsapp || ''}"
                            data-avatar="${item.avatar_url ?? ''}">
                            <i class="fa fa-eye"></i>
                        </button>`
                })) : [];
            }
        },
        columns: [
            { data: 'nim' },
            { data: 'nama_lengkap' },
            { data: 'prodi' },
            { data: 'semester' },
            { data: 'kelas' },
            { data: 'jalur' },
            { data: 'tahun_masuk' },
            { data: 'status_mahasiswa' },
            { data: 'no_whatsapp' },
            { data: 'aksi', orderable: false }
        ]
    });
}

$(document).ready(function() {
    // Select2 untuk filter tahun
    $('#filter-tahun').select2({ minimumResultsForSearch: -1, width: 'style', dropdownCssClass: 'select2-custom' });
    initDataTable($('#filter-tahun').val());

    $('#filter-tahun').on('change', function() {
        initDataTable($(this).val());
    });

    // Event untuk tombol "View"
    $(document).on('click', '.btn-view', function() {
        let avatar = $(this).data('avatar');
        let nama = $(this).data('nama');
        let prodi = $(this).data('prodi');
        $('#view-avatar').attr('src', avatar ? avatar : `https://ui-avatars.com/api/?name=${encodeURIComponent(nama)}`);
        $('#view-nama').html(nama);
        $('#view-prodi').html(prodi);
        $('#view-nim').text($(this).data('nim'));
        $('#view-kelas').text($(this).data('kelas'));
        $('#view-jalur').text($(this).data('jalur'));
        $('#view-tahun').text($(this).data('tahun'));
        $('#view-semester').text($(this).data('semester'));
        $('#view-status').html(
            `<span class="badge-status ${
                $(this).data('status') == 'Aktif' ? 'badge-aktif' : $(this).data('status') == 'Cuti' ? 'badge-cuti' : 'badge-do'
            }">${$(this).data('status')}</span>`
        );
        let telp = $(this).data('telp');
        $('#view-telp').html(telp ? `<a href="https://wa.me/${telp}" target="_blank">${telp}</a>` : '-');
        $('#modalViewMahasiswa').modal('show');
    });

    // Agar modal lebih smooth saat muncul
    $('#modalViewMahasiswa').on('show.bs.modal', function () {
        $(this).find('.modal-dialog').css('opacity', 0);
        setTimeout(() => {
            $(this).find('.modal-dialog').css('opacity', 1);
        }, 70);
    });
    $('#modalViewMahasiswa').on('hide.bs.modal', function () {
        $(this).find('.modal-dialog').css('opacity', 0);
    });
});
</script>
</body>
</html>
