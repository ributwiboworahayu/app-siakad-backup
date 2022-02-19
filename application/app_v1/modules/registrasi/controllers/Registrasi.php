<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends MX_Controller {
	public function __construct()
	{
		parent::__construct();
		hasLOGIN();
		$this->load->library('pdf');
		$this->load->model('Setting','sett');
		$this->load->model('Data_reg','Dreg');
		$this->load->model('M_master','master');
		$this->load->model('Validasi','val');
		$this->load->model('Regview','vreg');
	}
	// kawasan fungsi setting registrasi
	public function setting()
	{
		$data['takad']=$this->db->get_where('m_takad',  array('status' =>1 ))->row();
		$data['alltakad']=$this->db->get('m_takad')->result();
		$data['title_page']='setting Portal Registrasi';
		$data['content']='content/setting';
		$this->load->view('template', $data);	
	}

	public function tables_setting()
	{
		$list = $this->sett->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$statusOP = ($field->status==1) ? "checked" : "";
			$statusCL = ($field->status==0) ? "checked" : "";
			if ($field->status==0) {
				$selected='';
				$badge='<label class="badge badge-danger">Closed</label>';
				$text='Open';
			}else{
				$selected='selected';
				$badge='<label class="badge badge-success">Opened</label>';
				$text='Close';
			}
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = getDetailAKD($field->thn_akd);
			$row[] = tgl_format($field->tgl_mulai);
			$row[] = tgl_format($field->tgl_bts_reg);
			$row[] = tgl_format($field->tgl_selesai);
			$row[] = $badge;
			$row[] = '<label class="st-1">
			<input type="radio" name="portal['.$field->id_setting.']" value="1" '.$statusOP.' onclick="portal('.$field->id_setting.',1);"/>
			<span style="padding-left:6px;">Open</span>
			</label><label class="st-2">
			<input type="radio" class="" name="portal['.$field->id_setting.']" value="0"  '.$statusCL.' onclick="portal('.$field->id_setting.',0);"/>
			<span style="padding-left:3px;">Close</span>
			</label><br>
			<button class="btn btn-out btn-primary btn-square btn-mini btn-edit" data="'.$field->id_setting.'" style="width:60px;">Edit</button><button class="btn btn-out btn-warning btn-square btn-mini" style="width:60px;">Hapus</button>
			';

			$data[] = $row;
		}


		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->sett->count_all(),
			"recordsFiltered" => $this->sett->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		$this->output->set_content_type('application/json')->set_output(json_encode($output));	
	}

	function setStatusChange()
	{
		$id=$this->input->post('id');
		$nilai=$this->input->post('nilai');
		$input = [
			'status' =>$nilai 
		];

		if ($nilai==1) {
			$CekPortalAktif=$this->db->get_where('ru_setting',['status'=>'1']);
			if ($CekPortalAktif->num_rows()>0) {
				$data = [
					'status' =>false,
					'pesan' =>"Ada Portal Yang sedang Aktif, Mohon Untuk Di non-aktifkan Portal lainnya" 
				];
			}else{
				$this->master->update('ru_setting','id_setting',$id,$input);
				$data = [
					'status' =>true,
					'pesan' =>"portal Telah Di aktifkan" 
				];
				$this->sendToTelegram('Buka');
			}
		}else{
			$this->master->update('ru_setting','id_setting',$id,$input);
			$data = [
				'status' =>true,
				'pesan' =>"portal Telah Di Non-aktifkan" 
			];
			$this->sendToTelegram('Tutup');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
		

	}

	function sendToTelegram($portal)
	{
		$getPengumuman=$this->master->viewData('ru_setting',['status'=>1],true)->row();
		$chat_id                  =	-1001284274192;
		if ($portal=='Buka') {
			$text='<pre>Tanggal : '.date('l, d F Y ').'
			perihal : Pengumuman Portal Registrasi Ulang
			Nomor : -

			Portal Registrasi Ulang Telah Di Buka
			Date open : '.tgl_format($getPengumuman->tgl_mulai).'
			Date Close : '.tgl_format($getPengumuman->tgl_selesai).'
			Date Batas Registrasi : '.tgl_format($getPengumuman->tgl_bts_reg).'

			Silahkan Lakukan Registrasi Pada Tanggal Tersebut
			Pesan Ini Di Kirim melalui Sistem Akademik POLKAM </pre>

			<a href="http://siak.poltek-kampar.ac.id">http://siak.poltek-kampar.ac.id</a>
			';
		}else{
			$text='<pre>Tanggal : '.date('l, d F Y ').'
			perihal : Pengumuman Portal Registrasi Ulang
			Nomor : -

			Portal Registrasi Ulang Telah Di Tutup

			Silahkan Cek Status Registrasi Anda Pada Sistem SIAK POLTEK-KAMPAR
			Pesan Ini Di Kirim melalui Sistem Akademik POLKAM </pre>

			<a href="http://siak.poltek-kampar.ac.id">http://siak.poltek-kampar.ac.id</a>
			';
		}
		
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

		// $url = "https://api.telegram.org/bot1301714740:AAE8EQa45GCVOindrIKOr15khzZGOt5vMFc/sendMessage";
		$url = "https://api.telegram.org/bot1225703219:AAEwyCW7t0QnhS7BuoCKDfj09Pl1HO7WxtM/sendMessage";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, count($data));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		// echo $result;
	}

	function getSetting()
	{
		$id=$this->input->get('id');
		$getDataSetting=$this->db->get('ru_setting', ['id_setting' =>$id]);

		$this->output->set_content_type('application/json')->set_output(json_encode($getDataSetting->row_array()));
	}

	function saveSetting()
	{
		$id=$this->input->post('id_');
		$thn=$this->input->post('thn');
		$mulai=$this->input->post('tgl_open');
		$timem=$this->input->post('time_open');
		$batas=$this->input->post('tgl_batas');
		$timeb=$this->input->post('time_batas');
		$selesai=$this->input->post('tgl_close');
		$times=$this->input->post('time_close');
		$status=$this->input->post('status');
		$input=[
			'thn_akd'=>$thn,
			'tgl_mulai'=>$mulai.' '.date('H:i:s', strtotime($timem)),
			'tgl_bts_reg'=>$batas.' '.date('H:i:s', strtotime($timeb)),
			'tgl_selesai'=>$selesai.' '.date('H:i:s', strtotime($times)),
			'status'=>$status
		];
		if ($id==0) {
			// $this->db->insert('ru_setting', $input);
			$this->master->create('ru_setting',$input);
			$data=['pesan'=>"Data Portal Registrasi Ulang Baru Telah Di simpan"];
		}else{
			// $this->db->where('id_setting', $id);
			// $this->db->update('ru_setting', $input);
			$this->master->update('ru_setting','id_setting',$id,$input);
			$data=['pesan'=>"Data Portla Berhasil di Update"];
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	// end kawasan fungsi setting registrasi
	
	//kawasan fungsi menu data registrasi
	public function datareg()
	{
		$data['title_page']='Data Registrasi';
		$data['content']='content/datareg';
		$this->load->view('template', $data);	
	}

	public function tables_DataReg()
	{
		$list = $this->Dreg->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->kode_takad.' <b>[ '.$field->thun_akademik.' ]</b>';
			$row[] = 'Data Registrasi MHS'.$field->keterangan;
			$row[] = $this->RegStausData($field->id_thnakad);

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Dreg->count_all(),
			"recordsFiltered" => $this->Dreg->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function RegStausData($id)
	{
		$data1=$this->db->query("SELECT (SELECT COUNT(mhs_id) FROM ru_reregis WHERE mhs_id=a.id_mhs AND takad_id=$id)as ada FROM m_mahasiswa a WHERE (SELECT COUNT(mhs_id) FROM ru_reregis WHERE mhs_id=a.id_mhs AND takad_id=$id)=0");
		$data2=$this->db->get_where('ru_reregis', array('takad_id' =>$id,'status'=>"Proses" ));
		$data3=$this->db->get_where('ru_reregis', array('takad_id' =>$id,'status'=>"Aktif" ));
		$data4=$this->db->get_where('ru_reregis', array('takad_id' =>$id,'status'=>"Tunda" ));
		$JmlNotReg=$data1->num_rows();
		$JmlProsereg=$data2->num_rows();
		$JmlSelreg=$data3->num_rows();
		$JmlTnda=$data4->num_rows();

		return '<ul><a href="'.base_url().'registrasi/lihatdata/'.$id.'"><li>Belum Registrasi : <span class="badge badge-danger">'.$JmlNotReg.' Data </span></li></a><a href="'.base_url().'registrasi/lihatdata/'.$id.'/proses"><li>Proses : <span class="badge badge-info">'.$JmlProsereg.' Data</span></li></a><a href="'.base_url().'registrasi/lihatdata/'.$id.'/selesai"><li>Aktif : <span class="badge badge-success">'.$JmlSelreg.' Data</span></li></a><a href="'.base_url().'registrasi/lihatdata/'.$id.'/tunda"><li>Tunda : <span class="badge badge-warning">'.$JmlTnda.' Data</span></li></a></ul>';
		// $this->output->set_content_type('application/json')->set_output(json_encode($JmlSelreg));
	}

	public function lihatdata($id,$keyreg=null)
	{
		$data =[
			'prodi'=>$this->db->get('m_prodi')->result(),
			'semester'=>$this->db->get('m_semester')->result(),
			'kelas'=>$this->db->get('m_kelas')->result(),
			'takad'=>$id,
			'keyreg'=>$keyreg
		];
		// // $data['takad']=$id;
		// // $data['json']=$tema;
		$data['content']="content/viewreg";
		$data['title_page']='setting Portal Registrasi';
		$this->load->view('template', $data);
		// $table=$this->vreg->get_datatables();
		// $this->output->set_content_type('application/json')->set_output(json_encode($tabel));

	}

	function tables_vreg($value='')
	{
		$list = $this->vreg->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			
			$row = array();
			$row[] = $no;
			$row[] = $field->nim;
			$row[] = $field->nama;
			$row[] = getDetailProdi($field->prodi_id);
			if ($field->sb_ !=NULL) {
				$row[] =$field->sb_  .' Up To '.$field->sp_;
			}else{
				$row[] ='Semester Aktif Saat Ini :'. $field->semester_id;
			}
			
			if ($this->input->post('keyreg')!='') {
				$row[] = $field->tgl_;	
			}
			if ($this->input->post('keyreg')=='') {
				$row[] = '<span class="badge badge-danger">Belum Mendaftar</span>';
			}
			if ($this->input->post('keyreg')=='proses') {
				$row[] = '<span class="badge badge-danger">Proses</span>';
			}
			if ($this->input->post('keyreg')=='selesai') {
				$row[] = '<ul><li>Status REG : <span class="badge badge-info">Selesai</span></li><li>Status MHS : <span class="badge badge-success">'.$field->st_.'</span></li><li>Status By : <span class="badge badge-warning">'.$field->stv_.'</span></li><ul>';
			}
			if ($this->input->post('keyreg')=='tunda') {
				$row[] = '<ul><li>Status REG : <span class="badge badge-info">Tunda</span></li><li>Status MHS : <span class="badge badge-success">'.$field->st_.'</span></li><li>Status By : <span class="badge badge-warning">'.$field->stv_.'</span></li><ul>';
			}

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->vreg->count_all(),
			"recordsFiltered" => $this->vreg->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	// end kawasan funsi menu data registrasi

	//fungsi untuk data histori pendaftaran mahasiswa
	public function histori()
	{
		$user=GetUserMHS($this->session->userdata('email'));
		$data['histori']=$this->db->get_where('ru_reregis',['mhs_id'=>$user['id_mhs']])->result();
		$data['title_page']='Data Registrasi';
		$data['content']='content/histori';
		$this->load->view('template', $data);	
		// $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function lihatDetailHistori($idreg)
	{
		$getData=$this->Dreg->getHistoriDetail($idreg)->result();
		$data['title_page']='Data Registrasi';
		$data['dt_validasi']=$getData;
		$data['content']='content/detailhistori';
		$this->load->view('template', $data);	
	}
	//end fungsi histori data registrasi

	// fungsi untuk menu pendaftaran registrasi
	public function pendaftaran()
	{
		$getDataRUsetting=$this->sett->getConfigReg()->row();
		$DataRegMHS=$this->sett->getDataValidasi($this->session->userdata('email'),$getDataRUsetting->thn_akd);
		if ($this->sett->getConfigReg()->num_rows()>0) {
			$cekData=($DataRegMHS->num_rows()>0)? '':'hidden';
			$btn_ui=($DataRegMHS->num_rows()>0)? '<button type="button" class="btn btn-primary btn-cek-vld">Cek Registrasi</button>':'<button type="submit" class="btn btn-primary btn-dft">Daftar</button>';
			if ($getDataRUsetting->stt==0) {
				$display=[
					'dis_portal'=>"hidden",
					'dis_before'=>"",
					'dis_after'=>"hidden",
					'dis_validasi'=>"hidden",
					'dis_btn'=>$btn_ui	
				];

			}else if ($getDataRUsetting->stt==1) {
				$display=[
					'dis_portal'=>"hidden",
					'dis_before'=>"hidden",
					'dis_after'=>"",
					'dis_validasi'=>$cekData,	
					'dis_btn'=>$btn_ui,	
					'msg_selesai'=>"hidden",
					'counttimer'=>""
				];
			}else{
				$display=[
					'dis_portal'=>"hidden",
					'dis_before'=>"hidden",
					'dis_after'=>"block",
					'dis_validasi'=>$cekData,	
					'dis_btn'=>$btn_ui,
					'msg_selesai'=>"",
					'counttimer'=>"hidden"	
				];
			}
		}else{
			$display=[
				'dis_portal'=>"",
				'dis_before'=>"hidden",
				'dis_after'=>"hidden",
				'dis_validasi'=>"hidden",
				'dis_btn'=>$btn_ui	
			];
		}
		
		$data=[
			'ui'=>$display,
			'ru_setting'=>$getDataRUsetting,
			'tgl_mulai'=>$getDataRUsetting->tgl_mulai,
			'tgl_batas'=>$getDataRUsetting->tgl_bts_reg,
			'tgl_selesai'=>$getDataRUsetting->tgl_selesai,
			'thun_akademik'=>$this->master->viewData('m_takad',['id_thnakad'=>$getDataRUsetting->thn_akd],true)->row(),
			'dt_mahasiswa'=>$this->master->viewData('m_mahasiswa',['email'=>$this->session->userdata('email')],true)->row(),
			'dt_validasi'=>$DataRegMHS->result()
		];

		$data['title_page']='Data Registrasi';
		$data['content']='content/pendaftaran';
		$this->load->view('template', $data);	

		// $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function savePendaftaran()
	{
		$id_mhs=$this->input->post('mhs_id');
		$id_setting=$this->input->post('setting_id');
		$id_takad=$this->input->post('takad_id');
		$s_sebelum=$this->input->post('semester_sebelum');
		$s_pengajuan=$this->input->post('semester_pengajuan');
		$tgl=date('Y-m-d H:i:s');
		//buat array nilai post dari form
		$input = [
			'mhs_id' =>$id_mhs, 
			'setting_id' =>$id_setting, 
			'takad_id' =>$id_takad, 
			'semester_sebelum' =>$s_sebelum, 
			'semester_pengajuan' =>$s_pengajuan, 
			'status' =>'Proses', 
			'tgl_terdaftar' =>$tgl, 
			'tgl_selesai' =>'0000-00-00 00:00:00', 
		];
		//cek data mhs jika terdaftar
		$getMhsTerdaftar=$this->db->get_where('ru_reregis',['mhs_id'=>$id_mhs,'takad_id'=>$id_takad]);
		if ($getMhsTerdaftar->num_rows()>0) {
			$status=FALSE;
		}else{
			$this->master->create('ru_reregis',$input,false);
		//mengabil last id saat insert data
			$insert_id = $this->db->insert_id();
		//ambil data validator dari db
			$getDvalidator=$this->master->viewData('ru_validator',false)->result();
			foreach ($getDvalidator as $vd) {
				$input_tr[]=['ru_reg_id'=>$insert_id,'validator'=>$vd->id_validator,'status'=>'Proses','tgl_valid'=>null];
			}
			$this->master->create('tr_rurregis',$input_tr,true);
			$this->sendNotif();
			$status=TRUE;
		}
		//simpan ke db table ru_reregis
		
		$this->output->set_content_type('application/json')->set_output(json_encode(['status'=>$status,'ui_btn'=>'<button type="button" class="btn btn-primary btn-cek-vld">Cek Registrasi</button>']));
	}
	//end fungsi pendaftaran


	//function validasi
	public function validasi()
	{
		$level=$this->session->userdata('id_jabatan');
		$email=$this->session->userdata('email');
		$getLevelKet=$this->master->viewData('user_trakses', array('email' =>$email,'level_id'=>$level ),true)->row();
		$data=[
			'aktifprodi'=>$getLevelKet->keterangan,
			'prodi'=>$this->db->get('m_prodi')->result(),
			'semester'=>$this->db->get('m_semester')->result(),
			'aktifta'=>$this->master->viewData('m_takad', array('status' =>1 ),true)->row()->id_thnakad,
			'alltakad'=>$this->master->viewData('m_takad',false)->result()
		];
		if ($getLevelKet->keterangan!=0) {
			if ($level==2) {
				$data['content']='content/pageV-1';
			}else{
				$data['content']='content/pageV-2';
			}
		}else{
			if ($level==3) {
				$getDosen         =$this->master->viewData('m_dosen',array('email' =>$email ),true)->row()->id_dosen;
				$data['kelas']    =$this->master->viewData('m_kelas', array('dosen_id' => $getDosen),true)->result();
				$data['content']='content/pageV-3';
			}else{
				$data['content']='content/pageV-1';
			}
		}
		// $data['takad']    =$this->master->viewData('m_takad', array('status' =>1 ),true)->row()->id_thnakad;
		$data['title_page']='Data Registrasi';
		
		$this->load->view('template', $data);	
		// $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function tables_v1()
	{
		$list = $this->val->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[]='<input type="checkbox" name="" value="" placeholder="">';
			$row[] = $field->nim;
			$row[] = wordwrap($field->nama,15,"<br>\n");
			$row[] = getDetailProdi($field->prodi_id). $this->input->post('prodi_id');
			$row[] = $field->semester_sebelum.' <i class="ion-arrow-right-c"></i> '.$field->semester_pengajuan;
			$row[] = tgl_format($field->tgl_terdaftar);
			if ($this->session->userdata('id_jabatan')==4) {
				$row[] = $this->statusAllValidator($field->id_rreg);
			}
			if ($this->session->userdata('id_jabatan')==3) {
				$row[] = $this->StatusValidasiDSNWali($field->id_rreg);
				// $row[]="";
			}else{
				$row[] = $this->StatusValidasi($field->id_rreg);
			}
			$row[] = $this->Button($field->id_rreg);
			
			

			$data[] = $row;
		}


		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->val->count_all(),
			"recordsFiltered" => $this->val->count_filtered(),
			"data" => $data,
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	function Button($id)
	{
		$getData=$this->master->viewData('tr_rurregis',getDataValidator($id) ,true)->row();
		if ($getData->validator==9) {
			$btn='<button type="button" class="btn btn-primary btn-mini valid" '.$this->disabledButtonKaprodi($id).' data-idtr="'.$getData->id_trru.'">Validasi</button>';
		}else{
			if ($this->session->userdata('id_jabatan')==3) {
				$validator = [5,6];
				$this->db->select('*');
				$this->db->from('tr_rurregis a');
				$this->db->join('ru_validator b', 'a.validator = b.id_validator', 'inner');
				$this->db->where('ru_reg_id', $id);
				$this->db->where_in('a.validator', $validator);
				$dwValid=$this->db->get()->result();
				$btn='';
				foreach ($dwValid as $vl) {
					$btn =$btn.'<div class="dropdown-primary dropdown open">
					<button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action '.$vl->validator.'</button>
					<div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
					<a class="dropdown-item waves-light waves-effect valid" href="#" data-idtr="'.$vl->id_trru.'">Validasi</a>
					<a class="dropdown-item waves-light waves-effect tunda" href="#" data-idtr="'.$vl->id_trru.'">Tunda</a>
					</div>
					</div>';
				}
				
			}else{
				$btn='<div class="dropdown-primary dropdown open">
				<button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action</button>
				<div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
				<a class="dropdown-item waves-light waves-effect valid" href="#" data-idtr="'.$getData->id_trru.'">Validasi</a>
				<a class="dropdown-item waves-light waves-effect tunda" href="#" data-idtr="'.$getData->id_trru.'">Tunda</a>
				</div>
				</div>';	
			}
			
		}
		

		// $this->output->set_content_type('application/json')->set_output(json_encode($getData));
		return $btn;

	}
	function disabledButtonKaprodi($id)
	{
		$this->db->select('*');
		$this->db->from('tr_rurregis a');
		$this->db->join('ru_validator b', 'a.validator = b.id_validator', 'inner');
		$this->db->where('a.ru_reg_id', $id);
		$this->db->where('a.validator !=', 9);
		$this->db->where('a.status', 1);
		$getData=$this->db->get()->num_rows();
		$atr=($getData == 8)? '' : 'disabled' ;
		
		return $atr;
		// $this->output->set_content_type('application/json')->set_output(json_encode($getData));
	}
	function StatusValidasi($id)
	{
		$getData=$this->master->viewData('tr_rurregis', getDataValidator($id),true);
		if ($getData->row()->status==0) {
			$data='<span class="badge badge-info">Proses</span>';
		}elseif ($getData->row()->status==2) {
			$data='&emsp; <a class="mytooltip" href="javascript:void(0)"> <span class="badge badge-warning">Tunda</span><span class="tooltip-content5" style="font-size:12px;height:100px;"><span class="tooltip-text3"><span class="tooltip-inner2">Notes :<br>'.wordwrap($getData->row()->pesan,20,"<br>\n").'</span></span></span></a>';
		}else{
			$data='<span class="badge badge-success">Selesai</span>';
		}
		return $data;
	}

	function StatusValidasiDSNWali($id)
	{
		$validator = [5,6];
		$this->db->select('*');
		$this->db->from('tr_rurregis a');
		$this->db->join('ru_validator b', 'a.validator = b.id_validator', 'inner');
		$this->db->where('ru_reg_id', $id);
		$this->db->where_in('a.validator', $validator);
		$getData=$this->db->get()->result();
		$data="";
		foreach ($getData as $dta) {
			if ($dta->status==0) {
				$data=$data.$dta->validator.' : <span class="badge badge-info">Proses</span><br>';
			}elseif ($dta->status==2) {
				$data=$data.$dta->validator.' : <span class="badge badge-warning">Tunda </span><br>';
			}else{
				$data=$data.$dta->validator.' : <span class="badge badge-success">Selesai</span><br>';
			}
		}
		
		return $data;
	}

	function statusAllValidator($id)
	{
		// $getData=$this->master->viewData('tr_rurregis', ['ru_reg_id'=>$id],true)->result();
		$this->db->select('*');
		$this->db->from('tr_rurregis a');
		$this->db->join('ru_validator b', 'a.validator = b.id_validator', 'inner');
		$this->db->where('a.ru_reg_id', $id);
		$this->db->where('a.validator !=', 9);
		$getData=$this->db->get()->result();
		$data='';
		foreach ($getData as $vl) {
			if ($vl->status==0) {
				$data=$data.'<small>'.$vl->validator.': <span class="badge badge-info">Proses</span></small><br>';
			}elseif ($vl->status==2) {
				$data=$data.'<small>'.$vl->validator.': <span class="badge badge-warning">Tunda</span></small><br>';
			}else{
				$data=$data.'<small>'.$vl->validator.': <span class="badge badge-success">Selesai</span></small><br>';
			}
			
		}
		
		return $data;
	}

	function validasiRegistasi($pesan=null)
	{
		$id=$this->input->post('id');
		$sql="SELECT c.email,b.* FROM tr_rurregis a INNER JOIN ru_reregis b ON a.ru_reg_id=b.id_rreg INNER JOIN m_mahasiswa c ON b.mhs_id=c.id_mhs WHERE a.id_trru=$id ";
		$getMailMhs=$this->db->query($sql)->row();
		if ($pesan==NULL) {
			$this->db->where('id_trru', $id);
			$this->db->update('tr_rurregis', ['status'=>1,'pesan'=>'','tgl_valid'=>date('Y-m-d H:i:s')]);

			if ($this->session->userdata('id_jabatan')==4) {
				$this->db->where('id_rreg', $getMailMhs->id_rreg);
				$this->db->update('ru_reregis', array('status'=>"Aktif",'valid_st'=>'Validator','tgl_selesai'=>date('Y-m-d H:i:s')));
				$this->RegUpdateMHS($getMailMhs->mhs_id);
			}
			$msg="Registrasi Anda Telah Di setujui dengan Status <b>Selesai</b>";
			$this->db->insert('notifikasi', array('pengirim' =>$this->session->userdata('email') ,'penerima'=>$getMailMhs->email,'lvl'=>5,'pesan'=>$msg,'status'=>'1','tgl_notif'=>date('Y-m-d H:i:s') ));
			Pusher();
			$this->output->set_content_type('application/json')->set_output(json_encode(['status'=>$msg]));

			
		}else{
			$this->db->where('id_trru', $id);
			$this->db->update('tr_rurregis', ['status'=>2,'pesan'=>urldecode($pesan),'tgl_valid'=>date('Y-m-d H:i:s')]);
			$msg="Registrasi Anda Telah Di lakukan dengan Status <b>Tunda</b> Cek Pesan Di Status Registrasi ";
			$this->db->insert('notifikasi', array('pengirim' =>$this->session->userdata('email') ,'penerima'=>$getMailMhs->email,'lvl'=>5,'pesan'=>$msg,'status'=>'1','tgl_notif'=>date('Y-m-d H:i:s') ));
			Pusher();
			$this->output->set_content_type('application/json')->set_output(json_encode(['status'=>urldecode($msg)]));
			
		}
		

	}

	function RegUpdateMHS($idmhs)
	{
		$GetMhs=$this->db->get_where('m_mahasiswa',['id_mhs'=>$idmhs])->row();

		$input_mhs=['semester_id'=>$GetMhs->semester_id + 1];
		$this->db->where('id_mhs', $idmhs);
		$this->db->update('m_mahasiswa', $input_mhs);
		// $this->output->set_content_type('application/json')->set_output(json_encode($input_mhs));
		return true;
	}

	//end function validasi
	function sendNotifMHS($email,$pesan)
	{
		$input = [
			'pengirim' =>$this->session->userdata('email'),
			'penerima'=>$email,
			'lvl'=>5,
			'pesan'=>$pesan,
			'status'=>1,
			'tgl_notif'=>date('Y-m-d H:i:s')
		];

		$this->db->insert('notifikasi', $input);

		return true;
	}
	public function sendNotif()
	{
		$email=$this->session->userdata('email');
		$getPD=$this->db->get_where('m_mahasiswa', array('email' =>$email ))->row();

		$id = array(2,6,7,9);
		$this->db->where_in('level_id', $id);
		$this->db->order_by('level_id', 'asc');
		$singel = $this->db->get('user_trakses')->result();
		foreach ($singel as $sg) {
			$this->db->insert('notifikasi', array('pengirim' =>$email ,'penerima'=>$sg->email,'lvl'=>$sg->level_id,'pesan'=>"Telah Melakukan Pendaftaran REG ULANG Mohon Untuk di Validasi",'status'=>'1','tgl_notif'=>date('Y-m-d H:i:s') ));
		}
		$opk=$this->db->get_where('user_trakses', array('level_id' =>8))->row();
		$this->db->insert('notifikasi', array('pengirim' =>$email ,'penerima'=>$opk->email,'lvl'=>8,'pesan'=>"Telah Melakukan Pendaftaran REG ULANG",'status'=>'1','tgl_notif'=>date('Y-m-d H:i:s') ));

		$kp=$this->db->get_where('user_trakses', array('level_id' =>4,'keterangan'=>$getPD->prodi_id))->row();
		$this->db->insert('notifikasi', array('pengirim' =>$email ,'penerima'=>$kp->email,'lvl'=>4,'pesan'=>"Telah Melakukan Pendaftaran REG ULANG Mohon Untuk di Validasi",'status'=>'1','tgl_notif'=>date('Y-m-d H:i:s') ));

		$getKLS=$this->db->get_where('m_kelas', array('id_kelas' =>$getPD->kelas_id ))->row();
		$opdw=$this->db->get_where('m_dosen', array('id_dosen' =>$getKLS->dosen_id ))->row();
		$this->db->insert('notifikasi', array('pengirim' =>$email ,'penerima'=>$opdw->email,'lvl'=>3,'pesan'=>"Telah Melakukan Pendaftaran REG ULANG Mohon Untuk di Validasi",'status'=>'1','tgl_notif'=>date('Y-m-d H:i:s') ));


		return true;

	}

	function autodaftar()
	{
		$getMhs=$this->db->get('m_mahasiswa')->result();
		foreach ($getMhs as $vl) {
			$input []= [
				'mhs_id' =>$vl->id_mhs, 
				'setting_id' =>'1', 
				'takad_id' =>'3', 
				'semester_sebelum' =>$vl->semester_id, 
				'semester_pengajuan' =>$vl->semester_id + 1, 
				'status' =>'Proses', 
				'tgl_terdaftar' =>date('Y-m-d H:i:s'), 
				'tgl_selesai' =>'0000-00-00 00:00:00', 
			];
		}

		$this->db->insert_batch('ru_reregis', $input);
		
		$getRegistData=$this->db->get('ru_reregis')->result();
		$input_tr=[];
		foreach ($getRegistData as $vg) {
			$getDataValidator=$this->master->viewData('ru_validator',false)->result();
			foreach ($getDataValidator as $vd) {
				$valid=($vd->id_validator=='9')? 0:1;
				$input_tr[]=[
					'ru_reg_id'=>$vg->id_rreg,
					'validator'=>$vd->id_validator,
					'status'=>$valid,
					'tgl_valid'=>date('Y-m-d H:i:s')
				];
			}
		}

		$this->db->insert_batch('tr_rurregis', $input_tr);
		$this->output->set_content_type('application/json')->set_output(json_encode($input_tr));
		
	}

	function autoValidation()
	{
		$data=['status'=>1];
		$getAKD=$this->master->viewData('m_takad',$data,true)->row();
		$getRureg=$this->db->get_where('ru_reregis', array('takad_id' =>$getAKD->id_thnakad,'semester_sebelum'=>3 ))->result();
		$n=0;
		foreach ($getRureg as $reg) {

			// $this->db->select('ru_reg_id,COUNT(id_trru)as jml ');
			$this->db->select('*');
			$this->db->from('tr_rurregis');
			$this->db->where('ru_reg_id', $reg->id_rreg);
			$this->db->where('status', 2);
			// $this->db->group_by('ru_reg_id');
			$getTransaksivalid=$this->db->get();
			$this->db->select('*');
			$this->db->from('tr_rurregis');
			$this->db->where('ru_reg_id', $reg->id_rreg);
			// $this->db->where('status', 2);
			$this->db->group_by('ru_reg_id');
			$getTransaksivalid1=$this->db->get();
			if ($getTransaksivalid->num_rows()>0) {
				$valid='Tunda';
			}else{
				$valid="Aktif";
			}

			// $CekSTselesai=
			// $getIdVld=$this->db->get_where('tr_rurregis', ['validator'=>9,'ru_reg_id'=>$reg->id_rreg]);
			// foreach ($getIdVld->result() as $idvld) {
			// 		$id[]=$idvld->id_trru;
			// 	}
			
			foreach ($getTransaksivalid1->result() as $vld) {
				// $valid=($vld->jml==8)?'Aktif':'Tunda';
				$hsl[]=[
					'id_rreg' => $vld->ru_reg_id ,
					'status' => $valid,
					'valid_st' => 'Sistem' ,
					'tgl_selesai' =>date('Y-m-d H:i:s')
				];
				
				// $update_tr[]=[
				// 	'id_trru'=>$vld->ru_reg_id,
				// 	'validator'=>$vld->validator,
				// 	'status'=>$hsl,
				// 	'tgl_valid'=>date('Y-m-d H:i:s')
				// ];
				
			}
			// $n++;
			
		}

		// $this->db->update_batch('tr_rurregis', $update_tr, 'id_trru');

		$this->output->set_content_type('application/json')->set_output(json_encode($hsl));

		
	}

	function autodft($value='')
	{
		$mhs_id = [40,42,43,44,45,46,47,59,64,87,107,126,135];
		foreach ($mhs_id as $vl) {
			$input []= [
				'mhs_id' =>$vl, 
				'setting_id' =>'1', 
				'takad_id' =>'3', 
				'semester_sebelum' =>'3', 
				'semester_pengajuan' =>'4', 
				'status' =>'Proses', 
				'tgl_terdaftar' =>date('Y-m-d H:i:s'), 
				'tgl_selesai' =>'0000-00-00 00:00:00', 
			];
		}

		$this->db->insert_batch('ru_reregis', $input);
		
		$getRegistData=$this->db->get('ru_reregis')->result();
		$input_tr=[];
		foreach ($getRegistData as $vg) {
			$getDataValidator=$this->master->viewData('ru_validator',false)->result();
			foreach ($getDataValidator as $vd) {
				
				$input_tr[]=[
					'ru_reg_id'=>$vg->id_rreg,
					'validator'=>$vd->id_validator,
					'status'=>0,
					'tgl_valid'=>date('Y-m-d H:i:s')
				];
			}
		}

		$this->db->insert_batch('tr_rurregis', $input_tr);
		$this->output->set_content_type('application/json')->set_output(json_encode($input));
	}
	public function byKelasReg()
	{
		$sql="SELECT a.* FROM m_mahasiswa a WHERE a.kelas_id=6 AND (SELECT COUNT(b.mhs_id) FROM ru_reregis b WHERE b.mhs_id=a.id_mhs AND takad_id='3')=0 ORDER BY `a`.`id_mhs` ASC ";
		$tgl=['2021-03-12 09:25:45','2021-03-11 12:45:25','2021-03-11 09:55:45','2021-03-12 010:25:45','2021-03-12 14:15:25','2021-03-12 15:35:15','2021-03-11 14:15:25','2021-03-11 08:45:15','2021-03-12 12:10:05','2021-03-11 15:25:45','2021-03-12 013:15:23'];
		$data=$this->db->query($sql)->result();
		$no=0;
		foreach ($data as $vl) {
			$input []= [
				'mhs_id' =>$vl->id_mhs, 
				'setting_id' =>'1', 
				'takad_id' =>'3', 
				'semester_sebelum' =>'3', 
				'semester_pengajuan' =>'4', 
				'status' =>'Proses', 
				'tgl_terdaftar' =>$tgl[$no], 
				'tgl_selesai' =>'0000-00-00 00:00:00', 
			];
			# code...
			$no++;
		}
		$this->db->insert_batch('ru_reregis', $input);
		
		$getRegistData=$this->db->get('ru_reregis')->result();
		$input_tr=[];
		foreach ($getRegistData as $vg) {
			$getDataValidator=$this->master->viewData('ru_validator',false)->result();
			foreach ($getDataValidator as $vd) {
				
				$input_tr[]=[
					'ru_reg_id'=>$vg->id_rreg,
					'validator'=>$vd->id_validator,
					'status'=>0,
					'tgl_valid'=>date('Y-m-d H:i:s')
				];
			}
		}

		$this->db->insert_batch('tr_rurregis', $input_tr);
		$this->output->set_content_type('application/json')->set_output(json_encode($input));
	}

	function AutoValidRegitrasi($value='')
	{
		$data=['status'=>1];
		$idRuregTunda='';
		$idRureg='';
		$st=false;
		$getAKD=$this->master->viewData('m_takad',$data,true)->row();
		$getRureg=$this->db->get_where('ru_reregis', array('takad_id' =>$getAKD->id_thnakad,'status'=>"Proses" ));
		foreach ($getRureg->result() as $dt_rureg) {
			$result[]=[
				'id_rreg'=>$dt_rureg->id_rreg,
				'mhs_id'=>$dt_rureg->mhs_id,
				'takad_id'=>$dt_rureg->takad_id,
				'semester_s'=>$dt_rureg->semester_sebelum,
				'semester_p'=>$dt_rureg->semester_pengajuan,
				'status'=>$dt_rureg->status
			];
			$idRureg .= $dt_rureg->id_rreg.",";
			
			// $CekStTunda=$this->db->get_where('tr_rurregis',array("ru_reg_id"=>$dt_rureg->id_rreg,'status'=>2));
			$CekStTunda=$this->db->query("SELECT * FROM tr_rurregis a INNER JOIN ru_reregis b ON a.ru_reg_id=b.id_rreg WHERE a.ru_reg_id=$dt_rureg->id_rreg AND a.status=2 GROUP BY a.ru_reg_id ");
				// $st='';
			foreach ($CekStTunda->result() as $tunda) {
				if ($CekStTunda->num_rows()>0) {
					$update[]=[
						'id_rreg'=>$tunda->ru_reg_id,
						'mhs_id'=>$tunda->mhs_id,
						'status'=>"Tunda",
						'valid_st'=>"Sistem",
						'tgl_selesai'=>"2021-03-22 16:00:00"
					];

					$update_mhs[]=[
						'id_mhs'=>$tunda->mhs_id,
						'semester_id'=>$tunda->semester_pengajuan
					];
					$idRuregTunda .= $tunda->ru_reg_id.",";
					$st=true;
				}
			}

		}
		$idRuregTunda 	= substr($idRuregTunda, 0, -1);
		$idRureg 	= substr($idRureg, 0, -1);
		if ($idRuregTunda!=false) {
			$CekStrposesNotIn=$this->db->query("SELECT * FROM `ru_reregis` WHERE id_rreg NOT IN($idRuregTunda) AND status='Proses' ORDER BY `ru_reregis`.`id_rreg` ASC ");
			foreach ($CekStrposesNotIn->result() as $NotIn) {
				$update[]=[
					'id_rreg'=>$NotIn->id_rreg,
					'mhs_id'=>$NotIn->mhs_id,
					'status'=>"Aktif",
					'valid_st'=>"Sistem",
					'tgl_selesai'=>"2021-03-22 16:00:00"
				];
				$update_mhs[]=[
					'id_mhs'=>$NotIn->mhs_id,
					'semester_id'=>$NotIn->semester_pengajuan
				];
			}
			
		}else{
			foreach ($getRureg->result() as $all) {
				$update[]=[
					'id_rreg'=>$all->id_rreg,
					'mhs_id'=>$all->mhs_id,
					'status'=>"Aktif",
					'valid_st'=>"Sistem",
					'tgl_selesai'=>"2021-04-09 16:00:00"
				];
				$update_mhs[]=[
					'id_mhs'=>$all->mhs_id,
					'semester_id'=>$all->semester_pengajuan
				];
			}
			
		}
		$CekStProses=$this->db->query("SELECT * FROM tr_rurregis WHERE ru_reg_id IN (".$idRureg.") AND status=0 ");
		foreach ($CekStProses->result() as $proses) {
			$prses[]=[
				'id_trru'=>$proses->id_trru,
				// 'rureg_id'=>$proses->ru_reg_id,
				// 'validator'=>$proses->validator,
				'status'=>1,
				'tgl_valid'=>"2021-03-22 16:00:00"
			];
		}
		$this->db->update_batch('ru_reregis', $update, 'id_rreg');
		$this->db->update_batch('tr_rurregis', $prses, 'id_trru');
		$this->db->update_batch('m_mahasiswa', $update_mhs, 'id_mhs');

		$this->output->set_content_type('application/json')->set_output(json_encode(['st'=>$st,'idTunda'=>$idRuregTunda,'id_rreg'=>$idRureg,'jumlah_dataRegis'=>$getRureg->num_rows(),'jml_stProsesRegis'=>$CekStrposesNotIn->num_rows(),'data'=>$update,'jml_proses_validator'=>$CekStProses->num_rows(),'data_updateProses'=>$prses,'mhs_update'=>$update_mhs]));
		
	}
	function cetakReportDataReg(){
		$pdf = new FPDF('p','mm','A4');
        // membuat halaman baru
		$pdf->SetMargins(15, 20, 11.7);
		$pdf->AliasNbPages();
		$pdf->AddPage();
        // setting jenis font yang akan digunakan
		$pdf->SetFont('Arial','B',16);
		$pdf->Image(FCPATH.'assets/plkm.png',10,15,30,30,'PNG');
		$pdf->Image(FCPATH.'assets/yayasan.png',170,15,30,33,'PNG');
        // mencetak string 
		$pdf->SetFont('Arial','B',18);
        // Move to the right
        // $pdf->Cell(80);
        // Title
        // $pdf->Cell(52,10);
		$pdf->Cell(180,8,'YAYASAN DATUK TABANO',0,1,'C');
        // $pdf->Ln(0);
		$pdf->SetFont('Times','B',30);
		$pdf->Cell(180,8,'POLITKENIK KAMPAR',0,1,'C');

		$pdf->SetFont('Arial','',12);
		$pdf->Cell(180,5,'Sektretariat: Jl. Tengku Muhammad KM. 02 Bangkinang-Riau 28412',0,1,'C');
		$pdf->Cell(180,5,'Telpon: 0762 07015469 Faks: 0762 7004467 www.poltek-kampar.ac.id',0,1,'C');
        // Line break
  //       $pdf->Ln(5);
  //       $pdf->Cell(30);
		$pdf->SetLineWidth(0.7);
		$pdf->Line(10,47,200,47);
		$pdf->SetLineWidth(0.2);
		$pdf->Line(10,48,200,48);
		$pdf->ln(10);
		$getTakad=$this->db->get_where('m_takad',array('status'=>1))->row();
		$pdf->SetFont('Arial','BU',12);
		$pdf->Cell(180,5,'LAPORAN REGISTRASI MAHASISWA TA '.$getTakad->thun_akademik." SEMESTER ".strtoupper($getTakad->ta_tipe),0,1,'C');
		$pdf->ln(20);
		$getKelas=$this->db->query("SELECT a.id_kelas,b.nama_prodi,a.nama_kelas FROM m_kelas a INNER JOIN m_prodi b ON a.jurusan_id=b.kode_prodi ORDER BY `a`.`id_kelas` ASC ")->result();
		$no=42;
		foreach ($getKelas as $kelas) {
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(40,6,'Program Studi',0,0,'L');
			$pdf->Cell(40,6,': '.$kelas->nama_prodi,0,1,'L');
			$pdf->Cell(40,6,'Kelas',0,0,'L');
			$pdf->Cell(40,6,': '.$kelas->nama_kelas,0,1,'L');
			$pdf->SetLineWidth(0);
			
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(10,10,"No",1,0);
			$pdf->Cell(20,10,"Nim",1,0);
			$pdf->Cell(45,10,"Nama",1,0);
			$pdf->Cell(35,5,"Semester",1,0,"C");
			$pdf->Cell(30,10,"Tgl Terdaftar",1,0,"C");
			$pdf->Cell(40,5,"Status",1,0,"C");
			$pdf->Cell(0,5,"",0,1);
			$pdf->Cell(75,5,"",0,0);
			$pdf->Cell(15,5,"sebelum",1,0,"C");
			$pdf->Cell(10,5,"daftar",1,0,"C");
			$pdf->Cell(10,5,"aktif",1,0,"C");
			$pdf->Cell(30,5,"",0,0);
			$pdf->Cell(20,5,"MHS Reg",1,0,"C");
			$pdf->Cell(20,5,"By Valid",1,1,"C");
			$getMhs=$this->db->query("SELECT a.nim,a.nama,a.semester_id aktif ,(SELECT COUNT(id_rreg) FROM ru_reregis b WHERE a.id_mhs=b.mhs_id AND b.takad_id=3)as ada,(SELECT c.semester_sebelum FROM ru_reregis c WHERE c.mhs_id=a.id_mhs AND c.takad_id=3)as sebelum,(SELECT c.semester_pengajuan FROM ru_reregis c WHERE c.mhs_id=a.id_mhs AND c.takad_id=3)as daftar,(SELECT c.status FROM ru_reregis c WHERE c.mhs_id=a.id_mhs AND c.takad_id=3)as status,(SELECT c.valid_st FROM ru_reregis c WHERE c.mhs_id=a.id_mhs AND c.takad_id=3)as valid_st,(SELECT c.tgl_terdaftar FROM ru_reregis c WHERE c.mhs_id=a.id_mhs AND c.takad_id=3)as tgl_terdaftar FROM m_mahasiswa a WHERE a.kelas_id=$kelas->id_kelas ORDER BY `a`.`id_mhs` ASC ");
			$a=1;
			if ($getMhs->num_rows()>0) {
				foreach ($getMhs->result() as $row){
					$pdf->SetFont('Arial','',8);
					$pdf->Cell(10,6,$a,1,0);
					$pdf->Cell(20,6,$row->nim,1,0);
					$pdf->Cell(45,6,$row->nama,1,0);
					if ($row->ada==0) {
						$pdf->Cell(15,6,$row->sebelum,1,0,"C");
						$pdf->Cell(10,6,$row->daftar,1,0,"C");
						$pdf->Cell(10,6,$row->aktif,1,0,"C");
						$pdf->Cell(30,6,"",1,0,"C");
						// $pdf->Cell(20,6,$row->status,1,0,"C"); 
						$pdf->Cell(40,6,"Belum Mendaftar",1,1,"C"); 
					}else{
						$pdf->Cell(15,6,$row->sebelum,1,0,"C");
						$pdf->Cell(10,6,$row->daftar,1,0,"C");
						$pdf->Cell(10,6,$row->aktif,1,0,"C");
						$pdf->Cell(30,6,tgl_format($row->tgl_terdaftar),1,0,"C");
						$pdf->Cell(20,6,$row->status,1,0,"C"); 
						$pdf->Cell(20,6,$row->valid_st,1,1,"C"); 
					}



					$a++;
				}
			}else{
				$pdf->SetFont('Arial','B',8);
				// $pdf->Cell(245, 10, ' No Data', 'L'||'B', 0, 'L');
				// $pdf->Cell(245, 10, ' No Data', 'L'||'B', 0, 'L');
				$pdf->Cell(180,10,"No Data ",'LR',1,"C");
				$pdf->Cell(180,10,"PROSES REGISTRASI BELUM SELESAI",'LBR',1,"C");
			}
			
			
			$pdf->Cell(10,20,'',0,1);
			// $pdf->ln(15);
			$no=$no+12;
		}
        // $pdf->SetFont('Arial','B',10);
        // $pdf->Cell(10,10,"No",1,0);
        // $pdf->Cell(30,10,"Nim",1,0);
        // $pdf->Cell(60,10,"Nama",1,0);
        // $pdf->Cell(60,5,"Semester",1,0,"C");
        // $pdf->Cell(45,10,"Tgl Terdaftar",1,0,"C");
        // $pdf->Cell(40,5,"Status",1,0,"C");
        // $pdf->Cell(0,5,"",0,1);
        // $pdf->Cell(100,5,"",0,0);
        // $pdf->Cell(20,5,"sebelum",1,0,"C");
        // $pdf->Cell(20,5,"daftar",1,0,"C");
        // $pdf->Cell(20,5,"aktif",1,0,"C");
        // $pdf->Cell(45,5,"",0,0);
        // $pdf->Cell(20,5,"aa",1,0,"C");
        // $pdf->Cell(20,5,"aa",1,1,"C");


		$pdf->Output('I','Cetak.pdf');
	}
}

/* End of file Registrasi.php */
/* Location: ./application/modules/registrasi/controllers/Registrasi.php */