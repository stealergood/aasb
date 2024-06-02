<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homecontroller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['profil_model', 'admin_model', 'absensi_model']);
        is_logged_in();
    }

    public function index()
    {
        $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'Home';

        $data['jumlah_siswa'] = $this->absensi_model->jumlah_siswa();
        $data['jumlah_guru'] = $this->absensi_model->jumlah_guru();
        $data['jumlah_absensi'] = $this->absensi_model->jumlah_absensi();

        $data['script']     = $this->load->view('admin/home/script', $data, true);
        $data['content']    = $this->load->view('admin/home/index', $data, true);

        $this->load->view('admin/template', $data);
    }

    public function jumlah_kehadiran()
    {
        $list = $this->absensi_model->jumlah_kehadiran()->result();
        $data           = array();
        foreach ($list as $val) {
            if ($val->name == 'H') {
                $jenenge = "Hadir";
            } else if ($val->name == 'I') {
                $jenenge = "Izin";
            } else if ($val->name == 'S') {
                $jenenge = "Sakit";
            } else if ($val->name == 'A') {
                $jenenge = "Alpha";
            } else if ($val->name == 'T') {
                $jenenge = "Lainnya";
            }

            $row        = array(
                'name' => $jenenge,
                'value' => $val->value
            );

            $data[]     = $row;
        }
        echo json_encode($data);
    }

    public function users_profile()
    {
        $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'User Profil ' . $this->session->userdata('name');

        if ($this->session->userdata('jenis_login') == "admin") {
            $table = "tb_admin";
            $where = array(
                'username' => $this->session->userdata('username')
            );
            $data['data'] = $this->profil_model->get_detail_profil($table, $where);
            $data['script']     = $this->load->view('admin/profil/admin/script', $data, true);
            $data['content']    = $this->load->view('admin/profil/admin/index', $data, true);
        } else if ($this->session->userdata('jenis_login') == "siswa") {
            $table = "tb_siswa";
            $where = array(
                'username' => $this->session->userdata('username')
            );
            $data['data'] = $this->profil_model->get_detail_profil_siswa($table, $where);
            $data['data_kelas'] = $this->absensi_model->get_data_kelas();
            $data['script']     = $this->load->view('admin/profil/siswa/script', $data, true);
            $data['content']    = $this->load->view('admin/profil/siswa/index', $data, true);
        } else if ($this->session->userdata('jenis_login') == "guru") {
            $table = "tb_guru";
            $where = array(
                'username' => $this->session->userdata('username')
            );
            $data['data'] = $this->profil_model->get_detail_profil($table, $where);
            $data['script']     = $this->load->view('admin/profil/guru/script', $data, true);
            $data['content']    = $this->load->view('admin/profil/guru/index', $data, true);
        } else if ($this->session->userdata('jenis_login') == "kepala_sekolah") {
            $table = "tb_kepala_sekolah";
            $where = array(
                'username' => $this->session->userdata('username')
            );
            $data['data'] = $this->profil_model->get_detail_profil($table, $where);
            $data['script']     = $this->load->view('admin/profil/kepala_sekolah/script', $data, true);
            $data['content']    = $this->load->view('admin/profil/kepala_sekolah/index', $data, true);
        } else if ($this->session->userdata('jenis_login') == "orang_tua") {
            $table = "tb_orang_tua";
            $where = array(
                'username' => $this->session->userdata('username')
            );
            $data['data'] = $this->profil_model->get_detail_profil($table, $where);
            $data['script']     = $this->load->view('admin/profil/orang_tua/script', $data, true);
            $data['content']    = $this->load->view('admin/profil/orang_tua/index', $data, true);
        }

        $this->load->view('admin/template', $data);
    }

    public function users_update()
    {
        if ($this->session->userdata('jenis_login') == "admin") {
            $id_admin = $this->input->post('id_admin');
            $table = "tb_admin";

            $where = [
                'id_admin' => $id_admin
            ];
            $username = $this->input->post('username');

            $cek_data = [
                'username' => $username,
                'id_admin !=' => $id_admin
            ];

            $cek_username = $this->profil_model->cek_username_profil($cek_data, $table)->num_rows();

            if ($cek_username == 0) {

                $data = [
                    'name' => $this->input->post('name'),
                    'username' => $username
                ];

                $this->profil_model->update_profil($data, $where, $table);

                if ($this->db->affected_rows() > 0) {
                    $params = [
                        "status"   => true,
                        'info' => "Berhasil Update Data"
                    ];
                    $sess_data['username']      = $username;
                    $sess_data['name']          =  $this->input->post('name');
                    $this->session->set_userdata($sess_data);
                } else {
                    $params = [
                        "status"   => 'more',
                        'info' => "Tidak Ada Perubahan.."
                    ];
                }
            } else {
                $params = [
                    "status"   => 'username',
                    'info' => "Username Sudah Ada"
                ];
            }

            echo json_encode($params);
        } else if ($this->session->userdata('jenis_login') == "siswa") {
            // HALAMAN SISWA UPDATE PPOFIL
            $id_siswa = $this->input->post('id_siswa');
            $table = "tb_siswa";

            $where = [
                'id_siswa' => $id_siswa
            ];
            $username = $this->input->post('username');

            $cek_data = [
                'username' => $username,
                'id_siswa !=' => $id_siswa
            ];

            $cek_username = $this->profil_model->cek_username_profil($cek_data, $table)->num_rows();

            if ($cek_username == 0) {

                $data = [
                    'name' => $this->input->post('name'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'alamat' => $this->input->post('alamat'),
                    'tahun_masuk' => $this->input->post('tahun_masuk'),
                    'kelas' => $this->input->post('kelas'),
                    'username' => $username
                ];

                $this->profil_model->update_profil($data, $where, $table);

                if ($this->db->affected_rows() > 0) {
                    $params = [
                        "status"   => true,
                        'info' => "Berhasil Update Data"
                    ];
                    $sess_data['username']      = $username;
                    $sess_data['name']          =  $this->input->post('name');
                    $this->session->set_userdata($sess_data);
                } else {
                    $params = [
                        "status"   => 'more',
                        'info' => "Tidak Ada Perubahan.."
                    ];
                }
            } else {
                $params = [
                    "status"   => 'username',
                    'info' => "Username Sudah Ada"
                ];
            }

            echo json_encode($params);
        } else if ($this->session->userdata('jenis_login') == "guru") {
            // HALAMAN GURU UPDATE PPOFIL
            $id_guru = $this->input->post('id_guru');
            $table = "tb_guru";

            $where = [
                'id_guru' => $id_guru
            ];
            $username = $this->input->post('username');

            $cek_data = [
                'username' => $username,
                'id_guru !=' => $id_guru
            ];

            $cek_nip = [
                'nip_guru' => $this->input->post('id_guru'),
                'id_guru !=' => $id_guru
            ];

            $cek_nip_guru = $this->profil_model->cek_username_profil($cek_nip, $table)->num_rows();

            if ($cek_nip_guru == 0) {
                $cek_username = $this->profil_model->cek_username_profil($cek_data, $table)->num_rows();
                if ($cek_username == 0) {

                    $data = [
                        'nip_guru' => $this->input->post('nip_guru'),
                        'nama_guru' => $this->input->post('name'),
                        'email' => $this->input->post('email'),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                        'jabatan' => $this->input->post('jabatan'),
                        'no_telepon' => $this->input->post('no_telepon'),
                        'alamat' => $this->input->post('alamat'),
                        'username' => $username
                    ];

                    $this->profil_model->update_profil($data, $where, $table);

                    if ($this->db->affected_rows() > 0) {
                        $params = [
                            "status"   => true,
                            'info' => "Berhasil Update Data"
                        ];
                        $sess_data['username']      = $username;
                        $sess_data['name']          =  $this->input->post('name');
                        $this->session->set_userdata($sess_data);
                    } else {
                        $params = [
                            "status"   => 'more',
                            'info' => "Tidak Ada Perubahan.."
                        ];
                    }
                } else {
                    $params = [
                        "status"   => 'username',
                        'info' => "Username Sudah Ada"
                    ];
                }
            } else {
                $params = [
                    "status"   => 'nip',
                    'info' => "NIP Guru Sudah Ada"
                ];
            }

            echo json_encode($params);
        } else if ($this->session->userdata('jenis_login') == "kepala_sekolah") {
            // HALAMAN KEPALA SEKOLAH UPDATE PPOFIL
            $id_kepala_sekolah = $this->input->post('id_kepala_sekolah');
            $table = "tb_kepala_sekolah";

            $where = [
                'id_kepala_sekolah' => $id_kepala_sekolah
            ];
            $username = $this->input->post('username');

            $cek_data = [
                'username' => $username,
                'id_kepala_sekolah !=' => $id_kepala_sekolah
            ];

            $cek_nip = [
                'nip_kepala_sekolah' => $this->input->post('id_kepala_sekolah'),
                'id_kepala_sekolah !=' => $id_kepala_sekolah
            ];

            $cek_nip_kepala_sekolah = $this->profil_model->cek_username_profil($cek_nip, $table)->num_rows();

            if ($cek_nip_kepala_sekolah == 0) {
                $cek_username = $this->profil_model->cek_username_profil($cek_data, $table)->num_rows();
                if ($cek_username == 0) {

                    $data = [
                        'nip_kepala_sekolah' => $this->input->post('nip_kepala_sekolah'),
                        'name' => $this->input->post('name'),
                        'email' => $this->input->post('email'),
                        'alamat' => $this->input->post('alamat'),
                        'username' => $username
                    ];

                    $this->profil_model->update_profil($data, $where, $table);

                    if ($this->db->affected_rows() > 0) {
                        $params = [
                            "status"   => true,
                            'info' => "Berhasil Update Data"
                        ];
                        $sess_data['username']      = $username;
                        $sess_data['name']          =  $this->input->post('name');
                        $this->session->set_userdata($sess_data);
                    } else {
                        $params = [
                            "status"   => 'more',
                            'info' => "Tidak Ada Perubahan.."
                        ];
                    }
                } else {
                    $params = [
                        "status"   => 'username',
                        'info' => "Username Sudah Ada"
                    ];
                }
            } else {
                $params = [
                    "status"   => 'nip',
                    'info' => "NIP Kepala Sekolah Sudah Ada"
                ];
            }

            echo json_encode($params);
        } else if ($this->session->userdata('jenis_login') == "orang_tua") {
            // HALAMAN ORANG TUA UPDATE PPOFIL
            $id_orang_tua = $this->input->post('id_orang_tua');
            $table = "tb_orang_tua";

            $where = [
                'id_orang_tua' => $id_orang_tua
            ];
            $username = $this->input->post('username');

            $cek_data = [
                'username' => $username,
                'id_orang_tua !=' => $id_orang_tua
            ];

            $cek_username = $this->profil_model->cek_username_profil($cek_data, $table)->num_rows();
            if ($cek_username == 0) {

                $data = [
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'alamat' => $this->input->post('alamat'),
                    'no_telepon' => $this->input->post('no_telepon'),
                    'username' => $username
                ];

                $this->profil_model->update_profil($data, $where, $table);

                if ($this->db->affected_rows() > 0) {
                    $params = [
                        "status"   => true,
                        'info' => "Berhasil Update Data"
                    ];
                    $sess_data['username']      = $username;
                    $sess_data['name']          =  $this->input->post('name');
                    $this->session->set_userdata($sess_data);
                } else {
                    $params = [
                        "status"   => 'more',
                        'info' => "Tidak Ada Perubahan.."
                    ];
                }
            } else {
                $params = [
                    "status"   => 'username',
                    'info' => "Username Sudah Ada"
                ];
            }

            echo json_encode($params);
        }
    }

    public function users_update_password()
    {
        if ($this->session->userdata('jenis_login') == "admin") {
            $id_admin = $this->input->post('id_admin');
            $table = "tb_admin";

            $where = [
                'id_admin' => $id_admin
            ];

            $password_lama = $this->input->post('password_lama');

            $cek_profil = $this->profil_model->get_detail_profil($table, $where);

            if (password_verify($password_lama, $cek_profil['password'])) {

                $data = [
                    'password' =>  password_hash($this->input->post('password_baru'), PASSWORD_DEFAULT)
                ];

                $this->profil_model->update_profil($data, $where, $table);

                if ($this->db->affected_rows() > 0) {
                    $params = [
                        "status"   => true,
                        'info' => "Berhasil Update Data"
                    ];
                } else {
                    $params = [
                        "status"   => 'more',
                        'info' => "Tidak Ada Perubahan.."
                    ];
                }
            } else {
                $params = [
                    "status"   => 'password_lama',
                    'info' => "Password Lama Tidak Sama"
                ];
            }

            echo json_encode($params);
        } else if ($this->session->userdata('jenis_login') == "siswa") {
            $id_siswa = $this->input->post('id_siswa');
            $table = "tb_siswa";

            $where = [
                'id_siswa' => $id_siswa
            ];

            $password_lama = $this->input->post('password_lama');

            $cek_profil = $this->profil_model->get_detail_profil($table, $where);

            if (password_verify($password_lama, $cek_profil['password'])) {

                $data = [
                    'password' =>  password_hash($this->input->post('password_baru'), PASSWORD_DEFAULT)
                ];

                $this->profil_model->update_profil($data, $where, $table);

                if ($this->db->affected_rows() > 0) {
                    $params = [
                        "status"   => true,
                        'info' => "Berhasil Update Data"
                    ];
                } else {
                    $params = [
                        "status"   => 'more',
                        'info' => "Tidak Ada Perubahan.."
                    ];
                }
            } else {
                $params = [
                    "status"   => 'password_lama',
                    'info' => "Password Lama Tidak Sama"
                ];
            }

            echo json_encode($params);
        } else if ($this->session->userdata('jenis_login') == "guru") {
            $id_guru = $this->input->post('id_guru');
            $table = "tb_guru";

            $where = [
                'id_guru' => $id_guru
            ];

            $password_lama = $this->input->post('password_lama');

            $cek_profil = $this->profil_model->get_detail_profil($table, $where);

            if (password_verify($password_lama, $cek_profil['password'])) {

                $data = [
                    'password' =>  password_hash($this->input->post('password_baru'), PASSWORD_DEFAULT)
                ];

                $this->profil_model->update_profil($data, $where, $table);

                if ($this->db->affected_rows() > 0) {
                    $params = [
                        "status"   => true,
                        'info' => "Berhasil Update Data"
                    ];
                } else {
                    $params = [
                        "status"   => 'more',
                        'info' => "Tidak Ada Perubahan.."
                    ];
                }
            } else {
                $params = [
                    "status"   => 'password_lama',
                    'info' => "Password Lama Tidak Sama"
                ];
            }

            echo json_encode($params);
        } else if ($this->session->userdata('jenis_login') == "kepala_sekolah") {
            $id_kepala_sekolah = $this->input->post('id_kepala_sekolah');
            $table = "tb_kepala_sekolah";

            $where = [
                'id_kepala_sekolah' => $id_kepala_sekolah
            ];

            $password_lama = $this->input->post('password_lama');

            $cek_profil = $this->profil_model->get_detail_profil($table, $where);

            if (password_verify($password_lama, $cek_profil['password'])) {

                $data = [
                    'password' =>  password_hash($this->input->post('password_baru'), PASSWORD_DEFAULT)
                ];

                $this->profil_model->update_profil($data, $where, $table);

                if ($this->db->affected_rows() > 0) {
                    $params = [
                        "status"   => true,
                        'info' => "Berhasil Update Data"
                    ];
                } else {
                    $params = [
                        "status"   => 'more',
                        'info' => "Tidak Ada Perubahan.."
                    ];
                }
            } else {
                $params = [
                    "status"   => 'password_lama',
                    'info' => "Password Lama Tidak Sama"
                ];
            }

            echo json_encode($params);
        } else if ($this->session->userdata('jenis_login') == "orang_tua") {
            $id_orang_tua = $this->input->post('id_orang_tua');
            $table = "tb_orang_tua";

            $where = [
                'id_orang_tua' => $id_orang_tua
            ];

            $password_lama = $this->input->post('password_lama');

            $cek_profil = $this->profil_model->get_detail_profil($table, $where);

            if (password_verify($password_lama, $cek_profil['password'])) {

                $data = [
                    'password' =>  password_hash($this->input->post('password_baru'), PASSWORD_DEFAULT)
                ];

                $this->profil_model->update_profil($data, $where, $table);

                if ($this->db->affected_rows() > 0) {
                    $params = [
                        "status"   => true,
                        'info' => "Berhasil Update Data"
                    ];
                } else {
                    $params = [
                        "status"   => 'more',
                        'info' => "Tidak Ada Perubahan.."
                    ];
                }
            } else {
                $params = [
                    "status"   => 'password_lama',
                    'info' => "Password Lama Tidak Sama"
                ];
            }

            echo json_encode($params);
        }
    }
}
