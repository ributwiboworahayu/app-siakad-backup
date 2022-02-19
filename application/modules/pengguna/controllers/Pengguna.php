<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('M_master','master');
		$this->load->model('Mahasiswa','mhs');

	}

	// List all your items
	public function Mahasiswa()
	{
		$data=[
			'prodi'=>$this->master->viewData('m_prodi')->result(),
			'semester'=>$this->master->viewData('m_semester')->result()
		];
		$data['title_page']="Data Pengguna Mahasiswa";
		$data['content']='mahasiswa';
		$this->load->view('template',$data);
	}

	// Add a new item
	public function TablesMahasiswa()
	{
		$list = $this->mhs->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {

			$row = array();
			$row[] = $no+1;
			$row[] = $field->nim;
			$row[] = $field->nama;
			$row[] = '<small>'.$field->email.'</small>';
			$row[] = getDetailProdi($field->prodi_id);
			$row[] = getDetailSemester($field->semester_id);
			$row[] = $this->CekAkun($field->email);
			


			$data[] = $row;
		$no++;
		}


		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mhs->count_all(),
			"recordsFiltered" => $this->mhs->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function CekAkun($email)
	{
		$GetAkun=$this->master->viewData('users',['email'=>$email],true)->num_rows();
		if ($GetAkun>0) {
			$btn='<button type="button" class="btn btn-mini btn-warning btn-reset" data-email="'.$email.'">Reset Akun</button><button type="button" class="btn btn-mini btn-danger btn-delete" data-email="'.$email.'">Delete Akun</button>';
		}else{
			$btn='<button type="button" class="btn btn-mini btn-info btn-block btn-create" data-email="'.$email.'" style="width:80%;">Create Akun</button>';

		}
		return $btn;
	}

	//Update one item
	public function DeleteAkun()
	{
		$email=$this->input->post('email');
		$this->db->where('email', $email);
		$this->db->delete('users');
		$data=[
			'status'=>true,
			'msg'=>'Akun telah Di hapus/non-aktif '.$email
		];

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function CreateAkun()
	{
		$mail=$this->input->post('email');
		$GetInfoUser=$this->master->viewData('m_mahasiswa',['email'=>$mail],true);
		if ($GetInfoUser->num_rows()>0) {
			$Users=[
				'email'=>$GetInfoUser->row()->email,
				'username'=>$GetInfoUser->row()->nama,
				'password'=>md5($GetInfoUser->row()->nim)
			];

			// $UserTrakses=[
			// 	'email'=>$GetInfoUser->email,
			// 	'level_id'=>5,
			// 	'keterangan'=>0
			// ];
		}else{
			$GetUserElse=$this->master->viewData('m_dosen',['email'=>$mail],true);
			$Users=[
				'email'=>$GetUserElse->row()->email,
				'username'=>$GetUserElse->row()->nama_dsn,
				'password'=>md5($GetUserElse->row()->nrp)
			];

			// $UserTrakses=[
			// 	'email'=>$GetUserElse->email,
			// 	'level_id'=>5,
			// 	'keterangan'=>0
			// ];
		}

		$this->db->insert('users', $Users);
		$data=[
			'status'=>true,
			'msg'=>'Akun '.$mail.' Berhasil Di buat'
		];
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	//Delete one item
	public function delete( $id = NULL )
	{

	}
}

/* End of file Pengguna.php */
/* Location: ./application/modules/pengguna/controllers/Pengguna.php */
