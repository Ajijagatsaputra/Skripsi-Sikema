<!-- Detail Pekerjaan -->
<div class="section-card animate-fade-in" id="waktuAlumniMendapatkanPekerjaan" style="display: none;">
    <div class="section-header">
        <i class="fas fa-building"></i>
        Anda Mendapatkan Pekerjaan
    </div>
    <div class="section-body">
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label"><i class="fas fa-globe text-primary"></i> Apakah
                    anda mendapatkan pekerjaan sebelum 6 bulan sejak kelulusan?</label>
                <select name="mendapatkan_pekerjaan" class="form-select" id="mendapatkanPekerjaan" onchange>
                    <option value="" disabled selected>-- Pilih tingkat --</option>
                    <option value="<=6bulan">1. Ya, bekerja sebelum 6 bulan sejak lulus
                    </option>
                    <option value=">6bulan">2. Tidak, bekerja setelah 6 bulan sejak lulus
                    </option>
                </select>
            </div>

            <!-- Detail sebelum 6 bulan -->
            <div id="detailKurang6Bulan" class="row g-4 mt-3" style="display: none;">
                <div class="col-md-6">
                    <label class="form-label">Berapa bulan anda mendapatkan pekerjaan pertama
                        sejak lulus?</label>
                    <input type="number" name="bulan_kerja_kurang6" class="form-control" min="0"
                        placeholder="Isikan dengan angka 0-6 bulan">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Berapa rata-rata pendapatan anda per bulan? (Take
                        Home Pay)</label>
                    <input type="number" name="pendapatan_kurang6" class="form-control" min="0"
                        placeholder="diisi angka">
                </div>
            </div>

            <!-- Detail setelah 6 bulan -->
            <div id="detailLebih6Bulan" class="row g-4 mt-3" style="display: none;">
                <div class="col-md-6">
                    <label class="form-label">Berapa bulan anda mendapatkan pekerjaan?</label>
                    <input type="number" name="bulan_kerja_lebih6" class="form-control" min="0"
                        placeholder="diisi angka">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Berapa rata-rata pendapatan anda per bulan? (Take
                        Home Pay)</label>
                    <input type="number" name="pendapatan_lebih6" class="form-control" min="0"
                        placeholder="Isikan dengan angka 7-24 bulan">
                </div>
            </div>
        </div>
    </div>
</div>
