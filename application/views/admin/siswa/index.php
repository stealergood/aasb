<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales">

                        <div class="card-body">
                            <h5 class="card-title">Daftar Siswa</h5>
                            <?php
                            $jenis_login = $this->session->userdata('jenis_login');
                            $jenis = array("admin", "guru", "kepala_sekolah");

                            if (in_array($jenis_login, $jenis)) {
                            ?>
                                <button id="tambah" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_tambah_siswa"><i class="bi bi-plus-circle"></i> Tambah</button>
                            <?php
                            }
                            ?>
                            <table class="table table-hover table-bordered" id="siswa_table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">NIS</th>
                                        <th scope="col">Nama Siswa</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col">Nama Orangtua</th>
                                        <th scope="col">Nama Guru</th>
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

<div class="modal fade" id="modal_tambah_siswa" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Siswa Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <label for="nis" class="col-sm-5 col-form-label">NIS</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="nis" id="nis" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            <small id="nis_help" class="form-text"></small>
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
                        <label for="kelas" class="col-sm-5 col-form-label">Kelas</label>
                        <div class="col-sm-7">
                            <select class="form-select" aria-label="Default select" name="kelas" id="kelas">
                                <?php
                                foreach ($data_kelas as $kelas) {
                                    echo '<option value="' . $kelas->id_kelas . '">' . $kelas->nama_kelas . '</option>';
                                }
                                ?>
                            </select>
                            <small id="kelas_help" class="form-text"></small>
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
                        <label for="alamat" class="col-sm-5 col-form-label">Alamat</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" id="alamat" name="alamat" style="height: 100px"></textarea>
                            <small id="alamat_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tahun_masuk" class="col-sm-5 col-form-label">Tahun Masuk</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="tahun_masuk" id="tahun_masuk" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            <small id="tahun_masuk_help" class="form-text"></small>
                        </div>
                    </div>
                 <!--   <div class="row mb-3">
                        <label for="email_orangtua" class="col-sm-5 col-form-label">Email Orang Tua</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="email_orangtua" id="email_orangtua" >
                            <small id="email_orangtua_help" class="form-text"></small>
                        </div> -->
                        <div class="row mb-3">
                        <label for="nama_orangtua" class="col-sm-5 col-form-label">Nama Orang Tua</label>
                        <div class="col-sm-7">
                            <select class="form-select" aria-label="Default select" name="id_orang_tua" id="id_orang_tua">
                                        <option value="">-- Pilih Orang Tua --</option>
                                        <?php
                                        foreach ($data_ortu as $ortu) {
                                            echo '<option value="' . $ortu->id_orang_tua . '">' . $ortu->name . '</option>';
                                        }
                                        ?>
                                    </select>
                            <small id="id_orang_tua_help" class="form-text"></small>
                        </div>
                    </div>
                     <div class="row mb-3">
                        <label for="nama_orangtua" class="col-sm-5 col-form-label">Nama Guru Kelas</label>
                        <div class="col-sm-7">
                            <select class="form-select" aria-label="Default select" name="id_guru" id="id_guru">
                                        <option value="">-- Pilih Guru Kelas --</option>
                                        <?php
                                        foreach ($data_guru as $ortu) {
                                            echo '<option value="' . $ortu->id_guru . '">' . $ortu->nama_guru . '</option>';
                                        }
                                        ?>
                                    </select>
                            <small id="id_orang_tua_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="username" class="col-sm-5 col-form-label">Username</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="username" id="username" onkeypress='if (event.which === 32) return false;' <small id="username_help" class="form-text"></small>
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

<div class="modal fade" id="modal_edit_siswa" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <label for="nis" class="col-sm-5 col-form-label">NIS</label>
                        <div class="col-sm-7">
                            <input type="hidden" class="form-control" name="edit_id_siswa" id="edit_id_siswa">
                            <input type="text" class="form-control" name="edit_nis_siswa" id="edit_nis_siswa">
                            <small id="edit_nis_help" class="form-text"></small>
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
                        <label for="kelas" class="col-sm-5 col-form-label">Kelas</label>
                        <div class="col-sm-7">
                            <select class="form-select" aria-label="Default select" name="edit_kelas" id="edit_kelas">
                                <?php
                                foreach ($data_kelas as $kelas) {
                                    echo '<option value="' . $kelas->id_kelas . '">' . $kelas->nama_kelas . '</option>';
                                }
                                ?>
                            </select>
                            <small id="edit_kelas_help" class="form-text"></small>
                        </div>
                    </div>
                     <div class="row mb-3">
                        <label for="nama_orangtua" class="col-sm-5 col-form-label">Nama Orang Tua</label>
                        <div class="col-sm-7">
                            <select class="form-select" aria-label="Default select" name="edit_orang_tua" id="edit_orang_tua">
                                        <option value="">-- Pilih Orang Tua --</option>
                                        <?php
                                        foreach ($data_ortu as $ortu) {
                                            echo '<option value="' . $ortu->id_orang_tua . '">' . $ortu->name . '</option>';
                                        }
                                        ?>
                                    </select>
                            <small id="id_orang_tua_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama_orangtua" class="col-sm-5 col-form-label">Nama Guru Kelas</label>
                        <div class="col-sm-7">
                            <select class="form-select" aria-label="Default select" name="edit_guru" id="edit_guru">
                                        <option value="">-- Pilih Guru Kelas --</option>
                                        <?php
                                        foreach ($data_guru as $ortu) {
                                            echo '<option value="' . $ortu->id_guru . '">' . $ortu->nama_guru . '</option>';
                                        }
                                        ?>
                                    </select>
                            <small id="id_guru_help" class="form-text"></small>
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
                        <label for="alamat" class="col-sm-5 col-form-label">Alamat</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" id="edit_alamat" name="edit_alamat" style="height: 100px"></textarea>
                            <small id="edit_alamat_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tahun_masuk" class="col-sm-5 col-form-label">Tahun Masuk</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="edit_tahun_masuk" id="edit_tahun_masuk">
                            <small id="edit_tahun_masuk_help" class="form-text"></small>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="username" class="col-sm-5 col-form-label">Username</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="edit_username" id="edit_username" onkeypress='if (event.which === 32) return false;'>
                            <small id="edit_username_help" class="form-text"></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-5 col-form-label">Password</label>
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

<div class="modal fade" id="modal_hapus_siswa" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus <b id="hapus_nama_siswa"></b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="hapus_id_siswa">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button id="delete" type="button" class="btn btn-primary">Hapus</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->

<div class="modal fade" id="modal_view_siswa" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">

                        <!-- Recent Sales -->
                        <div class="col-6">
                            <div class="row mb-3">
                                <label for="nis" class="col-sm-5 col-form-label">NIS</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="view_nis_siswa" id="view_nis_siswa" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nama" class="col-sm-5 col-form-label">Nama</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="view_nama" id="view_nama" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="kelas" class="col-sm-5 col-form-label">Kelas</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="view_kelas" id="view_kelas" readonly>
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
                                <label for="alamat" class="col-sm-5 col-form-label">Alamat</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" id="view_alamat" name="view_alamat" style="height: 100px" readonly></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tahun_masuk" class="col-sm-5 col-form-label">Tahun Masuk</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="view_tahun_masuk" id="view_tahun_masuk" readonly>
                                </div>
                            </div> -->
                         <!--    <div class="row mb-3">
                                <label for="nama_orangtua" class="col-sm-5 col-form-label">Nama Orangtua</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="view_nama_orangtua" id="view_nama_orangtua" readonly>
                                </div>
                            </div>
                             <div class="row mb-3">
                                <label for="nama_orangtua" class="col-sm-5 col-form-label">Nama Guru</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="view_nama_guru" id="view_nama_guru" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
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