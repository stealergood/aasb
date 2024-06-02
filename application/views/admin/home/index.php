<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body py-4">
                                    <div class="d-flex gap-4">

                                        <div>
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <?php if ($settings['app_name']) : ?>
                                                        <tr>
                                                            <th scope="row">App Name</th>
                                                            <td><?= $settings['app_name'] ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    <?php if ($settings['phone']) : ?>
                                                        <tr>
                                                            <th scope="row">Phone</th>
                                                            <td><?= $settings['phone'] ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    <?php if ($settings['email']) : ?>
                                                        <tr>
                                                            <th scope="row">Email</th>
                                                            <td><?= $settings['email'] ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    <?php if ($settings['address']) : ?>
                                                        <tr>
                                                            <th scope="row">Address</th>
                                                            <td><?= $settings['address'] ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    <?php if ($settings['website']) : ?>
                                                        <tr>
                                                            <th scope="row">Website</th>
                                                            <td>
                                                                <a href="<?= $settings['website'] ?>" target="_blank"><?= $settings['website'] ?></a>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    <?php if ($settings['slogan']) : ?>
                                                        <tr>
                                                            <th scope="row">Visi</th>
                                                            <td><?= $settings['slogan'] ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    <?php if ($settings['description']) : ?>
                                                        <tr>
                                                            <th scope="row">Misi</th>
                                                            <td><?= $settings['description'] ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <?php if ($settings['logo']) : ?>
                                            <div>
                                                <img src="<?= base_url() ?>assets/img/<?= $settings['logo'] ?>" alt="Logo Image" class="img-fluid" width="2000">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card info-card sales-card">

                                        <div class="card-body">
                                            <h5 class="card-title">Siswa</h5>

                                            <div class="d-flex align-items-center">
                                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-person-circle"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6><?= $jumlah_siswa['jumlah'] ?></h6>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div><!-- End Sales Card -->

                                <!-- Sales Card -->
                                <div class="col-md-4">
                                    <div class="card info-card sales-card">

                                        <div class="card-body">
                                            <h5 class="card-title">Guru</h5>

                                            <div class="d-flex align-items-center">
                                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-people-fill"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6><?= $jumlah_guru['jumlah'] ?></h6>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div><!-- End Sales Card -->

                                <!-- Revenue Card -->
                                <div class="col-md-4">
                                    <div class="card info-card revenue-card">

                                        <div class="card-body">
                                            <h5 class="card-title">Presensi</h5>

                                            <div class="d-flex align-items-center">
                                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-people"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6><?= $jumlah_absensi['jumlah'] ?></h6>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div><!-- End Revenue Card --> 

                             <!-- Customers Card -->
                <div class="col-md-15">

                    <!-- Website Traffic -->
                    <div class="card">
                        <div class="card-body pb-0">
                            <h5 class="card-title">Jumlah Kehadiran Siswa Dengan Keterangan 2024</h5>
                            <div id="trafficChart" style="min-height: 350px;" class="echart"></div>

                        </div>
                    </div><!-- End Website Traffic -->

               </div><!-- End Customers Card -->
                            </div>
                        </div>
                    </div>
                </div>

            
                        </div>
                    </div><!-- End Website Traffic -->

                </div><!-- End Customers Card --> 


            </div>
        </div><!-- End Left side columns -->

    </div>
</section>