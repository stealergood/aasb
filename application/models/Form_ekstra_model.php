<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_ekstra_model extends CI_Model
{

    var $table = 'tb_log_ekstrakurikuler';
    var $column_order = array(null, 'tb_siswa.nis_siswa', 'tanggal', 'tb_ekstrakurikuler.nama'); //set column field database for datatable orderable
    var $column_search = array('tb_siswa.nis_siswa', 'tb_siswa.name'); //set column field database for datatable searchable 
    var $order = array('id_form_ekstrakurikuler' => 'desc'); // default order 

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

        $this->db->select('tb_log_ekstrakurikuler.*,tb_siswa.id_siswa,tb_siswa.nis_siswa,tb_siswa.name,tb_siswa.jenis_kelamin,tb_ekstrakurikuler.nama');
        $this->db->join('tb_siswa', 'tb_siswa.id_siswa = tb_log_ekstrakurikuler.id_siswa', 'left');
        $this->db->join('tb_ekstrakurikuler', 'tb_ekstrakurikuler.id_ekstrakurikuler = tb_log_ekstrakurikuler.id_ekstrakurikuler', 'left');


        if ($siswa != null) {
            $this->db->where('tb_log_ekstrakurikuler.id_siswa', $siswa['id_siswa']);
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

    public function get_data_ekstrakurikuler()
    {
        return $this->db->where('status', '1')->get('tb_ekstrakurikuler')->result();
    }

    public function cek_absensi_ekstra($data = null)
    {
        return $this->db->where($data)->get('tb_log_ekstrakurikuler');
    }

    public function simpan_absensi_ekstra($data = null)
    {
        $this->db->insert('tb_log_ekstrakurikuler', $data);
    }

    public function delete_log_absensi_esktra($id = null)
    {
        $this->db->where('id_form_ekstrakurikuler', $id);
        $this->db->delete('tb_log_ekstrakurikuler');
    }

    public function laporan_pdf($where = null)
    {
        $this->db->select('tb_log_ekstrakurikuler.*,tb_siswa.id_siswa,tb_siswa.nis_siswa,tb_siswa.name,tb_siswa.jenis_kelamin,tb_ekstrakurikuler.nama');
        $this->db->from('tb_log_ekstrakurikuler');
        $this->db->join('tb_siswa', 'tb_siswa.id_siswa = tb_log_ekstrakurikuler.id_siswa', 'left');
        $this->db->join('tb_ekstrakurikuler', 'tb_ekstrakurikuler.id_ekstrakurikuler = tb_log_ekstrakurikuler.id_ekstrakurikuler', 'left');
        if ($where != null) {
            $this->db->where($where);
        }

        return $this->db->get();
    }
}
