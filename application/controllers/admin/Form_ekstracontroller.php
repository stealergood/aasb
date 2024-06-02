<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_ekstracontroller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['absensi_model', 'rekap_model', 'form_ekstra_model', 'profil_model']);
        is_logged_in();
    }

    public function index()
    {
        $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'Form Ekstrakurikuler';

        $data['data_kelas'] = $this->absensi_model->get_data_kelas();
        $data['data_mapel'] = $this->absensi_model->get_data_mapel();
        $data['data_guru'] = $this->absensi_model->get_data_guru();
        $data['data_ekstrakurikuler'] = $this->form_ekstra_model->get_data_ekstrakurikuler();

        if ($this->session->userdata('jenis_login') == 'siswa') {
            $table = "tb_siswa";
            $where = array(
                'username' => $this->session->userdata('username')
            );
            $data['data_siswa'] = $this->profil_model->get_detail_profil_siswa($table, $where);
        }

        $data['script']     = $this->load->view('admin/absensi/ekstrakurikuler/script', $data, true);
        $data['content']    = $this->load->view('admin/absensi/ekstrakurikuler/index', $data, true);
        $this->load->view('admin/template', $data);
    }


    public function siswa_ajax_list()
    {
        $list = $this->absensi_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $data_siswa) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $data_siswa->nis_siswa;
            $row[] = $data_siswa->name;
            $row[] = $data_siswa->nama_kelas;
            $row[] = '<button type="button" id="button_pilih_siswa" class="btn btn-warning btn-sm" data-id="' . $data_siswa->id_siswa . '" data-nis_siswa="' . $data_siswa->nis_siswa . '" data-nama="' . $data_siswa->name . '" data-kelas="' . $data_siswa->kelas . '" data-jenis_kelamin="' . $data_siswa->jenis_kelamin . '" data-alamat="' . $data_siswa->alamat . '" data-tahun_masuk="' . $data_siswa->tahun_masuk . '" data-username="' . $data_siswa->username . '">Pilih Siswa</button>';

            $data[] = $row;
        }


        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->absensi_model->count_all(),
            "recordsFiltered" => $this->absensi_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $where_cek_ekstra = array(
            'id_siswa' => $this->input->post('id_siswa'),
            'tanggal' => $this->input->post('tanggal'),
            'id_ekstrakurikuler' => $this->input->post('ekstrakurikuler')
        );
        $cek = $this->form_ekstra_model->cek_absensi_ekstra($where_cek_ekstra)->num_rows();

        if ($cek == 0) {
            $data['id_ekstrakurikuler'] = $this->input->post('ekstrakurikuler');
            $data['id_siswa'] = $this->input->post('id_siswa');
            $data['id_kelas'] = $this->input->post('kelas');
            $data['tanggal'] = $this->input->post('tanggal');
            $data['keterangan'] = $this->input->post('keterangan');
            $data['pertemuan_ke'] = $this->input->post('pertemuan');
            $data['created_at'] = date("Y-m-d H:i:s");

            $this->form_ekstra_model->simpan_absensi_ekstra($data);

            if ($this->db->affected_rows() > 0) {
                $params = [
                    "status"   => true,
                    'info' => "Berhasil Simpan Data"
                ];
            } else {
                $params = [
                    "status"   => 'error',
                    'info' => "Tidak Ada Perubahan..",
                    'data' => $data
                ];
            }
        } else {
            $params = [
                "status"   => 'error',
                'info' => "nis dan tanggal sudah pernah di input..."
            ];
        }
        echo json_encode($params);
    }

    public function laporan()
    {
        $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'Laporan Ekstrakurikuler';

        $data['data_kelas'] = $this->absensi_model->get_data_kelas();
        $data['data_mapel'] = $this->absensi_model->get_data_mapel();
        $data['data_ekstrakurikuler'] = $this->form_ekstra_model->get_data_ekstrakurikuler();

        $data['script']     = $this->load->view('admin/absensi/ekstrakurikuler/laporan/script', $data, true);
        $data['content']    = $this->load->view('admin/absensi/ekstrakurikuler/laporan/index', $data, true);
        $this->load->view('admin/template', $data);
    }

    public function laporan_ajax()
    {
        $get_where = array();

        if (!empty($this->input->post('ekstrakurikuler'))) {
            $get_where['tb_log_ekstrakurikuler.id_ekstrakurikuler'] = htmlspecialchars($this->input->post('ekstrakurikuler'));
        }
        if (!empty($this->input->post('kelas'))) {
            $get_where['id_kelas'] = $this->input->post('kelas');
        }
        if (!empty($this->input->post('keterangan'))) {
            $get_where['tb_log_ekstrakurikuler.keterangan'] = $this->input->post('keterangan');
        }
        if (!empty($this->input->post('tanggal_dari')) and empty($this->input->post('tanggal_sampai'))) {
            $get_where['tanggal'] = $this->input->post('tanggal_dari');
        } else if (empty($this->input->post('tanggal_dari')) and !empty($this->input->post('tanggal_sampai'))) {
            $get_where['tanggal'] = $this->input->post('tanggal_sampai');
        } else if (!empty($this->input->post('tanggal_dari')) and !empty($this->input->post('tanggal_sampai'))) {
            $get_where['tanggal >='] = $this->input->post('tanggal_dari');
            $get_where['tanggal <='] = $this->input->post('tanggal_sampai');
        }

        $list = $this->form_ekstra_model->get_datatables($get_where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $data_form) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $data_form->nis_siswa;
            $row[] = $data_form->name;
            if ($data_form->jenis_kelamin == "L") {
                $jk = "Laki - laki";
            } else {
                $jk = "Perempuan";
            }
            $row[] = $jk;
            $row[] = $data_form->tanggal;
            $row[] = $data_form->nama;
            $row[] = $data_form->keterangan;
            $hapus = "";
            if ($this->session->userdata('jenis_login') == "admin") {
                $hapus = ' <button type="button" class="btn btn-danger btn-sm" id="button_hapus_form_ekstra" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_hapus_form_ekstra" data-id="' . $data_form->id_form_ekstrakurikuler . '" data-nama="' . $data_form->name . ' - ' . $data_form->nama . '"><i class="bi bi-trash"></i></button>';
            }
            $row[] = $hapus;

            $data[] = $row;
        }


        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->form_ekstra_model->count_all($get_where),
            "recordsFiltered" => $this->form_ekstra_model->count_filtered($get_where),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function laporan_pdf()
    {
        $config             = $this->Config_model->get_setting();
        $get_where = array();

        if (!empty($this->input->post('ekstrakurikuler'))) {
            $get_where['tb_log_ekstrakurikuler.id_ekstrakurikuler'] = htmlspecialchars($this->input->post('ekstrakurikuler'));
        }
        if (!empty($this->input->post('kelas'))) {
            $get_where['id_kelas'] = $this->input->post('kelas');
        }
        if (!empty($this->input->post('keterangan'))) {
            $get_where['tb_log_ekstrakurikuler.keterangan'] = $this->input->post('keterangan');
        }
        if (!empty($this->input->post('tanggal_dari')) and empty($this->input->post('tanggal_sampai'))) {
            $get_where['tanggal'] = $this->input->post('tanggal_dari');
        } else if (empty($this->input->post('tanggal_dari')) and !empty($this->input->post('tanggal_sampai'))) {
            $get_where['tanggal'] = $this->input->post('tanggal_sampai');
        } else if (!empty($this->input->post('tanggal_dari')) and !empty($this->input->post('tanggal_sampai'))) {
            $get_where['tanggal >='] = $this->input->post('tanggal_dari');
            $get_where['tanggal <='] = $this->input->post('tanggal_sampai');
        }

        $data = array(
            "dataku" =>  $this->form_ekstra_model->laporan_pdf($get_where)->result(),
            "settings" => $config
        );

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = "laporan.pdf";
        $this->pdf->load_view('admin/absensi/ekstrakurikuler/laporan/laporan_pdf', $data);
    }


    public function delete()
    {
        $id = $this->input->post('id');

        $this->form_ekstra_model->delete_log_absensi_esktra($id);

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
