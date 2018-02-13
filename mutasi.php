<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('model_barang2');
		$this->load->model('model_ruangan');
		$this->load->model('model_mutasi');
		$this->load->model('model_notifikasi');
		$this->load->model('model_letak_barang');

	}

	public function index()
	{	
		$mau_ke = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		
		$this->model_secure->getsecure();
		$isi['content'] = 'mutasi/view_datamutasi';
		$isi['judul'] = 'Master Data';
		$isi['subjudul'] = 'Data Mutasi';
		$isi['qmutasi'] = $this->model_mutasi->get_allmutasi();
		$akses = $this->session->userdata('nama_jabatan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$this->load->view('home/view_home',$isi);
	}

	public function ambil_detail_letak()
	{
		$id = $this->uri->segment(3);

		$this->model_secure->getsecure();
		$isi['content'] = 'mutasi/form_mutasi';
		$isi['judul'] = 'Transaksi';
		$isi['subjudul'] = 'Mutasi';
		$isi['no_mutasi'] = $this->model_mutasi->get_max_kodemutasi();
		$isi['ruang'] = $this->model_ruangan->select_ruangan();
		$isi['data'] = $this->model_barang2->tampil_barangmutasi();
		$isi['tampil'] = $this->model_barang2->getbarangmutasi($id);
		$akses = $this->session->userdata('nama_jabatan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$isi['ambil_data'] = $this->model_letak_barang->get_byid_detail($id);
		$this->load->view('home/view_home',$isi);
	}

	public function simpan_mutasi()
	{	

		$no_mutasi = addslashes($this->input->post('no_mutasi'));
		$nodetail = addslashes($this->input->post('nodetail'));
		$tgl_mutasi = addslashes($this->input->post('tgl_mutasi'));
		$no_ruangan = addslashes($this->input->post('no_ruangan'));
		$ruangan_baru = addslashes($this->input->post('ruangan_baru'));
		$kode_barang = addslashes($this->input->post('kode_barang'));
		$nama_barang = addslashes($this->input->post('nama_barang'));
		$merk = addslashes($this->input->post('merk'));
		$versi = addslashes($this->input->post('versi'));
		$jumlah_mutasi = addslashes($this->input->post('jumlah_mutasi'));
		$satuan = addslashes($this->input->post('satuan'));
		$status = addslashes($this->input->post('status'));
		$keterangan = addslashes($this->input->post('keterangan'));

		$data1 = array(
			'no_mutasi' => $no_mutasi,
			'tgl_mutasi' => $tgl_mutasi,
			'no_ruangan' => $no_ruangan,
			'ruangan_baru' => $ruangan_baru,
			'kode_barang' => $kode_barang,
			'nama_barang' => $nama_barang,
			'merk' => $merk,
			'versi' => $versi,
			'jumlah_mutasi' => $jumlah_mutasi,
			'satuan' => $satuan,
			'keterangan' => $keterangan
		 );

		$this->model_mutasi->insert_mutasi($data1);

		$data2['no_ruangan'] = $this->input->post('ruangan_baru');
		$data2['kode_barang'] = $this->input->post('kode_barang');
		$data2['nama_barang'] = $this->input->post('nama_barang');
		$data2['merk'] = $this->input->post('merk');
		$data2['versi'] = $this->input->post('versi');
		$data2['jumlah'] = $this->input->post('jumlah_mutasi');
		$data2['satuan'] = $this->input->post('satuan');
		$data2['status'] = $this->input->post('status');
		$data2['no_mutasi'] = $this->input->post('no_mutasi');
		$data2['keterangan'] = $this->input->post('keterangan');
		
		$this->model_letak_barang->insert_detail_mutasi($data2);

		$d_u_head2['total_barang'] = $this->model_letak_barang->update_total_barang2($data1['ruangan_baru'],$data1['jumlah_mutasi']);
		$key3['no_ruangan'] = $data1['ruangan_baru'];
		$this->model_letak_barang->update_headerletakbarang($d_u_head2,$key3);


		$d_u = array(
			'nodetail' => $nodetail,
			'no_ruangan' => $no_ruangan,
			'kode_barang' => $kode_barang,
			'nama_barang' => $nama_barang,
			'merk' => $merk,
			'versi' => $versi,
			'jumlah' => $jumlah,
			'satuan' => $satuan,
			'keterangan' => $keterangan
			);
		//pengurangan jumlah barang pada tabel detail letak barang
		$d_u['jumlah'] = $this->model_letak_barang->kurang_jumlah($d_u['nodetail'],$data1['jumlah_mutasi']);
		$key['nodetail'] = $d_u['nodetail'];
		$this->model_letak_barang->update_setelahmutasi($d_u,$key);
		//update total barang pada tabel header letak barang
		$d_u_head['total_barang'] = $this->model_letak_barang->update_total_barang($d_u['no_ruangan'],$data1['jumlah_mutasi']);
		$key2['no_ruangan'] = $d_u['no_ruangan'];
		$this->model_letak_barang->update_headerletakbarang($d_u_head,$key2);

		$this->session->set_flashdata("info","<div class=\"alert alert-success fade in\" id=\"alert\"><i calss=\"glyphicon glyphicon-ok\"></i><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a> Data Berhasil Ditambah</div>");
		redirect('mutasi');
	}

	// public simpan_setelah_mutasi()
	// {
	// 	$nodetail = addslashes($this->input->post('nodetail'));
	// 	$ruangan_baru = addslashes($this->input->post('ruangan_baru'));
	// 	$kode_barang = addslashes($this->input->post('kode_barang'));
	// 	$nama_barang = addslashes($this->input->post('nama_barang'));
	// 	$merk = addslashes($this->input->post('merk'));
	// 	$versi = addslashes($this->input->post('versi'));
	// 	$jumlah_mutasi = addslashes($this->input->post('jumlah_mutasi'));
	// 	$satuan = addslashes($this->input->post('satuan'));
	// 	$status = addslashes($this->input->post('status'));
	// 	$keterangan = addslashes($this->input->post('keterangan'));
	// 	$no_ruangan = $ruangan_baru;
	// 	$jumlah_mutasi = $jumlah;
	// }

	// $d_detail = array(
	// 	'no_ruangan' => $no_ruangan,
	// 	'kode_barang' => $kode_barang,
	// 	'nama_barang' => $nama_jabatan,
	// 	'merk' => $merk,
	// 	'versi' => $versi,
	// 	'jumlah' => $jumlah,
	// 	'satuan' => $satuan,
	// 	'status' => $status,
	// 	'keterangan' => $keterangan,
	// 	);


	public function tampil_mutasi()
	{
		$mau_ke = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		
		$this->model_secure->getsecure();
		$isi['content'] = 'mutasi/view_datamutasi';
		$isi['judul'] = 'Master Data';
		$isi['subjudul'] = 'Data Mutasi';
		$isi['qmutasi'] = $this->model_mutasi->get_allmutasi();
		$akses = $this->session->userdata('nama_jabatan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$this->load->view('home/view_home',$isi);
	}

	public function hapus_mutasi()
	{
		$id_m = $this->uri->segment(3);

		foreach ($this->model_mutasi->get_mutasi_id($id_m) as $item) {
			$d_detmu['no_mutasi'] = $item->no_mutasi;
			$d_detmu['tgl_mutasi'] = $item->tgl_mutasi;
			$d_detmu['kode_barang'] = $item->kode_barang;
			$d_detmu['nama_barang'] = $item->nama_barang;
			$d_detmu['merk'] = $item->merk;
			$d_detmu['versi'] = $item->versi;
			$d_detmu['jumlah_mutasi'] = $item->jumlah_mutasi;
			$d_detmu['satuan'] = $item->satuan;
			$d_detmu['no_ruangan'] = $item->no_ruangan;
			$d_detmu['ruangan_baru'] = $item->ruangan_baru;
		}	


		foreach ($this->model_letak_barang->cari($id_m) as $item) {
			$d_tampung['nodetail'] = $item->nodetail;
			$tmp = $d_tampung['nodetail'];
			$d_tampung['no_ruangan'] = $item->no_ruangan;
			$d_tampung['jumlah'] = $item->jumlah;
		}

		//melakukan pengurangan total barang pada tabel letak barang
		$d_u_head['total_barang'] = $this->model_letak_barang->update_total_barang4($d_detmu['ruangan_baru'],$d_tampung['jumlah']);
		$key2['no_ruangan'] = $d_detmu['ruangan_baru'];
		//mengupdate total barang pada tabel letak barang
		$this->model_letak_barang->update_headerletakbarang($d_u_head,$key2);
		//menghapus data pada tabel detail letak barang
		$this->model_letak_barang->delete_dari_mutasi($tmp);
		//menghapusm data pada tabel mutasi
		$this->model_mutasi->delete_mutasi($id_m);

		$this->session->set_flashdata("info","<div class=\"alert alert-danger fade in\" id=\"alert\"><i calss=\"glyphicon glyphicon-ok\"></i><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a> Data Berhasil Dihapus</div>");
		redirect('mutasi');

	}


}