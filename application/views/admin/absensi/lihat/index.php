<section class="section">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-pills card-header-pills right">
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?= site_url('absensi/laporan') ?>">Kembali</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Keterangan izin dari : <?= $data_izin['nama_siswa'] ?></h5>
                            <div class="row">
                                <img src="<?= base_url('assets/upload/') . $data_izin['file_izin'] ?>" alt="...">
                            </div>

                        </div>

                    </div>
                </div><!-- End Recent Sales -->

            </div>
        </div><!-- End Left side columns -->

    </div>
</section>