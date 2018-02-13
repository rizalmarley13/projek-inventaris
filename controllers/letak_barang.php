<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Letak_barang extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('model_barang2');
		$this->load->model('model_ruangan');
		$this->load->model('model_letak_barang');
		$this->load->model('model_notifikasi');

	}

	public function index()
	{	
		$this->model_secure->getsecure();
		$isi['content'] = 'letakbarang/view_letakbarang';
		$isi['judul'] = 'Master Data';
		$isi['subjudul'] = 'Data Letak Barang';
		$isi['ruang'] = $this->model_ruangan->select_ruangan();
		$isi['data'] = $this->model_barang2->tampil_barangmutasi();
		$akses = $this->session->userdata('nama_jabatan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$isi['data_letak'] = $this->model_letak_barang->get_data_letak(); //menampilkan data pada tabel letak barang
		$this->load->view('home/view_home',$isi);
	}

	public function input_letak_brg() // menampilkan form_input_letak_barang
	{
		$this->model_secure->getsecure();
		$isi['content'] = 'letakbarang/form_input_letak_brg';
		$isi['judul'] = 'Master Data';
		$isi['subjudul'] = 'Input Letak Barang';
		$isi['ruang'] = $this->model_ruangan->select_ruangan();
		$isi['data'] = $this->model_barang2->tampil_barangmutasi();
		$akses = $this->session->userdata('nama_jabatan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$isi['data_barang'] = $this->model_barang2->get_allbarang();
		$isi['data_sementara'] = $this->model_letak_barang->get_datasementara(); // menampilkan tabel_sementara
		$isi['jmltotal'] = $this->model_letak_barang->total_barang();
		$this->load->view('home/view_home',$isi);
	}

	public function get_detail_barang() //menampilkan ajax_detail_barang
	{
		$idu=$this->input->post('kode_barang');
		$data=array(
			'detail_barang'=>$this->model_barang2->get_barang_byid($idu),
			);
		$this->load->view('letakbarang/ajax_detail_barang',$data);
	}

	public function tambah_tabel_sementara() // menyimpan kedalam tabel_sementara
	{	
		$data['kode_barang'] = $this->input->post('kode_barang');
		$data['nama_barang'] = $this->input->post('nama_barang');
		$data['merk'] = $this->input->post('merk');
		$data['versi'] = $this->input->post('versi');
		$data['jumlah'] = $this->input->post('jumlah');
		$data['satuan'] = $this->input->post('satuan');
		$data['kondisi'] = $this->input->post('kondisi');
		$data['keterangan'] = $this->input->post('keterangan');

		$kode_cek = $data['kode_barang'];
		$hasil_cek_kode = $this->model_letak_barang->cek_kode_brg($kode_cek);
		if ($hasil_cek_kode->num_rows() == 1) {
			echo "<script>alert('kode Barang dan Nama Barang sudah ditambahkan');
			history.go(-1);
			</script>";
		} else {
	
		$this->model_letak_barang->insert_tabel_sementara($data);
		redirect('letak_barang/input_letak_brg');
		}
	}

	public function update_setelahhapus()
	{
		$id = $this->uri->segment(3);

		foreach ($this->model_letak_barang->get_byid_detail($id) as $row) {
			$ambil['nodetail'] = $row->nodetail;
			$ambil['no_ruangan'] = $row->no_ruangan;
			$ambil['jumlah'] = $row->jumlah;
		}
		//melakukan pengurangan total barang pada tabel letak barang
		$d_u_head['total_barang'] = $this->model_letak_barang->update_total_barang3($ambil['no_ruangan'],$ambil['jumlah']);
		$key2['no_ruangan'] = $ambil['no_ruangan'];
		//mengupdate total barang pada tabel letak barang
		$this->model_letak_barang->update_headerletakbarang($d_u_head,$key2);
		//menghapus data pada tabel detail letak barang
		$this->model_letak_barang->delete_detail_letak($id);

		redirect('letak_barang');
	}

	public function edit_detail_letak()
	{
		$id = $this->uri->segment(3);

		$this->model_secure->getsecure();
		$isi['content'] = 'letakbarang/form_edit_detail';
		$isi['judul'] = 'Master Data';
		$isi['subjudul'] = 'Data Letak Barang';
		$akses = $this->session->userdata('nama_jabatan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$isi['data_detail'] = $this->model_letak_barang->get_byid_detail($id);
		$this->load->view('home/view_home',$isi);
	}

	public function update_detail_letak()
	{	
		
		$nodetail = addslashes($this->input->post('nodetail'));
		$no_ruangan = addslashes($this->input->post('no_ruangan'));
		$kode_barang = addslashes($this->input->post('kode_barang'));
		$nama_barang = addslashes($this->input->post('nama_barang'));
		$merk = addslashes($this->input->post('merk'));
		$versi = addslashes($this->input->post('versi'));
		$jumlah = addslashes($this->input->post('jumlah'));
		$jumlah_baru = addslashes($this->input->post('jumlah_baru'));
		$satuan = addslashes($this->input->post('satuan'));
		$status = addslashes($this->input->post('status'));
		$kondisi = addslashes($this->input->post('kondisi'));
		$keterangan = addslashes($this->input->post('keterangan'));

		$selisih['jumlah'] = $jumlah - $jumlah_baru;

		$data = array(
			'no_ruangan' => $no_ruangan,
			'kode_barang' => $kode_barang,
			'nama_barang' => $nama_barang,
			'merk' => $merk,
			'versi' => $versi,
			'jumlah' => $jumlah_baru,
			'satuan' => $satuan,
			'status' => $status,
			'kondisi' => $kondisi,
			'keterangan' => $keterangan
			 );

		$this->model_letak_barang->update_detail_letak_brg($nodetail,$data);

		$d_u_head['total_barang'] = $this->model_letak_barang->update_total_barang3($data['no_ruangan'],$selisih['jumlah']);
		$key2['no_ruangan'] = $data['no_ruangan'];
		$this->model_letak_barang->update_headerletakbarang($d_u_head,$key2);

		$this->session->set_flashdata("info","<div class=\"alert alert-success fade in\" id=\"alert\"><i calss=\"glyphicon glyphicon-ok\"></i><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a> Data Berhasil Diupdate</div>");
		redirect('letak_barang');
	}

	public function hapus_byid() // menghapus data di tabel_sementara
	{
		$id = $this->uri->segment(3);
		$this->model_letak_barang->delete_tabel_sementara($id);
		redirect('letak_barang/input_letak_brg');
	}

	public function hapus_detail_letak()
	{
		$id = $this->uri->segment(3);
		$this->model_letak_barang->delete_detail_letak($id);

		
		
		redirect('letak_barang');
	}

	public function simpan_letak_brg() //menyimpan ke database tabel_letak_brg dan tabel_detail_letak_brg
	{
		$d_header['no_ruangan'] = $this->input->post('no_ruangan');
		$temp = $d_header['no_ruangan'];
		$d_header['total_barang'] = $this->input->post('total_barang');

		$this->model_letak_barang->insert_letak_brg($d_header);

		foreach ($this->model_letak_barang->get_datasementara() as $item) {
			$d_detail['no_ruangan'] = $temp;
			$d_detail['kode_barang'] = $item->kode_barang;
			$d_detail['nama_barang'] = $item->nama_barang;
			$d_detail['merk'] = $item->merk;
			$d_detail['versi'] = $item->versi;
			$d_detail['jumlah'] = $item->jumlah;
			$d_detail['satuan'] = $item->satuan;
			$d_detail['kondisi'] = $item->kondisi;
			$d_detail['keterangan'] = $item->keterangan;

			$this->model_letak_barang->insert_detail_letak($d_detail);
		}

		$this->model_letak_barang->kosongkan();
		$this->session->set_flashdata("info","<div class=\"alert alert-success fade in\" id=\"alert\"><i calss=\"glyphicon glyphicon-ok\"></i><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a> Data Berhasil Ditambah</div>");
		redirect('letak_barang/input_letak_brg');
	}

	public function lihat_detail_brg()
	{	
		$id_l = $this->uri->segment(3);
		$this->model_secure->getsecure();
		$isi['content'] = 'letakbarang/view_detail_letak_brg';
		$isi['judul'] = 'Master Data';
		$isi['subjudul'] = 'Data Detail Letak Barang';
		$akses = $this->session->userdata('nama_jabatan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$isi['data_letak'] = $this->model_letak_barang->get_data_letak(); // menampilkan data pada tabel letak barang
		$isi['data_detail'] = $this->model_letak_barang->tampil_detail($id_l); // menampilkan data detail letak
		$isi['jmlbarang'] = $this->model_letak_barang->total_barang_detail($id_l);
		$this->load->view('home/view_home',$isi);
	}
	

}
