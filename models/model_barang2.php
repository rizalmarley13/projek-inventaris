<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_barang2 extends CI_model {

	var $tabel = 'tabel_barang';
	var $tabel1 = 'tabel_jenisbarang';

	//digunakan untuk plugin autocomplete ref form permintaan dan form mutasi
	public function get_allbarang(){
		$this->db->from($this->tabel);
		$q = $this->db->get();
		
		if ($q->num_rows() > 0){
			return $q->result();
		}
		
	}

	public function get_allbarang_atk(){
		$q = $this->db->query("SELECT * FROM tabel_barang WHERE id_jenis ='1'");
		
		if ($q->num_rows() > 0){
			return $q->result();
		}
		
	}

	public function get_barang_byid($idu){
		$this->db->from($this->tabel);
		$this->db->where('kode_barang',$idu);
		$q = $this->db->get();

		if ($q->num_rows() == 1){
			return $q->result();
		}
	}

	public function get_barang_permintaan($kode_barang)
	{
		$this->db->from($this->tabel);
		$this->db->where('kode_barang',$kode_barang);
		$query = $this->db->get();

		return $query->row();
	}

	public function tampil_barang(){
		$q = $this->db->query("SELECT tabel_jenisbarang.id_jenis,tabel_jenisbarang.nama,tabel_barang.kode_barang,tabel_barang.nama_barang,tabel_barang.id_jenis,tabel_barang.merk,tabel_barang.versi,tabel_barang.sumber,tabel_barang.tgl_beli,tabel_barang.tgl_expired,tabel_barang.harga_beli,tabel_barang.jumlah,tabel_barang.satuan,tabel_barang.qr_code FROM tabel_jenisbarang INNER JOIN tabel_barang ON tabel_jenisbarang.id_jenis = tabel_barang.id_jenis");
		if ($q->num_rows() > 0){
			return $q->result();
		}
	}

	public function tampil_modalbarang(){
		$q = $this->db->query("SELECT kode_barang,nama_barang,jumlah,satuan FROM tabel_barang");
		if ($q->num_rows() > 0){
			return $q->result();
		}
	}

	public function tampil_barangmutasi(){
		$q = $this->db->query("SELECT kode_barang,nama_barang,merk,versi FROM tabel_barang");
		if ($q->num_rows() > 0){
			return $q->result();
		}
	}

	public function getbarangmutasi($id){
		$this->db->from($this->tabel);
		$this->db->where('kode_barang',$id);
		$q = $this->db->get();

		if ($q->num_rows() == 1){
			return $q->result();
		}
	}

	public function update_barang($kode_barang,$data){
		$this->db->where('kode_barang',$kode_barang);
		$this->db->update($this->tabel,$data);

		return TRUE;
	}

	public function insert_barang($data){
		$this->db->insert($this->tabel, $data);
		return TRUE;
	}

	public function delete_barang($idu){
		$this->db->where('kode_barang',$idu);
		$this->db->delete($this->tabel);
		if ($this->db->affected_rows() == 1){
			return TRUE;
		}
		return FALSE;
	}

	public function select_jenisbrg(){
		$this->db->order_by('id_jenis','ASC');
		$q = $this->db->get($this->tabel1);

		return $q->result_array();
	}

	public function cek_kode($kode){
		$q = $this->db->query("SELECT * from tabel_barang where kode_barang='$kode'");
		return $q;
	}

	public function qrcode_barang_byid($id)
	{
		$this->db->from($this->tabel);
		$this->db->where('kode_barang',$id);
		$q = $this->db->get();

		if ($q->num_rows() == 1){
			return $q->result();
		}
	}

	public function tampil_qrcode()
	{	
		if(isset($_GET['id_gambar'])) {
		$q = $this->db->query("SELECT * FROM tabel_barang where kode_barang=" . $GET_['id_gambar']);
		$row = mysql_fetch_array($q);
		echo $row["qr_code"];
		}
	}

	public function ganti_qrbrg($id,$image_name)
	{
		$this->db->where('kode_barang',$id);
        $this->db->set('qr_code',$image_name);
        $this->db->update($this->tabel);
	}

	public function kurang_stok($kode_barang,$kurang)
	{
		$q = $this->db->query("SELECT jumlah FROM tabel_barang WHERE kode_barang='".$kode_barang."'");
		$jumlah = "";
		foreach ($q->result() as $d)
		{
			$jumlah = $d->jumlah - $kurang;
		}
		return $jumlah;
	}
	
	public function update_stok($d_u,$key)
	{
		$this->db->update("tabel_barang",$d_u,$key);
	}

	public function get_max_kodebarang()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(kode_barang,5)) AS idmax FROM tabel_barang");
		$kd = ""; //kode awal
		if($q->num_rows()>0){
			foreach ($q->result() as $k) {
				$tmp = ((int)$k->idmax)+1; // string kode di set ke integer
				$kd = sprintf("%05s",$tmp); // untuk mengambil 8 karakter terakhir kode
			}
		}
		else
		{
			$kd = "00001"; //
		}
		return "BR-".$kd;
	}
}


