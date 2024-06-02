<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kepala_sekolahcontroller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['kepala_sekolah_model']);
        $this->session->set_flashdata('sebagai', 'kepala_sekolah');
        is_logged_in();
    }

    public function index()
    {
        $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'Data Kepala Sekolah';

        $data['script']     = $this->load->view('admin/kepala_sekolah/script', $data, true);
        $data['content']    = $this->load->view('admin/kepala_sekolah/index', $data, true);
        $this->load->view('admin/template', $data);
    }


    public function ajax_list()
    {
        $list = $this->kepala_sekolah_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $data_kepala_sekolah) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $data_kepala_sekolah->nip_kepala_sekolah;
            $row[] = $data_kepala_sekolah->name;
            $row[] = $data_kepala_sekolah->email;
            //   $row[] = $data_kepala_sekolah->username;
            $row[] = $data_kepala_sekolah->alamat;
            $row[] = $data_kepala_sekolah->status ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Non Aktif</span>';
            $jenis_login = $this->session->userdata('jenis_login');
            $jenis = array("admin");

            if (in_array($jenis_login, $jenis)) {
                $row[] = '<button type="button" id="button_view_kepala_sekolah" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal_view_kepala_sekolah" data-id="' . $data_kepala_sekolah->id_kepala_sekolah . '" data-nip_kepala_sekolah="' . $data_kepala_sekolah->nip_kepala_sekolah . '" data-nama="' . $data_kepala_sekolah->name . '" data-email="' . $data_kepala_sekolah->email . '" data-alamat="' . $data_kepala_sekolah->alamat . '" data-username="' . $data_kepala_sekolah->username . '"><i class="bi bi-info-circle"></i></button> <button type="button" id="button_edit_kepala_sekolah" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_edit_kepala_sekolah" data-id="' . $data_kepala_sekolah->id_kepala_sekolah . '" data-nip_kepala_sekolah="' . $data_kepala_sekolah->nip_kepala_sekolah . '" data-nama="' . $data_kepala_sekolah->name . '" data-email="' . $data_kepala_sekolah->email . '" data-alamat="' . $data_kepala_sekolah->alamat . '" data-username="' . $data_kepala_sekolah->username . '" data-status_kepala="' . $data_kepala_sekolah->status . '"><i class="bi bi-pencil" ></i></button> <button type="button" class="btn btn-danger btn-sm" id="button_hapus_kepala_sekolah" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_hapus_kepala_sekolah" data-id="' . $data_kepala_sekolah->id_kepala_sekolah . '" data-nama="' . $data_kepala_sekolah->name . '"><i class="bi bi-trash"></i></button>';
            } else {
                $row[] = '<button type="button" id="button_view_kepala_sekolah" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal_view_kepala_sekolah" data-id="' . $data_kepala_sekolah->id_kepala_sekolah . '" data-nip_kepala_sekolah="' . $data_kepala_sekolah->nip_kepala_sekolah . '" data-nama="' . $data_kepala_sekolah->name . '" data-email="' . $data_kepala_sekolah->email . '" data-alamat="' . $data_kepala_sekolah->alamat . '" data-username="' . $data_kepala_sekolah->username . '"><i class="bi bi-info-circle"></i></button>';
            }
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->kepala_sekolah_model->count_all(),
            "recordsFiltered" => $this->kepala_sekolah_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $nip_kepala_sekolah = $this->input->post('nip_kepala_sekolah');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $status = $this->input->post('status');
        $username = $this->input->post('username');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        $cek = $this->kepala_sekolah_model->cek_nip_kepala_sekolah($nip_kepala_sekolah)->num_rows();

        if ($cek == 0) {

            $cek_username = $this->kepala_sekolah_model->cek_username_kepala_sekolah($username)->num_rows();

            if ($cek_username == 0) {
                $data = array(
                    'nip_kepala_sekolah' => $nip_kepala_sekolah,
                    'name' => $nama,
                    'email' => $email,
                    'alamat' => $alamat,
                    'status' => $status,
                    'username' => $username,
                    'password' => $password
                );

                $this->kepala_sekolah_model->tambah_kepala_sekolah($data);

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
                    'info' => "Username Kepala Sekolah Sudah Ada"
                ];
            }
        } else {
            $params = [
                "status"   => false,
                'info' => "Nip Kepala Sekolah Sudah Ada"
            ];
        }

        echo json_encode($params);
    }

    public function update()
    {
        $id_kepala_sekolah = $this->input->post('id_kepala_sekolah');
        $nip_kepala_sekolah = $this->input->post('nip_kepala_sekolah');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $status = $this->input->post('status');
        $username = $this->input->post('username');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        $cek = $this->kepala_sekolah_model->cek_kepala_sekolah_edit($nip_kepala_sekolah, $id_kepala_sekolah)->num_rows();

        if ($cek == "0") {
            $cek_username = $this->kepala_sekolah_model->cek_edit_username_kepala_sekolah($username, $id_kepala_sekolah)->num_rows();
            if ($cek_username == 0) {
                $data = [
                    'nip_kepala_sekolah' => $nip_kepala_sekolah,
                    'name' => $nama,
                    'email' => $email,
                    'alamat' => $alamat,
                    'status' => $status,
                    'username' => $username
                ];

                if ($this->input->post('password') != '') {
                    $data['password'] = $password;
                }

                $this->kepala_sekolah_model->update_kepala_sekolah($data, $id_kepala_sekolah);

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
                    'info' => "Username Kepala Sekolah Sudah Ada"
                ];
            }
        } else {
            $params = [
                "status"   => false,
                'info' => "NIP Kepala Sekolah Sudah Ada"
            ];
        }
        echo json_encode($params);
    }

    public function delete()
    {
        $id_kepala_sekolah = $this->input->post('id_kepala_sekolah');

        $this->kepala_sekolah_model->delete_kepala_sekolah($id_kepala_sekolah);

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
