<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <!-- Horizontal Form -->
                    <?php
                    $jenis_login = $this->session->userdata('jenis_login');
                    $jenis = array("admin", "guru", "kepala_sekolah", "orang_tua");

                    if (in_array($jenis_login, $jenis)) {
                    ?>
                        <div class="row mb-3 mt-4">
                            <label for="nis_siswa" class="col-sm-4 col-form-label">Nomor Induk Siswa</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="hidden" class="form-control" id="id_siswa" name="id_siswa" aria-describedby="basic-addon2">
                                    <input type="text" class="form-control" id="nis_siswa" name="nis_siswa" aria-describedby="basic-addon2">

                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" id="button_cari_nis" name="button_cari_nis" data-bs-toggle="modal" data-bs-target="#modal_daftar_siswa">Cari NIS</button>
                                    </div>
                                </div>
                                <small id="nis_siswa_help" class="form-text"></small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nama_siswa" class="col-sm-4 col-form-label">Nama Siswa</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa">
                                <small id="nama_siswa_help" class="form-text"></small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kelas" class="col-sm-4 col-form-label">Kelas</label>
                            <div class="col-sm-8">
                                <select class="form-select" aria-label="Default select" name="kelas" id="kelas">
                                    <?php
                                    foreach ($data_kelas as $kelas) {
                                        echo '<option value="' . $kelas->id_kelas . '">' . $kelas->nama_kelas . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jenis_kelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-8">
                                <select class="form-select" aria-label="Default select" name="jenis_kelamin" id="jenis_kelamin">
                                    <option value="L">Laki - laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    <?php
                    } else {

                    ?>
                        <div class="row mb-3 mt-4">
                            <label for="nis_siswa" class="col-sm-4 col-form-label">Nomor Induk Siswa</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="hidden" class="form-control" id="id_siswa" name="id_siswa" aria-describedby="basic-addon2" value="<?= $data_siswa['id_siswa'] ?>">
                                    <input type="text" class="form-control" id="nis_siswa" name="nis_siswa" aria-describedby="basic-addon2" value="<?= $data_siswa['nis_siswa'] ?>" readonly>
                                </div>
                                <small id="nis_siswa_help" class="form-text"></small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nama_siswa" class="col-sm-4 col-form-label">Nama Siswa</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= $data_siswa['name'] ?>" readonly>
                                <small id="nama_siswa_help" class="form-text"></small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kelas" class="col-sm-4 col-form-label">Kelas</label>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" id="kelas" name="kelas" value="<?= $data_siswa['kelas'] ?>" readonly>
                                <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $data_siswa['nama_kelas'] ?>" readonly>
                            </div>
                        </div>

                    <?php } ?>

                    <div class="row mb-3">
                        <label for="ekstrakurikuler" class="col-sm-4 col-form-label">Ekstrakurikuler</label>
                        <div class="col-sm-8">
                            <select class="form-select" aria-label="Default select" name="ekstrakurikuler" id="ekstrakurikuler">
                                <?php
                                foreach ($data_ekstrakurikuler as $ekstrakurikuler) {
                                    echo '<option value="' . $ekstrakurikuler->id_ekstrakurikuler . '">' . $ekstrakurikuler->nama . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tanggal" class="col-sm-4 col-form-label">Tanggal</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo date("Y-m-d"); ?>">
                            <small id="tanggal_help" class="form-text"></small>
                        </div>
                    </div>

                <!--    <div class="row mb-3">
                        <label for="pertemuan" class="col-sm-4 col-form-label">Pertemuan Ke</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="pertemuan" name="pertemuan" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            <small id="pertemuan_help" class="form-text"></small>
                        </div>
                    </div> -->

                    <div class="row mb-3">
                        <label for="presensi" class="col-sm-4 col-form-label">Presensi</label>
                        <div class="col-sm-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="presensi" id="hadir" value="H" checked>
                                <label class="form-check-label" for="hadir">
                                    Hadir
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="presensi" id="izin" value="I">
                                <label class="form-check-label" for="izin">
                                    Izin
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="presensi" id="alpha" value="A">
                                <label class="form-check-label" for="alpha">
                                    Alpha
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class=" text-center">
                        <button type="button" id="simpan" name="simpan" class="btn btn-primary">Simpan</button>
                        <button type="button" id="batal" name="batal" class="btn btn-danger">Batal</button>
                    </div>
                    <!-- End Horizontal Form -->

                </div>
            </div>

        </div>

    </div>
</section>


<div class="modal fade" id="modal_daftar_siswa" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <table class="table table-hover table-bordered" id="siswa_table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->