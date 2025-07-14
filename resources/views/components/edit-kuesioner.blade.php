@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Kuesioner Tracer Alumni</h4>
                </div>
                <div class="card-body">
                    {{-- Tampilkan error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('tracer.create') }}">
                        @csrf

                        <h5 class="fw-bold mb-3">Data Pribadi</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" required
                                    value="{{ old('nama', $alumni->nama_lengkap ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>No HP/WA</label>
                                <input type="text" name="no_hp" class="form-control" required
                                    value="{{ old('no_hp', $alumni->no_hp ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required
                                    value="{{ old('email', auth()->user()->email ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tahun Lulus</label>
                                <input type="number" name="tahun_lulus" class="form-control" required min="2000" max="{{ date('Y') }}"
                                    value="{{ old('tahun_lulus', $alumni->tahun_lulus ?? '') }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label>Alamat</label>
                                <input type="text" name="alamat" class="form-control" required
                                    value="{{ old('alamat', $alumni->alamat ?? '') }}">
                            </div>
                        </div>

                        <h5 class="fw-bold mt-4 mb-3">Status Pekerjaan</h5>
                        <div class="mb-3 d-flex gap-3">
                            <div class="form-check">
                                <input type="radio" name="bekerja" id="bekerja_ya" value="ya" class="form-check-input"
                                    {{ old('bekerja', $tracer->bekerja ?? '') == 'ya' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="bekerja_ya">Bekerja</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="bekerja" id="bekerja_wirausaha" value="wirausaha" class="form-check-input"
                                    {{ old('bekerja', $tracer->bekerja ?? '') == 'wirausaha' ? 'checked' : '' }}>
                                <label class="form-check-label" for="bekerja_wirausaha">Wirausaha</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="bekerja" id="bekerja_tidak" value="tidak" class="form-check-input"
                                    {{ old('bekerja', $tracer->bekerja ?? '') == 'tidak' ? 'checked' : '' }}>
                                <label class="form-check-label" for="bekerja_tidak">Tidak Bekerja</label>
                            </div>
                        </div>

                        {{-- Pekerjaan --}}
                        <div id="detailPekerjaan" style="display: {{ old('bekerja', $tracer->bekerja ?? '') == 'ya' ? 'block' : 'none' }};">
                            <div class="alert alert-info py-2">*Isi jika memilih status <b>Bekerja</b></div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Nama Perusahaan</label>
                                    <input type="text" name="nama_perusahaan" class="form-control"
                                        value="{{ old('nama_perusahaan', $tracer->nama_perusahaan ?? '') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control"
                                        value="{{ old('jabatan', $tracer->jabatan ?? '') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Alamat Pekerjaan</label>
                                    <input type="text" name="alamat_pekerjaan" class="form-control"
                                        value="{{ old('alamat_pekerjaan', $tracer->alamat_pekerjaan ?? '') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Gaji</label>
                                    <input type="text" name="gaji" class="form-control"
                                        value="{{ old('gaji', $tracer->gaji ?? '') }}">
                                </div>
                            </div>
                        </div>

                        {{-- Wirausaha --}}
                        <div id="detailWirausaha" style="display: {{ old('bekerja', $tracer->bekerja ?? '') == 'wirausaha' ? 'block' : 'none' }};">
                            <div class="alert alert-info py-2">*Isi jika memilih status <b>Wirausaha</b></div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Nama Usaha</label>
                                    <input type="text" name="nama_usaha" class="form-control"
                                        value="{{ old('nama_usaha', $tracer->nama_usaha ?? '') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Posisi/Jabatan</label>
                                    <select name="posisi_usaha" class="form-select">
                                        <option value="">-- Pilih posisi --</option>
                                        <option value="founder" {{ old('posisi_usaha', $tracer->posisi_usaha ?? '') == 'founder' ? 'selected' : '' }}>Founder</option>
                                        <option value="co-founder" {{ old('posisi_usaha', $tracer->posisi_usaha ?? '') == 'co-founder' ? 'selected' : '' }}>Co-Founder</option>
                                        <option value="staff" {{ old('posisi_usaha', $tracer->posisi_usaha ?? '') == 'staff' ? 'selected' : '' }}>Staff</option>
                                        <option value="freelance" {{ old('posisi_usaha', $tracer->posisi_usaha ?? '') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Tingkat Usaha</label>
                                    <select name="tingkat_usaha" class="form-select">
                                        <option value="">-- Pilih tingkat --</option>
                                        <option value="lokal" {{ old('tingkat_usaha', $tracer->tingkat_usaha ?? '') == 'lokal' ? 'selected' : '' }}>Lokal</option>
                                        <option value="nasional" {{ old('tingkat_usaha', $tracer->tingkat_usaha ?? '') == 'nasional' ? 'selected' : '' }}>Nasional</option>
                                        <option value="internasional" {{ old('tingkat_usaha', $tracer->tingkat_usaha ?? '') == 'internasional' ? 'selected' : '' }}>Internasional</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Pendapatan Usaha</label>
                                    <select name="pendapatan_usaha" class="form-select">
                                        <option value="">-- Pilih pendapatan --</option>
                                        <option value="0-2000000" {{ old('pendapatan_usaha', $tracer->pendapatan_usaha ?? '') == '0-2000000' ? 'selected' : '' }}>0 - 2 juta</option>
                                        <option value="2000001-4000000" {{ old('pendapatan_usaha', $tracer->pendapatan_usaha ?? '') == '2000001-4000000' ? 'selected' : '' }}>&gt; 2 - 4 juta</option>
                                        <option value="4000001-999999999" {{ old('pendapatan_usaha', $tracer->pendapatan_usaha ?? '') == '4000001-999999999' ? 'selected' : '' }}>&gt; 4 juta</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Alamat Usaha</label>
                                    <input type="text" name="alamat_usaha" class="form-control"
                                        value="{{ old('alamat_usaha', $tracer->alamat_usaha ?? '') }}">
                                </div>
                            </div>
                        </div>

                        {{-- Kompetensi --}}
                        <h5 class="fw-bold mt-4 mb-3">Kompetensi Lulusan</h5>
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
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Etika/Bahasa Inggris</label>
                                <select name="etika" class="form-select" required>
                                    @foreach ($opsi_kompetensi as $val => $label)
                                        <option value="{{ $val }}" {{ old('etika', $tracer->etika ?? '') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Keahlian</label>
                                <select name="keahlian" class="form-select" required>
                                    @foreach ($opsi_kompetensi as $val => $label)
                                        <option value="{{ $val }}" {{ old('keahlian', $tracer->keahlian ?? '') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Penggunaan Teknologi</label>
                                <select name="penggunaanteknologi" class="form-select" required>
                                    @foreach ($opsi_kompetensi as $val => $label)
                                        <option value="{{ $val }}" {{ old('penggunaanteknologi', $tracer->penggunaanteknologi ?? '') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Teamwork</label>
                                <select name="teamwork" class="form-select" required>
                                    @foreach ($opsi_kompetensi as $val => $label)
                                        <option value="{{ $val }}" {{ old('teamwork', $tracer->teamwork ?? '') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Komunikasi</label>
                                <select name="komunikasi" class="form-select" required>
                                    @foreach ($opsi_kompetensi as $val => $label)
                                        <option value="{{ $val }}" {{ old('komunikasi', $tracer->komunikasi ?? '') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Pengembangan Skills</label>
                                <select name="pengembangan" class="form-select" required>
                                    @foreach ($opsi_kompetensi as $val => $label)
                                        <option value="{{ $val }}" {{ old('pengembangan', $tracer->pengembangan ?? '') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Evaluasi Pendidikan<br>
                                <span class="text-muted small">Apakah kurikulum kampus relevan dengan pekerjaan Anda sekarang?</span>
                            </label>
                            <select name="relevansi_kurikulum" class="form-select" required>
                                <option value="">-- Pilih tingkat relevansi --</option>
                                <option value="sangat_relevan" {{ old('relevansi_kurikulum', $tracer->relevansi_pekerjaan ?? '') == 'sangat_relevan' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ Sangat Relevan</option>
                                <option value="relevan" {{ old('relevansi_kurikulum', $tracer->relevansi_pekerjaan ?? '') == 'relevan' ? 'selected' : '' }}>⭐⭐⭐⭐ Relevan</option>
                                <option value="cukup" {{ old('relevansi_kurikulum', $tracer->relevansi_pekerjaan ?? '') == 'cukup' ? 'selected' : '' }}>⭐⭐⭐ Cukup Relevan</option>
                                <option value="tidak_relevan" {{ old('relevansi_kurikulum', $tracer->relevansi_pekerjaan ?? '') == 'tidak_relevan' ? 'selected' : '' }}>⭐⭐ Kurang Relevan</option>
                                <option value="sangat_tidak_relevan" {{ old('relevansi_kurikulum', $tracer->relevansi_pekerjaan ?? '') == 'sangat_tidak_relevan' ? 'selected' : '' }}>⭐ Tidak Relevan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Saran & Komentar</label>
                            <textarea name="saran" class="form-control" rows="3">{{ old('saran', $tracer->saran ?? '') }}</textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleStatus() {
        let val = document.querySelector('input[name="bekerja"]:checked')?.value;
        document.getElementById('detailPekerjaan').style.display = (val === 'ya') ? 'block' : 'none';
        document.getElementById('detailWirausaha').style.display = (val === 'wirausaha') ? 'block' : 'none';
    }
    document.querySelectorAll('input[name="bekerja"]').forEach(function(el) {
        el.addEventListener('change', toggleStatus);
    });
    // Initial
    toggleStatus();
</script>
@endsection
