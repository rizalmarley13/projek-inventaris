<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('cart');
		$this->load->helper('url','form','html');
		$this->load->model('model_barang2');
		$this->load->model('model_permintaan');
		$this->load->model('model_notifikasi');
	}

	public function index()
	{
		$this->model_secure->getsecure();
		$isi['content'] = 'permintaan/form_permintaan1';
		$isi['judul'] = 'Transaksi';
		$isi['subjudul'] = 'Permintaan';
		$akses=$this->session->userdata('nama_jabataan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_count();
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$isi['kodepermintaan'] = $this->model_permintaan->get_max_kodepermintaan();
		$isi['data_barang'] = $this->model_barang2->get_allbarang_atk();
		$this->load->view('home/view_home',$isi);
	}

	public function tambah_permintaan_to_cart()
	{
		$data = array(
			'id' => $this->input->post('kode_barang'),
			'qty' => $this->input->post('qty'),
			'price' => $this->input->post('harga_beli'),
			'name' => $this->input->post('nama_barang'),
			'options' => $this->input->post('options'),
			);
		$this->cart->insert($data);
		redirect('permintaan');
	}

	public function tambah_permintaan()
	{
		$d_header['no_permintaan'] = $this->model_permintaan->get_max_kodepermintaan();
		$temp = $d_header['no_permintaan'];
		$d_header['id_karyawan'] = $this->input->post('id_karyawan');
		$d_header['bagian'] = $this->input->post('bagian');
		$d_header['total_barang'] = $this->input->post('total_barang');
		$d_header['tgl_permintaan'] = date("Y-m-d", strtotime($this->input->post('tgl_permintaan')));
		$this->model_permintaan->insert_permintaan($d_header);

		foreach ($this->cart->contents() as $items) {
			$d_detail['no_permintaan'] = $temp;
			$d_detail['kode_barang'] = $items['id'];
			$d_detail['jumlah_diminta'] = $items['qty'];
			$d_detail['nama_barang'] = $items['name'];
			$d_detail['satuan'] = $items['options'];
			$this->model_permintaan->insert_detpermintaan($d_detail);
			//mengupdate jumlah stok barang
			$d_u['jumlah'] = $this->model_barang2->kurang_stok($d_detail['kode_barang'],$d_detail['jumlah_diminta']);
			$key['kode_barang'] = $d_detail['kode_barang'];
			$this->model_barang2->update_stok($d_u,$key);
		}
		$this->session->unset_userdata('limit_add_cart');
		$this->cart->destroy();
		$this->session->set_flashdata("info","<div class=\"alert alert-success fade in\" id=\"alert\"><i calss=\"glyphicon glyphicon-ok\"></i><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a> Data Berhasil Di Simpan</div>");
		redirect('permintaan');

	}

	public function get_detail_barang()
	{
		$idu=$this->input->post('kode_barang');
		$data=array(
			'detail_barang'=>$this->model_barang2->get_barang_byid($idu),
			);
		$this->load->view('permintaan/ajax_detail_barang',$data);
	}

	public function reset_permintaan()
	{
		$this->session->unset_userdata('limit_add_cart');
		$this->cart->destroy();

		redirect('permintaan');
	}

	public function hapus_item($rowid)
	{
		$id = $this->uri->segment(3);

		$data = array(
			'rowid' => $id,
			'qty' => 0,
			 );
       
		$this->cart->update($data);

		redirect('permintaan');
	}

	// public function get_databarang() // function Untuk AUTOCOMPLETE
	// {
	// 	$kode = $this->input->post('kode',TRUE);
	// 	$query = $this->model_barang2->get_allbarang();

	// 	$barang = array();
	// 	foreach ($query as $brg) {
	// 		$barang [] = array(
	// 			'label' => $brg->nama_barang,
	// 			'kode_barang' => $brg->kode_barang,
	// 			'nama_barang' => $brg->nama_barang,
	// 			'merk' => $brg->merk,
	// 			'versi' => $brg->versi,
	// 			'jumlah' => $brg->jumlah,
	// 			'satuan' => $brg->satuan
	// 			);
	// 	}
	// 	echo json_encode($barang);
	// }

	

	// public function tambah_barang_permintaan()
	// {
		
	// 	$data = array(
	// 		'no_permintaan' => $this->input->post('no_permintaan'),
	// 		'kode_barang'=> $this->input->post('kode_barang'),
	// 		'nama_barang' => $this->input->post('nama_barang'),
	// 		'jumlah_diminta' => $this->input->post('jumlah_diminta'),
	// 		'satuan' => $this->input->post('satuan')
	// 	);

	// 	$this->model_permintaan->tambah_barang($data);

	// }

	// public function tampil_data_permintaan()
	// {
	// 	$query = $this->model_permintaan->tampil_barang();
	// 	$tampil = array();
	// 	foreach ($query as $rowtampil) {
	// 		$row = array();
	// 				$row[] = $rowtampil->kode_barang;
	// 				$row[] = $rowtampil->nama_barang;
	// 				$row[] = $rowtampil->jumlah_diminta;
	// 				$row[] = $rowtampil->satuan;				
	// 		$tampil[] = $row;
	// 	}
	// 	$output = array('tampil' => $tampil);
	// 	echo json_encode($output);
	// }

	// public function tampil_tbl_sementara()
	// {
	// 	$isi['tampil'] = $this->model_permintaan->tampil_barang();
	// 	$isi['jmltotal'] = $this->model_permintaan->total_brg();
	// 	$this->load->view('permintaan/tabel_sementara',$isi);
	// }

	// public function hapus_barang_permintaan($kode_barang)
	// {
	// 	$this->model_permintaan->hapus_barang($kode_barang);
	// }


}
	

