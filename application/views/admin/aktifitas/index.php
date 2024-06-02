<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales">

                        <div class="card-body">
                            <h5 class="card-title"> </h5>
                            <?php
                            $jenis_login = $this->session->userdata('jenis_login');
                            $jenis = array("admin", "guru", "kepala_sekolah");

                            if (in_array($jenis_login, $jenis)) {
                            ?>
                                <button id="tambah" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_tambah_aktifitas"><i class="bi bi-plus-circle"></i> Tambah</button>
                            <?php
                            }
                            ?>
                            <table class="table table-hover table-bordered" id="aktifitas_table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">NIP</th>
                                        <th scope="col">Nama Guru</th>
                                        <th scope="col">Mata Pelajaran</th>
                                        <th scope="col">Ekstra</th>
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

<div class="modal fade" id="modal_tambah_aktifitas" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                 <div class="row mb-3">
                        <label for="nama_orangtua" class="col-sm-5 col-form-label">Nama Guru</label>
                        <div class="col-sm-7">
                            <select class="form-select" aria-label="Default select" name="id_guru" id="id_guru">
                                        <option value="">-- Pilih Guru --</option>
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
                        <label for="nama_mapel" class="col-sm-5 col-form-label">Nama Mapel</label>
                        <div class="col-sm-7">
                            <select class="form-select" aria-label="Default select" name="id_mapel" id="id_mapel">
                                        <option value="">-- Pilih Mapel --</option>
                                        <?php
                                        foreach ($data_mapel as $ortu) {
                                            echo '<option value="' . $ortu->id_mapel . '">' . $ortu->nama_mapel . '</option>';
                                        }
                                        ?>
                                    </select>
                            <small id="id_mapel_help" class="form-text"></small>
                        </div>
                    </div>
                     <div class="row mb-3">
                        <label for="nama_ekstrakurikuler" class="col-sm-5 col-form-label">Nama Ekstrakurikuler</label>
                        <div class="col-sm-7">
                            <select class="form-select" aria-label="Default select" name="id_ekstrakurikuler" id="id_ekstrakurikuler">
                                        <option value="">-- Pilih Ekstrakurikuler --</option>
                                        <?php
                                        foreach ($data_ekskul as $ortu) {
                                            echo '<option value="' . $ortu->id_ekstrakurikuler . '">' . $ortu->nama . '</option>';
                                        }
                                        ?>
                                    </select>
                            <small id="id_ekstrakurikuler_help" class="form-text"></small>
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

<div class="modal fade" id="modal_edit_aktifitas" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perubahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <label for="nama_orangtua" class="col-sm-5 col-form-label">Nama Guru</label>
                        <div class="col-sm-7">
                        <input type="hidden" class="form-control" name="edit_id_aktifitas" id="edit_id_aktifitas">
                            <select class="form-select" aria-label="Default select" name="edit_guru" id="edit_guru">
                                        <option value="">-- Pilih Guru --</option>
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
                        <label for="nama_mapel" class="col-sm-5 col-form-label">Nama Mata Pelajaran</label>
                        <div class="col-sm-7">
                            <select class="form-select" aria-label="Default select" name="edit_mapel" id="edit_mapel">
                                        <option value="">-- Pilih Mapel --</option>
                                        <?php
                                        foreach ($data_mapel as $ortu) {
                                            echo '<option value="' . $ortu->id_mapel . '">' . $ortu->nama_mapel . '</option>';
                                        }
                                        ?>
                                    </select>
                            <small id="id_mapel_help" class="form-text"></small>
                        </div>
                    </div>
                     <div class="row mb-3">
                        <label for="nama_ekstrakurikuler" class="col-sm-5 col-form-label">Nama Ekstrakurikuler</label>
                        <div class="col-sm-7">
                            <select class="form-select" aria-label="Default select" name="edit_ekstrakurikuler" id="edit_ekstrakurikuler">
                                        <option value="">-- Pilih Ekstrakurikuler --</option>
                                        <?php
                                        foreach ($data_ekskul as $ortu) {
                                            echo '<option value="' . $ortu->id_ekstrakurikuler . '">' . $ortu->nama . '</option>';
                                        }
                                        ?>
                                    </select>
                            <small id="id_ekstrakurikuler_help" class="form-text"></small>
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

<div class="modal fade" id="modal_hapus_aktifitas" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus <b id="hapus_nama_aktifitas"></b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="hapus_id_aktifitas">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button id="delete" type="button" class="btn btn-primary">Hapus</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->

<div class="modal fade" id="modal_view_aktifitas" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail</h5>
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
                                    <input type="text" class="form-control" name="view_nis_aktifitas" id="view_nis_aktifitas" readonly>
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
                            </div>
                             <div class="row mb-3">
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
                            </div>
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