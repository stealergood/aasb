<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mata_pelajarancontroller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['mapel_model']);
        is_logged_in();
    }

    public function index()
    {
        $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'Mata Pelajaran';

        $data['script']     = $this->load->view('admin/data_kegiatan/mata_pelajaran/script', $data, true);
        $data['content']    = $this->load->view('admin/data_kegiatan/mata_pelajaran/index', $data, true);
        $this->load->view('admin/template', $data);
    }


    public function ajax_list()
    {
        $list = $this->mapel_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $data_mapel) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $data_mapel->kode_mapel;
            $row[] = $data_mapel->nama_mapel;
            if ($data_mapel->status == 0) {
                $status = "No-Aktif";
            } else {
                $status = "Aktif";
            }
            $row[] = $status;
            
            $jenis_login = $this->session->userdata('jenis_login');
            $jenis = array("admin", "guru", "kepala_sekolah");

            if (in_array($jenis_login, $jenis)) {
                $row[] = '<button type="button" id="button_edit_mapel" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_edit_mapel" data-id="' . $data_mapel->id_mapel . '" data-kode="' . $data_mapel->kode_mapel . '" data-nama="' . $data_mapel->nama_mapel . '" data-status="' . $data_mapel->status . '"><i class="bi bi-pencil" ></i></button> <button type="button" class="btn btn-danger btn-sm" id="button_hapus_mapel" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_hapus_mapel" data-id="' . $data_mapel->id_mapel . '" data-nama="' . $data_mapel->nama_mapel . '"><i class="bi bi-trash"></i></button>';
            }else{
                $row[] = "";
            }

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mapel_model->count_all(),
            "recordsFiltered" => $this->mapel_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $kode_mapel = $this->input->post('kode_mapel');
        $nama_mapel = $this->input->post('nama_mapel');
        $status = $this->input->post('status');

        $cek = $this->mapel_model->cek_mapel($kode_mapel)->num_rows();

        if ($cek == 0) {

            $data = array(
                'kode_mapel' => $kode_mapel,
                'nama_mapel' => $nama_mapel,
                'status' => $status
            );

            $this->mapel_model->tambah_mapel($data);

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
                'info' => "Kode Mata Pelajaran Sudah Ada"
            ];
        }
        echo json_encode($params);
    }

    public function update()
    {
        $id_mapel = $this->input->post('id_mapel');
        $kode_mapel = $this->input->post('kode_mapel');
        $nama_mapel = $this->input->post('nama_mapel');
        $status = $this->input->post('status');

        $cek = $this->mapel_model->cek_mapel_edit($kode_mapel, $id_mapel)->num_rows();

        if ($cek == "0") {

            $data = array(
                'kode_mapel' => $kode_mapel,
                'nama_mapel' => $nama_mapel,
                'status' => $status
            );

            $this->mapel_model->update_mapel($data, $id_mapel);

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
                'info' => "Kode Mata Palajaran Sudah Ada"
            ];
        }
        echo json_encode($params);
    }

    public function delete()
    {
        $id_mapel = $this->input->post('id_mapel');

        $this->mapel_model->delete_mapel($id_mapel);

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
