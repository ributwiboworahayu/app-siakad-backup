<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_dosen extends MX_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dosen','dsn');
		$this->load->model('M_master','master');
	}
	public function index()
	{
		$data=[
				'prodi'=>$this->master->getProdiAll()
		];
		$data['content']='content/data';
		$this->load->view('index',$data);
	}

	public function tables()
	{
		$list = $this->dsn->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = '<input type="checkbox" name="checked[]" value="'.$field->id_dosen.'" placeholder="" class="check">';
			$row[] = $field->nrp;
			$row[] = $field->nidn;
			$row[] = $field->nama_dsn;
			$row[] = $field->email;
			$row[] = $field->jenis_k;
			$row[] = getDetailProdi($field->prodi_id);
			$row[] = '<button type="button" class="btn btn-out btn-warning btn-square btn-mini btn-edit" data="'.$field->id_dosen.'"><i class="ion-edit"></i> Edit</button>';

			$data[] = $row;
		}


		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->dsn->count_all(),
			"recordsFiltered" => $this->dsn->count_filtered(),
			"data" => $data,
		);
	
		//output dalam format JSON
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function formValidasi($method)
	{
		$id_dosen 	= $this->input->post('id_dsn', true);
		$nrp			= $this->input->post('nrp', true);
		$nidn 			= $this->input->post('nidn', true);
		$email 			= $this->input->post('email', true);
		if ($method == 'add') {
			$u_nrp = '|is_unique[m_dosen.nrp]';
			$u_nidn = '|is_unique[m_dosen.nidn]';
			$u_email = '|is_unique[m_dosen.email]';
		} else {
			$dbdata 	= $this->dsn->getDsnByid($id_dosen);
			$u_nrp		= $dbdata->nrp === $nrp ? "" : "|is_unique[m_dosen.nrp]";
			$u_nidn		= $dbdata->nidn === $nidn ? "" : "|is_unique[m_dosen.nidn]";
			$u_email	= $dbdata->email === $email ? "" : "|is_unique[m_dosen.email]";
		}
		$this->form_validation->set_rules('nrp', 'nrp', 'required|numeric|trim|min_length[8]|max_length[12]' . $u_nrp);
		$this->form_validation->set_rules('nidn', 'nidn', 'required|numeric|trim|min_length[8]|max_length[12]' . $u_nidn);
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email' . $u_email);
		$this->form_validation->set_rules('jenis_k', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('prodi', 'prodi', 'required');

		$this->form_validation->set_message('required', 'Kolom {field} wajib diisi');
	}

	public function getDsnId()
	{
		$id=$this->input->get('id');
		$getData=$this->dsn->getDsnByid($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($getData));
	}
	public function save()
	{
		$method = $this->input->post('method', true);
		$this->formValidasi($method);

		if ($this->form_validation->run() == FALSE) {
			$data = [
				'status'	=> false,
				'errors'	=> [
					'nrp' => strip_tags(form_error('nrp')),
					'nidn' => strip_tags(form_error('nidn')),
					'nama' => strip_tags(form_error('nama')),
					'email' => strip_tags(form_error('email')),
					'jenis_k' => strip_tags(form_error('jenis_k')),
					'prodi' => strip_tags(form_error('prodi')),
				]
			];
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$input = [
				'nrp' 			=> $this->input->post('nrp', true),
				'nidn' 			=> $this->input->post('nidn', true),
				'email' 		=> $this->input->post('email', true),
				'nama' 			=> $this->input->post('nama', true),
				'jenis_k' => $this->input->post('jenis_k', true),
				'prodi_id' => $this->input->post('prodi', true),
				
			];
			if ($method === 'add') {
				// $action = $this->master->create('mahasiswa', $input);
				$this->output->set_content_type('application/json')->set_output(json_encode(['add'=>$input,'status'=>true]));
			} else if ($method === 'edit') {
				// $id = $this->input->post('id_mahasiswa', true);
				// $action = $this->master->update('mahasiswa', $input, 'id_mahasiswa', $id);
				$this->output->set_content_type('application/json')->set_output(json_encode(['edit'=>$input,'status'=>true]));
			}

			// if ($action) {
			// 	$this->output_json(['status' => true]);
			// } else {
			// 	$this->output_json(['status' => false]);
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




}

/* End of file Data_dosen.php */
/* Location: ./application/modules/data_dosen/controllers/Data_dosen.php */