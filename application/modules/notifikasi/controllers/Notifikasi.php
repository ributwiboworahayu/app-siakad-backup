<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {

	public function getJmlNotif()
	{
		$email=$this->session->userdata('email');
		$getData=$this->db->get_where('notifikasi', array('status' =>1,'penerima'=>$email,'lvl'=>$this->session->userdata('id_jabatan') ))->num_rows();
		if ($getData >0) {
			$data['status']=true;
			$data['jumlah']=$getData;
		}else{
			$data['status']=false;
			$data['jumlah']=0;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function getNotifikasi()
	{
		$email=$this->session->userdata('email');
		$this->db->order_by('id_notif', 'desc');
		$getData=$this->db->get_where('notifikasi', array('penerima'=>$email,'lvl'=>$this->session->userdata('id_jabatan')));
		$data['jml']=$this->db->get_where('notifikasi', array('status' =>1,'penerima'=>$email,'lvl'=>$this->session->userdata('id_jabatan') ))->num_rows();
		$data['notif']=$getData;

		$this->load->view('notifikasi',$data);
	}

	function updateAllNotif()
	{
		$this->db->where('penerima', $this->session->userdata('email'));
		$this->db->where('lvl', $this->session->userdata('id_jabatan'));
		$this->db->update('notifikasi', ['status'=>0]);

		$this->output->set_content_type('application/json')->set_output(json_encode(true));
	}

	function desktopNotif()
	{
		$email=$this->session->userdata('email');
		$this->db->order_by('id_notif', 'desc');
		$getData=$this->db->get_where('notifikasi', array('penerima'=>$email,'lvl'=>$this->session->userdata('id_jabatan'),'status'=>1));
		if ($getData->num_rows()>0) {
			$data['status']=true;
			$data['result']='Anda Memiliki '.$getData->num_rows().' Pesan Yang Belum Di Baca Di sistem Akademik';
		}else{
			$data['status']=false;
			$data['result']='';
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function pusher_test($value='')
	{
		Pusher();
		echo 'test notif pusher';
	}

}

/* End of file Notifikasi.php */
/* Location: ./application/modules/notifikasi/controllers/Notifikasi.php */