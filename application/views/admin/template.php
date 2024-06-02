<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title ?> | <?= $settings['app_name'] ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url() ?>assets/img/<?= $settings['favicon'] ?>" rel="icon">
    <link href="<?= base_url() ?>assets/img/<?= $settings['favicon'] ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/datatables/datatables.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <?php $this->load->view('admin/layout/header'); ?>

    <!-- ======= Sidebar ======= -->
    <?php
    if ($this->session->userdata('jenis_login') == "admin") {
        $this->load->view('admin/layout/sidebar');
    } else if ($this->session->userdata('jenis_login') == "siswa") {
        $this->load->view('admin/layout/sidebar_siswa');
    } else if ($this->session->userdata('jenis_login') == "guru") {
        $this->load->view('admin/layout/sidebar_guru');
    } else if ($this->session->userdata('jenis_login') == "kepala_sekolah") {
        $this->load->view('admin/layout/sidebar_kepala_sekolah');
    } else if ($this->session->userdata('jenis_login') == "orang_tua") {
        $this->load->view('admin/layout/sidebar_orang_tua');
    }
    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1><?= $title ?></h1>
        </div><!-- End Page Title -->

        <!-- Main content -->
        <?= $content ?>
        <!-- /.content -->

    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url() ?>assets/js/jquery-3.6.1.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/chart.js/chart.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/quill/quill.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url() ?>assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/php-email-form/validate.js"></script>
    <script src="<?= base_url() ?>assets/vendor/datatables/datatables.min.js"></script>
    <script src="<?= base_url() ?>assets/js/sweetalert.min.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url() ?>assets/js/main.js"></script>
    <!-- JS Tambahan -->
    <?php
    if (isset($script)) {
        echo $script;
    }
    ?>
</body>

</html>