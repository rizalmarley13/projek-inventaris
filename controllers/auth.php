<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Auth extends Ci_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->library(array('session'));
		$this->load->model('model_login');


	}
	function index(){
		if ($this->session->userdata('islogin')) {
			redirect('home');
		}

		$data['id']="";
		$this->load->view('view_login',$data);
	}

	function login(){
		
		if ($this->session->userdata('islogin')) {
			redirect('index.php/home');
		}
		$this->load->library("form_validation");
		$this->form_validation->set_rules('usertext',"Nama User","required");
		$this->form_validation->set_rules('passtext',"Password","required");

		if ($this->form_validation->run()) {
				$data['id']=$this->input->post('id_user');
				$password=$this->input->post('password');
				$tgl=$this->input->post('tgltext');

			$query=$this->model_learning->data_login($data['id']);
			$auth=$query->row_array();

			if ($query->num_rows()>0 && $password==$auth['password']) 
			{
					$user = array('id_user' =>$data['id'],
						  'password'=>$auth['password'],
						  'tgl_login'=>$tgl,
						  'islogin'=>true);

			
						$this->session->set_userdata($user);
						redirect('index.php/home');
			}
			else
			{
				?>
				<script>
				alert("Gagal Login");
				</script>
				<?php echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/auth/'>";
			}

		}
		else{
			$data['id']="";
			$this->load->view("view_login",$data);
		}		

	}

	
	function logout(){
		$this->session->sess_destroy();
		redirect('auth'); // memanggil kontroller auth.php
	}



}