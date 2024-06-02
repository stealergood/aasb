<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil_model extends CI_Model
{
    public function get_detail_profil($table = null, $where = null)
    {
        $this->db->select(' *');
        $this->db->from($table);
        $this->db->where($where);
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

    public function get_detail_profil_siswa($table = null, $where = null)
    {
        $this->db->select('tb_siswa.*,tb_kelas.nama_kelas');
        $this->db->from($table);
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.kelas', 'left');
        $this->db->where($where);
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

    public function update_profil($data = null, $where = null, $table = null)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function cek_username_profil($cek_data, $table)
    {
        $this->db->where($cek_data);
        $this->db->from($table);
        return $this->db->get();
    }
}
