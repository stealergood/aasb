<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $settings['app_name'] ?></title>
    <meta content="<?= $settings['meta_description'] ?>" name="description">
    <meta content="<?= $settings['meta_keyword'] ?>" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url() ?>assets/img/<?= $settings['favicon'] ?>" rel="icon">
    <link href="<?= base_url() ?>assets/img/<?= $settings['favicon'] ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <main>
        <div class="container">
            <?php

            // var_dump($this->session->flashdata());
            ?>
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="<?= base_url('assets/img/') . $settings['logo'] ?>" alt="">
                                    <span class="d-none d-lg-block"><?= $settings['app_name'] ?></span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                     <!--   <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5> -->
                                    <!--   <p class="text-center small">Enter your username & password to login</p> --> 
                                        
                                       <p class="text-center small">Masukkan username & password Anda</p>
                                    </div>

                                    <?php if (isset($error)) {
                                        echo $error;
                                    } ?>
                                    <?php if (@$this->session->flashdata('message')) { ?>
                                        <p class="login-box-msg text-danger"><?= $this->session->flashdata('message'); ?></p>
                                    <?php } ?>

                                    <form action="<?= base_url('login'); ?>" method="post" class="row g-3 needs-validation" novalidate>

                                        <!--<div class="col-12"> --
                                            <label for="yourLevel" class="form-label">Login Sebagai</label>
                                            <select class="form-select" aria-label="Default select example" name="jenis_login" id="jenis_login">
                                                <option value="" selected>- Pilih Role -</option>
                                                <option value="admin">Admin</option>
                                                <option value="siswa">Siswa</option>
                                                <option value="guru">Guru</option>
                                                <option value="kepala_sekolah">Kepala Sekolah</option>
                                                <option value="orang_tua">Orang Tua</option>
                                                </select>
                                        </div> -->
                                        <input type="hidden" name="jenis_login" value="<?php echo $this->session->flashdata('sebagai'); ?> ">
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="username" class="form-control" name="username" id="username" required>
                                                <div class="invalid-feedback">Please enter your username.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" name="password" id="password" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.min.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>