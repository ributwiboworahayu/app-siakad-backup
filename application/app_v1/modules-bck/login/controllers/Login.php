<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

	public function index()
	{
		$this->load->view('login');
	}

	public function auth_chek()
	{
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if ($this->form_validation->run() == TRUE) {
			$cek_data=$this->db->get_where('users', array('email' =>$this->input->post('email'),'password'=>md5($this->input->post('password')) ));
			$result  =$cek_data->row();
			if ($cek_data->num_rows()>0) {
				$user_ses=[
						'user'  =>$result->username,
						'email' =>$result->email,
						'login' =>TRUE];
			
			$this->session->set_userdata( $user_ses );
				$data['response']='200';
				$data['pesan']="BERHASIL";
			}else{
				$data['response']='404';
				$data['pesan']="GAGAL";
			}
			
		} else {
			// $data['response']='403';
			$data=[
					'response'=>'403',
					'email'=> strip_tags(form_error('email')) ,
					'password'=> strip_tags( form_error('password'))
					];
			
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function logout()
	{
		$data_session = array('id_jabatan'=>"",'email'=>"",'user'=>"",'login'=>"");
      	$this->session->unset_userdata($data_session);//clear session
      	$this->session->sess_destroy();//tutup session
		redirect(base_url());
	}
}
