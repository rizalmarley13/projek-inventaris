<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_permintaan extends CI_model {
	var $tabel1='tabel_permintaan';
	var $tabel2='tabel_detailpermintaan';
	var $tabel3='tabel_barang';

	function __construct(){
		parent::__construct();
	}

	public function get_alldata(){
		$this->db->from($this->tabel);
		$q = $this->db->get();
		if ($q->num_rows() > 0){
			return $q->result();
		}

	}

	public function get_databyid($id)
	{
		$this->db->from($this->tabel);
		$this->db->where('no_permintaan',$id);
		$q = $this->db->get();
		if ($q->num_rows() == 1){
			return $q->result();
		}

	}

	public function insert_permintaan($d_header){
			$this->db->insert($this->tabel1,$d_header);
			return TRUE;
		}

	public function insert_detpermintaan($d_detail){
			
			$this->db->insert($this->tabel2,$d_detail);
			return TRUE;
	}

	public function tampil_detpermintaan(){
		$this->db->from($this->tabel2);
		$q = $this->db->get();

		if ($q->num_rows() > 0){
			return $q->result();
		}
	}

	public function tambah_barang($data){
		$this->db->insert($this->tabel2,$data);
		return TRUE;
	}

	public function tampil_barang()
	{	
		// $q = $this->db->query("SELECT kode_barang, nama_barang, SUM(jumlah_diminta) AS total, satuan FROM tabel_sementara");
		$this->db->from($this->tabel2);
		$q = $this->db->get();

		if ($q->num_rows() > 0){
			return $q->result();
		} 
	}

	public function delete_item($hps)
	{
		$this->db->where('kode_barang',$hps);
		$this->db->delete($this->tabel2);
		if ($this->db->affected_rows() == 1){
			return TRUE;
		}
		return FALSE;
	}

	public function total_brg()
	{
		$this->db->select('SUM(jumlah_diminta) as total');
		$this->db->from($this->tabel3);
		$q = $this->db->get();

		if ($q->num_rows() > 0){
			return $q->result();
		}
	}

	public function get_max_kodepermintaan()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(no_permintaan,8)) AS idmax FROM tabel_permintaan");
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
		return "PM-".$kd;
	}
}