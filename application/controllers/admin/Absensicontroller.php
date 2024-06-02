<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensicontroller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['absensi_model', 'rekap_model', 'profil_model']);
        is_logged_in();
    }

    public function index()
    {
        $config                     = $this->Config_model->get_setting();
        $data['settings']           = $config;
        $data['title']              = 'Form Presensi';

        $data['data_kelas']         = $this->absensi_model->get_data_kelas();
        $data['data_mapel']         = $this->absensi_model->get_data_mapel();
        $data['data_guru']          = $this->absensi_model->get_data_guru();

        if ($this->session->userdata('jenis_login') == 'siswa') {
            $table = "tb_siswa";
            $where = array(
                'username' => $this->session->userdata('username')
            );
            $data['data_siswa'] = $this->profil_model->get_detail_profil_siswa($table, $where);
        }

        if ($this->session->userdata('jenis_login') == 'guru') {
            $table = "tb_guru";
            $where = array(
                'username' => $this->session->userdata('username')
            );
            $data['data_guru'] = $this->profil_model->get_detail_profil($table, $where);
        }

        $data['script']             = $this->load->view('admin/absensi/script', $data, true);
        $data['content']            = $this->load->view('admin/absensi/index', $data, true);
        $this->load->view('admin/template', $data);
    }


    public function siswa_ajax_list()
    {
        $list           = $this->absensi_model->get_datatables();
        $data           = array();
        $no             = $_POST['start'];
        foreach ($list as $data_siswa) {
            $no++;
            $row        = array();
            $row[]      = $no;
            $row[]      = $data_siswa->nis_siswa;
            $row[]      = $data_siswa->name;
            $row[]      = $data_siswa->nama_kelas;
            $row[]      = '<button type="button" id="button_pilih_siswa" class="btn btn-warning btn-sm" data-id="' . $data_siswa->id_siswa . '" data-nis_siswa="' . $data_siswa->nis_siswa . '" data-nama="' . $data_siswa->name . '" data-kelas="' . $data_siswa->kelas . '" data-nama_kelas="' . $data_siswa->nama_kelas . '" data-id_guru="' . $data_siswa->id_guru . '" data-nama_guru="' . $data_siswa->nama_guru . '" data-jenis_kelamin="' . $data_siswa->jenis_kelamin . '" data-alamat="' . $data_siswa->alamat . '" data-tahun_masuk="' . $data_siswa->tahun_masuk . '" data-username="' . $data_siswa->username . '">Pilih Siswa</button>';

            $data[]     = $row;
        }


        $output = array(
            "draw"                  => $_POST['draw'],
            "recordsTotal"          => $this->absensi_model->count_all(),
            "recordsFiltered"       => $this->absensi_model->count_filtered(),
            "data"                  => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $id_siswa       = $this->input->post('id_siswa');
        $tanggal        = $this->input->post('tanggal');

        if (isset($_FILES['file_izin']['name']) and !empty($_FILES['file_izin']['name'])) {
            $extension      = pathinfo($_FILES['file_izin']['name'], PATHINFO_EXTENSION);
            $new_name       = trim(substr(md5(rand()), 0, 10)) . '.' . $extension;
            // simpan gambar ke server
            move_uploaded_file($_FILES['file_izin']['tmp_name'], 'assets/upload/' . $new_name);
        } else {
            $new_name = NULL;
        }
        $cek_absensi = [
            'id_siswa'      => $id_siswa,
            'tanggal'       => $tanggal,
            'id_mengajar'   => $this->input->post('mapel')
        ];
        $cek                = $this->absensi_model->cek_absensi_siswa($cek_absensi)->num_rows();

        if ($cek == 0) {
            /*
            $keterangan             = $this->input->post('keterangan');
            $jenis                  = array("I", "S", "A", "T");

            if (in_array($keterangan, $jenis)) {
                $get_one_siswa              = $this->absensi_model->get_one_siswa($id_siswa);
                $get_one_guru               = $this->absensi_model->get_one_guru($this->input->post('guru'));

                $val['id_izin']           = $this->input->post('kode_izin');
                $val['nis_siswa']           = $get_one_siswa['nis_siswa'];
                $val['nama_siswa']          = $get_one_siswa['name'];
                $val['jenis_kelamin']       = $get_one_siswa['jenis_kelamin'];
                $val['kelas']               = $get_one_siswa['kelas'];
                $val['nip_guru']            = $get_one_guru['nip_guru'];
                $val['nama_guru']           = $get_one_guru['nama_guru'];
                $val['tanggal_izin']        = $this->input->post('tanggal');
                $val['jam_izin']            = $this->input->post('jam');
                $val['keterangan_izin']     = $this->input->post('keterangan');
                $val['created_at']          = date("Y-m-d H:i:s");

                $extension      = pathinfo($_FILES['file_izin']['name'], PATHINFO_EXTENSION);
                $new_name       = trim(substr(md5(rand()), 0, 10)) . '.' . $extension;
                // simpan gambar ke server
                move_uploaded_file($_FILES['file_izin']['tmp_name'], 'assets/upload/' . $new_name);

                $val['file_izin']       = $new_name;
                $val['jenis_file']      = $extension;
                $data['id_izin']        = $this->absensi_model->simpan_izin($val);
            }*/

            $data['id_mengajar']        = $this->input->post('mapel');
            $data['id_siswa']           = $this->input->post('id_siswa');
            $data['id_guru']            = $this->input->post('guru');
            $data['tanggal']            = $this->input->post('tanggal');
            $data['id_kelas']           = $this->input->post('kelas');
            $data['keterangan']         = $this->input->post('keterangan');
            //    $data['pertemuan_ke']       = $this->input->post('pertemuan');
            //   $data['jam']                = $this->input->post('jam');
            $data['created_at']         = date("Y-m-d H:i:s");
            $data['file_izin']       = $new_name;
            $this->absensi_model->simpan_absensi($data);

            if ($this->db->affected_rows() > 0) {
                $params = [
                    "status"    => true,
                    'info'      => "Berhasil Simpan Data"
                ];
            } else {
                $params = [
                    "status"    => 'error',
                    'info'      => "Tidak Ada Perubahan.."
                ];
            }
        } else {
            $params = [
                "status"         => 'error',
                'info'           => "nis dan tanggal sudah pernah di input..."
            ];
        }
        echo json_encode($params);
    }

    public function laporan()
    {
        $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'Laporan Presensi';

        $data['data_kelas'] = $this->absensi_model->get_data_kelas();
        $data['data_mapel'] = $this->absensi_model->get_data_mapel();
        $data['data_guru']  = $this->absensi_model->get_data_guru();

        $data['script']     = $this->load->view('admin/absensi/laporan/script', $data, true);
        $data['content']    = $this->load->view('admin/absensi/laporan/index', $data, true);
        $this->load->view('admin/template', $data);
    }

    public function laporan_absensi_ajax_list()
    {
        $get_where = array();

        if (!empty($this->input->post('nip_guru'))) {
            $get_where['nip_guru']          = htmlspecialchars($this->input->post('nip_guru'));
        }
        if (!empty($this->input->post('kelas'))) {
            $get_where['kelas']             = $this->input->post('kelas');
        }
        if (!empty($this->input->post('tanggal_dari')) and empty($this->input->post('tanggal_sampai'))) {
            $get_where['tanggal_izin']      = $this->input->post('tanggal_dari');
        } else if (empty($this->input->post('tanggal_dari')) and !empty($this->input->post('tanggal_sampai'))) {
            $get_where['tanggal_izin']      = $this->input->post('tanggal_sampai');
        } else if (!empty($this->input->post('tanggal_dari')) and !empty($this->input->post('tanggal_sampai'))) {
            $get_where['tanggal_izin >=']   = $this->input->post('tanggal_dari');
            $get_where['tanggal_izin <=']   = $this->input->post('tanggal_sampai');
        }

        $list = $this->absensi_model->laporan_get_datatables($get_where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $data_izin) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $data_izin->id_izin;
            $row[] = $data_izin->nis_siswa;
            $row[] = $data_izin->nama_siswa;
            if ($data_izin->jenis_kelamin == "L") {
                $jk = "Laki - laki";
            } else {
                $jk = "Perempuan";
            }
            $row[] = $jk;
            $row[] = $data_izin->tanggal_izin;
            $row[] = $data_izin->jam_izin;
            $row[] = $data_izin->nama_kelas;
            $row[] = $data_izin->keterangan_izin;
            $hapus = "";
            $jenis_login = $this->session->userdata('jenis_login');
            $jenis = array("admin", "guru");

            if (in_array($jenis_login, $jenis)) {
                $hapus = ' <button type="button" class="btn btn-danger btn-sm" id="button_hapus_izin_siswa" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_hapus_izin_siswa" data-id="' . $data_izin->id_izin . '" data-nama="' . $data_izin->nama_siswa . '"><i class="bi bi-trash"></i></button>';
            }
            $konfirmasi = "";
            // $konfirmasi='<button type="button" class="btn btn-success btn-sm ms-1" id="button_konfirmasi_izin_siswa" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_konfirmasi_izin_siswa" data-id="' . $data_izin->id_izin . '" data-nama="' . $data_izin->nama_siswa . '">Konfirmasi</button>';
            if ($data_izin->konfirmasi == 1) {
                $konfirmasi = "";
            }
            $row[] = '<a class="btn btn-primary btn-sm" href="' . base_url() . 'absensi/lihat/' . $data_izin->id_izin . '">Lihat</a> ' . $hapus . $konfirmasi;

            $data[] = $row;
        }


        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->absensi_model->laporan_count_all($get_where),
            "recordsFiltered" => $this->absensi_model->laporan_count_filtered($get_where),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function lihat()
    {
        $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'Lihat Surat';
        $id_izin            = $this->uri->segment(3);

        $data_izin = $this->absensi_model->lihat_izin($id_izin);
        $data['data_izin']  = $data_izin;
        if ($data_izin['jenis_file'] == "pdf") {
            $data['content']    = $this->load->view('admin/absensi/lihat/index_pdf', $data, true);
        } else {
            $data['content']    = $this->load->view('admin/absensi/lihat/index', $data, true);
        }

        $this->load->view('admin/template', $data);
    }

    public function laporan_pdf()
    {
        $config             = $this->Config_model->get_setting();
        $get_where = array();

        if (!empty($this->input->post('guru'))) {
            $get_where['nip_guru'] = htmlspecialchars($this->input->post('guru'));
        }
        if (!empty($this->input->post('kelas'))) {
            $get_where['tb_log_absensi.kelas'] = $this->input->post('kelas');
        }
        if (!empty($this->input->post('tanggal_dari')) and empty($this->input->post('tanggal_sampai'))) {
            $get_where['tanggal_izin'] = $this->input->post('tanggal_dari');
        } else if (empty($this->input->post('tanggal_dari')) and !empty($this->input->post('tanggal_sampai'))) {
            $get_where['tanggal_izin'] = $this->input->post('tanggal_sampai');
        } else if (!empty($this->input->post('tanggal_dari')) and !empty($this->input->post('tanggal_sampai'))) {
            $get_where['tanggal_izin >='] = $this->input->post('tanggal_dari');
            $get_where['tanggal_izin <='] = $this->input->post('tanggal_sampai');
        }

        $data = array(
            "dataku" =>  $this->absensi_model->laporan_pdf_izin($get_where)->result(),
            "settings" => $config
        );

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = "laporan.pdf";
        $this->pdf->load_view('admin/absensi/lihat/laporan_pdf', $data);
    }

    public function izin_delete()
    {
        $id_izin = $this->input->post('id_izin');

        $izin = $this->absensi_model->get_data_one_izin($id_izin);

        unlink('./assets/upload/' . $izin['file_izin']);

        $this->absensi_model->delete_izin($id_izin);
        $this->absensi_model->delete_log_absensi($id_izin);

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


    public function izin_konfirmasi()
    {
        $id_izin = $this->input->post('id_izin');

        $izin = $this->absensi_model->get_data_one_izin($id_izin);

        // unlink('./assets/upload/' . $izin['file_izin']);
        $data = [
            'konfirmasi' => 1
        ];

        $this->absensi_model->konfirmasi_izin($data, $id_izin);

        if ($this->db->affected_rows() > 0) {
            $params = [
                "status"   => true,
                'info' => "Presensi berhasil di konfirmasi"
            ];
        } else {
            $params = [
                "status"   => 'false',
                'info' => "Gagal dikonfirmasi"
            ];
        }

        echo json_encode($params);
    }
    //LAPORAN PRESENSI UMUM
    public function rekap()
    {
        $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'Laporan Presensi';

        $data['data_kelas'] = $this->absensi_model->get_data_kelas();
        $data['data_mapel'] = $this->absensi_model->get_data_mapel();
        $data['data_guru'] = $this->absensi_model->get_data_guru();

        $data['script']     = $this->load->view('admin/absensi/rekap/script', $data, true);
        $data['content']    = $this->load->view('admin/absensi/rekap/index', $data, true);

        $this->load->view('admin/template', $data);
    }

    public function rekap_absensi_ajax_list()
    {
        $get_where = array();

        if (!empty($this->input->post('id_guru'))) {
            $get_where['tb_log_absensi.id_guru'] = htmlspecialchars($this->input->post('id_guru'));
        }
        if (!empty($this->input->post('kelas'))) {
            $get_where['tb_log_absensi.id_kelas'] = $this->input->post('kelas');
        }
        if (!empty($this->input->post('keterangan'))) {
            $get_where['tb_log_absensi.keterangan'] = $this->input->post('keterangan');
        }
        if (!empty($this->input->post('tanggal_dari')) and empty($this->input->post('tanggal_sampai'))) {
            $get_where['tanggal'] = $this->input->post('tanggal_dari');
        } else if (empty($this->input->post('tanggal_dari')) and !empty($this->input->post('tanggal_sampai'))) {
            $get_where['tanggal'] = $this->input->post('tanggal_sampai');
        } else if (!empty($this->input->post('tanggal_dari')) and !empty($this->input->post('tanggal_sampai'))) {
            $get_where['tanggal >='] = $this->input->post('tanggal_dari');
            $get_where['tanggal <='] = $this->input->post('tanggal_sampai');
        }
        if ($this->session->userdata('jenis_login') == "orang_tua") {
            $ido = $this->session->userdata('id_orang_tua');

            $siswa = $this->db->query("select id_siswa from tb_siswa where id_orang_tua='$ido'")->row()->id_siswa;
            $get_where['tb_log_absensi.id_siswa'] = $siswa;
        }
        $list = $this->rekap_model->get_datatables($get_where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $data_absensi) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $data_absensi->nis_siswa;
            $row[] = $data_absensi->name;
            $row[] = $data_absensi->nama_orangtua;
            $row[] = $data_absensi->jenis_kelamin;
            $row[] = $data_absensi->tanggal;
            //    $row[] = $data_absensi->nama_mapel;
            $row[] = $data_absensi->nama_kelas;
            //    $row[] = $data_absensi->pertemuan_ke;
            //   $row[] = $data_absensi->jam;
            $row[] = $data_absensi->keterangan;
            $hapus = "";
            $jenis_login = $this->session->userdata('jenis_login');
            $jenis = array("admin", "guru");

            if (in_array($jenis_login, $jenis)) {
                if ($data_absensi->file_izin != '') {

                    $hapus = '<a class="btn btn-primary btn-sm" href="' . base_url() . 'assets/upload/' . $data_absensi->file_izin . '" target="blank_">Lihat Izin</a> ';
                }
                if ($data_absensi->keterangan=='A' || $data_absensi->keterangan=='T' || $data_absensi->keterangan=='H' || $data_absensi->keterangan=='I' || $data_absensi->keterangan=='S') {

                    $hapus .= '<a class="btn btn-warning btn-sm" href="' . base_url() . 'email/' . $data_absensi->nis_siswa . '" >Kirim Email</a> ';
                }
                $hapus .= ' <button type="button" class="btn btn-danger btn-sm" id="button_hapus_presensi" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_hapus_presensi" data-id="' . $data_absensi->id_presensi . '" data-nama="' . $data_absensi->name . '"><i class="bi bi-trash"></i></button> ';
            }
            $row[] = $hapus;



            $data[] = $row;
        }


        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->rekap_model->count_all($get_where),
            "recordsFiltered" => $this->rekap_model->count_filtered($get_where),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function rekap_pdf()
    {
        $config             = $this->Config_model->get_setting();
        $get_where = array();

        if (!empty($this->input->post('guru'))) {
            $get_where['id_guru'] = htmlspecialchars($this->input->post('guru'));
        }
        if (!empty($this->input->post('kelas'))) {
            $get_where['tb_log_absensi.id_kelas'] = $this->input->post('kelas');
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
            "dataku" =>  $this->rekap_model->rekap_pdf($get_where)->result(),
            "settings" => $config
        );

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = "laporan.pdf";
        $this->pdf->load_view('admin/absensi/rekap/laporan_pdf', $data);
    }

    public function delete_presensi()
    {
        $id = $this->input->post('id');
        $cek_log = $this->rekap_model->get_detail_absensi($id);

        $this->rekap_model->delete_presensi($id);



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
