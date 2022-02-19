<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

	public function index()
	{

		$valid_login=$this->session->userdata('login');
		if($valid_login !=TRUE && $this->session->userdata('email')==''){
			$cap = $this->buat_captcha();
        $data['cap_img'] = $cap['image'];
        $this->session->set_userdata('kode_captcha', $cap['word']);
          	$this->load->view('login',$data);
        }else{
        	redirect(base_url().'welcome/role','refresh');
        }
		
	
	}

	function buat_captcha()
	{
		
		$vals = array(
			// 'word'     => '',
            'img_path' => FCPATH .'assets/captcha/',
            'img_url' => base_url().'assets/captcha/',
            'font_path' => FCPATH . 'assets/captcha/font/PlayfairDisplay-Regular.ttf',
            'font_size' => 25,
            'word_length'   => 4,
            'img_width' => '200',
            'img_height' => 55,
            'expiration' => 7200,
             'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
        )
        );
        $cap = create_captcha($vals);
        return $cap;
	}

	public function auth_chek()
	{
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		// $this->form_validation->set_rules('kode_captcha', 'kode_captcha', 'required|callback_cek_captcha');


		if ($this->form_validation->run($this) == TRUE) {
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
					'email'=> form_error('email') ,
					'password'=> form_error('password'),
					// 'captcha'=> strip_tags( form_error('kode_captcha'))
					];
			
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	  public function cek_captcha($input){
        if($input != $this->session->userdata('kode_captcha')){
        	$this->form_validation->set_message('cek_captcha', '%s yang anda input salah!');
            return false;
        }else{
            
            return true;
        }
    }

	public function logout()
	{
		$data_session = array('id_jabatan'=>"",'email'=>"",'user'=>"",'login'=>"");
      	$this->session->unset_userdata($data_session);//clear session
      	$this->session->sess_destroy();//tutup session
		redirect(base_url());
	}
}
