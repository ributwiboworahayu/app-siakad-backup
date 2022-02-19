<?php

defined('BASEPATH') or exit('No direct script access allowed');

class R_model extends CI_Model
{

    public function getProdiAll()
    {
        return $this->db->get('m_prodi')->result();
    }

    public function create($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function hapusData($id, $table)
    {
        $this->db->where('id', $id);
        $this->db->delete($table);
    }
}
