<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_reg extends CI_Model {

	var $table = 'm_takad'; //nama tabel dari database
	var $column_order = array(null, 'thun_akademik','ta_tipe','keterangan','status'); //field yang ada di table user
	var $column_search = array('thun_akademik'); //field yang diizin untuk pencarian 
	var $order = array('id_thnakad' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	private function _get_datatables_query()
	{
		if($this->input->post('takad_id')){
			$this->db->where('id_thnakad', $this->input->post('takad_id'));
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

	function getHistoriDetail($id)
	{
		$sql="SELECT * FROM tr_rurregis a INNER JOIN ru_validator b ON a.validator=b.id_validator WHERE ru_reg_id='".$id."'";

		return $this->db->query($sql);
	}

}

/* End of file Data_reg.php */
/* Location: ./application/modules/registrasi/models/Data_reg.php */