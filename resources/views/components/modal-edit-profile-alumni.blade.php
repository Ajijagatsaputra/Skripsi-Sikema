<!-- Modal Edit Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title" id="editProfileModalLabel">Edit Data Diri</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>

        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">NIM</label>
              <input type="text" name="nim" value="{{ $alumni->nim }}" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Nama Lengkap</label>
              <input type="text" name="nama_lengkap" value="{{ $alumni->nama_lengkap }}" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Prodi</label>
              <input type="text" name="prodi" value="{{ $alumni->prodi }}" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Kelas</label>
              <input type="text" name="kelas" value="{{ $alumni->kelas }}" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Jalur Masuk</label>
              <input type="text" name="jalur" value="{{ $alumni->jalur }}" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">No. HP</label>
              <input type="text" name="no_hp" value="{{ $alumni->no_hp }}" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Alamat</label>
              <input type="text" name="alamat" value="{{ $alumni->alamat }}" class="form-control">
            </div>
            <div class="col-md-3">
              <label class="form-label">Tahun Masuk</label>
              <input type="number" name="tahun_masuk" value="{{ $alumni->tahun_masuk }}" class="form-control">
            </div>
            <div class="col-md-3">
              <label class="form-label">Tahun Lulus</label>
              <input type="number" name="tahun_lulus" value="{{ $alumni->tahun_lulus }}" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Status Mahasiswa</label>
              <select name="status_mahasiswa" class="form-select">
                <option value="Lulus" {{ $alumni->status_mahasiswa == 'Lulus' ? 'selected' : '' }}>Lulus</option>
                <option value="Aktif" {{ $alumni->status_mahasiswa == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Cuti" {{ $alumni->status_mahasiswa == 'Cuti' ? 'selected' : '' }}>Cuti</option>
                <option value="DO" {{ $alumni->status_mahasiswa == 'DO' ? 'selected' : '' }}>Drop Out</option>
              </select>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>
