<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Semestercontroller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['semester_model']);
        is_logged_in();
    }

    public function index()
    {
        $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'Semester';

        $data['script']     = $this->load->view('admin/data_umum/semester/script', $data, true);
        $data['content']    = $this->load->view('admin/data_umum/semester/index', $data, true);
        $this->load->view('admin/template', $data);
    }


    public function ajax_list()
    {
        $list = $this->semester_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $data_semester) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $data_semester->semester;
            if ($data_semester->status_semester == 0) {
                $status = "No-Aktif";
            } else {
                $status = "Aktif";
            }
            $row[] = $status;
            $row[] = '<button type="button" id="button_edit_semester" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_edit_semester" data-id="' . $data_semester->id_semester . '" data-semester="' . $data_semester->semester . '" data-status="' . $data_semester->status_semester . '"><i class="bi bi-pencil" ></i></button> <button type="button" class="btn btn-danger btn-sm" id="button_hapus_semester" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_hapus_semester" data-id="' . $data_semester->id_semester . '" data-nama="' . $data_semester->semester . '"><i class="bi bi-trash"></i></button>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->semester_model->count_all(),
            "recordsFiltered" => $this->semester_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $semester = $this->input->post('semester');
        $status = $this->input->post('status');

        $cek = $this->semester_model->cek_semester($semester)->num_rows();

        if ($cek == 0) {

            $data = array(
                'semester' => $semester,
                'status_semester' => $status
            );

            $this->semester_model->tambah_semester($data);

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
                'info' => "Semester Sudah Ada"
            ];
        }
        echo json_encode($params);
    }

    public function update()
    {
        $id_semester = $this->input->post('id_semester');
        $semester = $this->input->post('semester');
        $status_semester = $this->input->post('status_semester');

        $cek = $this->semester_model->cek_semester_edit($semester, $id_semester)->num_rows();

        if ($cek == "0") {

            $data = array(
                'semester' => $semester,
                'status_semester' => $status_semester
            );

            $this->semester_model->update_semester($data, $id_semester);

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
                'info' => "Semester Sudah Ada"
            ];
        }
        echo json_encode($params);
    }

    public function delete()
    {
        $id_semester = $this->input->post('id_semester');

        $this->semester_model->delete_semester($id_semester);

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
