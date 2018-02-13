<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_letak_barang extends CI_model {

	var $tabel = 'tabel_letak_brg';
	var $tabel1 = 'tabel_detail_letak_brg';
	var $tabel2 = 'tabel_sementara';

	function __construct(){
		parent::__construct();
	}

	public function get_data_letak()
	{
		$this->db->from($this->tabel);
		$q = $this->db->get();

		if ($q->num_rows() > 0) {
			return $q->result();
		}
	}

	public function get_byid_detail($id)
	{
		$this->db->from($this->tabel1);
		$this->db->where('nodetail',$id);
		$q = $this->db->get();

		if ($q->num_rows() == 1) {
			return $q->result();
		}
	}

	public function tampil_detail($id_l)
	{
		$q = $this->db->query("SELECT tabel_letak_brg.no_ruangan,tabel_letak_brg.total_barang,tabel_detail_letak_brg.kode_barang,tabel_barang.nama_barang,tabel_detail_letak_brg.nodetail,tabel_detail_letak_brg.merk,tabel_detail_letak_brg.versi,tabel_detail_letak_brg.jumlah,tabel_detail_letak_brg.satuan,tabel_detail_letak_brg.status,tabel_detail_letak_brg.kondisi,tabel_detail_letak_brg.keterangan FROM tabel_letak_brg,tabel_detail_letak_brg,tabel_barang WHERE tabel_letak_brg.no_ruangan=tabel_detail_letak_brg.no_ruangan AND tabel_barang.kode_barang=tabel_detail_letak_brg.kode_barang AND tabel_detail_letak_brg.no_ruangan='$id_l'");
		if ($q->num_rows() > 0){
			return $q->result();
		}
	}

	public function get_datasementara()
	{
		$this->db->from($this->tabel2);
		$q = $this->db->get();

		if($q->num_rows() > 0){
			return $q->result();
		}
	}

	public function cek_kode_brg($kode_cek)
	{
		$q = $this->db->query("SELECT * FROM tabel_sementara WHERE kode_barang='$kode_cek'");
		return $q;
	}

	public function insert_tabel_sementara($data)
	{
		$this->db->insert($this->tabel2,$data);
		return TRUE;
	}

	public function insert_letak_brg($d_header)
	{
		$this->db->insert('tabel_letak_brg',$d_header);
		return TRUE;
	}

	public function insert_detail_letak($d_detail)
	{
		$this->db->insert($this->tabel1,$d_detail);
		return TRUE;
	}

	public function insert_detail_mutasi($data2)
	{

		$this->db->insert($this->tabel1,$data2);
		return TRUE;
	}

	public function total_barang()
	{
		$this->db->select('SUM(jumlah) as total');
		$this->db->from($this->tabel2);
		$q = $this->db->get();

		if ($q->num_rows() > 0){
			return $q->result();
		}
	}

	public function total_barang_detail($id_l)
	{
		$q = $this->db->query("SELECT SUM(IF(no_ruangan='$id_l', jumlah, 0)) AS jumlah_barang from tabel_detail_letak_brg");

		if ($q->num_rows() > 0){
			return $q->result();
		}
	}

	public function delete_tabel_sementara($id)
	{	
		$this->db->where('kode_barang',$id);
		$this->db->delete($this->tabel2);
		if ($this->db->affected_rows() == 1){
			return TRUE;
		}
		return FALSE;
	}

	public function delete_detail_letak($id)
	{
		$this->db->where('nodetail',$id);
		$this->db->delete($this->tabel1);
		if ($this->db->affected_rows() == 1){
			return TRUE;
		}
		return FALSE;

	}

	public function kurang_jumlah($nodetail,$k1)
	{
		$q = $this->db->query("SELECT jumlah FROM tabel_detail_letak_brg WHERE nodetail='".$nodetail."'");
		$jumlah = "";
		foreach ($q->result() as $d)
		{
			$jumlah= $d->jumlah - $k1;
		}
		return $jumlah;
	}

	public function update_total_barang($no_ruangan,$k2)
	{	
		$q = $this->db->query("SELECT total_barang FROM tabel_letak_brg WHERE no_ruangan='".$no_ruangan."'");
		$total_barang = "";
		foreach ($q->result() as $d)
		{
			$total_barang = $d->total_barang - $k2;
		}
		return $total_barang;	
	}

	public function update_total_barang2($no_ruangan,$k3)
	{	
		$q = $this->db->query("SELECT total_barang FROM tabel_letak_brg WHERE no_ruangan='".$no_ruangan."'");
		$total_barang = "";
		foreach ($q->result() as $d)
		{
			$total_barang = $d->total_barang + $k3;
		}
		return $total_barang;	
	}

	public function update_total_barang3($no_ruangan,$k4)
	{	
		$q = $this->db->query("SELECT total_barang FROM tabel_letak_brg WHERE no_ruangan='".$no_ruangan."'");
		$total_barang = "";
		foreach ($q->result() as $d)
		{
			$total_barang = $d->total_barang - $k4;
		}
		return $total_barang;	
	}

	public function update_total_barang4($ruangan_baru,$k5)
	{	
		$q = $this->db->query("SELECT total_barang FROM tabel_letak_brg WHERE no_ruangan='".$ruangan_baru."'");
		$total_barang = "";
		foreach ($q->result() as $d)
		{
			$total_barang = $d->total_barang - $k5;
		}
		return $total_barang;	
	}


	public function update_setelahmutasi($d_u,$key)
	{
		$this->db->update("tabel_detail_letak_brg",$d_u,$key);

		return TRUE;
	}

	public function update_headerletakbarang($d_u_head,$key2)
	{
		$this->db->update("tabel_letak_brg",$d_u_head,$key2);

		return TRUE;
	}

	public function update_detail_letak_brg($nodetail,$data)
	{
		$this->db->where('nodetail', $nodetail);
		$this->db->update($this->tabel1, $data);

		return TRUE;
	}

	public function delete_after_mutasi($id)
	{
		$this->db->where('nodetail',$id);
		$this->db->delete($this->tabel1);
		if ($this->db->affected_rows() == 1){
			return TRUE;
		}
		return FALSE;

	}

	public function delete_dari_mutasi($tmp)
	{
		$this->db->where('nodetail',$tmp);
		$this->db->delete($this->tabel1);
		if ($this->db->affected_rows() == 1){
			return TRUE;
		}
		return FALSE;
	}

	public function cari($id_m)
	{
		$this->db->from($this->tabel1);
		$this->db->where('no_mutasi',$id_m);
		$q = $this->db->get();

		if ($q->num_rows() == 1) {
			return $q->result();
		}
	}

	public function kosongkan()
	{
		$this->db->truncate($this->tabel2);
	}

}





