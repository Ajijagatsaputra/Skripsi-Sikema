@extends('layout')

@section('content')
    @include('components.navbar')

    <!-- Panggil CSS di Folder Public -->
    <link rel="stylesheet" href="{{ asset('css/edit-kuesioner-tracer-study.css') }}">
    <body>
        <div class="container questionnaire-container">
            <div class="header-section mb-4">
                <h1>Edit Kuesioner Tracer Study</h1>
                <p>Perbarui data tracer study alumni Anda dengan detail terbaru</p>
            </div>

            <form method="POST" action="{{ route('kuesioner.update', ['id' => $tracer->id]) }}">
                @csrf
                @method('PUT')

                <div class="section-title"><i class="fas fa-user-circle me-2"></i>Informasi Pribadi</div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" name="nama" class="form-control"
                            value="{{ old('nama', $alumni->nama_lengkap ?? '') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="no_hp" class="form-label">No. HP</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <input type="text" name="no_hp" class="form-control"
                            value="{{ old('no_hp', $alumni->no_hp ?? '') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Aktif</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', auth()->user()->email) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                        <input type="number" name="tahun_lulus" class="form-control"
                            value="{{ old('tahun_lulus', $alumni->tahun_lulus ?? '') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        <input type="text" name="alamat" class="form-control"
                            value="{{ old('alamat', $alumni->alamat ?? '') }}" required>
                    </div>
                </div>

                <div class="section-title"><i class="fas fa-briefcase me-2"></i>Status Saat Ini</div>
                <div class="mb-3">
                    <label for="bekerja" class="form-label">Status</label>
                    <select name="bekerja" id="bekerja" class="form-select" required>
                        <option value="ya" {{ old('bekerja', $tracer->bekerja ?? '') == 'ya' ? 'selected' : '' }}>
                            Bekerja</option>
                        <option value="wirausaha"
                            {{ old('bekerja', $tracer->bekerja ?? '') == 'wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                        <option value="tidak" {{ old('bekerja', $tracer->bekerja ?? '') == 'tidak' ? 'selected' : '' }}>
                            Belum/Tidak Bekerja</option>
                    </select>
                </div>

                <div id="infoPekerjaan"
                    style="display: {{ old('bekerja', $tracer->bekerja ?? '') == 'ya' ? 'block' : 'none' }};">
                    <div class="section-title"><i class="fas fa-building me-2"></i>Informasi Pekerjaan</div>
                    <div class="mb-3">
                        <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                            <input type="text" name="nama_perusahaan" class="form-control"
                                value="{{ old('nama_perusahaan', $tracer->nama_perusahaan ?? '') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                            <input type="text" name="jabatan" class="form-control"
                                value="{{ old('jabatan', $tracer->jabatan ?? '') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat_pekerjaan" class="form-label">Alamat Perusahaan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                            <input type="text" name="alamat_pekerjaan" class="form-control"
                                value="{{ old('alamat_pekerjaan', $tracer->alamat_pekerjaan ?? '') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="gaji" class="form-label">Gaji atau Pendapatan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" name="gaji" class="form-control"
                                value="{{ old('gaji', $tracer->gaji ?? '') }}">
                        </div>
                    </div>
                </div>

                <div id="infoWirausaha"
                    style="display: {{ old('bekerja', $tracer->bekerja ?? '') == 'wirausaha' ? 'block' : 'none' }};">
                    <div class="section-title"><i class="fas fa-lightbulb me-2"></i>Informasi Wirausaha</div>
                    <div class="mb-3">
                        <label for="nama_usaha" class="form-label">Nama Usaha</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-store"></i></span>
                            <input type="text" name="nama_usaha" class="form-control"
                                value="{{ old('nama_usaha', $tracer->nama_usaha ?? '') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="posisi_usaha" class="form-label">Posisi Anda dalam Usaha</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-chart-line"></i></span>
                            <input type="text" name="posisi_usaha" class="form-control"
                                value="{{ old('posisi_usaha', $tracer->posisi_usaha ?? '') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tingkat_usaha" class="form-label">Skala Usaha (contoh: Lokal/Nasional)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                            <input type="text" name="tingkat_usaha" class="form-control"
                                value="{{ old('tingkat_usaha', $tracer->tingkat_usaha ?? '') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat_usaha" class="form-label">Alamat Usaha</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                            <input type="text" name="alamat_usaha" class="form-control"
                                value="{{ old('alamat_usaha', $tracer->alamat_usaha ?? '') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pendapatan_usaha" class="form-label">Pendapatan Usaha Per Bulan (contoh:
                            0- 3000000)</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" name="pendapatan_usaha" class="form-control"
                                value="{{ old('pendapatan_usaha', $tracer->pendapatan_usaha ?? '') }}">
                        </div>
                    </div>
                </div>

                <div class="section-title"><i class="fas fa-cogs me-2"></i>Kompetensi yang Dimiliki</div>
                <div class="mb-3">
                    @php
                        $opsi_kompetensi = [
                            '' => '-- Pilih Level --',
                            'sangat_baik' => 'Sangat Baik',
                            'baik' => 'Baik',
                            'cukup' => 'Cukup',
                            'kurang_baik' => 'Kurang Baik',
                            'tidak_baik' => 'Tidak Baik',
                        ];
                    @endphp
                    <label class="form-label">Etika</label>
                    <select name="etika" class="form-select" required>
                        @foreach ($opsi_kompetensi as $val => $label)
                            <option value="{{ $val }}"
                                {{ old('etika', $tracer->etika) == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keahlian</label>
                    <select name="keahlian" class="form-select" required>
                        @foreach ($opsi_kompetensi as $val => $label)
                            <option value="{{ $val }}"
                                {{ old('keahlian', $tracer->keahlian) == $val ? 'selected' : '' }}>{{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Penggunaan Teknologi</label>
                    <select name="penggunaanteknologi" class="form-select" required>
                        @foreach ($opsi_kompetensi as $val => $label)
                            <option value="{{ $val }}"
                                {{ old('penggunaanteknologi', $tracer->penggunaanteknologi) == $val ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kerja Sama Tim</label>
                    <select name="teamwork" class="form-select" required>
                        @foreach ($opsi_kompetensi as $val => $label)
                            <option value="{{ $val }}"
                                {{ old('teamwork', $tracer->teamwork) == $val ? 'selected' : '' }}>{{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Komunikasi</label>
                    <select name="komunikasi" class="form-select" required>
                        @foreach ($opsi_kompetensi as $val => $label)
                            <option value="{{ $val }}"
                                {{ old('komunikasi', $tracer->komunikasi) == $val ? 'selected' : '' }}>{{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pengembangan Skils</label>
                    <select name="pengembangan" class="form-select" required>
                        @foreach ($opsi_kompetensi as $val => $label)
                            <option value="{{ $val }}"
                                {{ old('pengembangan', $tracer->pengembangan) == $val ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="section-title"><i class="fas fa-comments me-2"></i>Evaluasi dan Saran</div>
                <div class="mb-3">
                    <label class="form-label">Evaluasi Pendidikan<br><span class="text-muted small">Apakah kurikulum
                            kampus relevan dengan pekerjaan Anda sekarang?</span></label>
                    <select name="relevansi_kurikulum" class="form-select" required>
                        <option value="" disabled>-- Pilih tingkat relevansi --</option>
                        <option value="sangat_relevan"
                            {{ old('relevansi_kurikulum', $tracer->relevansi_pekerjaan) == 'sangat_relevan' ? 'selected' : '' }}>
                            ⭐⭐⭐⭐⭐ Sangat Relevan</option>
                        <option value="relevan"
                            {{ old('relevansi_kurikulum', $tracer->relevansi_pekerjaan) == 'relevan' ? 'selected' : '' }}>
                            ⭐⭐⭐⭐ Relevan</option>
                        <option value="cukup"
                            {{ old('relevansi_kurikulum', $tracer->relevansi_pekerjaan) == 'cukup' ? 'selected' : '' }}>⭐⭐⭐
                            Cukup Relevan</option>
                        <option value="tidak_relevan"
                            {{ old('relevansi_kurikulum', $tracer->relevansi_pekerjaan) == 'tidak_relevan' ? 'selected' : '' }}>
                            ⭐⭐ Kurang Relevan</option>
                        <option value="sangat_tidak_relevan"
                            {{ old('relevansi_kurikulum', $tracer->relevansi_pekerjaan) == 'sangat_tidak_relevan' ? 'selected' : '' }}>
                            ⭐ Tidak Relevan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="saran" class="form-label">Saran untuk Institusi</label>
                    <textarea name="saran" class="form-control" rows="4"
                        placeholder="Berikan saran Anda untuk pengembangan institusi... ">{{ old('saran', $tracer->saran ?? '') }}</textarea>
                </div>

                <div class="text-center mt-5">
                    <button type="submit" class="btn-submit"><i class="fas fa-save me-2"></i>Update Kuesioner</button>
                </div>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="{{ asset('assets/css/oneui.min.css') }}">
        <script src="{{ asset('assets/js/plugins/penggunatables/jquery.penggunaTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/penggunatables-bs5/js/penggunaTables.bootstrap5.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                // Function to toggle sections based on 'bekerja' status
                function toggleStatusSections() {
                    const status = $('#bekerja').val();
                    if (status === 'ya') {
                        $('#infoPekerjaan').slideDown();
                        $('#infoWirausaha').slideUp();
                    } else if (status === 'wirausaha') {
                        $('#infoPekerjaan').slideUp();
                        $('#infoWirausaha').slideDown();
                    } else {
                        $('#infoPekerjaan').slideUp();
                        $('#infoWirausaha').slideUp();
                    }
                }

                // Initial call to set correct visibility on page load
                toggleStatusSections();

                // Bind change event to the 'bekerja' select element
                $('#bekerja').on('change', function() {
                    toggleStatusSections();
                });

                // SweetAlert for success message
                @if (session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session('success') }}',
                        showConfirmButton: false,
                        timer: 3000, // Close after 3 seconds
                        customClass: {
                            popup: 'alert-success-custom'
                        }
                    });
                @endif
            });
        </script>
    </body>
@endsection
