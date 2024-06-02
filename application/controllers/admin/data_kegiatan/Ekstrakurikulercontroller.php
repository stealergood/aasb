<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ekstrakurikulercontroller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['ekstrakurikuler_model']);
        is_logged_in();
    }

    public function index()
    {
        $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'Ekstrakurikuler';

        $data['script']     = $this->load->view('admin/data_kegiatan/ekstrakurikuler/script', $data, true);
        $data['content']    = $this->load->view('admin/data_kegiatan/ekstrakurikuler/index', $data, true);
        $this->load->view('admin/template', $data);
    }


    public function ajax_list()
    {
        $list = $this->ekstrakurikuler_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $data_ekstrakurikuler) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $data_ekstrakurikuler->kode;
            $row[] = $data_ekstrakurikuler->nama;
            if ($data_ekstrakurikuler->status == 0) {
                $status = "No-Aktif";
            } else {
                $status = "Aktif";
            }
            $row[] = $status;
            
            $jenis_login = $this->session->userdata('jenis_login');
            $jenis = array("admin", "guru", "kepala_sekolah");

            if (in_array($jenis_login, $jenis)) {
                $row[] = '<button type="button" id="button_edit_ekstrakurikuler" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_edit_ekstrakurikuler" data-id="' . $data_ekstrakurikuler->id_ekstrakurikuler . '" data-kode="' . $data_ekstrakurikuler->kode . '" data-nama="' . $data_ekstrakurikuler->nama . '" data-status="' . $data_ekstrakurikuler->status . '"><i class="bi bi-pencil" ></i></button> <button type="button" class="btn btn-danger btn-sm" id="button_hapus_ekstrakurikuler" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_hapus_ekstrakurikuler" data-id="' . $data_ekstrakurikuler->id_ekstrakurikuler . '" data-nama="' . $data_ekstrakurikuler->nama . '"><i class="bi bi-trash"></i></button>';
            } else {
                $row[] = "";
            }
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ekstrakurikuler_model->count_all(),
            "recordsFiltered" => $this->ekstrakurikuler_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $kode = $this->input->post('kode_ekstrakurikuler');
        $nama = $this->input->post('nama_ekstrakurikuler');
        $status = $this->input->post('status');

        $cek = $this->ekstrakurikuler_model->cek_ekstrakurikuler($kode)->num_rows();

        if ($cek == 0) {

            $data = array(
                'kode' => $kode,
                'nama' => $nama,
                'status' => $status
            );

            $this->ekstrakurikuler_model->tambah_ekstrakurikuler($data);

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
                'info' => "Kode Ekstrakurikuler Sudah Ada"
            ];
        }
        echo json_encode($params);
    }

    public function update()
    {
        $id_ekstrakurikuler = $this->input->post('id_ekstrakurikuler');
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');
        $status = $this->input->post('status');

        $cek = $this->ekstrakurikuler_model->cek_ekstrakurikuler_edit($kode, $id_ekstrakurikuler)->num_rows();

        if ($cek == "0") {

            $data = array(
                'kode' => $kode,
                'nama' => $nama,
                'status' => $status
            );

            $this->ekstrakurikuler_model->update_ekstrakurikuler($data, $id_ekstrakurikuler);

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
        $id_ekstrakurikuler = $this->input->post('id_ekstrakurikuler');

        $this->ekstrakurikuler_model->delete_ekstrakurikuler($id_ekstrakurikuler);

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
