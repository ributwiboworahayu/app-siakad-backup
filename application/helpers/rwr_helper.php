<?php

function check_status($id, $status)
{
    $ci = get_instance();

    $result = $ci->db->get_where('r_distribusi_setting', ['id' => $id, 'status_portal' => $status])->row();

    if ($result->status_portal == 1) {
        return "checked='checked'";
    }
}

function check_submit($id, $submit)
{
    $ci = get_instance();

    $result = $ci->db->get_where('r_distribusi_setting', ['id' => $id, 'status_submit' => $submit])->row();

    if ($result->status_submit == 1) {
        return "checked='checked'";
    } elseif ($result->status_submit == 2) {
        return "checked='checked'";
    }
}

function set_dosendist($dsid)
{

    $ci = get_instance();

    $ci->db->select('a.id_distribusi, a.status_baak, a.status_wadir, a.keterangan, b.matkul, b.semester_id, b.teori, b.praktek, c.nama_kelas, d.thun_akademik');
    $ci->db->from('r_distribusi a');
    $ci->db->join('r_matakuliah b', 'a.matkul_id=b.id', 'inner');
    $ci->db->join('m_kelas c', 'a.kelas_id=c.id_kelas', 'inner');
    $ci->db->join('m_takad d', 'a.tahunakad_id=d.id_thnakad', 'inner');
    $ci->db->where('a.dosen_id', $dsid);
    return $ci->db->get();
}

function set_totalsum($iddosen)
{
    $ci = get_instance();

    $ci->db->select('sum(b.teori) as t, sum(b.praktek) as p');
    $ci->db->join('r_matakuliah b', 'a.matkul_id=b.id', 'inner');
    return $ci->db->get_where('r_distribusi a', ['a.dosen_id' => $iddosen])->row();
}

function set_mkselect($idk, $idmk, $table, $dske)
{
    $ci = get_instance();
    $ci->db->where('kelas_id', $idk);
    $ci->db->where('matkul_id', $idmk);
    $ci->db->where('dosen_ke', $dske);
    return $ci->db->get($table)->row();
}

function set_mkuliah($kkd, $smtid)
{
    $ci = get_instance();
    $ci->db->where('kurikulum_id', $kkd);
    $ci->db->where('semester_id', $smtid);
    return $ci->db->get('r_matakuliah');
}

function set_tdist($dsid)
{
    $ci = get_instance();
    $ci->db->select('a.id_distribusi, a.status_baak, a.status_wadir, a.keterangan, b.matkul, b.semester_id, b.teori, b.praktek, c.nama_kelas, d.thun_akademik');
    $ci->db->from('r_distribusi a');
    $ci->db->join('r_matakuliah b', 'a.matkul_id=b.id', 'inner');
    $ci->db->join('m_kelas c', 'a.kelas_id=c.id_kelas', 'inner');
    $ci->db->join('m_takad d', 'a.tahunakad_id=d.id_thnakad', 'inner');
    $ci->db->where('a.dosen_id', $dsid);
    return $ci->db->get();
}

function set_sumtdist($dsid)
{
    $ci = get_instance();
    $ci->db->select('sum(b.teori) as t, sum(b.praktek) as p');
    $ci->db->join('r_matakuliah b', 'a.matkul_id=b.id', 'inner');
    return $ci->db->get_where('r_distribusi a', ['a.dosen_id' => $dsid])->row();
}

function set_tvalid($dsid)
{
    $ci = get_instance();

    $ci->db->select('a.id_distribusi, a.status_baak, a.status_wadir, a.keterangan, b.matkul, b.semester_id, b.teori, b.praktek, c.nama_kelas, d.thun_akademik');
    $ci->db->from('r_distribusi a');
    $ci->db->join('r_matakuliah b', 'a.matkul_id=b.id', 'inner');
    $ci->db->join('m_kelas c', 'a.kelas_id=c.id_kelas', 'inner');
    $ci->db->join('m_takad d', 'a.tahunakad_id=d.id_thnakad', 'inner');
    $ci->db->where('a.dosen_id', $dsid);
    return $ci->db->get();
}

function set_sumtvalid($dsid)
{
    $ci = get_instance();
    $ci->db->select('sum(b.teori) as t, sum(b.praktek) as p');
    $ci->db->join('r_matakuliah b', 'a.matkul_id=b.id', 'inner');
    return $ci->db->get_where('r_distribusi a', ['a.dosen_id' => $dsid])->row();
}
