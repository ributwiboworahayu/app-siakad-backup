<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_prodi extends CI_Controller {

	public function index()
	{
		$data['content']="content/data";
		$this->load->view('index',$data);
	}
	public function SetKaprodi()
	{
		$data['content']="content/setkaprodi";
		$this->load->view('template',$data);
	}

	public function tables_prodi()
	{
		
	}

}

/* End of file Data_prodi.php */
/* Location: ./application/modules/data_prodi/controllers/Data_prodi.php */