<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// $this->load->library('');
		$this->load->model('M_master','master');
		$this->load->model('Pengumuman_m','pengumuman');
		$this->load->model('Pengumuman_kabak','p_kabak');
		$this->load->model('Pengumuman_wadir','p_wadir');
		hasLOGIN();
	}
	public function index()
	{
		$role=$this->session->userdata('id_jabatan');
		if ($role=='8') {
			$data['content']='content/operator';
		}elseif ($role=='10') {
			$data['content']='content/kabak';
		}elseif($role=='11'){
			$data['content']='content/wadir';
		}else{
			$data['content']='content/pengumuman';
		}
		$data['title_page']="Pengumuman";
		// $this->output->set_content_type('application/json')->set_output(json_encode($role));
		$this->load->view('template', $data);
	}

	public function tables_operator($value='')
	{
		$list = $this->pengumuman->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[]=$no;
			$row[] = $this->getAkedemik($field->akademik_id);
			$row[] = '<a href="'.base_url().'pengumuman/lihat/'.$field->id_pengumuman.'" target="_blank" data-toggle="tooltip" data-placement="top" title="Lihat Pengumuman" disabled>'.$field->no_pengumuman.'</a><br>'.$this->revisi($field->id_pengumuman).$this->publish($field->id_pengumuman);
			$row[] = $this->getKabakVal($field->id_pengumuman);
			$row[] = $this->getWadirVal($field->id_pengumuman);
			
			if ($field->send_kabak=='0') {
				$row[] ='<label class="label label-danger">False</label>' ;
				$row[] = '<button type="button" class="btn btn-out btn-warning btn-square btn-mini btn-edit" data="'.$field->id_pengumuman.'"><i class="ion-edit"></i> Edit</button><button type="button" class="btn btn-out btn-primary btn-square btn-mini btn-snp" data="'.$field->id_pengumuman.'"><i class="ion-android-send"></i> Send to kabak</button>';
				$row[] = '<input type="checkbox" name="checked[]" value="'.$field->id_pengumuman.'" placeholder="" class="check">';
			}else{
				$row[] ='<label class="label label-success">True</label>' ;
				$row[] = '<button href="'.base_url().'pengumuman/edit/'.$field->id_pengumuman.'" class="btn btn-out btn-warning btn-square btn-mini btn-edit" data="'.$field->id_pengumuman.'" '.$this->p_val($field->id_pengumuman).'><i class="ion-edit"></i>Edit</button><button type="button" class="btn btn-out btn-primary btn-square btn-mini btn-cncl" data="'.$field->id_pengumuman.'" '.$this->p_val($field->id_pengumuman).'><i class="ion-close-round"></i>Cancel Send</button>';
				$row[] = '<input type="checkbox" name="checked[]" value="'.$field->id_pengumuman.'" placeholder="" class="check">';
			}

			

			$data[] = $row;
		}


		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pengumuman->count_all(),
			"recordsFiltered" => $this->pengumuman->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function tables_kabak($value='')
	{
		$list = $this->p_kabak->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[]=$no;
			$row[] = $this->getAkedemik($field->akademik_id);
			$row[] = '<a href="'.base_url().'pengumuman/lihat/'.$field->id_pengumuman.'" target="_blank" data-toggle="tooltip" data-placement="top" title="Lihat Pengumuman">'.$field->no_pengumuman.'</a><br>'.$this->revisi($field->id_pengumuman);
			$row[] = $this->getKabakVal($field->id_pengumuman);
			$row[] = $this->getWadirVal($field->id_pengumuman);
			if ($field->send_wadir=='0') {
				$row[] ='<label class="label label-danger">False</label>' ;
				
			}else{
				$row[] ='<label class="label label-success">Ok</label>' ;
			}
			

			$row[] ='<a href="'.base_url().'pengumuman/cekDataPengumuman/kabak/p/'.$field->id_pengumuman.'" class="btn btn-out btn-warning btn-square btn-mini " data="'.$field->id_pengumuman.'"><i class="ion-eye"></i> Cek Data Pengumuman</a>' ;

			$data[] = $row;
		}


		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pengumuman->count_all(),
			"recordsFiltered" => $this->pengumuman->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function tables_wadir()
	{
		$list = $this->p_wadir->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[]=$no;
			$row[] = $this->getAkedemik($field->akademik_id);
			$row[] = '<a href="'.base_url().'pengumuman/lihat/'.$field->id_pengumuman.'" target="_blank" data-toggle="tooltip" data-placement="top" title="Lihat Pengumuman">'.$field->no_pengumuman.'</a><br>'.$this->revisi($field->id_pengumuman);
			$row[] = $this->getKabakVal($field->id_pengumuman);
			$row[] = $this->getWadirVal($field->id_pengumuman);
			$row[] ='<a href="'.base_url().'pengumuman/cekDataPengumuman/wadir/p/'.$field->id_pengumuman.'" class="btn btn-out btn-warning btn-square btn-mini " data="'.$field->id_pengumuman.'"><i class="ion-eye"></i> Cek Data Pengumuman</a>' ;

			

			$data[] = $row;
		}


		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pengumuman->count_all(),
			"recordsFiltered" => $this->pengumuman->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function revisi($id)
	{
		$data=$this->db->get_where('pengumuman_edited_st',array('pengumuman_id' =>$id));
		if ($data->num_rows()>0) {
			$this->db->select('*');
			$this->db->from('pengumuman_edited_st');
			$this->db->where('pengumuman_id', $id);
			$this->db->limit(1);
			$this->db->order_by('id_edited', 'desc');
			$hsl=$this->db->get()->row()->revisi;
			$label='<label class="label label-warning">Revisi Ke '.$hsl.'</label>';
		}else{
			$label='';
		}
		return $label;
	}

	public function publish($id)
	{
		$data=$this->db->get_where('pengumuman', array('id_pengumuman' =>$id ))->row();
		if ($data->published==0) {
			$hsl='';
		}else{
			$hsl='<label class="label label-success">Publish</label>';
		}

		return $hsl;
	}

	public function cancel_send()
	{
		$id=$this->input->post('id');
		// $field=$this->input->post('field');
		$this->db->where('id_pengumuman', $id);
		$this->db->update('pengumuman',array('send_kabak' =>'0'));

		$this->output->set_content_type('application/json')->set_output(json_encode(['status'=>TRUE]));
	}

	public function p_val($id_pengumuman)
	{
		$dta =$this->db->get_where('pengumuman_validasi', array('pengumuman_id'=>$id_pengumuman))->row();
		if ($dta->kabak=='1' && $dta->wadir=='1') {
			$hsl ='disabled';
		}else{
			$hsl ='';
		}
		return $hsl;
	}

	public function lihat($id)
	{
		// $key = $this->input->get('id', true);
		// $id  = $this->encryption->decrypt(rawurldecode($key));
		$data['isi'] =$this->db->get_where('pengumuman',array('id_pengumuman' =>$id ))->row();
		$this->load->view('content/view_pengumuman',$data);
		
	}

	public function getAkedemik($id)
	{
		$Data =$this->db->get_where('m_takad', array('id_thnakad' =>$id))->row();

		return $Data->thun_akademik;
	}

	public function getKabakVal($id)
	{
		$data   =$this->db->get_where('pengumuman_validasi', array('pengumuman_id' =>$id))->row();
		$review =$this->db->get_where('pengumuman_review', array('pengumuman_id' =>$id ,'reviewer_id'=>'1' ))->row();

		if ($data->kabak=='0') {
			$html='Status : <label class="label label-info">Proses..</label><br>Review : <label class="label label-info">Proses..</label>';
			
		}elseif ($data->kabak=='1') {
			$html='Status : <label class="label label-success">OK</label>';
		}else{
			$html='Status : <label class="label label-danger">not ok</label><br>Review : <label class="label label-warning v-label" style="cursor:pointer;" data="'.$review->id_review.'">1</label>';
		}
		return $html;
	}
	public function getWadirVal($id)
	{
		$data   =$this->db->get_where('pengumuman_validasi', array('pengumuman_id' =>$id))->row();
		$review =$this->db->get_where('pengumuman_review', array('pengumuman_id' =>$id ,'reviewer_id'=>'2' ))->row();
		if ($data->wadir=='0') {
			$html ='Status : <label class="label label-info">Proses..</label><br>Review : <label class="label label-info" >Proses..</label>';
			
		}elseif ($data->wadir=='1') {
			$html ='Status : <label class="label label-success">OK</label>';
		}else{
			$html ='Status : <label class="label label-danger">not ok</label><br>Review : <label class="label label-warning v-label" style="cursor:pointer;" data="'.$review->id_review.'">1</label>';
		}
		return $html;	
	}

	public function getReview()
	{
		$id     =$this->input->get('id');
		$review =$this->db->get_where('pengumuman_review',array('id_review' =>$id))->row();

		// $data['hsl']=$review;

		$this->output->set_content_type('application/json')->set_output(json_encode($review));

		
	}

	public function saveReview()
	{
		$id_pengumuman =$this->input->post('id_p');
		$review        =$this->input->post('isi_r');
		$id_review     =$this->input->post('r_id');
		$field         =$this->input->post('r_field');


		$input=[
			'pengumuman_id' =>$id_pengumuman,
			'review'        =>$review,
			'reviewer_id'   =>$id_review
		];
		$this->db->insert('pengumuman_review', $input);

		$this->db->where('pengumuman_id', $id_pengumuman);
		$this->db->update('pengumuman_validasi',array($field =>'2'));

		$this->output->set_content_type('application/json')->set_output(json_encode(['status'=>true]));
	}

	public function add()
	{
		$data=[
			'akd' =>$this->db->get('m_takad')->result()
		];
		$data['title']   ="Pengumuman";
		$data['content'] ='content/add';
		$this->load->view('index', $data);
	}

	public function edit($id)
	{
		
		$data=[
			'akd'  =>$this->db->get('m_takad')->result(),
			'data' =>$this->db->get_where('pengumuman', array('id_pengumuman' =>$id))->row()
		];
		$data['title']   ="Pengumuman";
		$data['content'] ='content/edit';
		$this->load->view('index', $data);
	}

	public function cekDataPengumuman()
	{
		$role      =$this->uri->segment(3);
		$id_p      =$this->uri->segment(5);
		$role_id   = ($role == 'kabak') ? '1' : '2';
		$getReview =$this->pengumuman->getReview($id_p,$role_id);

		if ($getReview->num_rows()>0) {
			$data=[
				'hsl'        =>$this->pengumuman->getJoinTakad($id_p),
				'role'       =>$role,
				'review'     =>$getReview->num_rows(),
				'review_isi' =>$getReview->row()->review,
			];
		}else{
			$data=[
				'hsl'        =>$this->pengumuman->getJoinTakad($id_p),
				'role'       =>$role,
				'review'     =>$getReview->num_rows(),
				'review_isi' =>'',
			];
		}

		

		// $this->output->set_content_type('application/json')->set_output(json_encode($data));
		$data['content'] ='content/review';
		$this->load->view('index', $data);
	}

	public function val_operator()
	{
		$id  =$this->input->post('id');
		$val =$this->input->post('val');

		$this->db->where('id_pengumuman', $id);
		$this->db->update('pengumuman', array('send_kabak' =>$val));


		$this->output->set_content_type('application/json')->set_output(json_encode(['status'=>TRUE]));
	}
	// public function val_kabak()
	// {
	// 	$id=$this->input->post('id');
	// 	$val=$this->input->post('val');

	// 	$this->db->where('id_pengumuman', $id);
	// 	$this->db->update('pengumuman', array('send_wadir' =>$val));

	// 	$this->db->where('pengumuman_id', $id);
	// 	$this->db->update('pengumuman_validasi', array('kabak' =>$val));

	// 	$this->output->set_content_type('application/json')->set_output(json_encode(['status'=>TRUE]));
	// }

	// public function val_wadir()
	// {
	// 	$id=$this->input->post('id');
	// 	$val=$this->input->post('val');

	// 	$link=urlencode($this->encryption->encrypt($field->id));
	// 	$this->db->where('pengumuman_id', $id);
	// 	$this->db->update('pengumuman_validasi', array('wadir' =>$val));
	// 	$this->send_telegram($link);
	// 	$this->output->set_content_type('application/json')->set_output(json_encode(['status'=>TRUE]));
	// }

	public function save()
	{
		$method=$this->input->post('method');
		if ($method=='add') {
			$input=[
				'akademik_id'    =>$this->input->post('akademik'),
				'no_pengumuman'  =>$this->input->post('no_surat'),
				'isi_pengumuman' =>$this->input->post('isi'),
				'send_kabak'     =>"0",
				'send_wadir'     =>"0",
				'created_on'     =>date('Y-m-d H:i:s'),
				'updated_on'     =>"0000-00-00 00:00:00",
			];
			$this->master->create('pengumuman',$input);
			$data['pesan'] ="Pengumuman Berhasil Di simpan";
		}else if ($method=='edit') {
			$input=[
				'akademik_id'    =>$this->input->post('akademik'),
				'no_pengumuman'  =>$this->input->post('no_surat'),
				'isi_pengumuman' =>$this->input->post('isi'),
				'send_kabak'     =>"0",
				'send_wadir'     =>"0",
				'updated_on'     =>date('Y-m-d H:i:s'),
			];
			$pengumuman_edited_st=[
				'pengumuman_id' =>$this->input->post('id'),
				'revisi'        =>$this->getEditedST($this->input->post('id'))
			];
			$this->master->create('pengumuman_edited_st',$pengumuman_edited_st);
			$this->master->update('pengumuman','id_pengumuman',$this->input->post('id'),$input);
			$data['pesan'] ="Pengumuman Berhasil Di edit";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function saveHslReview()
	{
		$action=$this->input->post('action');
		$role = ($this->input->post('role') == 'kabak') ? '1' : '2';
		if ($action=='review') {

			$pengumuman_review=[
				'pengumuman_id' =>$this->input->post('id_p'),
				'review'        =>$this->input->post('note'),
				'reviewer_id'   =>$role
			];
			
			$pengumuman_validasi=[
				'pengumuman_id'            =>$this->input->post('id_p'),
				$this->input->post('role') =>'2'
			];

			$this->master->create('pengumuman_review', $pengumuman_review);
			$this->master->update('pengumuman_validasi','pengumuman_id',$this->input->post('id_p'),$pengumuman_validasi);

		}elseif ($action=='validasi') {
			
			$pengumuman_validasi=[
				'pengumuman_id' =>$this->input->post('id_p'),
				'kabak'         =>'1'
			];

			$this->db->where('id_pengumuman',$this->input->post('id_p'));
			$this->db->update('pengumuman', array('send_wadir' =>1 ));

			$this->db->where('pengumuman_id',$this->input->post('id_p'));
			$this->db->update('pengumuman_validasi', $pengumuman_validasi);
		}elseif ($action=='publish') {
			
			$pengumuman_validasi=[
				'pengumuman_id' =>$this->input->post('id_p'),
				'wadir'         =>'1'
			];
			$this->db->where('id_pengumuman',$this->input->post('id_p'));
			$this->db->update('pengumuman', array('published' =>'1' ));
			$this->db->where('pengumuman_id',$this->input->post('id_p'));
			$this->db->update('pengumuman_validasi', $pengumuman_validasi);
			$link=$this->input->post('id_p');
			$this->send_telegram($link);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode(['status'=>true]));
	}

	public function getEditedST($id)
	{
		$data=$this->db->get_where('pengumuman_edited_st',array('pengumuman_id' =>$id));
		if ($data->num_rows()>0) {
			$this->db->select('*');
			$this->db->from('pengumuman_edited_st');
			$this->db->where('pengumuman_id', $id);
			$this->db->limit(1);
			$this->db->order_by('id_edited', 'desc');
			$hsl=$this->db->get()->row()->revisi;
		}else{
			$hsl='1';
		}

		return $hsl;
	}

	public function send_telegram($id)
	{
		$getPengumuman            =$this->db->get_where('pengumuman', array('id_pengumuman' =>$id ))->row()->isi_pengumuman;
		
		$chat_id                  = -1001284274192;
		$text                     ='<pre>'.strip_tags($getPengumuman).'</pre>';
		$parse_mode               ='HTML';
		$disable_web_page_preview = null;
		$reply_to_message_id      = null;
		$reply_markup             = null;

		$data = array(
			'chat_id'                  => urlencode($chat_id),
			'text'                     => $text,
			'parse_mode'               =>urlencode($parse_mode),
			'disable_web_page_preview' => urlencode($disable_web_page_preview),
			'reply_to_message_id'      => urlencode($reply_to_message_id),
			'reply_markup'             => urlencode($reply_markup)
		);

		$url = "https://api.telegram.org/bot1225703219:AAEwyCW7t0QnhS7BuoCKDfj09Pl1HO7WxtM/sendMessage";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, count($data));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
	}

}

/* End of file Pengumuman.php */
/* Location: ./application/modules/pengumuman/controllers/Pengumuman.php */