<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gurucontroller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['guru_model']);
        $this->session->set_flashdata('sebagai','guru');
        is_logged_in();
    }

    public function index()
    {
        $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'Data Guru';

        $data['script']     = $this->load->view('admin/guru/script', $data, true);
        $data['content']    = $this->load->view('admin/guru/index', $data, true);
        $this->load->view('admin/template', $data);
    }


    public function ajax_list()
    {
        $list = $this->guru_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $data_guru) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $data_guru->nip_guru;
            $row[] = $data_guru->nama_guru;
            $row[] = $data_guru->email;
            $row[] = $data_guru->jabatan;
            $row[] = $data_guru->no_telepon;
            if ($data_guru->jenis_kelamin == "L") {
                $jk = "Laki - laki";
            } else {
                $jk = "Perempuan";
            }
            $jenis_login = $this->session->userdata('jenis_login');
            $jenis = array("admin", "kepala_sekolah");

            if (in_array($jenis_login, $jenis)) {
                $row[] = '<button type="button" id="button_view_guru" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal_view_guru" data-id="' . $data_guru->id_guru . '" data-nip_guru="' . $data_guru->nip_guru . '" data-nama="' . $data_guru->nama_guru . '" data-email="' . $data_guru->email . '" data-jenis_kelamin="' . $data_guru->jenis_kelamin . $jk . '" data-jabatan="' . $data_guru->jabatan . '" data-alamat="' . $data_guru->alamat . '" data-no_telepon="' . $data_guru->no_telepon . '" data-username="' . $data_guru->username . '"><i class="bi bi-info-circle"></i></button> <button type="button" id="button_edit_guru" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_edit_guru" data-id="' . $data_guru->id_guru . '" data-nip_guru="' . $data_guru->nip_guru . '" data-nama="' . $data_guru->nama_guru . '" data-email="' . $data_guru->email . '" data-jenis_kelamin="' . $data_guru->jenis_kelamin . '" data-jabatan="' . $data_guru->jabatan . '" data-alamat="' . $data_guru->alamat . '" data-no_telepon="' . $data_guru->no_telepon . '" data-username="' . $data_guru->username . '"><i class="bi bi-pencil" ></i></button> <button type="button" class="btn btn-danger btn-sm" id="button_hapus_guru" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_hapus_guru" data-id="' . $data_guru->id_guru . '" data-nama="' . $data_guru->nama_guru . '"><i class="bi bi-trash"></i></button>';
            } else {
                $row[] = '<button type="button" id="button_view_guru" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal_view_guru" data-id="' . $data_guru->id_guru . '" data-nip_guru="' . $data_guru->nip_guru . '" data-nama="' . $data_guru->nama_guru . '" data-email="' . $data_guru->email . '" data-jenis_kelamin="' . $data_guru->jenis_kelamin .  $jk . '" data-jabatan="' . $data_guru->jabatan . '" data-alamat="' . $data_guru->alamat . '" data-no_telepon="' . $data_guru->no_telepon . '" data-username="' . $data_guru->username . '"><i class="bi bi-info-circle"></i></button>';
            }
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->guru_model->count_all(),
            "recordsFiltered" => $this->guru_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
        //var_dump($output);
    }


    public function add()
    {
        $nip_guru = $this->input->post('nip_guru');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $jabatan = $this->input->post('jabatan');
        $alamat = $this->input->post('alamat');
        $no_telepon = $this->input->post('no_telepon');
        $username = $this->input->post('username');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        $cek = $this->guru_model->cek_nip_guru($nip_guru)->num_rows();

        if ($cek == 0) {

            $cek_username = $this->guru_model->cek_username_guru($username)->num_rows();

            if ($cek_username == 0) {
                $data = array(
                    'nip_guru' => $nip_guru,
                    'nama_guru' => $nama,
                    'email' => $email,
                    'jenis_kelamin' => $jenis_kelamin,
                    'jabatan' => $jabatan,
                    'alamat' => $alamat,
                    'no_telepon' => $no_telepon,
                    'username' => $username,
                    'password' => $password
                );

                $this->guru_model->tambah_guru($data);

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
                    'info' => "Username Guru Sudah Ada"
                ];
            }
        } else {
            $params = [
                "status"   => false,
                'info' => "Nip Guru Sudah Ada"
            ];
        }

        echo json_encode($params);
    }

    public function update()
    {
        $id_guru = $this->input->post('id_guru');
        $nip_guru = $this->input->post('nip_guru');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $jabatan = $this->input->post('jabatan');
        $alamat = $this->input->post('alamat');
        $no_telepon = $this->input->post('no_telepon');
        $username = $this->input->post('username');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        $cek = $this->guru_model->cek_guru_edit($nip_guru, $id_guru)->num_rows();

        if ($cek == "0") {
            $cek_username = $this->guru_model->cek_edit_username_guru($username, $id_guru)->num_rows();
            if ($cek_username == 0) {
                $data = [
                    'nip_guru' => $nip_guru,
                    'nama_guru' => $nama,
                    'email' => $email,
                    'jenis_kelamin' => $jenis_kelamin,
                    'jabatan' => $jabatan,
                    'alamat' => $alamat,
                    'no_telepon' => $no_telepon,
                    'username' => $username
                ];

                if ($this->input->post('password') != '') {
                    $data['password'] = $password;
                }

                $this->guru_model->update_guru($data, $id_guru);

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
                    'info' => "Username Guru Sudah Ada"
                ];
            }
        } else {
            $params = [
                "status"   => false,
                'info' => "NIP Guru Sudah Ada"
            ];
        }
        echo json_encode($params);
    }

    public function delete()
    {
        $id_guru = $this->input->post('id_guru');

        $this->guru_model->delete_guru($id_guru);

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
