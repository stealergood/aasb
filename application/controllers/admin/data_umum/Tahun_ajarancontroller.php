<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahun_ajarancontroller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['tahun_model']);
        is_logged_in();
    }

    public function index()
    {
        $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'Tahun Ajaran';

        $data['script']     = $this->load->view('admin/data_umum/tahun_ajaran/script', $data, true);
        $data['content']    = $this->load->view('admin/data_umum/tahun_ajaran/index', $data, true);
        $this->load->view('admin/template', $data);
    }


    public function ajax_list()
    {
        $list = $this->tahun_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $data_tahun) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $data_tahun->tahun_ajaran;
            if ($data_tahun->status == 0) {
                $status = "No-Aktif";
            } else {
                $status = "Aktif";
            }
            $row[] = $status;
            $row[] = '<button type="button" id="button_edit_tahun_ajaran" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_edit_tahun_ajaran" data-id="' . $data_tahun->id_tahun_ajaran . '" data-tahun_ajaran="' . $data_tahun->tahun_ajaran . '" data-status="' . $data_tahun->status . '"><i class="bi bi-pencil" ></i></button> <button type="button" class="btn btn-danger btn-sm" id="button_hapus_tahun_ajaran" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_hapus_tahun_ajaran" data-id="' . $data_tahun->id_tahun_ajaran . '" data-tahun_ajaran="' . $data_tahun->tahun_ajaran . '"><i class="bi bi-trash"></i></button>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tahun_model->count_all(),
            "recordsFiltered" => $this->tahun_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $tahun_ajaran = $this->input->post('tahun_ajaran');
        $status = $this->input->post('status');

        $cek = $this->tahun_model->cek_tahun($tahun_ajaran)->num_rows();

        if ($cek == 0) {

            $data = array(
                'tahun_ajaran' => $tahun_ajaran,
                'status' => $status
            );

            $this->tahun_model->tambah_tahun_ajaran($data);

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
                'info' => "Tahun Ajaran Sudah Ada"
            ];
        }
        echo json_encode($params);
    }

    public function update()
    {
        $id_tahun_ajaran = $this->input->post('id_tahun_ajaran');
        $tahun_ajaran = $this->input->post('tahun_ajaran');
        $status = $this->input->post('status');

        $cek = $this->tahun_model->cek_tahun_ajaran_edit($tahun_ajaran, $id_tahun_ajaran)->num_rows();

        if ($cek == "0") {

            $data = array(
                'tahun_ajaran' => $tahun_ajaran,
                'status' => $status
            );

            $this->tahun_model->update_tahun_ajaran($data, $id_tahun_ajaran);

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
                'info' => "Tahun Ajaran Sudah Ada"
            ];
        }
        echo json_encode($params);
    }

    public function delete()
    {
        $id_tahun_ajaran = $this->input->post('id_tahun_ajaran');

        $this->tahun_model->delete_tahun_ajaran($id_tahun_ajaran);

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
