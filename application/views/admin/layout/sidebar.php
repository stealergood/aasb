<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">


        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url() ?>admin/home">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#data_umum-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Data Umum</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="data_umum-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url() ?>data_umum/kelas">
                        <i class="bi bi-circle"></i><span>Kelas</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>data_umum/semester">
                        <i class="bi bi-circle"></i><span>Semester</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>data_umum/tahun_ajaran">
                        <i class="bi bi-circle"></i><span>Tahun Ajaran</span>
                    </a>
                </li>

                 <li>
                    <a href="<?= base_url() ?>data_kegiatan/mata_pelajaran">
                        <i class="bi bi-circle"></i><span>Mata Pelajaran</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>data_kegiatan/ekstrakurikuler">
                        <i class="bi bi-circle"></i><span>Ekstrakurikuler</span>
                    </a>
                </li>


            </ul>
        </li><!-- End Data Umum Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url() ?>aktifitas">
                <i class="bi bi-menu-button-wide"></i>
                <span>Kegiatan Guru</span>
            </a>

    <!--    <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#data_kegiatan-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Data Kegiatan Guru</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="data_kegiatan-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
             <!--   <li>
                    <a href="<?= base_url() ?>data_kegiatan/mata_pelajaran">
                        <i class="bi bi-circle"></i><span>Mata Pelajaran</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>data_kegiatan/ekstrakurikuler">
                        <i class="bi bi-circle"></i><span>Ekstrakurikuler</span>
                    </a>
                </li> -->
            <!--    <li>
                    <a href="<?= base_url() ?>aktifitas">
                        <i class="bi bi-circle"></i><span>Kegiatan</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav --> 

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#data_user-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Data Profil</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="data_user-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= base_url() ?>siswa">
                        <i class="bi bi-circle"></i>
                        <span>Data Siswa</span>
                    </a>
                </li><!-- End Blank Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= base_url() ?>guru">
                        <i class="bi bi-circle"></i>
                        <span>Data Guru</span>
                    </a>
                </li><!-- End Blank Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= base_url() ?>kepala_sekolah">
                        <i class="bi bi-circle"></i>
                        <span>Data Kepala Sekolah</span>
                    </a>
                </li><!-- End Blank Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= base_url() ?>orang_tua">
                        <i class="bi bi-circle"></i>
                        <span>Data Orang Tua</span>
                    </a>
                </li><!-- End Blank Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= base_url() ?>admin">
                        <i class="bi bi-circle"></i>
                        <span>Data Admin</span>
                    </a>
                </li><!-- End Blank Page Nav -->
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#absensi-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Presensi</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="absensi-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= base_url() ?>absensi">
                        <i class="bi bi-circle"></i>
                        <span>Form Presensi</span>
                    </a>
                </li><!-- End Blank Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= base_url() ?>email">
                        <i class="bi bi-circle"></i>
                        <span>Kirim Email</span>
                    </a>
                </li><!-- End Blank Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= base_url() ?>absensi/laporan">
                        <i class="bi bi-circle"></i>
                        <span>Laporan Presensi</span>
                    </a>
                </li><!-- End Blank Page Nav -->

               <!-- <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= base_url() ?>absensi/rekap">
                        <i class="bi bi-circle"></i>
                        <span>Rekap Absensi</span>
                    </a>
                </li>--><!-- End Blank Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= base_url() ?>absensi/ekstrakurikuler">
                        <i class="bi bi-circle"></i>
                        <span>Form Ekstrakurikuler</span>
                    </a>
                </li><!-- End Blank Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= base_url() ?>absensi/ekstrakurikuler/laporan">
                        <i class="bi bi-circle"></i>
                        <span>Laporan Ekstrakurikuler</span>
                    </a>
                </li><!-- End Blank Page Nav -->
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url() ?>admin/setting">
                <i class="bi bi-gear"></i>
                <span>Settings</span>
            </a>
        </li><!-- End Blank Page Nav -->

    </ul>

</aside><!-- End Sidebar-->