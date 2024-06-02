<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		redirect(base_url('login'));
	}

	public function errore()
	{
		$config                     = $this->Config_model->get_setting();
        $data['settings']           = $config;
        $data['title']              = 'Error';
		$this->load->view('admin/error',$data);
	}
}
