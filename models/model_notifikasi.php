<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_notifikasi extends CI_model {

	var $tabel = 'tabel_notifikasi';

	function __construct(){
		parent::__construct();
	}

	public function get_notif($akses){
		// $this->db->from($this->tabel);
		// $this->db->order_by('kirim_ke',$akses);
		// $q = $this->db->get();
		$q = $this->db->query("SELECT * FROM tabel_notifikasi WHERE kirim_ke='".$akses."'");

		if ($q->num_rows() > 0){
			return $q->result();
		}
	}

	public function get_notif_byid($id)
	{
		$this->db->from($this->tabel);
		$this->db->where('id_notif',$id);
		$q = $this->db->get();

		if ($q->num_rows() == 1){
			return $q->result();
		}
	}

	public function post_notif($datanotif){
			$this->db->insert($this->tabel, $datanotif);
			return TRUE;
		}

	public function notif_count(){
		$this->db->from($this->tabel);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function notif_countif($akses)
	{
		$q = $this->db->query("SELECT COUNT(IF(kirim_ke='$akses',id_notif, NULL)) AS jml_notif FROM tabel_notifikasi");

		if ($q->num_rows() > 0){
			return $q->result();
		}

	}

	public function update_notif($temp1,$datanotif)
	{
		$this->db->where('id_notif',$temp1);
		$this->db->update($this->tabel,$datanotif);
		return TRUE;
	}

	public function hapus($id)
	{
		$this->db->where('id_notif',$id);
		$this->db->delete($this->tabel);
		if ($this->db->affected_rows() == 1){
			return TRUE;
		}
		return FALSE;
	}

}





