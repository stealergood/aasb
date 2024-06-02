<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url() ?>siswa/home">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#data_kegiatan-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Data kegiatan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="data_kegiatan-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
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
                        <span>Data Orangtua</span>
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

    </ul>

</aside><!-- End Sidebar-->