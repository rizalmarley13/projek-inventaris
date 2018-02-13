<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_secure extends CI_model {
	
	public function getsecure()
	{
		$id_user = $this->session->userdata('id_user');
		if (empty($id_user))
		{
			$this->session->sess_destroy();
			redirect('login');
		}
	}
}
