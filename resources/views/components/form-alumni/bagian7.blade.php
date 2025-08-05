<!-- Detail LanjutStudy bagian 7-->
                    <div class="section-card animate-fade-in" id="detailLanjutStudy" style="display: none;">
                        <div class="section-header">
                            <i class="fas fa-building"></i>
                            Detail Melanjutkan Pendidikan
                        </div>
                        <div class="section-body">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="fas fa-university text-primary"></i>
                                        Nama Perguruan Tinggi
                                    </label>
                                    <input type="text" name="universitas" class="form-control"
                                        placeholder="Contoh: Universitas Indonesia">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="fas fa-hand-holding-usd text-primary"></i>
                                        Sumber Biaya Studi Lanjut
                                    </label>
                                    <select name="sumber_biaya" class="form-select" required>
                                        <option value="" disabled selected>-- Pilih sumber biaya --</option>
                                        <option value="biaya_sendiri_orangtua">Biaya sendiri / orangtua</option>
                                        <option value="beasiswa">Beasiswa</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                        Program Studi
                                    </label>
                                    <input type="text" name="program_studi" class="form-control"
                                        placeholder="Teknik Informatika">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="fas fa-calendar-alt text-primary"></i>
                                        Tanggal Masuk
                                    </label>
                                    <input type="date" name="tanggal_masuk" class="form-control" required>
                                </div>


                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                        Alamat Perguruan Tinggi
                                    </label>
                                    <input type="text" name="lokasi_universitas" class="form-control"
                                        placeholder="Jln. Perintis Kemerdakaan Tegal.">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="fas fa-hand-holding-usd text-primary"></i>
                                        Saat kuliah di Politeknik Harapan Bersama,sumber biaya kuliah
                                    </label>
                                    <select name="sumber_biaya" class="form-select" id="sumberBiayaSelect" required>
                                        <option value="" disabled selected>-- Pilih sumber dana --</option>
                                        <option value="biaya_sendiri_orangtua">Biaya sendiri / orangtua</option>
                                        <option value="beasiswa_adik">Beasiswa ADIK</option>
                                        <option value="beasiswa_bidikmisi">Beasiswa BIDIKMISI</option>
                                        <option value="beasiswa_ppa">Beasiswa PPA</option>
                                        <option value="beasiswa_afirmasi">Beasiswa AFIRMASI</option>
                                        <option value="beasiswa_swasta">Beasiswa Perusahaan/Swasta</option>
                                        <option value="lainnya">Lainnya, tuliskan</option>
                                    </select>

                                    <div id="sumberBiayaLainnya" style="display: none;" class="mt-3">
                                        <input type="text" name="sumber_biaya_lainnya" class="form-control"
                                            placeholder="Tuliskan sumber dana lainnya">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
