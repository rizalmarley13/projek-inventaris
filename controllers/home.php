<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url','fungsi');
		$this->load->model('model_login');
		$this->load->model('model_notifikasi');
		$this->load->model('model_pengadaan');
		$this->load->database();
	}
	
	public function index()
	{
		$this->model_secure->getsecure();
		$isi['content'] = 'view_content';
		$isi['judul'] = 'Home';
		$isi['subjudul'] = '';
		$akses = $this->session->userdata('nama_jabatan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$this->load->view('home/view_home',$isi);
	}

	public function home_kepala()
	{
		$this->model_secure->getsecure();
		$isi['content'] = 'view_content';
		$isi['judul'] = 'Home';
		$isi['subjudul'] = '';
		$akses= $this->session->userdata('nama_jabatan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$this->load->view('home/view_home',$isi);
	}

	public function home_petugas(){
		$this->model_secure->getsecure();
		$isi['content'] = 'view_content';
		$isi['judul'] = 'Home';
		$isi['subjudul'] = '';
		$akses= $this->session->userdata('nama_jabatan');
		$isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
		$isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
		$this->load->view('home/view_home',$isi);
		echo "petugas";
	}

	public function load_row() //menampilan jumlah notifikasi pada navbar
	{	
		$akses = $this->session->userdata('nama_jabatan');
		$jmlnotif = $this->model_notifikasi->notif_countif($akses);
		
	            foreach ($jmlnotif as $rownotif) {
	            echo $rownotif->jml_notif;
	            }
	}

	public function load_data()
	{	
		$akses = $this->session->userdata('nama_jabatan');
		$notifikasi = $this->model_notifikasi->get_notif($akses);
		echo "
					<li>
			           <a>";
							if (empty($notifikasi)) {
					                echo "Tidak ada notifikasi"; 
					        } else {
						 	foreach ($notifikasi as $rnotif) {
						"</a>
					</li>";
                echo "<li>
                        <a href=\"".base_url()."index.php/pengadaan/get_notifikasi/$rnotif->id_notif\">
                            <div>"
                            .$rnotif->bagian."<br>
                            <small><b>".$rnotif->nama_karyawan."</b> ".timeAgo($rnotif->waktu)."</small> 
                            </div>
                        </a>
                    </li>
                    <li class=\"divider\"></li>";
                    }}
                echo "<li>
                        <a class=\"text-center\" href=\"#\">
                            <strong>Read All Messages</strong>
                            <i class=\"fa fa-angle-right\"></i>
                        </a>
                    </li>";
	}

}
