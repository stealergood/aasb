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
		$data['email_ortu'] = $this->db->query("
			SELECT ot.email
			FROM tb_siswa s
			JOIN tb_orang_tua ot ON s.id_orang_tua = ot.id_orang_tua
			WHERE s.nis_siswa = '$id'
		")->row()->email;
	
		$data['nama_ortu'] = $this->db->query("
			SELECT ot.name AS nama_orang_tua
			FROM tb_siswa s
			JOIN tb_orang_tua ot ON s.id_orang_tua = ot.id_orang_tua
			WHERE s.nis_siswa = '$id'
		")->row()->nama_orang_tua;
	
		$data['nama_siswa'] = $this->db->query("
			SELECT s.name
			FROM tb_siswa s
			WHERE s.nis_siswa = '$id'
		")->row()->name;
	
		$data['status_kehadiran'] = $this->db->query("
			SELECT la.keterangan AS status_kehadiran
			FROM tb_siswa s
			LEFT JOIN tb_log_absensi la ON s.id_siswa = la.id_siswa
			WHERE s.nis_siswa = '$id'
		")->row()->status_kehadiran;

		// var_dump($this->db->last_query());
        $data['settings']   = $config;
        $data['title']      = 'Kirim Email';
        $data['content']    = $this->load->view('admin/email/ortu', $data, true);
        $this->load->view('admin/template', $data);
	}

	public function send()
	{
		if ($this->input->post()) {
			$name = $this->session->userdata('name');
			$to = $this->input->post('email');
			$message = $this->input->post('message');
			$nama_ortu = $this->input->post('nama_ortu');
			$nama_siswa = $this->input->post('nama_siswa');
			$status_kehadiran = $this->input->post('status_kehadiran');
			// show_error($this->email->print_debugger());

			$this->load->config('email');
			$this->load->library('email');
			$this->email->from('mailtrap@demomailtrap.com', $name);
			$this->email->to($to);
			$this->email->subject('Pemberitahuan Absensi');
			// $this->email->message($message);

			$body = $this->load->view('admin/email/template_body', array(
				'nama_ortu' => $nama_ortu,
				'nama_siswa' => $nama_siswa,
				'status_kehadiran' => $status_kehadiran,
				'message' => $message
			), true);

			$this->email->message($body);


			if ($this->email->send()) {
				$data['error'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><b>Success !</b> Pesan email berhasil dikirim<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
				$config = $this->Config_model->get_setting();
				$data['settings'] = $config;
				$data['title'] = 'Kirim Email';
				$data['content'] = $this->load->view('admin/email/index', $data, true);
				// show_error($this->email->print_debugger());
				$this->load->view('admin/template', $data);
			} else {
				$data['error'] = '<div class="alert alert-daner alert-dismissible fade show" role="alert"><b>Error !</b> Pesan email gagal dikirim<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
				$config = $this->Config_model->get_setting();
				$data['settings'] = $config;
				$data['title'] = 'Kirim Email';
				$data['content'] = $this->load->view('admin/email/index', $data, true);
			}
		}
	}
}