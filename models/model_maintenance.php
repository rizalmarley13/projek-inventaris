<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_maintenance extends CI_model {

	var $tabel = 'tabel_maintanance';

	function __construct(){
		parent::__construct();
	}

	public function get_allmaintenance(){
		$this->db->from($this->tabel);
		$q = $this->db->get();

		if ($q->num_rows() > 0){
			return $q->result();
		}

	}

	public function get_mutasi_byid($idu){
		$this->db->from($this->tabel);
		$this->db->where('no_ruangan',$idu);
		$q = $this->db->get();

		if ($q->num_rows() == 1){
			return $q->result();
		}
	}

	public function insert_mutasi($data){
			$this->db->insert($this->tabel, $data);
			return TRUE;
		}

	public function update_mutasi($no_mutasi,$data){
		$this->db->where('no_mutasi',$no_mutasi);
		$this->db->update($this->tabel, $data);

		return TRUE;

	}

	public function delete_mutasi($idu){
		$this->db->where('no_ruangan',$idu);
		$this->db->delete($this->tabel);
		if ($this->db->affected_rows() == 1){
			return TRUE;
		}
		return FALSE;
	}

}





