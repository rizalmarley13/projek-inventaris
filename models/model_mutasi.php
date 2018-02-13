<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_mutasi extends CI_model {

	var $tabel = 'tabel_mutasi';
	var $tabel1 = 'tabel_sementara';
	var $tabel2 = 'tabel_letak_brg';
	var $tabel3 = 'tabel_detail_letak_brg';

	function __construct(){
		parent::__construct();
	}

	public function get_allmutasi()
	{
		$this->db->from($this->tabel);
		$q = $this->db->get();

		if ($q->num_rows() > 0){
			return $q->result();
		}

	}

	public function get_mutasi_byid($idu)
	{
		$this->db->from($this->tabel);
		$this->db->where('no_ruangan',$idu);
		$q = $this->db->get();

		if ($q->num_rows() == 1){
			return $q->result();
		}
	}

	public function get_mutasi_id($id_m)
	{
		$this->db->from($this->tabel);
		$this->db->where('no_mutasi',$id_m);
		$q = $this->db->get();

		if ($q->num_rows() == 1){
			return $q->result();
		}
	}

	public function insert_mutasi($data1)
	{
			$this->db->insert($this->tabel, $data1);
			return TRUE;
	}

	public function update_mutasi($no_mutasi,$data)
	{
		$this->db->where('no_mutasi',$no_mutasi);
		$this->db->update($this->tabel, $data);

		return TRUE;

	}

	public function delete_mutasi($id_m)
	{
		$this->db->where('no_mutasi',$id_m);
		$this->db->delete($this->tabel);
		if ($this->db->affected_rows() == 1){
			return TRUE;
		}
		return FALSE;
	}

	public function get_max_kodemutasi()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(no_mutasi,8)) AS idmax FROM tabel_mutasi");
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
		return "MT-".$kd;
	}


}





