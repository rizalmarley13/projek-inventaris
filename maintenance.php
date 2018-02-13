<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('model_notifikasi');
		$this->load->model('model_maintenance');
	}

	public function index()
	{
		$this->model_secure->getsecure();
		$isi['content'] = 'maintenance/view_datamaintenance';
		$isi['judul'] = 'Master';
		$isi['subjudul'] = 'Data Maintenance';
		$akses = $this->session->userdata('nama_jabatan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$isi['qmaintenance'] = $this->model_maintenance->get_allmaintenance();
		$this->load->view('home/view_home',$isi);
	}
}
