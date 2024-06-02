<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales">

                        <div class="card-body">
                            <h5 class="card-title">Daftar Ekstrakurikuler</h5>
                            <?php
                            $jenis_login = $this->session->userdata('jenis_login');
                            $jenis = array("admin", "guru", "kepala_sekolah");

                            if (in_array($jenis_login, $jenis)) {
                            ?>
                                <button id="tambah" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_ekstrakurikuler_baru"><i class="bi bi-plus-circle"></i> Tambah</button>
                            <?php
                            }
                            ?>
                            <table class="table table-hover table-bordered" id="ekstrakurikuler_table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Ekstrakurikuler</th>
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

<div class="modal fade" id="modal_ekstrakurikuler_baru" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Ekstrakurikuler Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <label for="kode_mapel" class="col-sm-5 col-form-label">Kode Ekstrakurikuler</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="kode_ekstrakurikuler" id="kode_ekstrakurikuler" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            <small id="kode_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama_mapel" class="col-sm-5 col-form-label">Nama Ekstrakurikuler</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="nama_ekstrakurikuler" id="nama_ekstrakurikuler">
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
                <button id="save" type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->

<div class="modal fade" id="modal_edit_ekstrakurikuler" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Ekstrakurikuler</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <label for="edit_kode" class="col-sm-5 col-form-label">Kode Ekstrakurikuler</label>
                        <div class="col-sm-7">
                            <input type="hidden" class="form-control" name="edit_id_ekstrakurikuler" id="edit_id_ekstrakurikuler">
                            <input type="text" class="form-control" name="edit_kode" id="edit_kode" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            <small id="edit_kode_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nam_kelas" class="col-sm-5 col-form-label">Nama Ekstrakurikuler</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="edit_nama" id="edit_nama">
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
                <button id="save_edit" type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->

<div class="modal fade" id="modal_hapus_ekstrakurikuler" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus <b id="hapus_ekstrakurikuler"></b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="hapus_id_ekstrakurikuler">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button id="delete" type="button" class="btn btn-primary">Hapus</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->