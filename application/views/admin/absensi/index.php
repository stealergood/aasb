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
                                <input type="hidden" class="form-control" id="kelas" name="kelas"  readonly>
                                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jenis_kelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-8">
                                 <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin">
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
                                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="<?= $data_siswa['nama_kelas'] ?>" readonly>
                            </div>
                        </div>

                    <?php } ?>

               <!--     <div class="row mb-3">
                        <label for="mapel" class="col-sm-4 col-form-label">Mata Pelajaran</label>
                        <div class="col-sm-8">
                            <select class="form-select" aria-label="Default select" name="mapel" id="mapel" required>
                                <option value="">- Pilih Mata Pelajaran -</option>
                                <?php
                                foreach ($data_mapel as $mapel) {
                                    echo '<option value="' . $mapel->id_mapel . '">' . $mapel->nama_mapel . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div> -->

                    <div class="row mb-3">
                        <label for="tanggal" class="col-sm-4 col-form-label">Tanggal</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tanggal" name="tanggal" >
                            <small id="tanggal_help" class="form-text"></small>
                        </div>
                    </div>
                    <?php
                    if ($this->session->userdata('jenis_login') == 'guru') {
                    ?>
                       <!-- <div class="row mb-3">
                            <label for="pertemuan" class="col-sm-4 col-form-label">Guru</label>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" id="guru" name="guru" value="<?= $data_guru['id_guru'] ?>" readonly>
                                <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="<?= $data_guru['nama_guru'] ?>" readonly>
                                <small id="pertemuan_help" class="form-text"></small>
                            </div>
                        </div>-->
                         <div class="row mb-3">
                            <label for="kelas" class="col-sm-4 col-form-label">Guru</label>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" id="id_guru" name="id_guru"  readonly>
                                <input type="text" class="form-control" id="nama_guru" name="nama_guru" readonly>
                            </div>
                        </div>
                    <?php
                    }elseif ($this->session->userdata('jenis_login') == 'siswa') {
                    	$usr=$this->session->userdata('username');
                    	$idg=$this->db->query("select id_guru from tb_siswa  where username='$usr'")->row()->id_guru;
                    	$ng=$this->db->query("select nama_guru from tb_guru where id_guru ='$idg'")->row()->nama_guru;
                    ?>
                     
                         <div class="row mb-3">
                            <label for="kelas" class="col-sm-4 col-form-label">Guru</label>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" id="id_guru" name="id_guru" value="<?=$idg?>"  readonly>
                                <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="<?=$ng?>" readonly>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                       <!-- <div class="row mb-3">
                            <label for="guru" class="col-sm-4 col-form-label">Guru</label>
                            <div class="col-sm-8">
                                <select class="form-select" aria-label="Default select" name="guru" id="guru">
                                <option value="">- Pilih Guru -</option>
                                    <?php
                                    foreach ($data_guru as $guru) {
                                        echo '<option value="' . $guru->id_guru . '">' . $guru->nip_guru . ' - ' . $guru->nama_guru . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>-->
                         <div class="row mb-3">
                            <label for="kelas" class="col-sm-4 col-form-label">Guru</label>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" id="id_guru" name="id_guru"  readonly>
                                <input type="text" class="form-control" id="nama_guru" name="nama_guru" readonly>
                            </div>
                        </div>
                    <?php } ?>
                 <!--   <div class="row mb-3">
                        <label for="pertemuan" class="col-sm-4 col-form-label">Pertemuan Ke</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" class="form-control" id="pertemuan" name="pertemuan" aria-describedby="basic-addon2" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                            <small id="pertemuan_help" class="form-text"></small>
                        </div>
                    </div>
 
                    <div class="row mb-3">
                        <label for="kelas" class="col-sm-4 col-form-label">Jam Mulai</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <input type="time" class="col-4 form-control" id="jam_mulai" name="jam_mulai">
                                        </div>
                                        <label for="kelas" class="col-sm-2 col-form-label">Hingga</label>
                                        <div class="col-sm-5">
                                            <input type="time" class="form-control" id="jam_hingga" name="jam_hingga">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <small id="jam_mulai_help" class="form-text"></small>
                        </div>
                    </div> -->

                    <div class="row mb-3">
                        <label for="presensi" class="col-sm-4 col-form-label">Presensi</label>
                        <?php if ($this->session->userdata('jenis_login') == 'siswa') { ?>
                        <!--ini form izin siswa -->
                         <div class="col-sm-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="presensi" id="izin" value="I" checked>
                                <label class="form-check-label" for="izin">
                                    Izin
                                </label>
                            </div>
                        </div>
                        <!---------------------------------------------->
                        
                    <?php } else { ?>
                        <div class="col-sm-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="presensi" id="hadir" value="H" checked>
                                <label class="form-check-label" for="hadir">
                                    Hadir
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="presensi" id="alpha" value="A" >
                                <label class="form-check-label" for="alpha">
                                    Alpa
                                </label>
                            </div>
                        <!--    <div class="form-check">
                                <input class="form-check-input" type="radio" name="presensi" id="izin" value="I" >
                                <label class="form-check-label" for="izin">
                                    Izin
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="presensi" id="tk" value="T" >
                                <label class="form-check-label" for="tk">
                                    Tanpa Keterangan
                                </label>
                            </div>
                        </div> -->
                    <?php } ?>
                        <!--<div class="col-sm-4">
                            <button type="button" id="form_izin" name="form_izin" class="btn btn-warning mt-2" data-bs-toggle="modal" data-bs-target="#modal_form_izin">Form Izin</button>
                        </div>-->
                    </div>
                    <div class="row mb-3">
                        <label for="pertemuan" class="col-sm-4 col-form-label">Surat Izin</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="file" class="form-control" id="file_izin" name="file_izin" >
                            </div>
                            <small id="file_help" class="form-text"></small>
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

<div class="modal fade" id="modal_form_izin" tabindex="-1" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Izin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">

                <div class="row mb-3">
                    <label for="kode_izin" class="col-sm-4 col-form-label">Kode Izin</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="kode_izin" name="kode_izin" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        <small id="kode_izin_help" class="form-text"></small>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="pertemuan" class="col-sm-4 col-form-label">Keterangan</label>
                    <div class="col-sm-8">
                        <select class="form-select" aria-label="Default select" name="jenis_izin" id="jenis_izin">
                            <option value="I">izin</option>
                            <option value="S">Sakit</option>
                            <option value="A">Alpha</option>
                            <option value="T">Tanpa Keterangan</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="pertemuan" class="col-sm-4 col-form-label">Surat Perizinan</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="file" id="file_izin" name="file_izin">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="tambah_file" type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->