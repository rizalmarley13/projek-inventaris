<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('model_user');
		$this->load->model('model_notifikasi');
	}

	public function index()
	{
		$idu 	= $this->uri->segment(4);
		
		$this->model_secure->getsecure();
		$isi['content'] = 'user/view_profiluser';
		$isi['judul'] = 'Profil';
		$isi['subjudul'] = 'User Login';
		$akses = $this->session->userdata('nama_jabatan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);

		$this->load->view('home/view_home',$isi);
	}
}