<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelascontroller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['kelas_model']);
        is_logged_in();
    }

    public function index()
    {
        $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'Kelas';

        $data['script']     = $this->load->view('admin/data_umum/kelas/script', $data, true);
        $data['content']    = $this->load->view('admin/data_umum/kelas/index', $data, true);
        $this->load->view('admin/template', $data);
    }


    public function ajax_list()
    {
        $list = $this->kelas_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $data_kelas) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $data_kelas->ta_kelas;
            $row[] = $data_kelas->nama_kelas;
            if ($data_kelas->status == 0) {
                $status = "No-Aktif";
            } else {
                $status = "Aktif";
            }
            $row[] = $status;
            $row[] = '<button type="button" id="button_edit_kelas" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit_kelas" data-id="' . $data_kelas->id_kelas . '" data-ta="' . $data_kelas->ta_kelas . '" data-nama="' . $data_kelas->nama_kelas . '" data-status="' . $data_kelas->status . '"><i class="bi bi-pencil" ></i></button> <button type="button" class="btn btn-danger btn-sm" id="button_hapus_kelas" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_hapus_kelas" data-id="' . $data_kelas->id_kelas . '" data-nama="' . $data_kelas->nama_kelas . '"><i class="bi bi-trash"></i></button>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->kelas_model->count_all(),
            "recordsFiltered" => $this->kelas_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $ta_kelas = $this->input->post('ta_kelas');
        $nama_kelas = $this->input->post('nama_kelas');
        $status_kelas = $this->input->post('status_kelas');

        $cek = $this->kelas_model->cek_ta_kelas($ta_kelas)->num_rows();

        if ($cek == 0) {

            $data = array(
                'ta_kelas' => $ta_kelas,
                'nama_kelas' => $nama_kelas,
                'status' => $status_kelas
            );

            $this->kelas_model->tambah_kelas($data);

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
                "status"   => false,
                'info' => "Kode Kelas Sudah Ada"
            ];
        }
        echo json_encode($params);
    }

    public function update()
    {
        $id_kelas = $this->input->post('id_kelas');
        $ta_kelas = $this->input->post('ta_kelas');
        $nama_kelas = $this->input->post('nama_kelas');
        $status_kelas = $this->input->post('status_kelas');

        $cek = $this->kelas_model->cek_ta_kelas_edit($ta_kelas, $id_kelas)->num_rows();

        if ($cek == "0") {

            $data = array(
                'ta_kelas' => $ta_kelas,
                'nama_kelas' => $nama_kelas,
                'status' => $status_kelas
            );

            $this->kelas_model->update_kelas($data, $id_kelas);

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
                "status"   => false,
                'info' => "Kode Kelas Sudah Ada"
            ];
        }
        echo json_encode($params);
    }

    public function delete()
    {
        $id_kelas = $this->input->post('id_kelas');

        $this->kelas_model->delete_kelas($id_kelas);

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
