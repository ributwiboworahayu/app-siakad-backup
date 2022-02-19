<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Data_mhs extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mahasiswa','mhs');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$data=[
				'prodi'=>$this->mhs->get_prodi(),
				'semester'=>$this->mhs->get_semester()
		];
		$data['title_page']="Data Mahasiswa";
		$data['content']='content/data';
		$this->load->view('template',$data);
	}

	public function tables()
	{
		$list = $this->mhs->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
		
			$row = array();
			$row[] = '<input type="checkbox" name="checked[]" value="'.$field->id_mhs.'" placeholder="" class="check">';
			$row[] = $field->nim;
			$row[] = $field->nama;
			$row[] = $field->email;
			$row[] = getDetailProdi($field->prodi_id);
			$row[] = getDetailSemester($field->semester_id);
			$row[] = $field->jenis_k;
			$row[] = '<button type="button" class="btn btn-out btn-warning btn-square btn-mini btn-edit" data="'.$field->id_mhs.'"><i class="ion-edit"></i> Edit</button>';
			
				

			$data[] = $row;
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

	public function getmhsId()
	{
		$id=$this->input->get('id');
		$getData=$this->mhs->getMhsByid($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($getData));
	}

	public function formValidasi($method)
	{
		$id_mahasiswa 	= $this->input->post('id_mhs', true);
		$nim 			= $this->input->post('nim', true);
		$email 			= $this->input->post('email', true);
		if ($method == 'add') {
			$u_nim = '|is_unique[m_mahasiswa.nim]';
			$u_email = '|is_unique[m_mahasiswa.email]';
		} else {
			$dbdata 	= $this->mhs->getMhsByid($id_mahasiswa);
			$u_nim		= $dbdata->nim === $nim ? "" : "|is_unique[m_mahasiswa.nim]";
			$u_email	= $dbdata->email === $email ? "" : "|is_unique[m_mahasiswa.email]";
		}
		$this->form_validation->set_rules('nim', 'NIM', 'required|numeric|trim|min_length[8]|max_length[12]' . $u_nim);
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email' . $u_email);
		$this->form_validation->set_rules('jenis_k', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('prodi', 'prodi', 'required');
		$this->form_validation->set_rules('semester', 'semester', 'required');

		$this->form_validation->set_message('required', 'Kolom {field} wajib diisi');
	}
	public function save()
	{
		$method = $this->input->post('method', true);
		$this->formValidasi($method);

		if ($this->form_validation->run() == FALSE) {
			$data = [
				'status'	=> false,
				'errors'	=> [
					'nim' => strip_tags(form_error('nim')),
					'nama' => strip_tags(form_error('nama')),
					'email' => strip_tags(form_error('email')),
					'jenis_k' => strip_tags(form_error('jenis_k')),
					'prodi' => strip_tags(form_error('prodi')),
					'semester' => strip_tags(form_error('semester')),
				]
			];
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$input = [
				'nim' 			=> $this->input->post('nim', true),
				'email' 		=> $this->input->post('email', true),
				'nama' 			=> $this->input->post('nama', true),
				'jenis_k' => $this->input->post('jenis_k', true),
				'prodi_id' => $this->input->post('prodi', true),
				'semester_id' => $this->input->post('semester', true),
				
			];
			if ($method === 'add') {
				$input['kelas_id']=0;
				// $action = $this->master->create('m_mahasiswa', $input);
				$this->output->set_content_type('application/json')->set_output(json_encode(['add'=>$input,'status'=>true]));
			} else if ($method === 'edit') {
				$id = $this->input->post('id_mhs', true);
				$this->db->where('id_mhs', $id);
				$action = $this->db->update('m_mahasiswa', $input);
				$this->output->set_content_type('application/json')->set_output(json_encode(['edit'=>$input,'status'=>true]));
			}

			// if ($action) {
			// 	$this->output->set_content_type('application/json')->set_output(json_encode(['status'=>true]));
			// } else {
			// 	$this->output->set_content_type('application/json')->set_output(json_encode(['status'=>false]));
			// }
		}
	}

	public function delete()
	{
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			$this->output->set_content_type('application/json')->set_output(json_encode(['status' => false]));
		} else {
			// if ($this->master->delete('jurusan', $chk, 'id_jurusan')) {
				$this->output->set_content_type('application/json')->set_output(json_encode(['status' => true, 'total' => count($chk)]));
			// }
		}
	}

	function ServiceApiMHS(){
		$list = $this->mhs->get_datatables();
		header("Access-Control-Allow-Headers: Authorization, Content-Type");
		header("Access-Control-Allow-Origin: *");
		header('content-type: application/json; charset=utf-8');
		$data['data']=$list;
		echo json_encode($data);
	}

	public function AllUpdate()
	{
		$sql="SELECT * FROM m_mahasiswa WHERE prodi_id=12 AND substr(nim,1,4)=2019 ORDER BY id_mhs DESC ";
		$GetAllData=$this->db->query($sql)->result();
		foreach ($GetAllData as $data) {
			$result[]=[
				'id_mhs'=>$data->id_mhs,
				'nim'=>$data->nim,
				'nama'=>$data->nama,
				'semester_id'=>$data->semester_id
			];
			$update[]=[
				'id_mhs'=>$data->id_mhs,
				'semester_id'=>'4'
			];
		}

		$hs=$this->db->update_batch('m_mahasiswa', $update, 'id_mhs');


		$this->output->set_content_type('application/json')->set_output(json_encode($hs));
	}
}

/* End of file Data_mhs.php */
/* Location: ./application/modules/data_mhs/controllers/Data_mhs.php */