<?php defined('BASEPATH') or exit('No direct script access allowed');

class Logincontroller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Login_model']);


        // Memeriksa apakah user sudah mengakses halaman sesuai denan rolenya, kalau belum, maka akan diarahkan ke halaman 404
    }

    public function login()
    {
        $this->_login();
    }

    public function _login()
    {
        /*if($this->session->flashdata('sebagai')==null AND $this->input->post('username')==null){
        $config                     = $this->Config_model->get_setting();
        $data['settings']           = $config;
        $data['title']              = 'Error';
        $this->load->view('admin/error',$data);
        return false;
        }*/
        $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_message('required', '%s harus di isi');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login', $data);
        } else {
            $d              = $this->input->post(null, true);
            $filter         = $this->security->xss_clean($d);
            // $jenis_login    = htmlspecialchars(trim($filter['jenis_login']));
            $username       = htmlspecialchars(trim($filter['username']));
            $password       = htmlspecialchars(trim($filter['password']));

            $authData        = $this->Login_model->get_user($username);
            //var_dump($auth->row_array());
            //die();
            if ($authData !== false) {
                $auth = $authData['user'];
                $jenis_login = $authData['jenis_login'];
                
                if ($auth->num_rows() == 1) {
                    $sess = $auth->row_array();
                    if (password_verify($password, $sess['password'])) {
                        $sess_data['logged_in']     = true;
                        $sess_data['username']      = $sess['username'];

                        $sess_data['level']         = $sess['level'];
                        $sess_data['jenis_login']   = $jenis_login;
                        if ($jenis_login == "guru") {
                            $sess_data['name']          = $sess['nama_guru'];
                        } else {
                            $sess_data['name']          = $sess['name'];
                        }
                        if ($jenis_login == "orang_tua") {
                            $sess_data['id_orang_tua']         = $sess['id_orang_tua'];
                        }
                        $this->session->set_userdata($sess_data);
                        if ($this->session->userdata('jenis_login') == "admin") {
                            redirect(site_url('admin/home'));
                        } else if ($this->session->userdata('jenis_login') == "siswa") {
                            redirect(site_url('siswa/home'));
                        } else if ($this->session->userdata('jenis_login') == "guru") {

                            redirect(site_url('guru/home'));
                        } else if ($this->session->userdata('jenis_login') == "kepala_sekolah") {
                            redirect(site_url('kepala_sekolah/home'));
                        } else if ($this->session->userdata('jenis_login') == "orang_tua") {

                            redirect(site_url('orang_tua/home'));
                        }
                    } else {
                        $data['error']        = '<div class="alert alert-primary alert-dismissible fade show" role="alert"><b>Kesalahan !</b> Periksa Kembali Username / Password Anda. ' . $jenis_login . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

                        $this->load->view('auth/login', $data);
                    }
                } else {
                    $data['error']            = '<div class="alert alert-primary alert-dismissible fade show" role="alert"><b>Kesalahan !</b> Periksa Kembali Username / Password Anda. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

                    $this->load->view('auth/login', $data);
                }
            } else {
                $data['error']            = '<div class="alert alert-primary alert-dismissible fade show" role="alert"><b>Kesalahan !</b> Jenis login silahkan di pilih. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

                $this->load->view('auth/login', $data);
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url(''));
    }
}
