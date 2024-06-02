<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi_model extends CI_Model
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
        $this->db->select('tb_siswa.*,tb_kelas.id_kelas,tb_kelas.nama_kelas,tb_guru.*');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.kelas', 'left');
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

    public function get_data_mapel()
    {
        return $this->db->where('status', '1')->get('tb_mapel')->result();
    }

    public function cek_absensi_siswa($data = null)
    {
        return $this->db->where($data)->get('tb_log_absensi');
    }

    public function simpan_absensi($data)
    {
        $this->db->insert('tb_log_absensi', $data);
    }

    public function simpan_izin($data)
    {
        $this->db->insert('tb_izin', $data);
        return $this->db->insert_id();
    }

    public function get_data_guru()
    {
        return $this->db->get('tb_guru')->result();
    }

    public function get_one_siswa($id)
    {
        $this->db->select(' *');
        $this->db->from('tb_siswa');
        $this->db->where('id_siswa', $id);
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

    public function get_one_guru($id)
    {
        $this->db->select(' *');
        $this->db->from('tb_guru');
        $this->db->where('id_guru', $id);
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

    var $laporan_table          = 'tb_izin';
    var $laporan_column_order   = array(null, 'kode_izin', 'nis_siswa', 'nama_siswa', 'nip_guru', 'nama_guru'); //set column field database for datatable orderable
    var $laporan_column_search  = array('nis_siswa', 'nama_siswa', 'nip_guru', 'nama_guru'); //set column field database for datatable searchable 
    var $laporan_order          = array('id_izin' => 'asc'); // default order 

    private function _get_laporan_datatables_query()
    {
        $this->db->select('tb_izin.*,tb_kelas.id_kelas,tb_kelas.nama_kelas');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_izin.kelas', 'left');
        $this->db->from($this->laporan_table);

        $i = 0;

        foreach ($this->laporan_column_search as $item) // loop column 
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

                if (count($this->laporan_column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->laporan_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->laporan_order)) {
            $order = $this->laporan_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function laporan_get_datatables($where = null)
    {
        $this->_get_laporan_datatables_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        if ($where != null) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function laporan_count_filtered($where = null)
    {
        $this->_get_laporan_datatables_query();
        if ($where != null) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function laporan_count_all($where = null)
    {
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->from($this->laporan_table);
        return $this->db->count_all_results();
    }

    public function lihat_izin($id)
    {
        $this->db->select(' *');
        $this->db->from('tb_izin');
        $this->db->where('id_izin', $id);
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

    public function laporan_pdf_izin($where = null)
    {
        $this->db->select('tb_izin.*,tb_kelas.id_kelas,tb_kelas.nama_kelas');
        $this->db->from('tb_izin');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_izin.kelas', 'left');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by("tb_izin.tanggal_izin", "DESC");

        return $this->db->get();
    }

    public function get_data_one_izin($id)
    {
        $this->db->select(' *');
        $this->db->from('tb_izin');
        $this->db->where('id_izin', $id);
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

    public function delete_izin($id)
    {
        $this->db->where('id_izin', $id);
        $this->db->delete('tb_izin');
    }

    public function konfirmasi_izin($data, $id)
    {
        $this->db->where('id_izin', $id);
        $this->db->update('tb_izin', $data);
    }

    public function delete_log_absensi($id)
    {
        $this->db->where('id_izin', $id);
        $this->db->delete('tb_log_absensi');
    }

    public function jumlah_kehadiran()
    {
        $current_year = date('Y');
        $this->db->select('keterangan as name, COUNT(*) as value');
        $this->db->from('tb_log_absensi');
        $this->db->where('YEAR(tanggal)', $current_year);
        $this->db->group_by('keterangan');

        return $this->db->get();
    }

    public function jumlah_siswa()
    {
        $this->db->select('COUNT(tb_siswa.id_siswa) as jumlah');
        $this->db->from('tb_siswa');
        return $this->db->get()->row_array();
    }

    public function jumlah_guru()
    {
        $this->db->select('COUNT(tb_guru.id_guru) as jumlah');
        $this->db->from('tb_guru');
        return $this->db->get()->row_array();
    }

    public function jumlah_absensi()
    {
        $this->db->select('COUNT(tb_log_absensi.id_presensi) as jumlah');
        $this->db->from('tb_log_absensi');
        return $this->db->get()->row_array();
    }
}
