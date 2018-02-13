<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_kepala extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('model_barang2');
		$this->load->model('model_notifikasi');
	}

	public function index()
	{
		$idu 	= $this->uri->segment(4);
		
		$this->model_secure->getsecure();
		$isi['content'] = 'barang/view_databarang_kepala';
		$isi['judul'] = 'Master';
		$isi['subjudul'] = 'Data Barang';
		$akses = $this->session->userdata('nama_jabatan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$isi['data'] = $this->model_barang2->tampil_barang();

		$this->load->view('home/view_home',$isi);
	}
	public function detail($idu)
	{
		$isi['content']		= 'barang/form_detailbarang_kepala';
		$isi['judul']		= 'Master';
		$isi['subjudul']	= 'Detail Data Barang';
		$akses = $this->session->userdata('nama_jabatan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$isi['qbarang']		= $this->model_barang2->get_barang_byid($idu);
		$this->load->view('home/view_home',$isi);
	}
	public function cek(){
		$kode_barang = $this->input->post('kode_barang');
		$this->model_barang2->cek_kode($kode_barang);
	}
}