<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekap_model extends CI_Model
{
    var $table = 'tb_log_absensi';
    var $column_order = array(null, 'tb_siswa.nis_siswa', 'tanggal', 'tb_mapel.nama_mapel'); //set column field database for datatable orderable
    var $column_search = array('tb_siswa.nis_siswa', 'tb_siswa.name'); //set column field database for datatable searchable 
    var $order = array('tanggal' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $session = $this->session->userdata();
        $siswa = null;
        if ($session['jenis_login'] == 'siswa') {
            // query get siswa
            $username = $session['username'];
            $siswa = $this->db->query("SELECT * FROM tb_siswa WHERE username = '$username'");
            $siswa = $siswa->row_array();
        }

        $this->db->select('tb_log_absensi.*,tb_siswa.id_siswa,tb_siswa.nis_siswa,tb_siswa.name,tb_siswa.jenis_kelamin,tb_mapel.nama_mapel,tb_kelas.nama_kelas,tb_kelas.id_kelas,tb_orang_tua.name as nama_orangtua,tb_orang_tua.email as email_orangtua');
        $this->db->join('tb_siswa', 'tb_siswa.id_siswa = tb_log_absensi.id_siswa', 'left');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_log_absensi.id_kelas', 'left');
        $this->db->join('tb_mapel', 'tb_mapel.id_mapel = tb_log_absensi.id_mengajar', 'left');
        $this->db->join('tb_orang_tua', 'tb_orang_tua.id_orang_tua = tb_siswa.id_orang_tua', 'left');


        if ($siswa != null) {
            $this->db->where('tb_siswa.id_siswa', $siswa['id_siswa']);
        }

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {   
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($where = null)
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        if ($where != null) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($where = null)
    {
        $this->_get_datatables_query();
        if ($where != null) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($where = null)
    {
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_detail_absensi($id)
    {
        $this->db->select(' *');
        $this->db->from('tb_log_absensi');
        $this->db->where('id_presensi', $id);
        $this->db->limit(1);

        $query = $this->db->get();

        $num = $query->num_rows();
        if ($num > 0) {
            $val = $query->result_array();
            return $val[0];
        } else {
            return 0;
        }
    }

    public function delete_presensi($id)
    {
        $this->db->where('id_presensi', $id);
        $this->db->delete('tb_log_absensi');
    }

    public function rekap_pdf($where = null)
    {
        $this->db->select('tb_log_absensi.*,tb_siswa.id_siswa,tb_siswa.nis_siswa,tb_siswa.name,tb_siswa.jenis_kelamin,tb_mapel.nama_mapel,tb_kelas.nama_kelas,tb_kelas.id_kelas,tb_orang_tua.name as nama_orangtua,tb_orang_tua.email as email_orangtua');
        $this->db->join('tb_siswa', 'tb_siswa.id_siswa = tb_log_absensi.id_siswa', 'left');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_log_absensi.id_kelas', 'left');
        $this->db->join('tb_mapel', 'tb_mapel.id_mapel = tb_log_absensi.id_mengajar', 'left');
        $this->db->join('tb_orang_tua', 'tb_orang_tua.id_orang_tua = tb_siswa.id_orang_tua', 'left');

        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->from($this->table);
        $this->db->order_by("tb_log_absensi.tanggal", "DESC");
        $this->db->order_by("tb_siswa.name", "ASC");

        return $this->db->get();
    }
}
