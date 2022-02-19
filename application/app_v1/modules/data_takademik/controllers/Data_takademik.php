<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_takademik extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('takademik','takad');
	}
	public function index()
	{
		$data['content']="takademik";
		$data['title_page']='setting Portal Registrasi';
		$this->load->view('template', $data);	
	}

	function tables_takad()
	{
		$list = $this->takad->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->kode_takad;
			$row[] = $field->thun_akademik;
			$row[] = $field->keterangan;
			if ($field->status=='0') {
				$row[] = '<span class="badge badge-danger">Non-aktif</span>';
			}else{
				$row[] = '<span class="badge badge-success">Aktif</span>';
			}
			
			$row[] = '<button class="btn btn-mini btn-grd-warning"><i class="ion-edit"></i> Edit</button>';
			$row[] = '<input type="checkbox" name="" value="" placeholder="">';
			
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->takad->count_all(),
			"recordsFiltered" => $this->takad->count_filtered(),
			"data" => $data,
		);
	
		//output dalam format JSON
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

}

/* End of file Data_takademik.php */
/* Location: ./application/modules/data_takademik/controllers/Data_takademik.php */