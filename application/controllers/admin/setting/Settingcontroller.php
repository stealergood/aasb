<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settingcontroller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'Setting';

        $data['script']     = $this->load->view('admin/setting/script', $data, true);
        $data['content']    = $this->load->view('admin/setting/index', $data, true);

        $this->load->view('admin/template', $data);
    }

    public function save_logo_image()
    {
        if (isset($_FILES['logo_image'])) {
            $config         = $this->Config_model->get_setting();
            $extension      = pathinfo($_FILES['logo_image']['name'], PATHINFO_EXTENSION);

            $new_name       = 'logo-' . trim(substr(md5(rand()), 0, 4)) . '.' . $extension;

            move_uploaded_file($_FILES['logo_image']['tmp_name'], 'assets/img/' . $new_name);

            unlink('./assets/img/' . $config['logo']);
            $data = [
                'logo'  => $new_name
            ];

            $where = [
                'id'    => 1
            ];

            $this->db->update('settings', $data, $where);

            $data = array(
                'info'          => 'Logo Berhasil di ubah',
                'image_source'  => base_url() . 'assets/img/' . $new_name
            );

            echo json_encode($data);
        }

        if (isset($_FILES['favicon_image'])) {
            $config         = $this->Config_model->get_setting();
            $extension      = pathinfo($_FILES['favicon_image']['name'], PATHINFO_EXTENSION);

            $new_name       = 'favicon-' . trim(substr(md5(rand()), 0, 4)) . '.' . $extension;

            move_uploaded_file($_FILES['favicon_image']['tmp_name'], 'assets/img/' . $new_name);

            unlink('./assets/img/' . $config['favicon']);
            $data = [
                'favicon'   => $new_name
            ];

            $where = [
                'id'        => 1
            ];

            $this->db->update('settings', $data, $where);

            $data = array(
                'info'          => 'Favicon Berhasil di ubah',
                'image_source'  => base_url() . 'assets/img/' . $new_name
            );

            echo json_encode($data);
        }
    }

    public function save_setting()
    {
        $data = array(
            'app_name'              => htmlspecialchars($this->input->post('app_name')),
            'slogan'                => htmlspecialchars($this->input->post('slogan')),
            'description'           => htmlspecialchars($this->input->post('description')),
            'meta_description'      => htmlspecialchars($this->input->post('meta_description')),
            'meta_keyword'          => htmlspecialchars($this->input->post('meta_keyword')),
            'address'               => htmlspecialchars($this->input->post('address')),
            'phone'                 => htmlspecialchars($this->input->post('phone')),
            'email'                 => htmlspecialchars($this->input->post('email')),
            'website'               => htmlspecialchars($this->input->post('website'))
        );

        $this->Config_model->update_setting($data);

        $params = [
            "success"   => true,
            "info"      => 'Update setting berhasil...'
        ];

        echo json_encode($params);
    }
}
