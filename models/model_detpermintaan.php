<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_detpermintaan extends CI_model {

	var $tabel = 'tabel_detailpermintaan';

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

	public function insert_detpermintaan($data){
			$this->db->insert($this->tabel, $data);
			return TRUE;
		}
}






