<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruangan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('model_ruangan');
		$this->load->model('model_notifikasi');
	}

	public function index()
	{
		$this->model_secure->getsecure();
		$isi['content'] = 'ruangan/view_dataruangan';
		$isi['judul'] = 'Master';
		$isi['subjudul'] = 'Data Ruangan';
		$isi['qruangan'] = $this->model_ruangan->get_allruangan();
		$akses = $this->session->userdata('nama_jabatan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$this->load->view('home/view_home',$isi);
	}

	public function form()
	{
		$mau_ke = $this->uri->segment(3);
		$idu 	= $this->uri->segment(4);

		$no_ruangan =addslashes($this->input->post('no_ruangan'));
		$nama_ruangan =addslashes($this->input->post('nama_ruangan'));
		$lantai =addslashes($this->input->post('lantai'));

		if ($mau_ke == "add") {
			$this->model_secure->getsecure();
			$isi['content'] 	= 'ruangan/form_tambahruangan';
			$isi['judul'] 		= 'Master';
			$isi['subjudul'] 	= 'Tambah Data Ruangan';
			$isi['aksi']		= 'aksi_add';
			$akses = $this->session->userdata('nama_jabatan');
			$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
			$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
			$this->load->view('home/view_home',$isi);
		}
		else if ($mau_ke == "edit"){
			$this->model_secure->getsecure();
			$isi['content']		= 'ruangan/form_tambahruangan';
			$isi['judul']		= 'Master';
			$isi['subjudul']	= 'Tambah Data Ruangan';
			$isi['aksi']		= 'aksi_edit';
			$isi['qruangan']	= $this->model_ruangan->get_ruangan_byid($idu);
			$akses = $this->session->userdata('nama_jabatan');
			$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
			$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
			$this->load->view('home/view_home',$isi);

		} else if ($mau_ke == "aksi_add"){
			$data = array(
				'no_ruangan'	=>$no_ruangan ,
				'nama_ruangan'	=>$nama_ruangan ,
				'lantai'		=>$lantai
			 );
			$this->model_ruangan->insert_ruangan($data);
			$this->session->set_flashdata("info","<div class=\"alert alert-success fade in\" id=\"alert\"><i calss=\"glyphicon glyphicon-ok\"></i><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a> Data Berhasil Ditambah</div>");
			redirect('ruangan');
			
		} else if ($mau_ke == "aksi_edit"){
			$data = array(
				'nama_ruangan'	=>$nama_ruangan ,
				'lantai'		=>$lantai 
			);
			$this->model_ruangan->update_ruangan($no_ruangan,$data);
			$this->session->set_flashdata("info","<div class=\"alert alert-success fade in\" id=\"alert\"><i calss=\"glyphicon glyphicon-ok\"></i><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a> Data Berhasil Diupdate</div>");
			redirect('ruangan');
		}	
	}

	public function delete($idu){
		$this->model_ruangan->delete_ruangan($idu);
		$this->session->set_flashdata("info","<div class=\"alert alert-danger fade in\" id=\"alert\"><i calss=\"glyphicon glyphicon-ok\"></i><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a> Data Berhasil Dihapus</div>");
		redirect('ruangan');
	}

}
