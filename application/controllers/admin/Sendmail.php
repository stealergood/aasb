<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Sendmail extends CI_Controller {
 
	public function __construct()
	{
		parent::__construct();
	}
 
	public function index()
	{
		$data['error']='';
        $config             = $this->Config_model->get_setting();
        
        $data['settings']   = $config;
        $data['title']      = 'Kirim Email';
        $data['content']    = $this->load->view('admin/email/index', $data, true);
        $this->load->view('admin/template', $data);
	}
	
	public function ortu($id)
	{
		$data['error']='';
        $config             = $this->Config_model->get_setting();
        $data['ortu'] = $this->db->query("select email from tb_siswa join tb_orang_tua on tb_siswa.id_orang_tua= tb_orang_tua.id_orang_tua where nis_siswa = '$id'")->row()->email;
        var_dump($this->db->last_query());
        $data['settings']   = $config;
        $data['title']      = 'Kirim Email';
        $data['content']    = $this->load->view('admin/email/ortu', $data, true);
        $this->load->view('admin/template', $data);
	}

	public function send()
	{
		if($this->input->post()){			
		$name=$this->session->userdata('name');
		$to=$this->input->post('email');
		$message=$this->input->post('message');
		$this->load->config('email');
		$this->load->library('email');
		$this->email->from('xxxx@gmail.com',$name);
		$this->email->to($to);
		$this->email->subject('Pemberitahuan Absensi');
		$this->email->message($message);

		if($this->email->send()){
                $data['error']= '<div class="alert alert-success alert-dismissible fade show" role="alert"><b>Success !</b> Pesan email berhasil dikirim<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                 $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'Kirim Email';
        $data['content']    = $this->load->view('admin/email/index', $data, true);
        $this->load->view('admin/template', $data);
		} else {
			// show_error($this->email->print_debugger());
			                $data['error']= '<div class="alert alert-daner alert-dismissible fade show" role="alert"><b>Error !</b> Pesan email gagal dikirim<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                 $config             = $this->Config_model->get_setting();
        $data['settings']   = $config;
        $data['title']      = 'Kirim Email';
        $data['content']    = $this->load->view('admin/email/index', $data, true);
		}
		}
	}
}