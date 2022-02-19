<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_akses extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Akses_pengguna','akses');
		$this->load->model('M_master','master');
		$this->load->model('Akses_menu','menu');

	}

	// List all your items
	public function index( $offset = 0 )
	{
		$data['title_page']="Data Akses Pengguna";
		$data['content']='user_akses';
		$this->load->view('template',$data);
	}

	public function tables()
	{
		$list=$this->akses->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->level;
			$row[] = $this->GetAksesMenu($field->id_level);
			$row[] = '<a href="'.base_url().'pengguna_akses/setaksespengguna/'.$field->id_level.'" class="btn btn-out btn-warning btn-square btn-mini btn-edit" ><i class="ion-edit"></i> Edit</a>';

			$data[] = $row;
		}


		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->akses->count_all(),
			"recordsFiltered" => $this->akses->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function GetAksesMenu($id)
	{
		$AksesMenu=$this->master->viewData('user_akses',['level'=>$id],true);
		if ($AksesMenu->num_rows()>0) {
			foreach ($AksesMenu->result() as $menu) {
				$list.='<li>'.$menu->kode_menu.'</li>';
			}
		}else{
			$list.='<li>Tidak Memiliki Akses Menu</li>';
		}

		return $list;
	}

	public function SetAksesPengguna($id)
	{
		$data['menu']=$this->menu->get_datatables();
		$data['level']=$this->master->viewData('user_level',['id_level'=>$id],true)->row();
		$data['title_page']="Setting Akses Pengguna";
		$data['content']='setting_akses';
		$this->load->view('template',$data);
		// $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function tablesMenuAkses()
	{
		$list=$this->menu->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $field->nama_menu;
			$row[] = $this->GetSubMenu($field->id,$this->input->post('level_id'));

			$data[] = $row;
		}


		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->menu->count_all(),
			"recordsFiltered" => $this->menu->count_filtered(),
			"data" => $data,
		);


		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}
	
	public function GetSubMenu($id,$level)
	{
		
		$child=$this->db->get_where('user_menu',['sub_main'=>$id])->result();
		foreach ($child as $ch){
			$list.='<div class="m-l-0 ">
			<input class="border-checkbox color-primary" name="kode_menu_'.$ch->kode_menu.'" value="'.$ch->kode_menu.'" type="checkbox" id="main'.$ch->id.'" '.CekMenu($level,$ch->kode_menu).'>
			<label class="">'.$ch->nama_menu.'</label>';
			$sub=$this->db->get_where('user_menu',['sub_main'=>$ch->id])->result();
			foreach ($sub as $sb){
				$list.='<div class="m-l-20">
				<input class="border-checkbox" name="kode_menu_'.$sb->kode_menu.'" value="'.$sb->kode_menu.'" type="checkbox" '.CekMenu($level,$sb->kode_menu).' onclick="check('.$ch->id.')">
				<label class="">'.$sb->nama_menu.'</label>
				</div>';
			}
			$list.='</div>';
		}

		return $list;
		
	}


	public function SaveAkses()
	{
		$level=$this->input->post('level');
		$this->db->order_by('id', 'asc');
		$this->db->where('tipe !=', 0);
		$GetMenu=$this->master->viewData('user_menu')->result();
		foreach($GetMenu as $menu){ //get all menu
			$post=$this->input->post('kode_menu_'.$menu->kode_menu);
			if (!empty($post)) {
				$CekSudahAda=$this->master->viewData('user_akses',['level'=>$level,'kode_menu'=>$post],true);
				if ($CekSudahAda->num_rows()<1) {
					//inser akses baru
					$this->db->insert('user_akses', ['level'=>$level,'kode_menu'=>$menu->kode_menu]);
				}else{
					//update akses lama
					$this->db->where('level', $level);
					$this->db->where('kode_menu', $menu->kode_menu);
					$this->db->update('user_akses', ['kode_menu'=>$menu->kode_menu]);
				}
			}else{
				//delete akses lama
				$this->db->where('level', $level);
				$this->db->where('kode_menu', $menu->kode_menu);
				$this->db->delete('user_akses');

			}
			
		}
		
		$data=[
			'status'=>true,
			'msg'=>'Menu Akses Berhasil Di setting'
		];

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function test(){
		$GetChildSubMenu=$this->db->get_where('user_menu',['tipe'=>1]);
		foreach($GetChildSubMenu->result() as $sub){
			$data[]=[
				'id'=>$sub->id,
				'nama'=>$sub->nama_menu
			];

		}
		$data['jmlsub']=$GetChildSubMenu->num_rows();

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}

/* End of file pengguna_akses.php */
/* Location: ./application/modules/pengguna_akses/controllers/pengguna_akses.php */
