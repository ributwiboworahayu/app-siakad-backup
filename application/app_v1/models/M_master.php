<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_master extends CI_Model {
	public function getProdiAll()
	{
		return $this->db->get('m_prodi')->result();
	}

	public function create($table,$data,$batch=false)
	{
		if ($batch==true) {
			return $this->db->insert_batch($table, $data);
		}else{
			return $this->db->insert($table, $data);
		}
		
	}

	public function update($table,$pk,$id,$data)
	{
		$this->db->where($pk, $id);
		return $this->db->update($table, $data);

	}
	
	public function viewData($table,$data=null,$where=false)
	{
		if ($where===false) {
			return $this->db->get($table);
		}else{
			return $this->db->get_where($table, $data );
		}
	}

}

/* End of file M_master.php */
/* Location: ./application/models/M_master.php */