<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales">

                        <div class="card-body">
                            <h5 class="card-title">Daftar Siswa Izin</h5>

                            <?= form_open_multipart('absensi/laporan_pdf', array('id' => "form_laporan", 'method' => "POST")); ?>
                            <div class="row g-3 mb-3">
                                <div class="col-2">
                                    <label for="guru" class="form-label">Guru</label>
                                    <select class="form-select" aria-label="Default select" name="guru" id="guru">
                                        <option value="">-- Pilih Guru --</option>
                                        <?php
                                        foreach ($data_guru as $guru) {
                                            echo '<option value="' . $guru->nip_guru . '">' . $guru->nip_guru . ' - ' . $guru->nama_guru . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label for="kelas" class="form-label">Kelas</label>
                                    <select class="form-select" aria-label="Default select" name="kelas" id="kelas">
                                        <option value="">-- Pilih Kelas --</option>
                                        <?php
                                        foreach ($data_kelas as $kelas) {
                                            echo '<option value="' . $kelas->id_kelas . '">' . $kelas->nama_kelas . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label for="kelas" class="form-label">Keterangan</label>
                                    <select class="form-select" aria-label="Default select" name="kelas" id="kelas">
                                        <option value="">-- Pilih Keterangan --</option>
                                       <option value="H">Hadir</option>
                                       <option value="I">Izin</option>
                                       <option value="S">Sakit</option>
                                       <option value="A">Alpha</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label for="kelas" class="form-label">Tanggal dari</label>
                                    <input type="date" class="form-control" id="tanggal_dari" name="tanggal_dari">
                                </div>
                                <div class="col-2">
                                    <label for="kelas" class="form-label">Tanggal Sampai</label>
                                    <input type="date" class="form-control" id="tanggal_sampai" name="tanggal_sampai">
                                </div>
                                <?php
                                $jenis_login = $this->session->userdata('jenis_login');
                                $jenis = array("admin", "guru", "kepala_sekolah");

                                if (in_array($jenis_login, $jenis)) {
                                ?>
                                    <div class="col-2">
                                        <div class="d-grid gap-2 mt-4">
                                            <button class="btn btn-primary mt-1" type="submit" id="cetak" name="cetak">Cetak</button>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <?= form_close(); ?>

                            <table class="table table-hover table-bordered" id="absensi_table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">KODE</th>
                                        <th scope="col">NIS</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Tanggal</th>
                                    <!--    <th scope="col">Jam</th> -->
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Surat Izin</th>
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

<div class="modal fade" id="modal_hapus_izin_siswa" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus <b id="hapus_nama_izin_siswa"></b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="hapus_id_izin_siswa">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button id="delete" type="button" class="btn btn-primary">Hapus</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
<div class="modal fade" id="modal_konfirmasi_izin_siswa" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi <b id="konfirmasi_nama_izin_siswa"></b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="konfirmasi_id_izin_siswa">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button id="konfirmasi" type="button" class="btn btn-primary">Konfirmasi</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->