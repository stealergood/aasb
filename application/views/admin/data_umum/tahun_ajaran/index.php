<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales">

                        <div class="card-body">
                            <h5 class="card-title">Daftar Tahun Ajaran</h5>

                            <button id="tambah" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_tambah_tahun_ajaran"><i class="bi bi-plus-circle"></i> Tambah</button>

                            <table class="table table-hover table-bordered" id="tahun_ajaran_table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tahun Ajaran</th>
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

<div class="modal fade" id="modal_tambah_tahun_ajaran" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Tahun Ajaran Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <label for="tahun_ajaran" class="col-sm-5 col-form-label">Tahun Ajaran</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="semester" id="tahun_ajaran" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            <small id="nama_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-5 col-form-label">Status</label>
                        <div class="col-sm-7">
                            <select class="form-select" aria-label="Default select" name="status" id="status">
                                <option value="1">Aktif</option>
                                <option value="0">Non-Aktif</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="save" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->

<div class="modal fade" id="modal_edit_tahun_ajaran" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Tahun Ajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <label for="nam_kelas" class="col-sm-5 col-form-label">Tahun Ajaran</label>
                        <div class="col-sm-7">
                            <input type="hidden" class="form-control" name="edit_id_tahun_ajaran" id="edit_id_tahun_ajaran">
                            <input type="text" class="form-control" name="edit_tahun_ajaran" id="edit_tahun_ajaran" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            <small id="edit_nama_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-5 col-form-label">Status</label>
                        <div class="col-sm-7">
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
                <button id="save_edit" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->

<div class="modal fade" id="modal_hapus_tahun_ajaran" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus <b id="hapus_tahun_ajaran"></b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="hapus_id_tahun_ajaran">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button id="delete" type="button" class="btn btn-primary">Hapus</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->