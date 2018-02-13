<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang2 extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->model('model_barang2');
		$this->load->model('model_notifikasi');
	}

	public function index()
	{	
		$this->model_secure->getsecure();

		$isi['content'] = 'barang/view_databarang';
		$isi['judul'] = 'Master';
		$isi['subjudul'] = 'Data Barang';
		$isi['data'] = $this->model_barang2->tampil_barang();
		$akses = $this->session->userdata('nama_jabatan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);

		$this->load->view('home/view_home',$isi);
	}

	public function form()
	{
		$mau_ke = $this->uri->segment(3);
		$idu 	= $this->uri->segment(4);

		if ($mau_ke == "add") {

			$this->model_secure->getsecure();
			$isi['content'] 	= 'barang/form_tambahbarang';
			$isi['judul'] 		= 'Master';
			$isi['subjudul'] 	= 'Tambah Data Barang';
			$isi['aksi'] = 'aksi_add';
			$isi['get_kodebarang'] = $this->model_barang2->get_max_kodebarang();
			$isi['jenisbrg'] = $this->model_barang2->select_jenisbrg();
			$akses = $this->session->userdata('nama_jabatan');
			$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
			$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
			$this->load->view('home/view_home',$isi);

		} else if ($mau_ke == "edit") {

			$this->model_secure->getsecure();
			$isi['content']		= 'barang/form_tambahbarang';
			$isi['judul']		= 'Master';
			$isi['subjudul']	= 'Edit Data Barang';
			$isi['aksi'] = 'aksi_edit';
			$akses = $this->session->userdata('nama_jabatan');
			$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
			$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
			$isi['qdata']		= $this->model_barang2->get_barang_byid($idu);
			$this->load->view('home/view_home',$isi);
		
		} else if ($mau_ke == "aksi_add") {
			
			$this->form_validation->set_error_delimiters('<div style="color:red; margin-bottom: 5px">', '</div>');
			$this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required');
			$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
			$this->form_validation->set_rules('harga_beli', 'Harga Beli', 'numeric');
			$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');

			if ($this->form_validation->run() == FALSE) {

				$this->model_secure->getsecure();
				$isi['content'] 	= 'barang/form_tambahbarang';
				$isi['judul'] 		= 'Master';
				$isi['subjudul'] 	= 'Tambah Data Barang';
				$isi['aksi'] = 'aksi_add';
				$isi['jenisbrg'] = $this->model_barang2->select_jenisbrg();
				$akses = $this->session->userdata('nama_jabatan');
				$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
				$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
				$this->load->view('home/view_home',$isi);
			} else {
				$data['kode_barang'] = $this->input->post('kode_barang');
				$data['nama_barang'] = $this->input->post('nama_barang');
				$data['id_jenis'] = $this->input->post('id_jenis');
				$data['merk'] = $this->input->post('merk');
				$data['versi'] = $this->input->post('versi');
				$data['sumber'] = $this->input->post('sumber');
				$data['tgl_beli'] = $this->input->post('tgl_beli');
				$data['tgl_expired'] = $this->input->post('tgl_expired');
				$data['harga_beli'] = $this->input->post('harga_beli');
				$data['jumlah'] = $this->input->post('jumlah');
				$data['satuan'] = $this->input->post('satuan');
				$data['qr_code'] = $this->input->post('qr_code');


				$kode = $data['kode_barang'];
				$hasil_cek = $this->model_barang2->cek_kode($kode);
				if ($hasil_cek->num_rows() == 1) {
					echo "<script>alert('Kode barang sudah digunakan');
					history.go(-1);
					</script>";
				} else {

				$this->model_barang2->insert_barang($data);
				$this->session->set_flashdata("info","<div class=\"alert alert-success\" id=\"alert\"><i calss=\"glyphicon glyphicon-ok\"></i><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a> Data Berhasil Ditambah</div>");
				redirect('barang2');
				}
			}

		} else if ($mau_ke == "aksi_edit") {

				$this->form_validation->set_error_delimiters('<div style="color:red; margin-bottom: 5px">', '</div>');
				$this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required');
				$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
				$this->form_validation->set_rules('harga_beli', 'Nama Barang', 'numeric');
				$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');

				if ($this->form_validation->run() == FALSE) {

					$this->model_secure->getsecure();
					$isi['content']		= 'barang/form_tambahbarang';
					$isi['judul']		= 'Master';
					$isi['subjudul']	= 'Edit Data Barang';
					$isi['aksi'] = 'aksi_edit';
					$akses = $this->session->userdata('nama_jabatan');
					$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
					$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
					$isi['qdata']		= $this->model_barang2->get_barang_byid($idu);
					$this->load->view('home/view_home',$isi);

				} else {

					$data['kode_barang'] = $this->input->post('kode_barang');
					$kode_barang = $data['kode_barang'];
					$data['nama_barang'] = $this->input->post('nama_barang');
					$data['id_jenis'] = $this->input->post('id_jenis');
					$data['merk'] = $this->input->post('merk');
					$data['versi'] = $this->input->post('versi');
					$data['sumber'] = $this->input->post('sumber');
					$data['tgl_beli'] = $this->input->post('tgl_beli');
					$data['tgl_expired'] = $this->input->post('tgl_expired');
					$data['harga_beli'] = $this->input->post('harga_beli');
					$data['jumlah'] = $this->input->post('jumlah');
					$data['satuan'] = $this->input->post('satuan');
					$data['qr_code'] = $this->input->post('qr_code');

					$this->model_barang2->update_barang($kode_barang,$data);
					$this->session->set_flashdata("info","<div class=\"alert alert-success\" id=\"alert\"><i calss=\"glyphicon glyphicon-ok\"></i><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a> Data Berhasil Diupdate</div>");
					redirect('barang2');
				}
		}


	}

	public function detail($idu)
	{	
		$this->model_secure->getsecure();
		$isi['content']		= 'barang/form_detailbarang';
		$isi['judul']		= 'Master';
		$isi['subjudul']	= 'Detail Data Barang';
		$isi['qbarang']		= $this->model_barang2->get_barang_byid($idu);
		$akses = $this->session->userdata('nama_jabatan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$this->load->view('home/view_home',$isi);
	}

	public function tampil_qrcode($id)
	{	
		$id = $this->uri->segment(3);

		$isi['content']		= 'barang/view_qrcode';
		$isi['judul']		= 'Master';
		$isi['subjudul']	= 'Detail Data Barang';
		$isi['tampil'] = $this->model_barang2->tampil_qrcode($id);
		$akses = $this->session->userdata('nama_jabatan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$this->load->view('home/view_home',$isi);
	}

	public function delete($idu){
		$this->model_barang2->delete_barang($idu);
		$this->session->set_flashdata("info","<div class=\"alert alert-danger\" id=\"alert\"><i calss=\"glyphicon glyphicon-ok\"></i><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a> Data Berhasil Dihapus</div>");
		redirect('barang2');
	}

}