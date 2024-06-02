<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth/logincontroller/login';
$route['404_override'] = 'welcome/errore';
$route['translate_uri_dashes'] = FALSE;
/*
| -------------------------------------------------------------------------
| ADMIN LOGIN
| -------------------------------------------------------------------------
*/
$route['login']             = 'auth/logincontroller/login';
$route['logout']            = 'auth/logincontroller/logout';
/*
| -------------------------------------------------------------------------
| ADMIN HOME
| -------------------------------------------------------------------------
*/
$route['admin/home']                            = 'admin/home/homecontroller';
$route['home/coba']                             = 'admin/home/homecontroller/coba';
$route['home/jumlah_kehadiran']                 = 'admin/home/homecontroller/jumlah_kehadiran';
$route['users-profile']                         = 'admin/home/homecontroller/users_profile';
$route['users_update']                          = 'admin/home/homecontroller/users_update';
$route['users_update_password']                 = 'admin/home/homecontroller/users_update_password';
/*
| -------------------------------------------------------------------------
| ADMIN DATA UMUM
| -------------------------------------------------------------------------
*/
/*
| -------------------------------------------------------------------------
| KELAS
| -------------------------------------------------------------------------
*/
$route['data_umum/kelas']                   = 'admin/data_umum/kelascontroller';
$route['data_umum/kelas/ajax_list']         = 'admin/data_umum/kelascontroller/ajax_list';
$route['data_umum/kelas/add']               = 'admin/data_umum/kelascontroller/add';
$route['data_umum/kelas/update']            = 'admin/data_umum/kelascontroller/update';
$route['data_umum/kelas/delete']            = 'admin/data_umum/kelascontroller/delete';
/*
| -------------------------------------------------------------------------
| SEMESTER
| -------------------------------------------------------------------------
*/
$route['data_umum/semester']                   = 'admin/data_umum/semestercontroller';
$route['data_umum/semester/ajax_list']         = 'admin/data_umum/semestercontroller/ajax_list';
$route['data_umum/semester/add']               = 'admin/data_umum/semestercontroller/add';
$route['data_umum/semester/update']            = 'admin/data_umum/semestercontroller/update';
$route['data_umum/semester/delete']            = 'admin/data_umum/semestercontroller/delete';
/*
| -------------------------------------------------------------------------
| TAHUN AJARAN
| -------------------------------------------------------------------------
*/
$route['data_umum/tahun_ajaran']                   = 'admin/data_umum/tahun_ajarancontroller';
$route['data_umum/tahun_ajaran/ajax_list']         = 'admin/data_umum/tahun_ajarancontroller/ajax_list';
$route['data_umum/tahun_ajaran/add']               = 'admin/data_umum/tahun_ajarancontroller/add';
$route['data_umum/tahun_ajaran/update']            = 'admin/data_umum/tahun_ajarancontroller/update';
$route['data_umum/tahun_ajaran/delete']            = 'admin/data_umum/tahun_ajarancontroller/delete';
/*
| -------------------------------------------------------------------------
| MATA PELAJARAN
| -------------------------------------------------------------------------
*/
$route['data_kegiatan/mata_pelajaran']                   = 'admin/data_kegiatan/mata_pelajarancontroller';
$route['data_kegiatan/mata_pelajaran/ajax_list']         = 'admin/data_kegiatan/mata_pelajarancontroller/ajax_list';
$route['data_kegiatan/mata_pelajaran/add']               = 'admin/data_kegiatan/mata_pelajarancontroller/add';
$route['data_kegiatan/mata_pelajaran/update']            = 'admin/data_kegiatan/mata_pelajarancontroller/update';
$route['data_kegiatan/mata_pelajaran/delete']            = 'admin/data_kegiatan/mata_pelajarancontroller/delete';
/*
| -------------------------------------------------------------------------
| EKSTRAKURIKULER
| -------------------------------------------------------------------------
*/
$route['data_kegiatan/ekstrakurikuler']                   = 'admin/data_kegiatan/ekstrakurikulercontroller';
$route['data_kegiatan/ekstrakurikuler/ajax_list']         = 'admin/data_kegiatan/ekstrakurikulercontroller/ajax_list';
$route['data_kegiatan/ekstrakurikuler/add']               = 'admin/data_kegiatan/ekstrakurikulercontroller/add';
$route['data_kegiatan/ekstrakurikuler/update']            = 'admin/data_kegiatan/ekstrakurikulercontroller/update';
$route['data_kegiatan/ekstrakurikuler/delete']            = 'admin/data_kegiatan/ekstrakurikulercontroller/delete';
/*
| -------------------------------------------------------------------------
| DATA SISWA
| -------------------------------------------------------------------------
*/
$route['siswa']                   = 'admin/siswacontroller';
$route['siswa/ajax_list']         = 'admin/siswacontroller/ajax_list';
$route['siswa/add']               = 'admin/siswacontroller/add';
$route['siswa/update']            = 'admin/siswacontroller/update';
$route['siswa/delete']            = 'admin/siswacontroller/delete';
/*
| -------------------------------------------------------------------------
| DATA GURU
| -------------------------------------------------------------------------
*/
$route['guru']                   = 'admin/gurucontroller';
$route['guru/ajax_list']         = 'admin/gurucontroller/ajax_list';
$route['guru/add']               = 'admin/gurucontroller/add';
$route['guru/update']            = 'admin/gurucontroller/update';
$route['guru/delete']            = 'admin/gurucontroller/delete';
/*
| -------------------------------------------------------------------------
| DATA KEPALA SEKOLAH
| -------------------------------------------------------------------------
*/
$route['kepala_sekolah']                   = 'admin/kepala_sekolahcontroller';
$route['kepala_sekolah/ajax_list']         = 'admin/kepala_sekolahcontroller/ajax_list';
$route['kepala_sekolah/add']               = 'admin/kepala_sekolahcontroller/add';
$route['kepala_sekolah/update']            = 'admin/kepala_sekolahcontroller/update';
$route['kepala_sekolah/delete']            = 'admin/kepala_sekolahcontroller/delete';
/*
| -------------------------------------------------------------------------
| DATA ORANG TUA
| -------------------------------------------------------------------------
*/
$route['orang_tua']                   = 'admin/orang_tuacontroller';
$route['orang_tua/ajax_list']         = 'admin/orang_tuacontroller/ajax_list';
$route['orang_tua/add']               = 'admin/orang_tuacontroller/add';
$route['orang_tua/update']            = 'admin/orang_tuacontroller/update';
$route['orang_tua/delete']            = 'admin/orang_tuacontroller/delete';
/*
| -------------------------------------------------------------------------
| DATA ADMIN
| -------------------------------------------------------------------------
*/
$route['admin']                   = 'admin/admincontroller';
$route['admin/ajax_list']         = 'admin/admincontroller/ajax_list';
$route['admin/add']               = 'admin/admincontroller/add';
$route['admin/update']            = 'admin/admincontroller/update';
$route['admin/delete']            = 'admin/admincontroller/delete';
/*
| -------------------------------------------------------------------------
| ABSENSI
| -------------------------------------------------------------------------
*/
$route['absensi']                                   = 'admin/absensicontroller';
$route['absensi/siswa_ajax_list']                   = 'admin/absensicontroller/siswa_ajax_list';
$route['absensi/add']                               = 'admin/absensicontroller/add';
//$route['absensi/laporan']                           = 'admin/absensicontroller/laporan';
$route['absensi/laporan_absensi_ajax_list']         = 'admin/absensicontroller/laporan_absensi_ajax_list';
$route['absensi/lihat/(:any)']                      = 'admin/absensicontroller/lihat/$1';
$route['absensi/laporan_pdf']                       = 'admin/absensicontroller/laporan_pdf';
$route['absensi/tampil_pdf']                        = 'admin/absensicontroller/tampil_pdf';
$route['absensi/izin_delete']                       = 'admin/absensicontroller/izin_delete';
$route['absensi/izin_konfirmasi']                   = 'admin/absensicontroller/izin_konfirmasi';
$route['absensi/laporan']                             = 'admin/absensicontroller/rekap';
$route['absensi/rekap_pdf']                         = 'admin/absensicontroller/rekap_pdf';
$route['absensi/rekap_absensi_ajax_list']           = 'admin/absensicontroller/rekap_absensi_ajax_list';
$route['absensi/delete_presensi']                   = 'admin/absensicontroller/delete_presensi';
/*
| -------------------------------------------------------------------------
| ABSENSI EKSTRAKURIKULER
| -------------------------------------------------------------------------
*/
$route['absensi/ekstrakurikuler']                                   = 'admin/form_ekstracontroller';
$route['absensi/ekstrakurikuler/add']                               = 'admin/form_ekstracontroller/add';
$route['absensi/ekstrakurikuler/laporan']                           = 'admin/form_ekstracontroller/laporan';
$route['absensi/ekstrakurikuler/laporan_ajax']                      = 'admin/form_ekstracontroller/laporan_ajax';
$route['absensi/ekstrakurikuler/delete']                            = 'admin/form_ekstracontroller/delete';
$route['absensi/ekstrakurikuler/laporan_pdf']                       = 'admin/form_ekstracontroller/laporan_pdf';
/*
| -------------------------------------------------------------------------
| SETTING WEB
| -------------------------------------------------------------------------
*/
$route['admin/setting']                         = 'admin/setting/settingcontroller';
$route['admin/setting/save_logo_image']         = 'admin/setting/settingcontroller/save_logo_image';
$route['admin/setting/save_setting']            = 'admin/setting/settingcontroller/save_setting';
/*
| -------------------------------------------------------------------------
| SISWA HOME
| -------------------------------------------------------------------------
*/
$route['siswa/home']                            = 'admin/home/homecontroller';
/*
| -------------------------------------------------------------------------
| GURU HOME
| -------------------------------------------------------------------------
*/
$route['guru/home']                            = 'admin/home/homecontroller';
/*
| -------------------------------------------------------------------------
| KEPALA SEKOLAH HOME
| -------------------------------------------------------------------------
*/
$route['kepala_sekolah/home']                            = 'admin/home/homecontroller';
/*
| -------------------------------------------------------------------------
| ORANG TUA HOME
| -------------------------------------------------------------------------
*/
$route['orang_tua/home']                            = 'admin/home/homecontroller';

$route['email']='admin/Sendmail';
$route['email/(:any)']='admin/Sendmail/ortu/$1';
$route['send']='admin/Sendmail/send';

/*
| -------------------------------------------------------------------------
| DATA AKTIFITAS
| -------------------------------------------------------------------------
*/
$route['aktifitas']                   = 'admin/aktifitascontroller';
$route['aktifitas/ajax_list']         = 'admin/aktifitascontroller/ajax_list';
$route['aktifitas/add']               = 'admin/aktifitascontroller/add';
$route['aktifitas/update']            = 'admin/aktifitascontroller/update';
$route['aktifitas/delete']            = 'admin/aktifitascontroller/delete';
