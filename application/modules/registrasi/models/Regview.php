<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regview extends CI_Model {
	var $table = 'm_mahasiswa a'; //nama tabel dari database
	var $column_order = array(null, 'nim','nama','email','prodi_id','semester_id','jenis_k','kelas_id'); //field yang ada di table user
	var $column_search = array('nim','nama'); //field yang diizin untuk pencarian 
	var $order = array('nim' => 'DESC'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	private function _get_datatables_query()
	{
		
		$this->db->select('a.id_mhs,a.nim,a.nama,a.prodi_id,a.semester_id,(SELECT semester_sebelum FROM ru_reregis c WHERE c.mhs_id=a.id_mhs AND takad_id='.$this->input->post('takad_id').')as sb_,(SELECT semester_pengajuan FROM ru_reregis c WHERE c.mhs_id=a.id_mhs AND takad_id='.$this->input->post('takad_id').')as sp_,(SELECT status FROM ru_reregis c WHERE c.mhs_id=a.id_mhs AND takad_id='.$this->input->post('takad_id').')as st_,(SELECT valid_st FROM ru_reregis c WHERE c.mhs_id=a.id_mhs AND takad_id='.$this->input->post('takad_id').')as stv_,(SELECT tgl_terdaftar FROM ru_reregis c WHERE c.mhs_id=a.id_mhs AND takad_id='.$this->input->post('takad_id').')as tgl_,(SELECT id_rreg FROM ru_reregis c WHERE c.mhs_id=a.id_mhs AND takad_id='.$this->input->post('takad_id').')as idreg_');
		$this->db->from($this->table);
		if($this->input->post('takad_id'))
		{
			// $this->db->where('(SELECT COUNT(mhs_id) FROM ru_reregis b WHERE b.mhs_id=a.id_mhs AND takad_id='.$this->input->post('takad_id').' AND b.status="Proses")=1');
			if ($this->input->post('keyreg')=='') {
				$this->db->where('(SELECT COUNT(b.mhs_id) FROM ru_reregis b WHERE b.mhs_id=a.id_mhs AND takad_id='.$this->input->post('takad_id').')=0');
			}
			if ($this->input->post('keyreg')=='proses') {
				$this->db->where('(SELECT COUNT(mhs_id) FROM ru_reregis b WHERE b.mhs_id=a.id_mhs AND takad_id='.$this->input->post('takad_id').' AND b.status="Proses")=1');
			}
			if ($this->input->post('keyreg')=='selesai') {
				$this->db->where('(SELECT COUNT(mhs_id) FROM ru_reregis b WHERE b.mhs_id=a.id_mhs AND takad_id='.$this->input->post('takad_id').' AND b.status!="Proses")=1');
			}
			if ($this->input->post('keyreg')=='tunda') {
				$this->db->where('(SELECT COUNT(mhs_id) FROM ru_reregis b WHERE b.mhs_id=a.id_mhs AND takad_id='.$this->input->post('takad_id').' AND b.status="Tunda")=1');
			}
			
		}
		
		if($this->input->post('prodi_id'))
		{
			$this->db->where('prodi_id', $this->input->post('prodi_id'));
		}
		if($this->input->post('semester_id'))
		{
			$this->db->where('semester_id', $this->input->post('semester_id'));
		}
		if($this->input->post('kelas_id'))
		{
			$this->db->where('kelas_id', $this->input->post('kelas_id'));
		}

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);

				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->_get_datatables_query();
		return $this->db->count_all_results();
	}
	
	public function DataViewValidasi($id)
	{
		$this->db->select('b.validator,a.status,a.tgl_valid,a.pesan');
		$this->db->from('tr_rurregis a');
		$this->db->join('ru_validator b', 'a.validator=b.id_validator', 'inner');
		$this->db->where('ru_reg_id', $id);
		return $this->db->get()->result();
	}
	

}

/* End of file Regview.php */
/* Location: ./application/modules/registrasi/models/Regview.php */