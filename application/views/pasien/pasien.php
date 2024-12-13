<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Form Data Pasien</h5>
        <button type="button" class="btn-close closed" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
        <form id="formPasien">
          <!-- Nama -->
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
              <input type="text" class="form-control" id="nama" placeholder="Masukkan nama" required>
            </div>
          </div>
          <!-- NIK -->
          <div class="mb-3">
            <label for="nik" class="form-label">NIK</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-id-card"></i></span>
              <input type="text" class="form-control angka" id="nik" placeholder="Masukkan NIK" maxlength="16" required>
            </div>
          </div>
          <!-- Jenis Kelamin -->
          <div class="mb-3">
            <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
              <select class="form-select" id="jenisKelamin" required>
                <option value="">Pilih jenis kelamin</option>
              </select>
            </div>
          </div>
          <!-- Golongan Darah -->
          <div class="mb-3">
            <label for="golongandarah" class="form-label">Golongan Darah</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-tint"></i></span>
              <select class="form-select" id="golongandarah" required>
                <option value="">Pilih golongan darah</option>
              </select>
            </div>
          </div>
          <!-- Usia -->
          <div class="mb-3">
            <label for="usia" class="form-label">Usia</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
              <input type="number" class="form-control angka" id="usia" placeholder="Masukkan usia" required>
            </div>
          </div>
          <!-- Alamat -->
          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-home"></i></span>
              <textarea class="form-control" id="alamat" rows="3" placeholder="Masukkan alamat" required></textarea>
            </div>
          </div>
          <!-- Tanggal Lahir -->
          <div class="mb-3">
            <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-calendar"></i></span>
              <input type="date" class="form-control" id="tanggalLahir" required>
            </div>
          </div>
        </form>
      </div>
      <!-- Modal Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary closed" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary btn-submit" onclick="simpan_data()">Simpan</button>
        <button type="button" class="btn btn-warning btn-editen" onclick="update_data()">Update</button>
      </div>
    </div>
  </div>
</div>

<div class="card tableU">
    <div class="card-header">
        <h3 class="card-title">Daftar Pasien</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body ">
        <button type="button" class="btn btn-primary btn-add btn-animated" data-toggle="modal" data-target="#formModal">
            Add
        </button>
        <button type="button" class="btn btn-success btn-animated" onclick="load_data()">
            Refresh
        </button>
        <table id="table2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Gender</th>
                    <th>Usia</th>
                    <th>Alamat</th>
                    <th>Edit</th>
                    <th>Del</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>