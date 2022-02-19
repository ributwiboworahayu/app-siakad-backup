<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Setting extends CI_Model {
	var $table = 'ru_setting'; //nama tabel dari database
	var $column_order = array(null, 'thn_akd','tgl_mulai','tgl_selesai','status'); //field yang ada di table user
	var $column_search = array('thn_akd'); //field yang diizin untuk pencarian 
	var $order = array('id_setting' => 'asc'); // default order 

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

	function getConfigReg($semester)
	{
		$sql="SELECT id_setting,thn_akd,tgl_mulai,tgl_bts_reg,tgl_selesai,status, CASE WHEN NOW() < tgl_mulai THEN '0' WHEN NOW() >= tgl_mulai AND NOW() <= tgl_bts_reg THEN '1' ELSE '2' END AS stt FROM ru_setting WHERE status=1 and semester_id='".$semester."'";
		return $this->db->query($sql);
	}

	function getDataValidasi($mail,$takad)
	{
		$sql="SELECT a.email,d.validator,c.status,c.tgl_valid,c.pesan FROM m_mahasiswa a INNER JOIN ru_reregis b ON a.id_mhs=b.mhs_id INNER JOIN tr_rurregis c ON b.id_rreg=c.ru_reg_id INNER JOIN ru_validator d ON c.validator=d.id_validator WHERE a.email='".$mail."' AND b.takad_id='".$takad."' ";
		return $this->db->query($sql);
	}
	

}

/* End of file Setting.php */
/* Location: ./application/modules/registrasi/models/Setting.php */