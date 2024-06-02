<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aktifitascontroller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['mapel_model']);
        $this->load->model(['ekstrakurikuler_model']);
        $this->load->model(['guru_model']);
        $this->load->model(['aktifitas_model']);
        $this->session->set_flashdata('sebagai','aktifitas');
        is_logged_in();
    }

    public function index()
    {
        $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'Data Kegiatan Guru';

        $data['data_mapel'] = $this->aktifitas_model->get_data_mapel();
        $data['data_ekskul'] = $this->ekstrakurikuler_model->get_data_ekskul();
        $data['data_guru'] = $this->guru_model->get_data_guru();
		
        $data['script']     = $this->load->view('admin/aktifitas/script', $data, true);
        $data['content']    = $this->load->view('admin/aktifitas/index', $data, true);
        $this->load->view('admin/template', $data);
    }


    public function ajax_list()
    {
        $list = $this->aktifitas_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $data_aktifitas) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $data_aktifitas->nip_guru;
            $row[] = $data_aktifitas->nama_guru;
            $row[] = $data_aktifitas->nama_mapel;
            $row[] = $data_aktifitas->nama_ekskul;
           if ($data_aktifitas->status == 0) {
                $status = "No-Aktif";
            } else {
                $status = "Aktif";
            }
             $row[] = $status;
            $jenis_login = $this->session->userdata('jenis_login');
            $jenis = array("admin", "guru", "kepala_sekolah");
			
            if (in_array($jenis_login, $jenis)) {
                $row[] = '<button type="button" id="button_edit_aktifitas" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_edit_aktifitas" data-id="' . $data_aktifitas->id_aktifitas . '" data-id_guru="' . $data_aktifitas->id_guru . '" data-id_mapel="' . $data_aktifitas->id_mapel . '" data-id_ekstrakurikuler="' . $data_aktifitas->id_ekstrakurikuler . '" data-status="' . $data_aktifitas->status . '"><i class="bi bi-pencil" ></i></button> <button type="button" class="btn btn-danger btn-sm" id="button_hapus_aktifitas" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_hapus_aktifitas" data-id="' . $data_aktifitas->id_aktifitas . '" data-nama="' . $data_aktifitas->nama_guru . '"><i class="bi bi-trash"></i></button>';
            } else {
                $row[] = '';
            }
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->aktifitas_model->count_all(),
            "recordsFiltered" => $this->aktifitas_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $id_guru = $this->input->post('id_guru');
        $id_mapel = $this->input->post('id_mapel');
        $id_ekstrakurikuler = $this->input->post('id_ekstrakurikuler');
        $status = $this->input->post('status');
       


                $data = array(
                    'id_guru' => $id_guru,
                    'id_mapel' => $id_mapel,
                    'id_ekstrakurikuler' => $id_ekstrakurikuler,
                    'status' => $status
                );

                $this->aktifitas_model->tambah_aktifitas($data);

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
            
        

        echo json_encode($params);
    }

    public function update()
    {
        $id_aktifitas = $this->input->post('id_aktifitas');
        $id_guru = $this->input->post('id_guru');
        $id_mapel = $this->input->post('id_mapel');
        $id_ekstrakurikuler = $this->input->post('id_ekstrakurikuler');
        $status = $this->input->post('status');

                $data = [
                  'id_guru' => $id_guru,
                    'id_mapel' => $id_mapel,
                    'id_ekstrakurikuler' => $id_ekstrakurikuler,
                    'status' => $status
                ];

              
                $this->aktifitas_model->update_aktifitas($data, $id_aktifitas);

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
           
        
        echo json_encode($params);
    }

    public function delete()
    {
        $id_aktifitas = $this->input->post('id_aktifitas');

        $this->aktifitas_model->delete_aktifitas($id_aktifitas);

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
