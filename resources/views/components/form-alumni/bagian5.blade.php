<!-- lokasi kerja -->
<div class="section-card animate-fade-in" id="lokasikerja" style="display: none;">
    <div class="section-header">
        <i class="fas fa-building"></i>
        Lokasi Pekerjaan
    </div>
    <div class="section-body">
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label"><i class="fas fa-map-marker-alt text-primary"></i>
                    Alamat Tempat Kerja</label>
                <input type="text" name="alamat_pekerjaan" class="form-control"
                    placeholder="Jalan, Desa/Kelurahan, RT, RW, Kecamatan">
            </div>

            <div class="col-md-6">
                <label class="form-label"><i class="fas fa-map-marker-alt text-primary"></i>
                    Provinsi Tempat Bekerja</label>
                <select name="provinsi" id="provinsi" class="form-select" required>
                    <option value="" disabled selected>-- Pilih Provinsi --</option>
                    @foreach (\Laravolt\Indonesia\Models\Province::pluck('name', 'code') as $code => $name)
                        <option value="{{ $code }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label"><i class="fas fa-map-marker-alt text-primary"></i>
                    Kabupaten / Kota</label>
                <select name="kota" id="kota" class="form-select" required>
                    <option value="" disabled selected>-- Pilih Kabupaten/Kota --</option>
                </select>
            </div>

            <!-- Info pekerjaan tambahan -->
            <div class="col-md-6">
                <label class="form-label"><i class="fas fa-globe text-primary"></i> Apa jenis perusahaan
                    instansi/institusi tempat anda bekerja sekarang?</label>
                <select name="tingkat_usaha_level" class="form-select">
                    <option value="" disabled selected>-- Pilih tingkat --</option>
                    <option value="instansi">1. Instansi pemerintah</option>
                    <option value="Organisasi">2. Organisasi nonProfit/LSM</option>
                    <option value="perusahaan">3. Perusahaan/Instansi Swasta</option>
                    <option value="Wirausaha">4. Wirausaha/Perusahaan Sendiri</option>
                    <option value="Bumn">5. BUMN/BUMD</option>
                    <option value="Instansi">6. Instansi Organisasi Multilateral</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label"><i class="fas fa-building text-primary"></i> Apa Nama
                    Perusahaan/Kantor tempat anda bekerja?</label>
                <input type="text" name="nama_perusahaan" class="form-control" placeholder="PT. Contoh Perusahaan">
            </div>
        </div>
    </div>
</div>
