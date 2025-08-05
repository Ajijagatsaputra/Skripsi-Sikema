<!DOCTYPE html>
<html lang="id">

@include('components.admin.head')
<!-- Select2 & FontAwesome CDN -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
<style>
    .table-custom tbody tr:nth-child(odd) { background-color: #f7fafc; }
    .table-custom tbody tr:nth-child(even) { background-color: #fff; }
    .table-custom tbody tr:hover { background: #e3f2fd; transition: background 0.28s; }
    .badge-status {
        display: inline-block; padding: .32em 1em; border-radius: 1em;
        font-size: .97em; font-weight: 500; box-shadow: 0 1px 5px rgba(44,62,80,.08);
    }
    .badge-aktif { background: #e6faef; color: #26946d;}
    .badge-non { background: #fbeee2; color: #e39113;}
    .badge-lain { background: #ffe0e0; color: #e53935;}
    .btn-detail {
        background: linear-gradient(90deg, #e6f0fc 70%, #e9edfa 100%);
        color: #19568d; border-radius: 1.3em; transition: all .2s;
        box-shadow: 0 2px 8px rgba(60,60,100,.05);
    }
    .btn-detail:hover { background: #dbeafe; color: #103f69;}
    /* Modal animasi & card style */
    .modal.fade .modal-dialog {
        transform: translateY(50px) scale(.98); transition: all .3s cubic-bezier(.42,0,.34,1.01); opacity: 0;
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
        border: none; border-radius: 1.6rem 1.6rem 0 0;
        background: linear-gradient(90deg,#dbeafd 80%,#fafdff 100%);
    }
    .modal-title { font-weight: 600; color: #1a569b; letter-spacing: .5px;}
    .btn-close { background: none; opacity: .7;}
    .btn-close:hover { opacity: 1; }
    .modal-avatar {
        width: 90px; height: 90px; object-fit: cover;
        border-radius: 50%;
        border: 3px solid transparent;
        background: linear-gradient(#fff,#fff) padding-box, linear-gradient(135deg,#48bb78 40%,#2563eb 100%) border-box;
        box-shadow: 0 2px 18px 2px rgba(44,62,80,.11);
        margin-bottom: 1em;
    }
    .modal-profile-title { font-weight: 700; font-size: 1.22rem; margin-bottom:.12em;}
    .dl-grid {
        display: grid; grid-template-columns: 1fr 2.4fr; row-gap: .36em; column-gap:.8em;
    }
    .dl-grid .ico { width:24px;text-align:center;opacity:.75;}
    @media (max-width: 575px) {
        .dl-grid { grid-template-columns: 1fr; }
        .modal-content { border-radius:1rem;}
        .modal-avatar { width:65px; height:65px;}
    }
    /* Select2 style tweak */
    .select2-container .select2-selection--single {
        height: 38px !important; padding: 6px 12px; border-radius: 0.375rem;
    }
</style>

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
                    <h1 class="h3 fw-bold mb-0">Data Dosen</h1>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="block block-rounded border shadow-sm">
                <div class="block-content block-content-full">
                    <div class="mb-4">
                        <label for="filter-tahun" class="form-label fw-semibold">Filter Tahun Akademik:</label>
                        <select id="filter-tahun" class="form-select w-auto d-inline-block" style="min-width:130px">
                            <option value="">Memuat data...</option>
                        </select>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-custom table-bordered table-striped table-hover align-middle js-dataTable-full w-100">
                            <thead class="table-light text-center">
                            <tr>
                                <th>Kode Dosen</th>
                                <th>Nama Dosen</th>
                                <th>Prodi</th>
                                <th>Status</th>
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

<!-- Modal Detail Dosen -->
<div class="modal fade" id="modalDetailDosen" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalDetailLabel">
                    <i class="fa-solid fa-id-badge me-2"></i> Detail Dosen
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center px-4 pt-4 pb-3">
                <img src="" id="detail-avatar" class="modal-avatar" alt="Avatar Dosen">
                <div class="modal-profile-title mb-1" id="detail-nama"></div>
                <div class="mb-3" id="detail-prodi" style="color:#767676"></div>
                <div class="dl-grid text-start mt-3">
                    <div class="ico"><i class="fa-solid fa-id-card"></i></div> <div id="detail-kode"></div>
                    <div class="ico"><i class="fa-solid fa-clipboard-check"></i></div> <div id="detail-status"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
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
    $(document).ready(function () {
        // Select2 untuk filter tahun
        $('#filter-tahun').select2({ minimumResultsForSearch: -1, width: 'style', dropdownCssClass: 'select2-custom' });

        // Load Tahun Akademik
        $.ajax({
            url: "{{ route('api.tahun-akademik') }}",
            type: 'GET',
            success: function (response) {
                let select = $('#filter-tahun');
                select.empty();

                if (response.status && response.data.length) {
                    response.data.forEach(item => {
                        const selected = item.status == 1 ? 'selected' : '';
                        select.append(`<option value="${item.kode}" ${selected}>${item.tahun_akademik}</option>`);
                    });
                    $('.js-dataTable-full').DataTable().ajax.reload();
                } else {
                    select.append(`<option value="">Tidak ada data</option>`);
                }
            },
            error: function () {
                $('#filter-tahun').html('<option value="">Gagal memuat</option>');
            }
        });

        $('#filter-tahun').on('change', function () {
            $('.js-dataTable-full').DataTable().ajax.reload();
        });

        // DataTable
        $('.js-dataTable-full').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            responsive: true,
            autoWidth: false,
            pageLength: 8,
            dom: "<'row mb-3'" +
                "<'col-md-6 d-flex align-items-center gap-2'B>" +
                "<'col-md-6 text-end'f>>" +
                "<'row'<'col-sm-12 table-responsive'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-outline-success btn-sm',
                    text: '<i class="fa fa-file-excel me-1"></i> Excel',
                    exportOptions: { columns: ':not(:last-child)' }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-outline-danger btn-sm',
                    text: '<i class="fa fa-file-pdf me-1"></i> PDF',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    exportOptions: { columns: ':not(:last-child)' }
                },
                {
                    extend: 'print',
                    className: 'btn btn-outline-info btn-sm',
                    text: '<i class="fa fa-print me-1"></i> Cetak',
                    exportOptions: { columns: ':not(:last-child)' }
                }
            ],
            ajax: {
                url: '/api/dosen',
                type: 'GET',
                data: function (d) {
                    d.kode_tahun_akademik = $('#filter-tahun').val();
                },
                dataSrc: function (json) {
                    let return_data = [];
                    if (json.status && json.data.length) {
                        $.each(json.data, function (i, item) {
                            // Status badge
                            let statusText = item.status || '-';
                            let statusClass = 'badge-lain';
                            if (statusText.toLowerCase() === 'aktif') statusClass = 'badge-aktif';
                            else if (statusText.toLowerCase().includes('non')) statusClass = 'badge-non';

                            // Avatar auto dari nama
                            let avatarUrl = item.avatar_url
                                ? item.avatar_url
                                : 'https://ui-avatars.com/api/?name=' + encodeURIComponent(item.name || 'Dosen');

                            return_data.push({
                                'kd_dosen': item.kd_dosen || '',
                                'name': `
                                    <div class="d-flex align-items-center">
                                        <img src="${avatarUrl}" alt="Avatar" style="width:30px;height:30px;border-radius:50%;margin-right:8px;object-fit:cover;border:2px solid #e3e3e3;">
                                        <span>${item.name || ''}</span>
                                    </div>`,
                                'prodi': item.prodi || '-',
                                'status': `<span class="badge-status ${statusClass}">${statusText}</span>`,
                                'aksi': `<button class="btn btn-detail btn-sm"
                                            data-kode="${item.kd_dosen}"
                                            data-nama="${item.name}"
                                            data-prodi="${item.prodi}"
                                            data-status="${statusText}"
                                            data-avatar="${avatarUrl}">
                                            <i class="fa fa-eye me-1"></i>
                                        </button>`
                            });
                        });
                    }
                    return return_data;
                }
            },
            columns: [
                { data: 'kd_dosen' },
                { data: 'name' },
                { data: 'prodi' },
                { data: 'status' },
                { data: 'aksi', orderable: false }
            ]
        });

        // Modal event
        $(document).on('click', '.btn-detail', function () {
            $('#detail-kode').text($(this).data('kode'));
            $('#detail-nama').html($(this).data('nama'));
            $('#detail-prodi').html($(this).data('prodi'));
            let status = $(this).data('status') || '-';
            let statusClass = 'badge-lain';
            if (status.toLowerCase() === 'aktif') statusClass = 'badge-aktif';
            else if (status.toLowerCase().includes('non')) statusClass = 'badge-non';
            $('#detail-status').html(`<span class="badge-status ${statusClass}">${status}</span>`);
            $('#detail-avatar').attr('src', $(this).data('avatar'));
            $('#modalDetailDosen').modal('show');
        });

        // Modal smooth animasi
        $('#modalDetailDosen').on('show.bs.modal', function () {
            $(this).find('.modal-dialog').css('opacity', 0);
            setTimeout(() => {
                $(this).find('.modal-dialog').css('opacity', 1);
            }, 70);
        });
        $('#modalDetailDosen').on('hide.bs.modal', function () {
            $(this).find('.modal-dialog').css('opacity', 0);
        });
    });
</script>
</body>
</html>
