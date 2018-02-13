<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_model {

	var $tabel = 'tabel_user';

	function __construct(){
		parent::__construct();
	}

	public function get_allruangan(){
		$this->db->from($this->tabel);
		$q = $this->db->get();

		if ($q->num_rows() > 0){
			return $q->result();
		}

	}

	public function get_user_byid($idu){
		$this->db->from($this->tabel);
		$this->db->where('no_ruangan',$idu);
		$q = $this->db->get();

		if ($q->num_rows() == 1){
			return $q->result();
		}
	}

	public function insert_ruangan($data){
			$this->db->insert($this->tabel, $data);
			return TRUE;
		}

	public function update_ruangan($no_ruangan,$data){
		$this->db->where('no_ruangan',$no_ruangan);
		$this->db->update($this->tabel, $data);

		return TRUE;

	}

	public function delete_ruangan($idu){
		$this->db->where('no_ruangan',$idu);
		$this->db->delete($this->tabel);
		if ($this->db->affected_rows() == 1){
			return TRUE;
		}
		return FALSE;
	}
	//digunakan untuk selectbox ruangan ref form mutasi
	public function select_ruangan(){
		$this->db->order_by('no_ruangan','ASC');
		$q = $this->db->get('tabel_ruangan');

		return $q->result_array();
		}
}





