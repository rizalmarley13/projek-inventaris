<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengadaan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->helper('url','form','html');
		$this->load->model('model_pengadaan');
		$this->load->model('model_notifikasi');
	}

	public function index()
	{
		$this->model_secure->getsecure();
		$isi['error'] = $this->upload->display_errors();
		$isi['content'] = 'pengadaan/form_pengadaan';
		$isi['judul'] = 'Transaksi';
		$isi['subjudul'] = 'Pengadaan';
		$akses = $this->session->userdata('nama_jabatan');
		$isi['no_pengadaan'] = $this->model_pengadaan->get_max_kodepengadaan();
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$isi['data_smtr_pengadaan'] = $this->model_pengadaan->getall_smtr_pengadaan();
		$isi['total_brg'] = $this->model_pengadaan->total_barang_pengadaan();
		$this->load->view('home/view_home',$isi);
	}

	public function tambah_tabel_smtr_pengadaan()
	{
		$nmfile = "file_".time();
		$config['upload_path'] = "./asset/uploads/";
		$config['allowed_types'] = "gif|jpg|png|jpeg|bmp";
		$config['max_size'] = '2048'; //maksimum besar file 2M
        $config['max_width']  = '1288'; //lebar maksimum 1288 px
        $config['max_height']  = '768'; //tinggi maksimu 768 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
 		$this->upload->initialize($config);

 		if ($_FILES['filegambar']['name'])
 		{
 			if ($this->upload->do_upload('filegambar'))
 			{
				
 				$gbr = $this->upload->data();
 				$data_smtr = array(
 					'nama_brg_jasa' => $this->input->post('nama_brg_jasa'),
 					'spesifikasi' => $this->input->post('spesifikasi'),
 					'jumlah' => $this->input->post('jumlah'),
 					'satuan' => $this->input->post('satuan'),
 					'nama_gbr' => $gbr['file_name'],
 					'keterangan' => $this->input->post('keterangan')
 					 );
 				$this->model_pengadaan->insert_tabel_smtr_pengadaan($data_smtr);
 				$this->session->set_flashdata("info","<div class=\"alert alert-success fade in\" id=\"alert\"><i calss=\"glyphicon glyphicon-ok\"></i><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a> Gambar Berhasil Di Upload dan Data Berhasil ditambahkan</div>");
				redirect('pengadaan');	
 			}
 			else
 			{
 				$this->session->set_flashdata("info","<div class=\"alert alert-danger fade in\" id=\"alert\"><i calss=\"glyphicon glyphicon-ok\"></i><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a> Gambar gagal di Upload dan Data gagal ditambahkan, cek kembali ukuran file gambar yang di upload</div>");
				redirect('pengadaan');
 			}

 		}
		
	}

	public function kirim_pengadaan()
	{
		$d_header['no_pengadaan'] = $this->input->post('no_pengadaan');
		$temp = $d_header['no_pengadaan'];
		$d_header['tgl_pengadaan'] = $this->input->post('tgl_baru');
		$d_header['tgl_pengadaan'] = $this->input->post('tgl_pengadaan');
		$d_header['id_karyawan'] = $this->input->post('id_karyawan');
		$d_header['nama_karyawan'] = $this->input->post('nama_karyawan');
		$d_header['bagian'] = $this->input->post('bagian');
		$d_header['jabatan'] = $this->input->post('jabatan');
		$d_header['total_barang'] = $this->input->post('total_barang');
		$d_header['komen_pk2'] = $this->input->post('komen_pk2');
		$d_header['komen_pjm'] = $this->input->post('komen_pjm');
		$d_header['kirim_ke'] = $this->input->post('kirim_ke');

		$this->model_pengadaan->insert_pengadaan($d_header);

		foreach ($this->model_pengadaan->getall_smtr_pengadaan() as $item) {
			$d_detail['no_pengadaan'] = $temp;
			$d_detail['nama_brg_jasa'] = $item->nama_brg_jasa;
			$d_detail['spesifikasi'] = $item->spesifikasi;
			$d_detail['jumlah'] = $item->jumlah;
			$d_detail['satuan'] = $item->satuan;
			$d_detail['nama_gbr'] = $item->nama_gbr;
			$d_detail['keterangan'] = $item->keterangan;

			$this->model_pengadaan->insert_detail_pengadaan($d_detail); 
		}

		$datanotif['id_notif'] = $this->input->post('no_pengadaan');
		$datanotif['tgl_pengadaan'] = $this->input->post('tgl_pengadaan');
		$datanotif['waktu'] = time();
		$datanotif['id_karyawan'] = $this->input->post('id_karyawan');
		$datanotif['nama_karyawan'] = $this->input->post('nama_karyawan');
		$datanotif['bagian'] = $this->input->post('bagian');
		$datanotif['jabatan'] = $this->input->post('jabatan');
		$datanotif['total_barang'] = $this->input->post('total_barang');
		$datanotif['komen_pk2'] = $this->input->post('komen_pk2');
		$datanotif['komen_pjm'] = $this->input->post('komen_pjm');
		$datanotif['kirim_ke'] = $this->input->post('kirim_ke');


		// $datanotif = array('id_notif' => $no_pengadaan,
		// 				'tgl_pengadaan' => $tgl_pengadaan,
		// 				'waktu' => time(),
		// 				'nama_karyawan' => $nama_karyawan,
		// 				'bagian' => $bagian,
		// 				'jabatan' => $jabatan,
		// 				'total_barang' => $total_barang,
		// 				'komen_pk2' => $komen_pk2,
		// 				'komen_pjm' => $komen_pjm,
		// 				'kirim_ke' => $kirim_ke
		// 	);

		$this->model_notifikasi->post_notif($datanotif);

		$this->model_pengadaan->kosongkan_tbl_sementarapengadaan();
		$this->session->set_flashdata("info","<div class=\"alert alert-success fade in\" id=\"alert\"><i calss=\"glyphicon glyphicon-ok\"></i><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a> Data Berhasil Di Kirim</div>");
		redirect('pengadaan');
	}

	public function get_notifikasi()
	{
		$id = $this->uri->segment(3);
		$this->model_secure->getsecure();
		$akses = $this->session->userdata('nama_jabatan');
		if ($akses == "Kepala Sarpras") {
			$isi['content'] = 'pengadaan/form_kirim_pk2';
		} elseif ($akses == "Kepala Administrasi Akademik & Kemahasiswaan") {
			$isi['content'] = 'pengadaan/form_kirim_sarpras';
		} else {
		$isi['content'] = 'pengadaan/persetujuan_pengadaan';		
		}

		$isi['judul'] = 'Transaksi';
		$isi['subjudul'] = 'Persetujuan Pengadaan';
		
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$isi['dnotif'] = $this->model_notifikasi->get_notif_byid($id);
		$isi['dpengadaan'] = $this->model_pengadaan->get_dpengadaan_byid($id);
		$isi['total_brg'] = $this->model_pengadaan->total_detail_pengadaan($id);
		
		$this->load->view('home/view_home',$isi);

	}

	public function kirim_ke_pk2()
	{
		$d_header['no_pengadaan'] = $this->input->post('no_pengadaan');
		$temp = $d_header['no_pengadaan'];
		$d_header['tgl_pengadaan'] = $this->input->post('tgl_pengadaan');
		$d_header['id_karyawan'] = $this->input->post('id_karyawan');
		$d_header['nama_karyawan'] = $this->input->post('nama_karyawan');
		$d_header['bagian'] = $this->input->post('bagian');
		$d_header['jabatan'] = $this->input->post('jabatan');
		$d_header['total_barang'] = $this->input->post('total_barang');
		$d_header['komen_pk2'] = $this->input->post('komen_pk2');
		$d_header['komen_pjm'] = $this->input->post('komen_pjm');
		$d_header['kirim_ke'] = $this->input->post('kirim_ke');

		$this->model_pengadaan->update_pengadaan($temp,$d_header);

		$datanotif['id_notif'] = $this->input->post('no_pengadaan');
		$temp1 = $datanotif['id_notif'];
		$datanotif['tgl_pengadaan'] = $this->input->post('tgl_pengadaan');
		$datanotif['waktu'] = time();
		$datanotif['nama_karyawan'] = $this->input->post('nama_karyawan');
		$datanotif['bagian'] = $this->input->post('bagian');
		$datanotif['jabatan'] = $this->input->post('jabatan');
		$datanotif['total_barang'] = $this->input->post('total_barang');
		$datanotif['komen_pk2'] = $this->input->post('komen_pk2');
		$datanotif['komen_pjm'] = $this->input->post('komen_pjm');
		$datanotif['kirim_ke'] = $this->input->post('kirim_ke');

		$this->model_notifikasi->update_notif($temp1,$datanotif);

		$this->session->set_flashdata("info","<div class=\"alert alert-success fade in\" id=\"alert\"><i calss=\"glyphicon glyphicon-ok\"></i><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a> Data Berhasil Di Kirim</div>");
		redirect('pengadaan');
	}

	public function persetujuan()
	{
		$id = $this->uri->segment(3); 

		// $id_notif = addslashes($this->input->post('id_notif'));
		// $no_pengadaan = addslashes($this->input->post('no_pengadaan'));
		// $tgl_pengadaan= addslashes($this->input->post('tgl_pengadaan'));
		// $id_karyawan = addslashes($this->input->post('id_karyawan'));
		// $nama_karyawan = addslashes($this->input->post('nama_karyawan'));
		// $bagian = addslashes($this->input->post('bagian'));
		// $jabatan = addslashes($this->input->post('jabatan'));
		// $komen_pk2 = addslashes($this->input->post('komen_pk2'));
		// $komen_pjm = addslashes($this->input->post('komen_pjm'));
		// $status = addslashes($this->input->post('status'));
		// $kirim_ke = addslashes($this->input->post('kirim_ke'));
		
		// if ($akses == "Ketua") {

		$dsetuju['no_pengadaan'] = $this->input->post('no_pengadaan');
		$temp = $dsetuju['no_pengadaan'];
		$dsetuju['tgl_pengadaan'] = $this->input->post('tgl_pengadaan');
		$dsetuju['id_karyawan'] = $this->input->post('id_karyawan');
		$dsetuju['nama_karyawan'] = $this->input->post('nama_karyawan');
		$dsetuju['bagian'] = $this->input->post('bagian');
		$dsetuju['jabatan'] = $this->input->post('jabatan');
		$dsetuju['total_barang'] = $this->input->post('total_barang');
		$dsetuju['komen_pk2'] = $this->input->post('komen_pk2');
		$dsetuju['komen_pjm'] = $this->input->post('komen_pjm');
		$dsetuju['status'] = $this->input->post('status');
		$dsetuju['kirim_ke'] = $this->input->post('kirim_ke');

		$this->model_pengadaan->setuju($temp,$dsetuju);
		$this->model_notifikasi->hapus($id);
		$this->session->set_flashdata("info","<div class=\"alert alert-success fade in\" id=\"alert\"><i calss=\"glyphicon glyphicon-ok\"></i><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a> Data Berhasil Dikirim</div>");
			redirect('pengadaan');
		// } else {
		// 	$dsetuju = array(
		// 				'tgl_pengadaan' => $tgl_pengadaan,
		// 				'nama_karyawan' => $nama_karyawan,
		// 				'bagian' => $bagian,
		// 				'jabatan' =>$jabatan,
		// 				'nama_brg_jasa' => $nama_brg_jasa,
		// 				'spesifikasi' => $spesifikasi,
		// 				'jumlah' => $jumlah,
		// 				'keterangan' => $keterangan,
		// 				'komentar' => $komentar,
		// 				'status' => $status,
		// 				'kirim_ke' => $kirim_ke
		//  );
		// $this->model_notifikasi->updatenotif($id_notif,$dsetuju);
		// $this->session->set_flashdata("info","<div class=\"alert alert-success\" id=\"alert\"><i calss=\"glyphicon glyphicon-ok\"></i> Data Berhasil Dikirim</div>");
		// 	redirect('pengadaan');
		// }
	}

	public function tampil_datapengadaan()
	{
		$this->model_secure->getsecure();
		$isi['content'] = 'pengadaan/view_datapengadaan';
		$isi['judul'] = 'Master Data';
		$isi['subjudul'] = 'Data Pengadaan';
		$akses = $this->session->userdata('nama_jabataan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$isi['dpengadaan'] = $this->model_pengadaan->get_allpengadaan();
		$this->load->view('home/view_home',$isi);
	}

	public function tampil_berdasarkan()
	{
		$showby = addslashes($this->input->post('showby'));

		$this->model_secure->getsecure();
		$isi['content'] = 'pengadaan/view_datapengadaan';
		$isi['judul'] = 'Master Data';
		$isi['subjudul'] = 'Data Pengadaan';
		$akses = $this->session->userdata('nama_jabataan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$isi['dpengadaan'] = $this->model_pengadaan->showby($showby);
		$this->load->view('home/view_home',$isi);
	}

	public function get_detail_pengadaan()
	{
		if($_POST['rowid']){
			$id = $_POST['rowid'];
			$data = array(
			'detail_pengadaan'=>$this->model_pengadaan->get_dpengadaan_byid($id), 
			);	
			
		}
		
		$this->load->view('pengadaan/ajax_detail_pengadaan',$data);
	}

	public function hapus_brg_pengadaan()
	{
		$id_del = $this->uri->segment(3);
		$this->model_pengadaan->delete_tbl_smtr_pengadaan($id_del);
		$this->session->set_flashdata("info","<div class=\"alert alert-danger fade in\" id=\"alert\"><i calss=\"glyphicon glyphicon-ok\"></i><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a> Data Berhasil Dihapus</div>");
		redirect('pengadaan');
	}

}
