<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales">

                        <div class="card-body">
                            <h5 class="card-title">Daftar Orangtua</h5>
                            <?php
                            $jenis_login = $this->session->userdata('jenis_login');
                            $jenis = array("admin", "guru", "kepala_sekolah");

                            if (in_array($jenis_login, $jenis)) {
                            ?>
                                <button id="tambah" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_tambah_orang_tua"><i class="bi bi-plus-circle"></i> Tambah</button>
                            <?php
                            }
                            ?>
                            <table class="table table-hover table-bordered" id="orang_tua_table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                      <th scope="col">Alamat</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Telepon</th>
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

<div class="modal fade" id="modal_tambah_orang_tua" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Orangtua Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-5 col-form-label">Nama</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="nama" id="nama">
                            <small id="nama_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                      <label for="alamat" class="col-sm-5 col-form-label">Alamat</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" id="alamat" name="alamat" style="height: 100px"></textarea>
                            <small id="alamat_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-sm-5 col-form-label">Email</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="email" id="email">
                            <small id="email_help" class="form-text"></small>
                        </div>
                    </div>
                 <!--     <div class="row mb-3">
                        <label for="alamat" class="col-sm-5 col-form-label">Alamat</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" id="alamat" name="alamat" style="height: 100px"></textarea>
                            <small id="alamat_help" class="form-text"></small>
                        </div>
                    </div> -->
                    <div class="row mb-3">
                        <label for="no_telepon" class="col-sm-5 col-form-label">No Telepon</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="no_telepon" id="no_telepon">
                            <small id="no_telepon_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="username" class="col-sm-5 col-form-label">Username</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="username" id="username" onkeypress='if (event.which === 32) return false;'>
                            <small id="username_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-5 col-form-label">Password</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" name="password" id="password">
                            <small id="password_help" class="form-text"></small>
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

<div class="modal fade" id="modal_edit_orang_tua" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Orangtua</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-5 col-form-label">Nama</label>
                        <div class="col-sm-7">
                            <input type="hidden" class="form-control" name="edit_id_orang_tua" id="edit_id_orang_tua">
                            <input type="text" class="form-control" name="edit_nama" id="edit_nama">
                            <small id="edit_nama_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="edit_email" class="col-sm-5 col-form-label">Email</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="edit_email" id="edit_email">
                            <small id="edit_email_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="edit_alamat" class="col-sm-5 col-form-label">Alamat</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" id="edit_alamat" name="edit_alamat" style="height: 100px"></textarea>
                            <small id="edit_alamat_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="edit_telepon" class="col-sm-5 col-form-label">No Telepon</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="edit_no_telepon" id="edit_no_telepon" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            <small id="edit_no_telepon_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="edit_username" class="col-sm-5 col-form-label">Username</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="edit_username" id="edit_username" onkeypress='if (event.which === 32) return false;'>
                            <small id="edit_username_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="edit_password" class="col-sm-5 col-form-label">Password</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" name="edit_password" id="edit_password">
                            <small id="edit_password_help" class="form-text"></small>
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

<div class="modal fade" id="modal_hapus_orang_tua" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus <b id="hapus_nama_orang_tua"></b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="hapus_id_orang_tua">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button id="delete" type="button" class="btn btn-primary">Hapus</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->

<div class="modal fade" id="modal_view_orang_tua" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Orangtua</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">

                        <!-- Recent Sales -->
                        <div class="col-6">
                            <div class="row mb-3">
                                <label for="nama" class="col-sm-5 col-form-label">Nama</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="view_nama" id="view_nama" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="view_no_telepon" class="col-sm-5 col-form-label">No Telepon</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="view_no_telepon" id="view_no_telepon" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="view_email" class="col-sm-5 col-form-label">Email</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="view_email" id="view_email" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row mb-3">
                                <label for="alamat" class="col-sm-5 col-form-label">Alamat</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" id="view_alamat" name="view_alamat" style="height: 100px" readonly></textarea>
                                </div>
                            </div>
                        <!--    <div class="row mb-3">
                                <label for="username" class="col-sm-5 col-form-label">Username</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="view_username" id="view_username" readonly>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->