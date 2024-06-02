<?php defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{

    public function get_user($user)
    {
        // if($login == 'admin'){
        //     $tabel = "tb_admin";
        // }else if($login == 'siswa'){
        //     $tabel = 'tb_siswa';
        // }else if($login == 'guru'){
        //     $tabel = 'tb_guru';
        // }else if($login == 'kepala_sekolah'){
        //     $tabel = 'tb_kepala_sekolah';
        // }else if($login == 'orang_tua'){
        //     $tabel = 'tb_orang_tua';
        // }

        $user = $this->db->escape_str($user);
        $admin = $this->db->where('username', $user)->get('tb_admin');
        if ($admin->num_rows() > 0) {
            $data = [
                'user' => $admin,
                'jenis_login' => 'admin'
            ];

            return $data;
        }

        $siswa = $this->db->where('username', $user)->get('tb_siswa');
        if ($siswa->num_rows() > 0) {
            $data = [
                'user' => $siswa,
                'jenis_login' => 'siswa'
            ];

            return $data;
        }

        $guru = $this->db->where('username', $user)->get('tb_guru');
        if ($guru->num_rows() > 0) {
            $data = [
                'user' => $guru,
                'jenis_login' => 'guru'
            ];

            return $data;
        }

        $kepala_sekolah = $this->db->where('username', $user)->get('tb_kepala_sekolah');
        if ($kepala_sekolah->num_rows() > 0) {
            $data = [
                'user' => $kepala_sekolah,
                'jenis_login' => 'kepala_sekolah'
            ];

            return $data;
        }

        $orang_tua = $this->db->where('username', $user)->get('tb_orang_tua');
        if ($orang_tua->num_rows() > 0) {
            $data = [
                'user' => $orang_tua,
                'jenis_login' => 'orang_tua'
            ];

            return $data;
        }

        return false;
    }
}
