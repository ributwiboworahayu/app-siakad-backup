<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_menu extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Menu','menu');
		$this->load->model('M_master','master');

	}

	public function index()
	{
		$data['title_page']="Data Mahasiswa";
		$data['content']='menu';
		$this->load->view('template',$data);
	}

	// Add a new item
	public function tables()
	{
		$list = $this->menu->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->tipe==0? 'parent': ($field->tipe==1?'child':'subchild');
			$row[] = $field->parent;
			$row[] = $field->kode_menu;
			$row[] = $field->nama_menu;
			$row[] = $field->url;
			$row[] = $this->GetSubMainMenu($field->sub_main);
			$row[] = '<button type="button" class="btn btn-out btn-warning btn-square btn-mini btn-edit" data="'.$field->id_dosen.'"><i class="ion-edit"></i> Edit</button>';

			$data[] = $row;
		}


		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->menu->count_all(),
			"recordsFiltered" => $this->menu->count_filtered(),
			"data" => $data,
		);
	
		//output dalam format JSON
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	//Update one item
	public function GetSubMainMenu($id)
	{
		$GetMenuSub=$this->master->viewData('user_menu',['id'=>$id],true);
		if ($GetMenuSub->num_rows()>0) {
			return $GetMenuSub->row()->nama_menu;
		}else{
			return 'Main Menu';
		}
	}

	function GetAllParentMenu()
	{
		$this->db->where('tipe', 0);
		$GetDataParent=$this->master->viewData('user_menu')->result();
		foreach ($GetDataParent as $parent) {
			$this->db->group_by('parent');
			$this->db->where('sub_main', $parent->id);
			$this->db->where('tipe', 1);
			$GetsubParent=$this->master->viewData('user_menu');
			if ($GetsubParent->num_rows()>0) {
				foreach ($GetsubParent->result() as $v) {
					$data[]=[
						'id'=>$v->id,
						'parent'=>$v->parent,
						'nama_menu'=>$v->nama_menu
					];
				}
			}else{
				$data[]=[
					'id'=>$parent->id,
					'parent'=>$parent->kode_menu,
					'nama_menu'=>$parent->nama_menu
				];
			}
			
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function GetAllSubMenu()
	{
		$tipe=$this->input->post('tipe');
		$parent=$this->input->post('val');
		if ($tipe==1) {
		$this->db->where('tipe', 0);
		$this->db->where('parent', NULL);
		$this->db->where('kode_menu', $parent);		
		}else{
		$this->db->where('tipe', 1);
		$this->db->where('parent', $parent);	

		}
		
		$GetDataParent=$this->master->viewData('user_menu')->result();
		foreach ($GetDataParent as $p) {
			$data[]=[
				'id'=>$p->id,
				'nama_menu'=>$p->nama_menu
			];
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}


	public function SaveMenu()
	{
		$dataPost=[
			'tipe'=>$this->input->post('tipe'),
			'parent'=>$this->input->post('tipe')==0? NULL:$this->input->post('parent'),
			'kode_menu'=>$this->input->post('kode_menu'),
			'nama_menu'=>$this->input->post('nama_menu'),
			'url'=>$this->input->post('url'),
			'icon'=>'',
			'sub_main'=>$this->input->post('submenu')
		];

		$this->master->create('user_menu',$dataPost);
		$this->output->set_content_type('application/json')->set_output(json_encode(['status'=>true,'msg'=>"Menu Berhasil Di Tambahkan"]));
	}

	//Delete one item
	public function delete( $id = NULL )
	{

	}
}

/* End of file Data_menu.php */
/* Location: ./application/modules/data_menu/controllers/Data_menu.php */
