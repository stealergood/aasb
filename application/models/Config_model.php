<?php
class Config_model extends CI_Model
{

    public function get_setting($id = null)
    {
        $this->db->where('id', '1');
        $this->db->limit(1);

        return $this->db->get('settings')->row_array();
    }

    public function update_setting($data)
    {
        $where = [
            'id'        => 1
        ];

        $this->db->update('settings', $data, $where);
    }
}
