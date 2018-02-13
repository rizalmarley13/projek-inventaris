<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pengadaan extends CI_model {

	var $tabel = 'tabel_pengadaan';
	var $tabel1 = 'tabel_smtr_pengadaan';
	var $tabel2 = 'tabel_detailpengadaan';

	function __construct(){
		parent::__construct();
	}

	public function get_allpengadaan(){
		$this->db->order_by('no_pengadaan','DESC');
		$q = $this->db->get($this->tabel);

		if ($q->num_rows() > 0){
			return $q->result();
		}

	}

	public function getall_smtr_pengadaan()
	{
		$this->db->from($this->tabel1);
		$q = $this->db->get();

		if ($q->num_rows() > 0){
			return $q->result();
		}
	}

	public function get_dpengadaan_byid($id)
	{

		$this->db->from($this->tabel2);
		$this->db->where('no_pengadaan',$id);
		$q = $this->db->get();

		if ($q->num_rows() > 0) {
			return $q->result();
		}
	}

	public function showby($showby)
	{
		$this->db->from($this->tabel);
		$this->db->where('status',$showby);
		$q = $this->db->get();

		if ($q->num_rows() > 0) {
			return $q->result();
		}
	}

	public function get_alldisetujui()
	{

		$q = $this->db->query("SELECT * FROM tabel_pengadaan WHERE status ='Disetujui'");

		if ($q->num_rows() > 0) {
			return $q->result();
		}
	}

	public function get_allpending()
	{

		$q = $this->db->query("SELECT * FROM tabel_pengadaan WHERE status ='Pending'");

		if ($q->num_rows() > 0) {
			return $q->result();
		}
	}

	public function get_alltidakdisetujui()
	{

		$q = $this->db->query("SELECT * FROM tabel_pengadaan WHERE status ='Tidak Disetujui'");

		if ($q->num_rows() > 0) {
			return $q->result();
		}
	}

	// public function tampil_detail_pengadaan()
	// {
	// 	$q = $this->db->query("SELECT tabel_pengadaan.no_pengadaan,tabel_pengadaan.tgl_pengadaan,tabel_pengadaan.id_karyawan,tabel_pengadaan.nama_karyawan,tabel_pengadaan.bagian,tabel_pengadaan.jabatan,tabel_pengadaan.total_barang,tabel_pengadaan.komen_pk2,tabel_pengadaan.komen_pjm,tabel_pengadaan.kirim_ke,tabel_detailpengadaan.no,tabel_detailpengadaan.no_pengadaan,tabel_detailpengadaan.nama_brg_jasa,tabel_detailpengadaan.spesifikasi,tabel_detailpengadaan.jumlah,tabel_detailpengadaan.satuan,tabel_detailpengadaan.keterangan,tabel_detailpengadaan.kirim_ke FROM tabel_pengadaan,tabel_detailpengadaan WHERE tabel_pengadaan.no_pengadaan=tabel_detailpengadaan.no_pengadaan AND tabel_detailpengadaan.no_pengadaan='$id'");
	// 	if 
	// }

	public function insert_tabel_smtr_pengadaan($data_smtr)
	{
		$this->db->insert($this->tabel1, $data_smtr);
		return TRUE;
	}

	public function insert_pengadaan($d_header)
	{
		$this->db->insert($this->tabel, $d_header);
		return TRUE;
	}

	public function insert_detail_pengadaan($d_detail)
	{
		$this->db->insert($this->tabel2, $d_detail);
		return TRUE;
	}

	public function update_pengadaan($temp,$d_header)
	{
		$this->db->where('no_pengadaan',$temp);
		$this->db->update($this->tabel,$d_header);
	}

	public function setuju($temp,$dsetuju)
	{
		$this->db->where('no_pengadaan',$temp);
		$this->db->update($this->tabel,$dsetuju);

		return TRUE;
	}

	// public function update_mutasi($no_mutasi,$data)
	// {
	// 	$this->db->where('no_mutasi',$no_mutasi);
	// 	$this->db->update($this->tabel, $data);

	// 	return TRUE;

	// }

	// public function delete_mutasi($idu){
	// 	$this->db->where('no_ruangan',$idu);
	// 	$this->db->delete($this->tabel);
	// 	if ($this->db->affected_rows() == 1){
	// 		return TRUE;
	// 	}
	// 	return FALSE;
	// }

	public function total_barang_pengadaan()
	{

		$this->db->select('SUM(jumlah) as total_barang');
		$this->db->from($this->tabel1);
		$q = $this->db->get();

		if ($q->num_rows() > 0){
			return $q->result();
		}
	}

	public function total_detail_pengadaan($id)
	{
		$q = $this->db->query("SELECT SUM(IF(no_pengadaan='$id', jumlah, 0)) AS total_detail from tabel_detailpengadaan");

		if ($q->num_rows() > 0){
			return $q->result();
		}
	}

	public function kosongkan_tbl_sementarapengadaan()
	{
		$this->db->truncate($this->tabel1);
	}

	public function delete_tbl_smtr_pengadaan($id_del)
	{
		$this->db->where('no',$id_del);
		$this->db->delete($this->tabel1);
		if ($this->db->affected_rows() == 1){
			return TRUE;
		}
		return FALSE;
	}

	public function get_max_kodepengadaan()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(no_pengadaan,8)) AS idmax FROM tabel_pengadaan");
		$kd = ""; //kode awal
		if($q->num_rows()>0){
			foreach ($q->result() as $k) {
				$tmp = ((int)$k->idmax)+1; // string kode di set ke integer
				$kd = sprintf("%08s",$tmp); // untuk mengambil 8 karakter terakhir kode
			}
		}
		else
		{
			$kd = "00000001"; //
		}
		return "PN-".$kd;
	}

}





