<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Validasi extends CI_Model {

	var $table = 'ru_reregis'; //nama tabel dari database
	var $column_order = array(null, 'nim','nama','email','prodi_id','semester_id','jenis_k','kelas_id'); //field yang ada di table user
	var $column_search = array('nim','nama'); //field yang diizin untuk pencarian 
	var $order = array('id_mhs' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	private function _get_datatables_query()
	{
		
		$this->db->join('m_mahasiswa', 'm_mahasiswa.id_mhs = ru_reregis.mhs_id', 'inner');
		if($this->input->post('takad_id'))
		{
			$this->db->where('takad_id',$this->input->post('takad_id'));
		}
		if($this->input->post('prodi_id'))
		{
			$this->db->where('prodi_id', $this->input->post('prodi_id'));
		}
		if($this->input->post('semester_id'))
		{
			$this->db->where('semester_sebelum', $this->input->post('semester_id'));
		}
		if($this->input->post('kelas_id'))
		{
			$this->db->where('kelas_id', $this->input->post('kelas_id'));
		}
		$this->db->from($this->table);

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
	

}

/* End of file Validasi.php */
/* Location: ./application/modules/registrasi/models/Validasi.php */