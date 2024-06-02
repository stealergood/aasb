<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales">

                        <div class="card-body">
                            <h5 class="card-title">Daftar Kelas</h5>

                            <button id="tambah" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah_kelas"><i class="bi bi-plus-circle"></i> Tambah</button>

                            <table class="table table-hover table-bordered" id="table_kelas">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tahun ajaran</th>
                                        <th scope="col">Nama Kelas</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div><!-- End Recent Sales -->

            </div>
        </div><!-- End Left side columns -->

    </div>
</section>

<div class="modal fade" id="tambah_kelas" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kelas Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <label for="ta_kelas" class="col-sm-3 col-form-label">TA Kelas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="ta_kelas" id="ta_kelas" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            <small id="ta_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nam_kelas" class="col-sm-3 col-form-label">Nama Kelas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_kelas" id="nama_kelas">
                            <small id="nama_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select class="form-select" aria-label="Default select" name="status_kelas" id="status_kelas">
                                <option value="1">Aktif</option>
                                <option value="0">Non-Aktif</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="save" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->

<div class="modal fade" id="edit_kelas" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <label for="kode_kelas" class="col-sm-3 col-form-label">TA Kelas</label>
                        <div class="col-sm-9">
                            <input type="hidden" class="form-control" name="edit_id_kelas" id="edit_id_kelas" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            <input type="text" class="form-control" name="edit_ta_kelas" id="edit_ta_kelas" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            <small id="edit_ta_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nam_kelas" class="col-sm-3 col-form-label">Nama Kelas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="edit_nama_kelas" id="edit_nama_kelas">
                            <small id="edit_nama_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select class="form-select" aria-label="Default select" name="edit_status" id="edit_status">
                                <option value="1">Aktif</option>
                                <option value="0">Non-Aktif</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="save_edit" type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->

<div class="modal fade" id="modal_hapus_kelas" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus <b id="hapus_nama_kelas"></b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="hapus_id_kelas">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button id="delete_kelas" type="button" class="btn btn-primary">Hapus Kelas</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->