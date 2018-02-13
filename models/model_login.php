<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_model {

	public function get_login($id_karyawan,$password,$level)
	{
		$this->db->select('*');
		$this->db->from('tabel_user');
		$this->db->where('id_karyawan',$id_karyawan);
		$this->db->where('password',md5($password));
		$this->db->where('level',$level);
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function cek_user($data){
		// $query = $this->db->get_where('tabel_user',$data);
		// return $query;

		$query = $this->db->join('tabel_jabatan','tabel_jabatan.id_jabatan=tabel_user.id_jabatan')->get_where('tabel_user',$data);
		return $query;
	}
}


