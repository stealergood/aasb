<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapel_model extends CI_Model
{
    var $table = 'tb_mapel';
    var $column_order = array(null, 'kode_mapel', 'nama_mapel'); //set column field database for datatable orderable
    var $column_search = array('kode_mapel', 'nama_mapel'); //set column field database for datatable searchable 
    var $order = array('id_mapel' => 'asc'); // default order 

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

    public function tambah_mapel($data)
    {
        $this->db->insert('tb_mapel', $data);
    }

    public function cek_mapel($kode = null)
    {
        return $this->db->where('kode_mapel', $kode)->get('tb_mapel');
    }

    public function cek_mapel_edit($kode, $id)
    {
        $this->db->where('kode_mapel', $kode);
        $this->db->where('id_mapel !=', $id);
        $this->db->from('tb_mapel');
        return $this->db->get();
    }

    public function update_mapel($data, $id)
    {
        $this->db->where('id_mapel', $id);
        $this->db->update('tb_mapel', $data);
    }

    public function delete_mapel($id)
    {
        $this->db->where('id_mapel', $id);
        $this->db->delete('tb_mapel');
    }
}
