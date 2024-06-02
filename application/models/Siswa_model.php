<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
    var $table = 'tb_siswa';
    var $column_order = array(null, 'nis_siswa', 'name', 'kelas'); //set column field database for datatable orderable
    var $column_search = array('nis_siswa', 'tb_siswa.name', 'kelas'); //set column field database for datatable searchable 
    var $order = array('id_siswa' => 'asc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->select('tb_siswa.*,tb_kelas.id_kelas,tb_kelas.nama_kelas,tb_orang_tua.name as nama_orangtua,tb_guru.nama_guru');
		$this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.kelas', 'left');
		$this->db->join('tb_orang_tua', 'tb_orang_tua.id_orang_tua = tb_siswa.id_orang_tua', 'left');
		$this->db->join('tb_guru', 'tb_guru.id_guru = tb_siswa.id_guru', 'left');
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

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_data_kelas()
    {
        return $this->db->where('status', '1')->get('tb_kelas')->result();
    }

    public function tambah_siswa($data)
    {
        $this->db->insert('tb_siswa', $data);
    }

    public function cek_nis_siswa($nis = null)
    {
        return $this->db->where('nis_siswa', $nis)->get('tb_siswa');
    }

    public function cek_username_siswa($username = null)
    {
        return $this->db->where('username', $username)->get('tb_siswa');
    }

    public function cek_siswa_edit($nis_siswa, $id)
    {
        $this->db->where('nis_siswa', $nis_siswa);
        $this->db->where('id_siswa !=', $id);
        $this->db->from('tb_siswa');
        return $this->db->get();
    }

    public function cek_edit_username_siswa($username, $id)
    {
        $this->db->where('username', $username);
        $this->db->where('id_siswa !=', $id);
        $this->db->from('tb_siswa');
        return $this->db->get();
    }

    public function update_siswa($data, $id)
    {
        $this->db->where('id_siswa', $id);
        $this->db->update('tb_siswa', $data);
    }

    public function delete_siswa($id)
    {
        $this->db->where('id_siswa', $id);
        $this->db->delete('tb_siswa');
    }
}
