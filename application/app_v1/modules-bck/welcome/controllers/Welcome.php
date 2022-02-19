<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$valid_login=$this->session->userdata('login');
		if($valid_login !=TRUE && $this->session->userdata('email')==''){
          redirect(base_url().'login','refresh');
        }else{
        	redirect(base_url().'welcome/role','refresh');
        }
		
		
	}
		public function role($id=NULL)
	{
		hasLOGIN();
	
		if ($id==NULL) {
		$email=$this->session->userdata('email');
		$cek_role=$this->db->get_where('user_trakses', array('email' =>$email ));
		if ($cek_role->num_rows()==1) {
			$idl=$cek_role->row();

			$jabatan=$this->db->get_where('user_level',array('id_level' =>$idl->level_id))->row();
		
			$role = array(
				'id_jabatan' => $idl->level_id,
				'role_st' => $jabatan->level
			);
			
			$this->session->set_userdata( $role );
			$data['title_page']="Dashboard";
			$data['page']="content/dashboard";
			$this->load->view('page2',$data);
		}else{
			$this->db->select('*');
			$this->db->from('user_trakses');
			$this->db->join('user_level', 'user_trakses.level_id = user_level.id_level', 'inner');
			$this->db->where('user_trakses.email', $email);
			$data['role']=$this->db->get()->result();
			$data['title_page']="Dashboard";
			$data['page']="content/dashboard";
			$this->load->view('page1',$data);

		}
		}else{
			$jabatan=$this->db->get_where('user_level',array('id_level' =>$id))->row();
		
			$role = array(
				'id_jabatan' => $id,
				'role_st' => $jabatan->level
			);
			
			$this->session->set_userdata( $role );
			$data['title_page']="Dashboard";
			$data['page']="content/dashboard";
			$this->load->view('page2',$data);
		}
		
	}

	public function grafik()
	{
		$sql="SELECT DISTINCT(LEFT(nim,4))as tahun, COUNT(id_mhs) as jumlahdata FROM m_mahasiswa GROUP BY LEFT(nim,4) ";
		$grafik=$this->db->query($sql)->result();
		$data = array();
		foreach ($grafik as $d) {
			$row = array();
			$row['tahun']=$d->tahun;
			$row['jumlahdata']=$d->jumlahdata;
			$data[]=$row;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));

	}

	public function grafikprodi()
	{
		$sql="SELECT COUNT(id_mhs) as jumlahdata,b.singkatan prodi FROM m_mahasiswa a INNER JOIN m_prodi b ON a.prodi_id=b.kode_prodi GROUP BY prodi_id";
		$grafik=$this->db->query($sql)->result();
		$data = array();
			$data['data']=$grafik;
			$data['xkeys']='prodi';
			$data['ykeys']='jumlahdata';
			$data['labels']='jumlahdata';
		// foreach ($grafik as $d) {
		// 	$row = array();
		// 	$row['prodi']=$d->prodi;
		// 	$row['jumlahdata']=$d->jumlahdata;
		// 	$data[]=$row;
		// }
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function morisjs()
	{
		$sql="SELECT DISTINCT(LEFT(nim,4))as tahun, COUNT(id_mhs) as jumlahdata FROM m_mahasiswa GROUP BY LEFT(nim,4) ";
		$grafik=$this->db->query($sql)->result();
		$data = array();
			$data['data']=$grafik;
			$data['xkeys']='tahun';
			$data['ykeys']='jumlahdata';
			$data['labels']='jumlahdata';

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function grafikjmlprodi()
	{
		$sqlTahun=$this->db->query("SELECT DISTINCT(LEFT(nim,4))as tahun FROM m_mahasiswa GROUP BY LEFT(nim,4)")->result();
		$data = array();
			foreach ($sqlTahun as $thn) {
				$row = array();
				$row['tahun']=$thn->tahun;
				$getProdi=$this->db->get('m_prodi')->result();
				$prd = array();
				foreach ($getProdi as $prodi) {
					$jumlah=$this->db->query("SELECT COUNT(id_mhs) as jumlahdata FROM m_mahasiswa WHERE prodi_id='".$prodi->kode_prodi."' AND LEFT(nim,4)='".$thn->tahun."'  GROUP BY LEFT(nim,4)")->row();
					$row[$prodi->singkatan]=$jumlah->jumlahdata;
					$prd[]=$prodi->singkatan;
				}
				
				$data[]=$row;
			}
			
			$jsn['data']=$data;
			$jsn['xkeys']='tahun';
			$jsn['ykeys']=$prd;
			$jsn['xlabels']=$prd;
		$this->output->set_content_type('application/json')->set_output(json_encode($jsn));
	}

}

/* End of file Welcome.php */
/* Location: ./application/modules/welcome/controllers/Welcome.php */