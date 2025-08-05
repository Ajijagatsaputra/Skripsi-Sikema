<div class="section-card animate-fade-in" id="caraMendapatkanPekerjaan" style="display: none;">
                                <div class="section-header">
                                    <i class="fas fa-briefcase"></i>
                                    Cara Mendapatkan Pekerjaan
                                </div>
                                <div class="section-body">
                                    <!-- Pertanyaan Utama -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">
                                            <i class="fas fa-question-circle text-primary"></i>
                                            Kapan anda mulai mencari pekerjaan?
                                        </label>
                                        <select name="waktu_cari_kerja" id="waktuCariKerja" class="form-select" required>
                                            <option value="" disabled selected>-- Pilih Jawaban --</option>
                                            <option value="sebelum_lulus">Sebelum lulus</option>
                                            <option value="setelah_lulus">Setelah lulus</option>
                                            <option value="tidak_mencari">Saya tidak mencari pekerjaan</option>
                                        </select>
                                    </div>

                                    <!-- Pertanyaan Lanjutan: Sebelum Lulus -->
                                    <div class="mb-4" id="sebelumLulusGroup" style="display: none;">
                                        <label class="form-label fw-bold">
                                            <i class="fas fa-clock text-primary"></i>
                                            Berapa bulan sebelum lulus anda mulai mencari pekerjaan?
                                        </label>
                                        <input type="number" name="bulan_sebelum_lulus" class="form-control"
                                            min="0" placeholder="Contoh: 2">
                                    </div>

                                    <!-- Pertanyaan Lanjutan: Setelah Lulus -->
                                    <div class="mb-4" id="setelahLulusGroup" style="display: none;">
                                        <label class="form-label fw-bold">
                                            <i class="fas fa-clock text-primary"></i>
                                            Berapa bulan setelah lulus anda mulai mencari pekerjaan?
                                        </label>
                                        <input type="number" name="bulan_setelah_lulus" class="form-control"
                                            min="0" placeholder="Contoh: 1">
                                    </div>
                                </div>
                            </div>
