<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru_model extends CI_Model
{
    var $table = 'tb_guru';
    var $column_order = array(null, 'nip_guru', 'name'); //set column field database for datatable orderable
    var $column_search = array('nip_guru', 'nama_guru'); //set column field database for datatable searchable 
    var $order = array('id_guru' => 'asc'); // default order 

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

    public function tambah_guru($data)
    {
        $this->db->insert('tb_guru', $data);
    }

    public function cek_nip_guru($nip = null)
    {
        return $this->db->where('nip_guru', $nip)->get('tb_guru');
    }

    public function cek_username_guru($username = null){
        return $this->db->where('username', $username)->get('tb_guru');
    }

    public function cek_guru_edit($nip_guru, $id)
    {
        $this->db->where('nip_guru', $nip_guru);
        $this->db->where('id_guru !=', $id);
        $this->db->from('tb_guru');
        return $this->db->get();
    }

    public function cek_edit_username_guru($username, $id)
    {
        $this->db->where('username', $username);
        $this->db->where('id_guru !=', $id);
        $this->db->from('tb_guru');
        return $this->db->get();
    }

    public function update_guru($data, $id)
    {
        $this->db->where('id_guru', $id);
        $this->db->update('tb_guru', $data);
    }

    public function delete_guru($id)
    {
        $this->db->where('id_guru', $id);
        $this->db->delete('tb_guru');
    }
    public function get_data_guru()
    {
        return $this->db->get('tb_guru')->result();
    }

}

