<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admincontroller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['admin_model']);
        $this->session->set_flashdata('sebagai','admin');
        is_logged_in();
    }

    public function index()
    {
        $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'Data Admin';

        $data['script']     = $this->load->view('admin/admin/script', $data, true);
        $data['content']    = $this->load->view('admin/admin/index', $data, true);
        $this->load->view('admin/template', $data);
    }


    public function ajax_list()
    {
        $list = $this->admin_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $data_admin) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $data_admin->name;
            $row[] = $data_admin->username;
            $row[] = '<button type="button" id="button_view_admin" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal_view_admin" data-id="' . $data_admin->id_admin . '" data-nama="' . $data_admin->name . '" data-username="' . $data_admin->username . '"><i class="bi bi-info-circle"></i></button> <button type="button" id="button_edit_admin" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_edit_admin" data-id="' . $data_admin->id_admin . '" data-nama="' . $data_admin->name . '" data-username="' . $data_admin->username . '"><i class="bi bi-pencil" ></i></button> <button type="button" class="btn btn-danger btn-sm" id="button_hapus_admin" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_hapus_admin" data-id="' . $data_admin->id_admin . '" data-nama="' . $data_admin->name . '"><i class="bi bi-trash"></i></button>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->admin_model->count_all(),
            "recordsFiltered" => $this->admin_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        $cek_username = $this->admin_model->cek_username_admin($username)->num_rows();

        if ($cek_username == 0) {
            $data = array(
                'name' => $nama,
                'username' => $username,
                'password' => $password
            );

            $this->admin_model->tambah_admin($data);

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
                'info' => "Username Admin Sudah Ada"
            ];
        }

        echo json_encode($params);
    }

    public function update()
    {
        $id_admin = $this->input->post('id_admin');
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        $cek_username = $this->admin_model->cek_edit_username_admin($username, $id_admin)->num_rows();
        if ($cek_username == 0) {
            $data = [
                'name' => $nama,
                'username' => $username
            ];

            if ($this->input->post('password') != '') {
                $data['password'] = $password;
            }

            $this->admin_model->update_admin($data, $id_admin);

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
        $id_admin = $this->input->post('id_admin');

        $this->admin_model->delete_admin($id_admin);

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
