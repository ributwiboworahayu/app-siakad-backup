<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Distribusi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllKurikulum($pid)
    {
        $psid = $pid['prodi_id'];
        $query = "SELECT `r_kurikulum`.*, `m_prodi_kaprodi`.`dosen_id`
        FROM `r_kurikulum`
        JOIN `m_prodi_kaprodi`
        ON `r_kurikulum`.`prodi_id` = `m_prodi_kaprodi`.`prodi_id`
        WHERE `m_prodi_kaprodi`.`prodi_id` = $psid
        ";
        return $this->db->query($query);
    }

    public function getSetting()
    {
        $this->db->select('a.id, b.kode_prodi, b.nama_prodi, c.thun_akademik, a.status_portal, a.status_submit, a.status_baak');
        $this->db->from('r_distribusi_setting a');
        $this->db->join('m_prodi b', 'a.prodi_id=b.kode_prodi', 'inner');
        $this->db->join('m_takad c', 'a.takad_id=c.id_thnakad', 'inner');
        return $this->db->get();
    }

    public function getSubmit($prodiid)
    {
        $this->db->where('prodi_id', $prodiid);
        $this->db->where('dosen_lintas_id', 0);
        return $this->db->get('r_distribusi_lp');
    }

    public function getDistri1($prodiid, $dsid, $thnakad)
    {
        $this->db->select('*');
        $this->db->from('r_distribusi a');
        $this->db->join('m_dosen b', 'a.dosen_id=b.id_dosen', 'inner');
        $this->db->where('a.prodi_id', $prodiid);
        $this->db->where('a.tahunakad_id', $thnakad);
        $this->db->where('a.dosen_id', $dsid);
        $this->db->group_by('a.dosen_id');
        return $this->db->get();
    }

    public function getADistri1($prodiid, $thnakad)
    {
        $this->db->select('*');
        $this->db->from('r_distribusi a');
        $this->db->join('m_dosen b', 'a.dosen_id=b.id_dosen', 'inner');
        $this->db->where('a.prodi_id', $prodiid);
        $this->db->where('a.tahunakad_id', $thnakad);
        $this->db->group_by('a.dosen_id');
        return $this->db->get();
    }

    public function getAllDistri1()
    {
        $this->db->select('*');
        $this->db->from('r_distribusi a');
        $this->db->join('m_dosen b', 'a.dosen_id=b.id_dosen', 'inner');
        $this->db->group_by('a.dosen_id');
        return $this->db->get();
    }

    public function getDosenLP($prodiid, $ta)
    {
        $this->db->select('*');
        $this->db->from('r_distribusi_lp a');
        $this->db->join('m_prodi b', 'a.prodi_lintas_id=b.kode_prodi', 'inner');
        $this->db->join('m_kelas c', 'a.kelas_id=c.id_kelas', 'inner');
        $this->db->join('r_matakuliah d', 'a.matkul_id=d.id', 'inner');
        $this->db->join('m_dosen e', 'a.dosen_lintas_id=e.id_dosen', 'inner');
        $this->db->where('a.prodi_id', $prodiid);
        $this->db->where('a.tahunakad_id', $ta);
        return $this->db->get();
    }

    public function form_lp($prodiid)
    {
        $this->db->select('a.prodi_id, a.dosen_lintas_id, a.matkul_id, c.nama_prodi, b.matkul, b.sks');
        $this->db->from('r_distribusi_lp a');
        $this->db->join('r_matakuliah b', 'a.matkul_id=b.id', 'inner');
        $this->db->join('m_prodi c', 'a.prodi_id=c.kode_prodi', 'inner');
        $this->db->where('a.prodi_lintas_id', $prodiid);
        return $this->db->get();
    }

    public function data_lp($prodiid)
    {
        $this->db->select('a.prodi_id, a.dosen_lintas_id, a.matkul_id, c.nama_prodi, c.singkatan, b.matkul, b.sks');
        $this->db->from('r_distribusi_lp a');
        $this->db->join('r_matakuliah b', 'a.matkul_id=b.id', 'inner');
        $this->db->join('m_prodi c', 'a.prodi_lintas_id=c.kode_prodi', 'inner');
        $this->db->where('a.prodi_id', $prodiid);
        return $this->db->get();
    }

    public function getDosenLB($prodiid, $ta)
    {
        $this->db->select('*');
        $this->db->from('r_distribusi_lb a');
        $this->db->join('r_dlb b', 'a.dosen_lb_id=b.id', 'inner');
        $this->db->join('r_matakuliah c', 'a.matkul_id=c.id', 'inner');
        $this->db->join('m_kelas d', 'a.kelas_id=d.id_kelas', 'inner');
        $this->db->where('a.prodi_id', $prodiid);
        $this->db->where('a.tahunakad_id', $ta);
        return $this->db->get();
    }

    public function tvalidlp($prodiid, $ta)
    {

        $this->db->select('*');
        $this->db->from('r_distribusi_lp a');
        $this->db->join('m_prodi b', 'a.prodi_lintas_id=b.kode_prodi', 'inner');
        $this->db->join('m_kelas c', 'a.kelas_id=c.id_kelas', 'inner');
        $this->db->join('r_matakuliah d', 'a.matkul_id=d.id', 'inner');
        $this->db->join('m_dosen e', 'a.dosen_lintas_id=e.id_dosen', 'inner');
        $this->db->where('a.prodi_id', $prodiid);
        $this->db->where('a.tahunakad_id', $ta);
        return $this->db->get();
    }

    public function tvalidlb($prodiid, $ta)
    {
        $this->db->select('*');
        $this->db->from('r_distribusi_lb a');
        $this->db->join('r_dlb b', 'a.dosen_lb_id=b.id', 'inner');
        $this->db->join('r_matakuliah c', 'a.matkul_id=c.id', 'inner');
        $this->db->join('m_kelas d', 'a.kelas_id=d.id_kelas', 'inner');
        $this->db->where('a.prodi_id', $prodiid);
        $this->db->where('a.tahunakad_id', $ta);
        return $this->db->get();
    }

    public function getMatkulDistri($kur, $smtnow)
    {
        $this->db->where('kurikulum_id', $kur);
        $this->db->where('semester_id', $smtnow);
        return $this->db->get('r_matakuliah');
    }

    public function getKelasType($smtid, $prodiid)
    {
        $this->db->where('prodi_id', $prodiid);
        $this->db->where('semester_id', $smtid);
        $this->db->join('m_kelas', 'm_mahasiswa.kelas_id=m_kelas.id_kelas', 'inner');
        $this->db->group_by('kelas_id');
        return $this->db->get('m_mahasiswa');
    }

    public function getInsertDs($idmk, $idkelas, $dske)
    {
        $this->db->where('dosen_ke', $dske);
        $this->db->where('kelas_id', $idkelas);
        $this->db->where('matkul_id', $idmk);
        return $this->db->get('r_distribusi');
    }

    public function getInsertDsLb($idmk, $idkelas, $dske, $table)
    {
        $this->db->where('dosen_ke', $dske);
        $this->db->where('kelas_id', $idkelas);
        $this->db->where('matkul_id', $idmk);
        return $this->db->get($table);
    }

    public function getInsertDsLuar($idmk, $idkelas, $dske, $prid, $table)
    {
        $this->db->where('dosen_ke', $dske);
        $this->db->where('kelas_id', $idkelas);
        $this->db->where('matkul_id', $idmk);
        $this->db->where('prodi_id', $prid);
        return $this->db->get($table);
    }

    public function delDistribusi1($prodiid, $idkelas, $idmk, $table)
    {
        $this->db->where('dosen_ke', 1);
        $this->db->where('prodi_id', $prodiid);
        $this->db->where('kelas_id', $idkelas);
        $this->db->where('matkul_id', $idmk);
        $this->db->delete($table);
    }

    public function delDistribusi2($prodiid, $idkelas, $idmk, $table)
    {
        $this->db->where('dosen_ke', 1);
        $this->db->where('prodi_id', $prodiid);
        $this->db->where('kelas_id', $idkelas);
        $this->db->where('matkul_id', $idmk);
        $this->db->delete($table);
    }

    public function editDistribusi($table, $id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($table, $data);
    }

    public function submitDistribusi($table, $prodiid, $data)
    {
        $this->db->where('prodi_id', $prodiid);
        $this->db->update($table, $data);
    }

    public function hapusDistribusi($id, $table)
    {
        $this->db->where('id', $id);
        $this->db->delete($table);
    }
}
