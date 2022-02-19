<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman_m extends CI_Model {
	var $table = 'pengumuman'; //nama tabel dari database
	var $column_order = array(null, 'akademik_id','no_pengumuman','isi_pengumuman','send_kabak','send_wadir'); //field yang ada di table user
	var $column_search = array('no_pengumuman'); //field yang diizin untuk pencarian 
	var $order = array('id_pengumuman' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	private function _get_datatables_query()
	{
		
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
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function getDsnByid($id)
	{
		return $this->db->get_where($this->table, array('id_dosen' =>$id))->row();
	}

	public function getJoinTakad($id)
	{
		$this->db->select('*');
		$this->db->from('pengumuman a');
		$this->db->join('m_takad b', 'a.akademik_id = b.id_thnakad', 'inner');
		$this->db->where('a.id_pengumuman', $id);
		return $this->db->get()->row();
	}

	public function getReview($id_p,$role_id)
	{
		return $this->db->get_where('pengumuman_review',array('pengumuman_id' =>$id_p ,'reviewer_id'=>$role_id ));
	}
	
	

}

/* End of file Pengumuman.php */
/* Location: ./application/modules/pengumuman/models/Pengumuman.php */