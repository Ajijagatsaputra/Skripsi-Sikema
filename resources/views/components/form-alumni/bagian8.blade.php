<!-- Kesesuaian berkerja bagian 8 -->
<div class="section-card animate-fade-in" id="kesesuaianPekerjaan" style="display: none;">
    <div class="section-header">
        <i class="fas fa-star"></i>
        Kesesuaian Pekerjaan
    </div>
    <div class="section-body">

        <!-- Pertanyaan 1 -->
        <div class="col-md-6 mb-2">
            <label class="form-label">
                <i class="fas fa-link text-primary"></i>
                Seberapa erat hubungan bidang studi dengan pekerjaan anda?
            </label>
            <select name="hubungan_studi_pekerjaan" class="form-select" required>
                <option value="" disabled selected>-- Pilih --</option>
                <option value="sangat_erat">Sangat erat</option>
                <option value="erat">Erat</option>
                <option value="cukup_erat">Cukup erat</option>
                <option value="kurang_erat">Kurang erat</option>
                <option value="tidak_erat">Tidak erat</option>
            </select>
        </div>


        <!-- Pertanyaan 2 -->
        <div class="col-md-6">
            <label class="form-label">
                <i class="fas fa-graduation-cap text-primary"></i>
                Tingkat pendidikan apa yang paling tepat / sesuai untuk pekerjaan anda?
            </label>
            <select name="pendidikan_sesuai_pekerjaan" class="form-select" required>
                <option value="" disabled selected>-- Pilih --</option>
                <option value="lebih_tinggi">Setingkat lebih tinggi</option>
                <option value="sama">Tingkat yang sama</option>
                <option value="lebih_rendah">Setingkat lebih rendah</option>
                <option value="tidak_perlu_pt">Tidak perlu pendidikan tinggi</option>
            </select>
        </div>

    </div>
</div>
