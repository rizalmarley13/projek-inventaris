<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url','text');
		$this->load->model('model_login');
	}
	public function index()
	{
		$this->load->view('view_login');
	}

	public function cek_data()
	{

		$data = array('id_karyawan' => $this->input->post('id_karyawan', TRUE),
						'password' => $this->input->post('password', TRUE)

			);
		$hasil = $this->model_login->cek_user($data);
		if($hasil->num_rows() == 1)
		{
			foreach ($hasil->result() as $sess) {
				$sess_data['logged_in'] = 'Sudah Login';
				$sess_data['id_user'] = $sess->id_user;
				$sess_data['id_karyawan'] = $sess->id_karyawan;
				$sess_data['nama_karyawan'] = $sess->nama_karyawan;
				$sess_data['nama_jabatan'] = $sess->nama_jabatan;
				$sess_data['bagian'] = $sess->bagian;
				$sess_data['level'] = $sess->level;
				$this->session->set_userdata($sess_data);
			}
			if($this->session->userdata('level')=='Admin'){
				redirect('home');
			}else if($this->session->userdata('level')=='Kepala Bagian'){
				redirect('home/home_kepala');
			}else{
				redirect('home/home_petugas');
			}	
		}else{
		echo "<script>alert('Gagal Login.. Cek Kode Pengguna, Kata Sandi !');
			history.go(-1);
			</script>";
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}


