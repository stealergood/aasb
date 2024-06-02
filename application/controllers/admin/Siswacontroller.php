<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswacontroller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['siswa_model']);
        $this->load->model(['orang_tua_model']);
        $this->load->model(['guru_model']);
        $this->session->set_flashdata('sebagai', 'siswa');
        is_logged_in();
    }

    public function index()
    {
        $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'Data Siswa';

        $data['data_kelas'] = $this->siswa_model->get_data_kelas();
        $data['data_ortu'] = $this->orang_tua_model->get_data_ortu();
        $data['data_guru'] = $this->guru_model->get_data_guru();

        $data['script']     = $this->load->view('admin/siswa/script', $data, true);
        $data['content']    = $this->load->view('admin/siswa/index', $data, true);
        $this->load->view('admin/template', $data);
    }


    public function ajax_list()
    {
        $list = $this->siswa_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $data_siswa) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $data_siswa->nis_siswa;
            $row[] = $data_siswa->name;
            $row[] = $data_siswa->nama_kelas;
            $row[] = $data_siswa->tahun_masuk;
            //$row[] = $data_siswa->email_orangtua;
            $row[] = $data_siswa->nama_orangtua;
            $row[] = $data_siswa->nama_guru;
            if ($data_siswa->jenis_kelamin == "L") {
                $jk = "Laki - laki";
            } else {
                $jk = "Perempuan";
            }
            $jenis_login = $this->session->userdata('jenis_login');
            $jenis = array("admin", "guru", "kepala_sekolah");

            if (in_array($jenis_login, $jenis)) {
                $row[] = '<button type="button" id="button_view_siswa" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal_view_siswa" data-id="' . $data_siswa->id_siswa . '" data-nis_siswa="' . $data_siswa->nis_siswa . '" data-nama="' . $data_siswa->name . '" data-kelas="' . $data_siswa->nama_kelas . '" data-jenis_kelamin="' . $jk . '" data-alamat="' . $data_siswa->alamat . '" data-tahun_masuk="' . $data_siswa->tahun_masuk . '" data-nama_orangtua="' . $data_siswa->nama_orangtua . '" data-username="' . $data_siswa->username . '" data-nama_guru="' . $data_siswa->nama_guru . '"><i class="bi bi-info-circle"></i></button> <button type="button" id="button_edit_siswa" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_edit_siswa" data-id="' . $data_siswa->id_siswa . '" data-nis_siswa="' . $data_siswa->nis_siswa . '" data-nama="' . $data_siswa->name . '" data-kelas="' . $data_siswa->kelas . '" data-jenis_kelamin="' . $data_siswa->jenis_kelamin . '" data-alamat="' . $data_siswa->alamat . '" data-id_orang_tua="' . $data_siswa->id_orang_tua . '" data-tahun_masuk="' . $data_siswa->tahun_masuk . '" data-username="' . $data_siswa->username . '" data-id_guru="' . $data_siswa->id_guru . '"><i class="bi bi-pencil" ></i></button> <button type="button" class="btn btn-danger btn-sm" id="button_hapus_siswa" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_hapus_siswa" data-id="' . $data_siswa->id_siswa . '" data-nama="' . $data_siswa->name . '"><i class="bi bi-trash"></i></button>';
            } else {
                $row[] = '<button type="button" id="button_view_siswa" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal_view_siswa" data-id="' . $data_siswa->id_siswa . '" data-nis_siswa="' . $data_siswa->nis_siswa . '" data-nama="' . $data_siswa->name . '" data-kelas="' . $data_siswa->nama_kelas . '" data-jenis_kelamin="' . $jk . '" data-alamat="' . $data_siswa->alamat . '" data-tahun_masuk="' . $data_siswa->tahun_masuk . '" data-id_orang_tua="' . $data_siswa->id_orang_tua . '"  data-guru="' . $data_siswa->id_guru . '" data-username="' . $data_siswa->username . '"><i class="bi bi-info-circle"></i></button>';
            }
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->siswa_model->count_all(),
            "recordsFiltered" => $this->siswa_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $nis_siswa = $this->input->post('nis_siswa');
        $nama = $this->input->post('nama');
        $kelas = $this->input->post('kelas');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $alamat = $this->input->post('alamat');
        $tahun_masuk = $this->input->post('tahun_masuk');
        $username = $this->input->post('username');
        //$email_orangtua = $this->input->post('email_orangtua');
        $id_orang_tua = $this->input->post('id_orang_tua');
        $id_guru = $this->input->post('id_guru');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        $cek = $this->siswa_model->cek_nis_siswa($nis_siswa)->num_rows();

        if ($cek == 0) {

            $cek_username = $this->siswa_model->cek_username_siswa($username)->num_rows();

            if ($cek_username == 0) {

                $data = array(
                    'nis_siswa' => $nis_siswa,
                    'name' => $nama,
                    'kelas' => $kelas,
                    'jenis_kelamin' => $jenis_kelamin,
                    'alamat' => $alamat,
                    'tahun_masuk' => $tahun_masuk,
                    'username' => $username,
                    'password' => $password,
                    // 'email_orangtua' => $email_orangtua
                    'id_orang_tua' => $id_orang_tua,
                    'id_guru' => $id_guru
                );

                $this->siswa_model->tambah_siswa($data);

                if ($this->db->affected_rows() > 0) {
                    $params = [
                        "status"   => true,
                        'info' => "Berhasil Simpan Data"
                    ];
                } else {
                    $params = [
                        "status"   => false,
                        'info' => "Gagal Simpan Data"
                    ];
                }
            } else {
                $params = [
                    "status"   => 'username',
                    'info' => "Username Siswa Sudah Ada"
                ];
            }
        } else {
            $params = [
                "status"   => false,
                'info' => "Nis Siswa Sudah Ada"
            ];
        }

        echo json_encode($params);
    }

    public function update()
    {
        $id_siswa = $this->input->post('id_siswa');
        $nis_siswa = $this->input->post('nis_siswa');
        $nama = $this->input->post('nama');
        $kelas = $this->input->post('kelas');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $alamat = $this->input->post('alamat');
        $tahun_masuk = $this->input->post('tahun_masuk');
        $username = $this->input->post('username');
        //$email_orangtua = $this->input->post('email_orangtua');
        $id_orang_tua = $this->input->post('id_orang_tua');
        $id_guru = $this->input->post('id_guru');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        $cek = $this->siswa_model->cek_siswa_edit($nis_siswa, $id_siswa)->num_rows();

        if ($cek == "0") {
            $cek_username = $this->siswa_model->cek_edit_username_siswa($username, $id_siswa)->num_rows();
            if ($cek_username == 0) {
                $data = [
                    'nis_siswa' => $nis_siswa,
                    'name' => $nama,
                    'kelas' => $kelas,
                    'jenis_kelamin' => $jenis_kelamin,
                    'alamat' => $alamat,
                    'tahun_masuk' => $tahun_masuk,
                    // 'email_orangtua' => $email_orangtua,
                    'id_orang_tua' => $id_orang_tua,
                    'id_guru' => $id_guru,
                    'username' => $username
                ];

                if ($this->input->post('password') != '') {
                    $data['password'] = $password;
                }

                $this->siswa_model->update_siswa($data, $id_siswa);

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
                    "status"   => 'username',
                    'info' => "Username Siswa Sudah Ada"
                ];
            }
        } else {
            $params = [
                "status"   => false,
                'info' => "NIS siswa Sudah Ada"
            ];
        }
        echo json_encode($params);
    }

    public function delete()
    {
        $id_siswa = $this->input->post('id_siswa');

        $this->siswa_model->delete_siswa($id_siswa);

        if ($this->db->affected_rows() > 0) {
            $params = [
                "status"   => true,
                'info' => "Berhasil Hapus Data"
            ];
        } else {
            $params = [
                "status"   => 'false',
                'info' => "Gagal Hapus Data"
            ];
        }
        echo json_encode($params);
    }
}
