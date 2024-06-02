<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales">

                        <div class="card-body">
                            <h5 class="card-title">Daftar Guru</h5>
                            <?php
                            $jenis_login = $this->session->userdata('jenis_login');
                            $jenis = array("admin", "guru", "kepala_sekolah");

                            if (in_array($jenis_login, $jenis)) {
                            ?>
                                <button id="tambah" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_tambah_guru"><i class="bi bi-plus-circle"></i> Tambah</button>
                            <?php
                            }
                            ?>
                            <table class="table table-hover table-bordered" id="guru_table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">NIP</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Jabatan</th>
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

<div class="modal fade" id="modal_tambah_guru" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Guru Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <label for="nip" class="col-sm-5 col-form-label">NIP</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="nip" id="nip" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            <small id="nip_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-5 col-form-label">Nama</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="nama" id="nama">
                            <small id="nama_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-sm-5 col-form-label">Email</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="email" id="email">
                            <small id="email_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-5 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-7">
                            <select class="form-select" aria-label="Default select" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="L">Laki - laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jabatan" class="col-sm-5 col-form-label">Jabatan</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="jabatan" id="jabatan">
                            <small id="jabatan_help" class="form-text"></small>
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

<div class="modal fade" id="modal_edit_guru" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <label for="nis" class="col-sm-5 col-form-label">NIP</label>
                        <div class="col-sm-7">
                            <input type="hidden" class="form-control" name="edit_id_guru" id="edit_id_guru">
                            <input type="text" class="form-control" name="edit_nip_guru" id="edit_nip_guru" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            <small id="edit_nip_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-5 col-form-label">Nama</label>
                        <div class="col-sm-7">
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
                        <label class="col-sm-5 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-7">
                            <select class="form-select" aria-label="Default select" name="edit_jenis_kelamin" id="edit_jenis_kelamin">
                                <option value="L">Laki - laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="edit_email" class="col-sm-5 col-form-label">Jabatan</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="edit_jabatan" id="edit_jabatan">
                            <small id="edit_jabatan_help" class="form-text"></small>
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
                            <input type="text" class="form-control" name="edit_no_telepon" id="edit_no_telepon">
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

<div class="modal fade" id="modal_hapus_guru" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus <b id="hapus_nama_guru"></b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="hapus_id_guru">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button id="delete" type="button" class="btn btn-primary">Hapus</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->

<div class="modal fade" id="modal_view_guru" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">

                        <!-- Recent Sales -->
                        <div class="col-6">
                            <div class="row mb-3">
                                <label for="nis" class="col-sm-5 col-form-label">NIP</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="view_nip_guru" id="view_nip_guru" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nama" class="col-sm-5 col-form-label">Nama</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="view_nama" id="view_nama" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="view_jabatan" class="col-sm-5 col-form-label">Jabatan</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="view_jabatan" id="view_jabatan" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="view_email" class="col-sm-5 col-form-label">Email</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="view_email" id="view_email" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-5 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="view_jenis_kelamin" id="view_jenis_kelamin" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row mb-3">
                                <label for="view_no_telepon" class="col-sm-5 col-form-label">No Telepon</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="view_no_telepon" id="view_no_telepon" readonly>
                                </div>
                            </div>
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
                            </div>
                        </div> -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->