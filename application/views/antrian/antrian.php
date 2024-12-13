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
          <!-- Keluhan -->
          <div class="mb-3">
            <label for="Keluhan" class="form-label">Keluhan</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-stethoscope"></i></span>
              <input type="text" class="form-control" id="Keluhan" placeholder="Masukkan Keluhan" required>
            </div>
          </div>
          <!-- Poli -->
          <div class="mb-3">
            <label for="Poli" class="form-label">Poli</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-clinic-medical"></i></span>
              <select class="form-select" id="Poli" required>
                <option value="">Pilih Poli</option>
              </select>
            </div>
          </div>
          <!-- Name -->
          <div class="mb-3">
            <label for="Name" class="form-label">Name</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
              <input type="text" class="form-control" id="Name" placeholder="Masukkan Nama" readonly disabled>
            </div>
          </div>
          <!-- NIK -->
          <div class="mb-3">
            <label for="NIK" class="form-label">NIK</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
              <select class="form-select" id="NIK" required onchange="updateName()">
              </select>
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
    <h3 class="card-title">Antrian</h3>
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
          <th>Kode Antrian</th>
          <th>Poli</th>
          <th>Keluhan</th>
          <th>NIK</th>
          <th>Nama</th>
          <th>Menu</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>