<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orang_tuacontroller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['orang_tua_model']);
        $this->session->set_flashdata('sebagai','orang_tua');
        is_logged_in();
    }

    public function index()
    {
        $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'Data Orangtua';

        $data['script']     = $this->load->view('admin/orang_tua/script', $data, true);
        $data['content']    = $this->load->view('admin/orang_tua/index', $data, true);
        $this->load->view('admin/template', $data);
    }


    public function ajax_list()
    {
        $list = $this->orang_tua_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $data_orang_tua) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $data_orang_tua->name;
           // $row[] = $data_orang_tua->alamat;
           // $row[] = $data_orang_tua->username;
            $row[] = $data_orang_tua->alamat;
            $row[] = $data_orang_tua->email;
            $row[] = $data_orang_tua->no_telepon;
            $jenis_login = $this->session->userdata('jenis_login');
            $jenis = array("admin", "guru", "kepala_sekolah");

            if (in_array($jenis_login, $jenis)) {
                $row[] = '<button type="button" id="button_view_orang_tua" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal_view_orang_tua" data-id="' . $data_orang_tua->id_orang_tua . '" data-nama="' . $data_orang_tua->name . '" data-email="' . $data_orang_tua->email . '" data-alamat="' . $data_orang_tua->alamat . '" data-no_telepon="' . $data_orang_tua->no_telepon . '" data-username="' . $data_orang_tua->username . '"><i class="bi bi-info-circle"></i></button> <button type="button" id="button_edit_orang_tua" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_edit_orang_tua" data-id="' . $data_orang_tua->id_orang_tua . '" data-nama="' . $data_orang_tua->name . '" data-email="' . $data_orang_tua->email . '"  data-alamat="' . $data_orang_tua->alamat . '" data-no_telepon="' . $data_orang_tua->no_telepon . '" data-username="' . $data_orang_tua->username . '"><i class="bi bi-pencil" ></i></button> <button type="button" class="btn btn-danger btn-sm" id="button_hapus_orang_tua" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_hapus_orang_tua" data-id="' . $data_orang_tua->id_orang_tua . '" data-nama="' . $data_orang_tua->name . '"><i class="bi bi-trash"></i></button>';
            } else {
                $row[] = '<button type="button" id="button_view_orang_tua" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal_view_orang_tua" data-id="' . $data_orang_tua->id_orang_tua . '" data-nama="' . $data_orang_tua->name . '" data-email="' . $data_orang_tua->email . '" data-alamat="' . $data_orang_tua->alamat . '" data-no_telepon="' . $data_orang_tua->no_telepon . '" data-username="' . $data_orang_tua->username . '"><i class="bi bi-info-circle"></i></button>';
            }
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->orang_tua_model->count_all(),
            "recordsFiltered" => $this->orang_tua_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $no_telepon = $this->input->post('no_telepon');
        $username = $this->input->post('username');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        $cek_username = $this->orang_tua_model->cek_username_orang_tua($username)->num_rows();

        if ($cek_username == 0) {
            $data = array(
                'name' => $nama,
                'email' => $email,
                'alamat' => $alamat,
                'no_telepon' => $no_telepon,
                'username' => $username,
                'password' => $password
            );

            $this->orang_tua_model->tambah_orang_tua($data);

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
                'info' => "Username Orang Tua Sudah Ada"
            ];
        }

        echo json_encode($params);
    }

    public function update()
    {
        $id_orang_tua = $this->input->post('id_orang_tua');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $no_telepon = $this->input->post('no_telepon');
        $username = $this->input->post('username');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        $cek_username = $this->orang_tua_model->cek_edit_username_orang_tua($username, $id_orang_tua)->num_rows();
        if ($cek_username == 0) {
            $data = [
                'name' => $nama,
                'email' => $email,
                'alamat' => $alamat,
                'no_telepon' => $no_telepon,
                'username' => $username
            ];

            if ($this->input->post('password') != '') {
                $data['password'] = $password;
            }

            $this->orang_tua_model->update_orang_tua($data, $id_orang_tua);

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
                'info' => "Username Orang Tua Sudah Ada"
            ];
        }

        echo json_encode($params);
    }

    public function delete()
    {
        $id_orang_tua = $this->input->post('id_orang_tua');

        $this->orang_tua_model->delete_orang_tua($id_orang_tua);

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
