<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kepala_sekolah_model extends CI_Model
{
    var $table = 'tb_kepala_sekolah';
    var $column_order = array(null, 'nip_kepala_sekolah', 'name'); //set column field database for datatable orderable
    var $column_search = array('nip_kepala_sekolah', 'name'); //set column field database for datatable searchable 
    var $order = array('id_kepala_sekolah' => 'asc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {

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

    public function tambah_kepala_sekolah($data)
    {
        $this->db->insert('tb_kepala_sekolah', $data);
    }

    public function cek_nip_kepala_sekolah($nip = null)
    {
        return $this->db->where('nip_kepala_sekolah', $nip)->get('tb_kepala_sekolah');
    }

    public function cek_username_kepala_sekolah($username = null){
        return $this->db->where('username', $username)->get('tb_kepala_sekolah');
    }

    public function cek_kepala_sekolah_edit($nip_kepala_sekolah, $id)
    {
        $this->db->where('nip_kepala_sekolah', $nip_kepala_sekolah);
        $this->db->where('id_kepala_sekolah !=', $id);
        $this->db->from('tb_kepala_sekolah');
        return $this->db->get();
    }

    public function cek_edit_username_kepala_sekolah($username, $id)
    {
        $this->db->where('username', $username);
        $this->db->where('id_kepala_sekolah !=', $id);
        $this->db->from('tb_kepala_sekolah');
        return $this->db->get();
    }

    public function update_kepala_sekolah($data, $id)
    {
        $this->db->where('id_kepala_sekolah', $id);
        $this->db->update('tb_kepala_sekolah', $data);
    }

    public function delete_kepala_sekolah($id)
    {
        $this->db->where('id_kepala_sekolah', $id);
        $this->db->delete('tb_kepala_sekolah');
    }
}
