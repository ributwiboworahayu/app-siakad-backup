<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Distribusi extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        hasLOGIN();
        $this->load->library('excel');
        $this->load->library('R_pdf');
        $this->load->library('kalender');
        $this->load->model('R_model', 'rmod');
        $this->load->model('Distribusi_model', 'rbmod');
    }

    public function index()
    {
        $email = $this->session->userdata('email');
        $pid = $this->db->get_where('m_dosen', ['email' => $email])->row_array();
        $uid = $pid['id_dosen'];
        $namaprodi = $this->db->get_where('m_prodi', ['ketua_id' => $uid])->row_array();
        $prodiid = $namaprodi['kode_prodi'];

        $waktu = $this->db->get_where('r_distribusi_setting', ['prodi_id' => $prodiid])->row();

        if ($waktu->status_portal != 1 || $waktu->status_submit != 0) {
            $this->distribusiAjar();
        } else {
            $this->tambahDistribusi();
        }
    }

    public function distribusiAjar()
    {
        $email = $this->session->userdata('email');
        $pid = $this->db->get_where('m_dosen', ['email' => $email])->row_array();
        $uid = $pid['id_dosen'];
        $ta = $this->db->get_where('m_takad', ['status' => 1])->row_array();
        $namaprodi = $this->db->get_where('m_prodi', ['ketua_id' => $uid])->row_array();
        $prodiid = $namaprodi['kode_prodi'];

        $data['vstatus'] = $this->db->get_where('r_distribusi', ['prodi_id' => $namaprodi['kode_prodi']])->row();
        $data['alasan'] = $this->db->get_where('r_penolakan', ['prodi_id' => $namaprodi['kode_prodi'], 'status' => 1])->row();
        $data['dslp'] = $this->rbmod->getDosenLP($prodiid, $ta['id_thnakad']);
        $data['dslb'] = $this->rbmod->getDosenLB($prodiid, $ta['id_thnakad']);
        $data['ta'] = $ta;
        $data['dosen'] = $this->db->get_where('m_dosen', ['prodi_id' => $prodiid])->result();
        $data['title_page'] = 'Distribusi Beban Ajar';
        $data['judul'] = 'DISTRIBUSI BEBAN MENGAJAR SEMESTER ' . $ta['ta_tipe'] . '<br>' . $namaprodi['nama_prodi'] . '  TA. ' . $ta['thun_akademik'] . '<br>POLITEKNIK KAMPAR';
        $data['content'] = 'content/distribusiajar';
        $this->load->view('distribusi/index', $data);
    }

    public function t_dist()
    {

        $dsid = $_GET['dsid'];
        $email = $this->session->userdata('email');
        $pid = $this->db->get_where('m_dosen', ['email' => $email])->row_array();
        $uid = $pid['id_dosen'];
        $namaprodi = $this->db->get_where('m_prodi', ['ketua_id' => $uid])->row_array();
        $thnakad = $this->db->get_where('m_takad', ['status' => 1])->row();
        $prodiid = $namaprodi['kode_prodi'];
        if ($_GET['dsid'] == 'undefined') {
            $data['data1'] = $this->rbmod->getADistri1($prodiid, $thnakad->id_thnakad)->result();
            $data['data11'] = $this->rbmod->getADistri1($prodiid, $thnakad->id_thnakad)->num_rows();
        } else {
            $data['data1'] = $this->rbmod->getDistri1($prodiid, $dsid, $thnakad->id_thnakad)->result();
            $data['data11'] = $this->rbmod->getDistri1($prodiid, $dsid, $thnakad->id_thnakad)->num_rows();
        }

        $this->load->view('content/t_distribusi', $data);
    }

    public function tambahDistribusi()
    {

        $email = $this->session->userdata('email');
        $pid = $this->db->get_where('m_dosen', ['email' => $email])->row_array();
        $uid = $pid['id_dosen'];
        $taid = $this->db->get_where('m_takad', ['status' => 1])->row_array();
        $tatipe = $taid['ta_tipe'];
        $namaprodi = $this->db->get_where('m_prodi', ['ketua_id' => $uid])->row_array();
        $prodiid = $namaprodi['kode_prodi'];

        $data['proid'] = $this->db->get_where('m_prodi', ['ketua_id' => $pid['id_dosen']])->row();
        $data['semester'] = $this->db->get_where('m_semester', ['keterangan' => $tatipe])->result_array();
        $data['kurikulum'] = $this->db->get_where('r_kurikulum', ['prodi_id' => $prodiid])->result_array();
        $data['kcek'] = $this->db->get_where('r_kurikulum', ['prodi_id' => $prodiid])->num_rows();
        $data['title_page'] = 'Distribusi Beban Ajar';
        $data['judul'] = 'Distribusi Beban Mengajar Semester ' . $tatipe . '<br>Politeknik Kampar<br>Tahun Akademik ' . $taid['thun_akademik'];
        $data['content'] = 'content/tambahdistribusi';

        $this->form_validation->set_rules('dosenpk[]', 'Dosen', 'required', [
            'required' => '<strong>Data gagal ditambahkan!</strong> Dosen harus diisi.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('distribusi/index', $data);
        } else {
            $dlp = $this->rbmod->getSubmit($prodiid)->row();
            if ($dlp == null) {
                $data = [
                    'status_submit' => 1,
                    'status_baak' => 0,
                    'status_wadir' => 0,
                    'status_direktur' => 0
                ];
                $status = [
                    'status' => 0
                ];
                $table = 'r_distribusi';
                $tablelp = 'r_distribusi_lp';
                $tablelb = 'r_distribusi_lb';
                $tsetting = 'r_distribusi_setting';
                $ttolak = 'r_penolakan';

                $this->rbmod->submitDistribusi($table, $prodiid, $data);
                $this->rbmod->submitDistribusi($tablelp, $prodiid, $data);
                $this->rbmod->submitDistribusi($tablelb, $prodiid, $data);
                $this->rbmod->submitDistribusi($tsetting, $prodiid, $data);
                $this->rbmod->submitDistribusi($ttolak, $prodiid, $status);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil dikirim!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('distribusi');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data gagal ditambahkan! Dosen Lintas Prodi belum disetujui oleh Prodi Lintas.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('distribusi');
            }
        }
    }

    public function form_dist()
    {
        $idkur = $_GET['idkk'];
        $idsmt = $_GET['idsmt'];

        $email = $this->session->userdata('email');
        $pid = $this->db->get_where('m_dosen', ['email' => $email])->row_array();
        $uid = $pid['id_dosen'];
        $namaprodi = $this->db->get_where('m_prodi', ['ketua_id' => $uid])->row_array();
        $prodiid = $namaprodi['kode_prodi'];

        $data['prodi'] = $this->db->get('m_prodi')->result();
        $data['taid'] = $this->db->get_where('m_takad', ['status' => 1])->row_array();
        $data['prodiid'] = $namaprodi['kode_prodi'];
        $data['matkul'] = $this->rbmod->getMatkulDistri($idkur, $idsmt)->result_array();
        $data['dosen'] = $this->db->get_where('m_dosen', ['prodi_id' => $prodiid])->result_array();
        $data['dosenlb'] = $this->db->get('r_dlb')->result();
        $data['mahasiswa'] = $this->rbmod->getKelasType($idsmt, $prodiid)->result_array();
        $data['idkur'] = $idkur;
        $data['idsmt'] = $idsmt;

        $this->load->view('content/form_dist', $data);
    }

    public function tmbhdata()
    {

        $idtmbh = $_GET['id'];
        $split = explode(":", $idtmbh);

        $idkelas = $split[0];
        $idmk = $split[1];
        $dsid = $split[2];
        $prid = $split[3];
        if ($dsid == 'lintaspr') {
            $prlintasid = $this->db->get_where('m_prodi', ['kode_prodi' => $prid])->row();
            $ket = 'Lintas Prodi ' . $prlintasid->singkatan;
            $prodiid = $this->input->get('prodiid');
            $data = [
                'prodi_id' => $prodiid,
                'prodi_lintas_id' => $prid,
                'dosen_ke' => 1,
                'matkul_id' => $idmk,
                'kelas_id' => $idkelas,
                'tahunakad_id' => $this->input->get('taid'),
                'keterangan' => $ket
            ];

            $table = 'r_distribusi_lp';
            $result = $this->rbmod->getInsertDsLuar($idmk, $idkelas, 1, $prodiid, $table);

            if ($result->num_rows() < 1) {
                $this->db->insert('r_distribusi_lp', $data);
                $this->rbmod->delDistribusi1($prodiid, $idkelas, $idmk, 'r_distribusi');
                $this->rbmod->delDistribusi1($prodiid, $idkelas, $idmk, 'r_distribusi_lb');
            } else {
                $this->db->where('dosen_ke', 1);
                $this->db->where('prodi_id', $this->input->get('prodiid'));
                $this->db->where('kelas_id', $idkelas);
                $this->db->where('matkul_id', $idmk);
                $this->db->update('r_distribusi_lp', $data);
            }
        } elseif ($dsid == 'dlb') {
            $prlintasid = $this->db->get_where('m_prodi', ['kode_prodi' => $prid])->row();
            $ket = 'DLB ' . $prlintasid->singkatan;
            $prodiid = $this->input->get('prodiid');

            $data = [
                'prodi_id' => $prodiid,
                'dosen_lb_id' => $prid,
                'dosen_ke' => 1,
                'matkul_id' => $idmk,
                'kelas_id' => $idkelas,
                'tahunakad_id' => $this->input->get('taid'),
                'keterangan' => $ket
            ];

            $table = 'r_distribusi_lb';
            $result = $this->rbmod->getInsertDsLb($idmk, $idkelas, 1, $table);

            if ($result->num_rows() < 1) {
                $this->db->insert('r_distribusi_lb', $data);
                $this->rbmod->delDistribusi1($prodiid, $idkelas, $idmk, 'r_distribusi');
                $this->rbmod->delDistribusi1($prodiid, $idkelas, $idmk, 'r_distribusi_lp');
            } else {
                $this->db->where('dosen_ke', 1);
                $this->db->where('kelas_id', $idkelas);
                $this->db->where('matkul_id', $idmk);
                $this->db->update('r_distribusi_lb', $data);
            }
        } else {
            $dosenid = $dsid;
            $prname = $this->db->get_where('m_prodi', ['kode_prodi' => $prid])->row();
            $ket = 'Prodi Lokal ' . $prname->singkatan;
            $prodiid = $this->input->get('prodiid');

            $data = [
                'prodi_id' => $prodiid,
                'dosen_id' => $dosenid,
                'dosen_ke' => 1,
                'matkul_id' => $idmk,
                'kelas_id' => $idkelas,
                'tahunakad_id' => $this->input->get('taid'),
                'keterangan' => $ket
            ];

            $result = $this->rbmod->getInsertDs($idmk, $idkelas, 1);

            if ($result->num_rows() < 1) {
                $this->db->insert('r_distribusi', $data);
                $this->rbmod->delDistribusi1($prodiid, $idkelas, $idmk, 'r_distribusi_lp');
                $this->rbmod->delDistribusi1($prodiid, $idkelas, $idmk, 'r_distribusi_lb');
            } else {
                $this->db->where('dosen_ke', 1);
                $this->db->where('kelas_id', $idkelas);
                $this->db->where('matkul_id', $idmk);
                $this->db->update('r_distribusi', $data);
            }
        }
    }

    public function hpsDataDua()
    {
        $id = $this->input->get('id');
        $split = explode(":", $id);

        $idkelas = $split[0];
        $dsid = $split[2];
        $this->db->where('dosen_id', $dsid);
        $this->db->where('dosen_ke', 2);
        $this->db->where('kelas_id', $idkelas);
        $this->db->delete('r_distribusi');
    }

    public function tmbhdatadua()
    {

        $idtmbh = $_GET['id'];
        $split = explode(":", $idtmbh);

        $idkelas = $split[0];
        $idmk = $split[1];
        $dsid = $split[2];
        $prid = $split[3];
        if ($dsid == 'lintaspr') {
            $prlintasid = $this->db->get_where('m_prodi', ['kode_prodi' => $prid])->row();
            $ket = 'Lintas Prodi ' . $prlintasid->singkatan;
            $prodiid = $this->input->get('prodiid');
            $data = [
                'prodi_id' => $prodiid,
                'prodi_lintas_id' => $prid,
                'dosen_lintas_id' => 0,
                'dosen_ke' => 2,
                'matkul_id' => $idmk,
                'kelas_id' => $idkelas,
                'tahunakad_id' => $this->input->get('taid'),
                'keterangan' => $ket
            ];

            $table = 'r_distribusi_lp';
            $result = $this->rbmod->getInsertDsLuar($idmk, $idkelas, 2, $prid, $table);

            if ($result->num_rows() < 1) {
                $this->db->insert('r_distribusi_lp', $data);
                $this->rbmod->delDistribusi2($prodiid, $idkelas, $idmk, 'r_distribusi');
                $this->rbmod->delDistribusi2($prodiid, $idkelas, $idmk, 'r_distribusi_lb');
            } else {
                $this->db->where('dosen_ke', 1);
                $this->db->where('prodi_id', $this->input->get('prodiid'));
                $this->db->where('kelas_id', $idkelas);
                $this->db->where('matkul_id', $idmk);
                $this->db->update('r_distribusi_lp', $data);
            }
        } elseif ($dsid == 'dlb') {
            $prlintasid = $this->db->get_where('m_prodi', ['kode_prodi' => $prid])->row();
            $ket = 'DLB ' . $prlintasid->singkatan;
            $prodiid = $this->input->get('prodiid');

            $data = [
                'prodi_id' => $prodiid,
                'dosen_lb_id' => $prid,
                'dosen_ke' => 2,
                'matkul_id' => $idmk,
                'kelas_id' => $idkelas,
                'tahunakad_id' => $this->input->get('taid'),
                'keterangan' => $ket
            ];

            $table = 'r_distribusi_lb';
            $result = $this->rbmod->getInsertDsLb($idmk, $idkelas, 2, $table);

            if ($result->num_rows() < 1) {
                $this->db->insert('r_distribusi_lb', $data);
                $this->rbmod->delDistribusi2($prodiid, $idkelas, $idmk, 'r_distribusi');
                $this->rbmod->delDistribusi2($prodiid, $idkelas, $idmk, 'r_distribusi_lp');
            } else {
                $this->db->where('dosen_ke', 2);
                $this->db->where('kelas_id', $idkelas);
                $this->db->where('matkul_id', $idmk);
                $this->db->update('r_distribusi_lb', $data);
            }
        } else {
            $dosenid = $dsid;
            $prname = $this->db->get_where('m_prodi', ['kode_prodi' => $prid])->row();
            $ket = 'Prodi Lokal ' . $prname->singkatan;
            $prodiid = $this->input->get('prodiid');

            $data = [
                'prodi_id' => $prodiid,
                'dosen_id' => $dosenid,
                'dosen_ke' => 2,
                'matkul_id' => $idmk,
                'kelas_id' => $idkelas,
                'tahunakad_id' => $this->input->get('taid'),
                'keterangan' => $ket
            ];

            $result = $this->rbmod->getInsertDs($idmk, $idkelas, 2);

            if ($result->num_rows() < 1) {
                $this->db->insert('r_distribusi', $data);
                $this->rbmod->delDistribusi2($prodiid, $idkelas, $idmk, 'r_distribusi_lp');
                $this->rbmod->delDistribusi2($prodiid, $idkelas, $idmk, 'r_distribusi_lb');
            } else {
                $this->db->where('dosen_ke', 2);
                $this->db->where('kelas_id', $idkelas);
                $this->db->where('matkul_id', $idmk);
                $this->db->update('r_distribusi', $data);
            }
        }
    }

    public function lintasProdi()
    {
        $email = $this->session->userdata('email');
        $pid = $this->db->get_where('m_dosen', ['email' => $email])->row_array();
        $uid = $pid['id_dosen'];
        $namaprodi = $this->db->get_where('m_prodi', ['ketua_id' => $uid])->row_array();
        $data['prodiid'] = $namaprodi['kode_prodi'];
        $prodiid = $namaprodi['kode_prodi'];
        $data['lpd'] = $this->rbmod->form_lp($prodiid);
        $data['lpl'] = $this->rbmod->data_lp($prodiid);
        $data['title_page'] = 'Distribusi Beban Ajar';
        $data['judul'] = 'Dosen Lintas Prodi';
        $data['content'] = 'content/lintasprodi';

        $this->form_validation->set_rules('pildosen[]', 'Dosen', 'required', [
            'required' => '<strong>Data gagal ditambahkan!</strong> Dosen harus diisi.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('distribusi/index', $data);
        } else {
            $dsn = $this->input->post('pildosen');
            foreach ($dsn as $ds) {
                $split = explode(":", $ds);
                $kdprodi = $split[0];
                $idmk = $split[1];
                $dsid = $split[2];

                $this->db->where('prodi_id', $kdprodi);
                $this->db->where('prodi_lintas_id', $prodiid);
                $this->db->where('matkul_id', $idmk);
                $getid = $this->db->get('r_distribusi_lp')->row();
                $insert[] = [
                    'id_distribusi_lp' => $getid->id_distribusi_lp,
                    'dosen_lintas_id' => $dsid

                ];
            }

            $this->db->update_batch('r_distribusi_lp', $insert, 'id_distribusi_lp');
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Dosen Lintas Prodi berhasil ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('distribusi/lintasprodi');
        }
    }

    public function dlb()
    {
        $data['dslb'] = $this->db->get('r_dlb');
        $data['title_page'] = 'Distribusi Beban Ajar';
        $data['content'] = 'content/dosenlb';

        $this->form_validation->set_rules('namadosenlb', 'Dosen', 'required', [
            'required' => '<strong>Data gagal ditambahkan!</strong> Nama Dosen harus diisi.'
        ]);
        $this->form_validation->set_rules('nohp', 'No Hp', 'required', [
            'required' => '<strong>Data gagal ditambahkan!</strong> No HP harus diisi.'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('distribusi/index', $data);
        } else {
            $namadosen = $this->input->post('namadosenlb');
            $nohp = $this->input->post('nohp');

            $data = [
                'namadosen' => $namadosen,
                'nohp' => $nohp
            ];
            $this->db->insert('r_dlb', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Dosen Luar Biasa berhasil ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('distribusi/dlb');
        }
    }

    public function dlbEdit()
    {

        $id = $this->input->post('id');
        $namadosen = $this->input->post('namadosenlb');
        $nohp = $this->input->post('nohp');

        $data = [
            'namadosen' => $namadosen,
            'nohp' => $nohp
        ];
        $table = 'r_dlb';
        $this->rbmod->editDistribusi($table, $id, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Dosen Luar Biasa berhasil diedit!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('distribusi/dlb');
    }

    public function hapusDlb($id)
    {
        $table = 'r_dlb';
        $this->rbmod->hapusDistribusi($id, $table);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Dosen Luar Biasa berhasil dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('distribusi/dlb');
    }

    public function dataajar()
    {
        echo 'OKE';
    }

    public function kurikulum()
    {
        $email = $this->session->userdata('email');
        $pid = $this->db->get_where('m_dosen', ['email' => $email])->row_array();

        $data['kurikulum1'] = $this->rbmod->getAllKurikulum($pid['prodi_id'])->row_array();
        $data['kurikulum'] = $this->rbmod->getAllKurikulum($pid['prodi_id'])->result_array();

        $data['title_page'] = 'Kurikulum';
        $data['content'] = 'content/kurikulum';

        $this->form_validation->set_rules('namakurikulum', 'Nama Kurikulum', 'required', [
            'required' => '<strong>Data gagal ditambahkan!</strong> Nama kurikulum harus diisi.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('distribusi/index', $data);
        } else {
            $data = [
                'tahun' => $this->input->post('tahun'),
                'namakurikulum' => $this->input->post('namakurikulum'),
                'prodi_id' => $pid['prodi_id']
            ];

            $table = 'r_kurikulum';
            $this->rmod->create($table, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Kurikulum berhasil ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('distribusi/kurikulum', $data);
        }
    }

    public function hapusKurikulum($id)
    {
        $table = 'r_kurikulum';
        $tablemk = 'r_matakuliah';
        $this->rbmod->hapusDistribusi($id, $table);
        $this->rbmod->hapusDistribusi($id, $tablemk);
        redirect('distribusi/kurikulum');
    }

    public function kurikulumEdit()
    {
        $table = 'r_kurikulum';
        $data = [
            'tahun' => $this->input->post('tahun'),
            'namakurikulum' => $this->input->post('namakurikulum')
        ];
        $id = $this->input->post('id');
        $this->rbmod->editDistribusi($table, $id, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Kurikulum berhasil diedit!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('distribusi/kurikulum');
    }

    public function mataKuliah($id = '')
    {

        $email = $this->session->userdata('email');

        $did = $this->db->get_where('m_dosen', ['email' => $email])->row_array();

        if ($id != '') {
            $data['selectkk'] = $id;
        } else {
            $data['selectkk'] = 0;
        }
        $data['kurikulum'] = $this->rbmod->getAllKurikulum($did['prodi_id'])->result();
        $data['kurikulum1'] = $this->rbmod->getAllKurikulum($did['prodi_id'])->num_rows();
        $data['semester'] = $this->db->get('m_semester')->result();
        $data['pid'] = $this->db->get_where('m_prodi_kaprodi', ['dosen_id' => $did['id_dosen']])->row_array();
        $data['kel'] = $this->db->get('r_kel')->result_array();

        $data['title_page'] = 'Mata Kuliah';
        $data['content'] = 'content/matakuliah';

        $this->load->view('distribusi/index', $data);
    }

    public function mataKuliahBaru()
    {
        $data['idkur'] = $this->input->post('kkid');
        $data['smtid'] = $this->input->post('smtid');
        $jumlahmk = $this->input->post('jumlahmk');
        $data['jumlahmk'] = $jumlahmk;
        $data['kel'] = $this->db->get('r_kel')->result();
        $data['title_page'] = 'Mata Kuliah';
        $data['content'] = 'content/tambahmk';

        $this->form_validation->set_rules('kodematkul[]', 'Kode Matkul', 'required', [
            'required' => '<strong>Data gagal ditambahkan!</strong> Kode Matkul harus diisi!'
        ]);
        $this->form_validation->set_rules('matkul[]', 'Kode Matkul', 'required', [
            'required' => '<strong>Data gagal ditambahkan!</strong> Mata Kuliah harus diisi!'
        ]);
        $this->form_validation->set_rules('kel[]', 'Kode Matkul', 'required', [
            'required' => '<strong>Data gagal ditambahkan!</strong> Kelompok harus dipilih!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('distribusi/index', $data);
        } else {
            $idkur = $this->input->post('idkur');
            $smtid = $this->input->post('smtid');
            $kode = $this->input->post('kodematkul');
            $mk = $this->input->post('matkul');
            $kelompok = $this->input->post('kel');
            $teori = $this->input->post('teori');
            $praktek = $this->input->post('praktek');
            $smtket = $this->db->get_where('m_semester', ['id_semester' => $smtid])->row();
            $index = 0;
            foreach ($kode as $kd) {
                $insert[] = [
                    'kurikulum_id' => $idkur,
                    'semester_id' => $smtid,
                    'kodematkul' => $kd,
                    'matkul' => $mk[$index],
                    'kel' => $kelompok[$index],
                    'sks' => $teori[$index] + $praktek[$index],
                    'teori' => $teori[$index],
                    'praktek' => $praktek[$index],
                    'smtket' => $smtket->keterangan
                ];
                $index++;
            }
            $this->db->insert_batch('r_matakuliah', $insert);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Mata kuliah berhasil ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('distribusi/matakuliah/');
        }
    }

    public function mk_data()
    {
        $idkur = $_GET['idkk'];
        $idsmt = $_GET['idsmt'];

        $email = $this->session->userdata('email');
        $pid = $this->db->get_where('m_dosen', ['email' => $email])->row_array();
        $uid = $pid['id_dosen'];

        $data['kel'] = $this->db->get('r_kel')->result_array();
        $data['pid'] = $this->db->get_where('m_prodi_kaprodi', ['dosen_id' => $uid])->row_array();
        $data['kkd'] = $idkur;
        $namakurikulum = $this->db->get_where('r_kurikulum', ['id' => $idkur])->row_array();
        $data['judul'] = 'Kurikulum ' . $namakurikulum['namakurikulum'];
        if ($idsmt == 'undefined') {
            $data['semester'] = $this->db->get('m_semester')->result_array();
        } else {
            $data['semester'] = $this->db->get_where('m_semester', ['id_semester' => $idsmt])->result_array();
        }

        $this->load->view('content/mk_data', $data);
    }


    public function hapusMkuliah()
    {
        $id = $_GET['id'];

        $table = 'r_matakuliah';
        $this->rbmod->hapusDistribusi($id, $table);
    }

    public function matakuliahEdit($kkd)
    {
        $data = [
            'kurikulum_id' => $this->input->post('idkk'),
            'semester_id' => $this->input->post('idsemester'),
            'kodematkul' => $this->input->post('kodematkul'),
            'matkul' => $this->input->post('matkul'),
            'kel' => $this->input->post('kel'),
            'sks' => $this->input->post('sks'),
            'teori' => $this->input->post('teori'),
            'praktek' => $this->input->post('praktek'),
            'smtket' => $this->input->post('keterangansmt')
        ];
        $id = $this->input->post('id');
        $table = 'r_matakuliah';
        $page = $this->uri->segment(5);
        $this->rbmod->editDistribusi($table, $id, $data);
        redirect('distribusi/matakuliah/' . $kkd . '/page/' . $page);
    }


    public function verifikasiSk()
    {

        $data['prodi'] = $this->db->get('m_prodi')->result();
        $data['ta'] = $this->db->get_where('m_takad', ['status' => 1])->row();
        $data['title_page'] = 'Distribusi Beban Ajar';
        $data['content'] = 'content/distribusiakademik';
        $this->load->view('distribusi/index', $data);
    }

    public function t_verif()
    {
        $taid = $this->input->get('taid');
        $prodiid = $this->input->get('prid');

        $ta = $this->db->get_where('m_takad', ['id_thnakad' => $taid])->row();
        $prid = $this->db->get_where('m_prodi', ['kode_prodi' => $prodiid])->row();

        $data['dsnjumlah'] = $this->db->get_where('m_dosen', ['prodi_id' => $prodiid])->num_rows();
        $data['dsnlbjumlah'] = $this->rbmod->getAllLBdist($prodiid)->num_rows();
        $data['alldosen'] = $this->db->get_where('m_dosen', ['prodi_id' => $prodiid])->result();
        $data['ta'] = $ta->id_thnakad;
        $data['dslp'] = $this->rbmod->tvalidlp($prodiid, $taid);
        $data['dslb'] = $this->rbmod->tvalidlb($prodiid, $taid);
        $data['prodiid'] = $prodiid;
        $data['data1'] = $this->rbmod->getADistri1($prodiid, $taid);
        $data['vstatus'] = $this->db->get_where('r_distribusi', ['prodi_id' => $prodiid])->row();
        $data['judul'] = 'DISTRIBUSI BEBAN MENGAJAR SEMESTER ' . $ta->ta_tipe . '<br>' . $prid->nama_prodi . '  TA. ' . $ta->thun_akademik . '<br>POLITEKNIK KAMPAR';

        $this->load->view('content/t_verif', $data);
    }

    public function tolakVerif()
    {
        $prodiid = $this->input->post('prodiid');
        $alasan = $this->input->post('tolakverifikasi');
        $penolak = 'Ka. Baak';
        $prd = $this->db->get_where('m_prodi', ['kode_prodi' => $prodiid])->row();
        $data = [
            'prodi_id' => $prodiid,
            'ditolak_oleh' => $penolak,
            'status' => 1,
            'keterangan' => $alasan
        ];
        $submit = [
            'status_submit' => 2,
            'status_baak' => 2
        ];
        $table = 'r_distribusi';
        $tablelp = 'r_distribusi_lp';
        $tablelb = 'r_distribusi_lb';
        $tablest = 'r_distribusi_setting';
        $this->db->insert('r_penolakan', $data);
        $this->rbmod->submitDistribusi($table, $prodiid, $submit);
        $this->rbmod->submitDistribusi($tablelp, $prodiid, $submit);
        $this->rbmod->submitDistribusi($tablelb, $prodiid, $submit);
        $this->rbmod->submitDistribusi($tablest, $prodiid, $submit);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Penolakan Prodi ' . $prd->singkatan . ' Berhasil! Data dikembalikan ke Kaprodi.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

        redirect('distribusi/verifikasisk');
    }

    public function verifikasiBaak()
    {
        $taid = $this->input->post('taid');
        $prodiid = $this->input->post('prodiid');
        $dosenid = $this->input->post('dosenid');
        $nosk = $this->input->post('nomorsk');
        $endsk = $this->input->post('endsk');
        $prd = $this->db->get_where('m_prodi', ['kode_prodi' => $prodiid])->row();
        $index = 0;
        foreach ($nosk as $sk) {
            $insertsk[] = [
                'prodi_id' => $prodiid,
                'dosen_id' => $dosenid[$index],
                'takad_id' => $taid,
                'no_sk' => $sk . $endsk[$index],
                'tgl_dibuat' => date('Y-m-d H:i:s')
            ];
            $index++;
        }

        $submit = [
            'status_baak' => 1
        ];
        $table = 'r_distribusi';
        $tablelp = 'r_distribusi_lp';
        $tablelb = 'r_distribusi_lb';
        $tablest = 'r_distribusi_setting';
        $table_sk = 'r_sk_dosen_mengajar';

        $this->db->insert_batch($table_sk, $insertsk);
        $this->rbmod->submitDistribusi($table, $prodiid, $submit);
        $this->rbmod->submitDistribusi($tablelp, $prodiid, $submit);
        $this->rbmod->submitDistribusi($tablelb, $prodiid, $submit);
        $this->rbmod->submitDistribusi($tablest, $prodiid, $submit);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Verifikasi Prodi ' . $prd->singkatan . ' Berhasil! Data telah dikirim ke Wadir 1<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

        redirect('distribusi/verifikasisk');
    }

    public function verifikasiwadir()
    {
        $data['prodi'] = $this->db->get('m_prodi')->result();
        $data['ta'] = $this->db->get_where('m_takad', ['status' => 1])->row();
        $data['title_page'] = 'Distribusi Beban Ajar';
        $data['content'] = 'content/distwadir';

        $this->load->view('distribusi/index', $data);
    }

    public function t_verifwadir()
    {
        $taid = $this->input->get('taid');
        $prodiid = $this->input->get('prid');
        $ta = $this->db->get_where('m_takad', ['id_thnakad' => $taid])->row();
        $prid = $this->db->get_where('m_prodi', ['kode_prodi' => $prodiid])->row();


        $data['dslp'] = $this->rbmod->tvalidlp($prodiid, $taid);
        $data['dslb'] = $this->rbmod->tvalidlb($prodiid, $taid);
        $data['prodiid'] = $prodiid;

        $data['ta'] = $ta->status;
        $data['data1'] = $this->rbmod->getADistri1($prodiid, $taid);
        $data['vstatus'] = $this->db->get_where('r_distribusi', ['prodi_id' => $prodiid, 'status_baak' => 1])->row();
        $data['judul'] = 'DISTRIBUSI BEBAN MENGAJAR SEMESTER ' . $ta->ta_tipe . '<br>' . $prid->nama_prodi . '  TA. ' . $ta->thun_akademik . '<br>POLITEKNIK KAMPAR';

        $this->load->view('content/t_verifwadir', $data);
    }

    public function tolakVerifWadir()
    {
        $prodiid = $this->input->post('prodiid');
        $alasan = $this->input->post('tolakverifikasi');
        $penolak = 'Wadir 1';
        $prd = $this->db->get_where('m_prodi', ['kode_prodi' => $prodiid])->row();
        $data = [
            'prodi_id' => $prodiid,
            'ditolak_oleh' => $penolak,
            'status' => 1,
            'keterangan' => $alasan
        ];

        $submit = [
            'status_submit' => 2,
            'status_baak' => 0,
            'status_wadir' => 2
        ];
        $table = 'r_distribusi';
        $tablelp = 'r_distribusi_lp';
        $tablelb = 'r_distribusi_lb';
        $tablest = 'r_distribusi_setting';
        $this->db->delete('r_sk_dosen_mengajar', ['prodi_id' => $prodiid]);
        $this->db->insert('r_penolakan', $data);
        $this->rbmod->submitDistribusi($table, $prodiid, $submit);
        $this->rbmod->submitDistribusi($tablelp, $prodiid, $submit);
        $this->rbmod->submitDistribusi($tablelb, $prodiid, $submit);
        $this->rbmod->submitDistribusi($tablest, $prodiid, $submit);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Penolakan Prodi ' . $prd->singkatan . ' Berhasil! Data dikembalikan ke Kaprodi.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

        redirect('distribusi/verifikasiwadir');
    }

    public function diVerifikasiWadir($id)
    {
        $prodiid = $id;
        $prd = $this->db->get_where('m_prodi', ['kode_prodi' => $id])->row();
        $submit = [
            'status_wadir' => 1
        ];
        $table = 'r_distribusi';
        $tablelp = 'r_distribusi_lp';
        $tablelb = 'r_distribusi_lb';
        $tablest = 'r_distribusi_setting';

        $this->rbmod->submitDistribusi($table, $prodiid, $submit);
        $this->rbmod->submitDistribusi($tablelp, $prodiid, $submit);
        $this->rbmod->submitDistribusi($tablelb, $prodiid, $submit);
        $this->rbmod->submitDistribusi($tablest, $prodiid, $submit);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Verifikasi Prodi ' . $prd->singkatan . ' Berhasil! Data telah dikirim ke Direktur.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

        redirect('distribusi/verifikasiwadir');
    }

    public function validasiDistribusi()
    {
        $data['prodi'] = $this->db->get('m_prodi')->result();
        $data['ta'] = $this->db->get_where('m_takad', ['status' => 1])->row();
        $data['title_page'] = 'Distribusi Beban Ajar';
        $data['content'] = 'content/distdir';
        $this->load->view('distribusi/index', $data);
    }

    public function t_validasi()
    {
        $taid = $this->input->get('taid');
        $prodiid = $this->input->get('prid');

        $ta = $this->db->get_where('m_takad', ['id_thnakad' => $taid])->row();
        $prid = $this->db->get_where('m_prodi', ['kode_prodi' => $prodiid])->row();
        $data['dslp'] = $this->rbmod->tvalidlp($prodiid, $taid);
        $data['dslb'] = $this->rbmod->tvalidlb($prodiid, $taid);
        $data['prodiid'] = $prodiid;
        $data['ta'] = $ta->status;
        $data['data1'] = $this->rbmod->getADistri1($prodiid, $taid);
        $data['vstatus'] = $this->db->get_where('r_distribusi', ['prodi_id' => $prodiid, 'status_baak' => 1])->row();
        $data['judul'] = 'DISTRIBUSI BEBAN MENGAJAR SEMESTER ' . $ta->ta_tipe . '<br>' . $prid->nama_prodi . '  TA. ' . $ta->thun_akademik . '<br>POLITEKNIK KAMPAR';

        $this->load->view('content/t_validasi', $data);
    }

    public function tolakValidasi()
    {
        $prodiid = $this->input->post('prodiid');
        $alasan = $this->input->post('tolakvalidasi');
        $penolak = 'Wadir 1';
        $prd = $this->db->get_where('m_prodi', ['kode_prodi' => $prodiid])->row();
        $data = [
            'prodi_id' => $prodiid,
            'ditolak_oleh' => $penolak,
            'status' => 1,
            'keterangan' => $alasan
        ];
        $submit = [
            'status_submit' => 2,
            'status_baak' => 0,
            'status_wadir' => 0,
            'status_direktur' => 2
        ];
        $table = 'r_distribusi';
        $tablelp = 'r_distribusi_lp';
        $tablelb = 'r_distribusi_lb';
        $tablest = 'r_distribusi_setting';
        $this->db->insert('r_penolakan', $data);
        $this->rbmod->submitDistribusi($table, $prodiid, $submit);
        $this->rbmod->submitDistribusi($tablelp, $prodiid, $submit);
        $this->rbmod->submitDistribusi($tablelb, $prodiid, $submit);
        $this->rbmod->submitDistribusi($tablest, $prodiid, $submit);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Penolakan Prodi ' . $prd->singkatan . ' Berhasil! Data dikembalikan ke Kaprodi.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

        redirect('distribusi/validasidistribusi');
    }

    public function diValidasi($id)
    {
        $prodiid = $id;
        $prd = $this->db->get_where('m_prodi', ['kode_prodi' => $id])->row();
        $submit = [
            'status_direktur' => 1
        ];
        $table = 'r_distribusi';
        $tablelp = 'r_distribusi_lp';
        $tablelb = 'r_distribusi_lb';
        $tablest = 'r_distribusi_setting';

        $this->rbmod->submitDistribusi($table, $prodiid, $submit);
        $this->rbmod->submitDistribusi($tablelp, $prodiid, $submit);
        $this->rbmod->submitDistribusi($tablelb, $prodiid, $submit);
        $this->rbmod->submitDistribusi($tablest, $prodiid, $submit);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Validasi Prodi ' . $prd->singkatan . ' Berhasil! Distribusi Prodi ' . $prd->nama_prodi . ' beban ajar selesai.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

        redirect('distribusi/validasidistribusi');
    }

    public function dataMengajar()
    {
        $email = $this->session->userdata('email');
        $dosen = $this->db->get_where('m_dosen', ['email' => $email])->row();
        $ta = $this->db->get_where('m_takad', ['status' => 1])->row();
        $prid = $this->db->get_where('m_prodi', ['kode_prodi' => $dosen->prodi_id])->row();

        $data['ta'] = $ta;
        $data['distribusi'] = $dosen;
        $data['distdosen'] = $this->db->get_where('r_distribusi', ['prodi_id' => $dosen->prodi_id, 'tahunakad_id' => $ta->id_thnakad, 'status_direktur' => 1])->num_rows();
        $data['content'] = 'content/distribusidosen';
        $data['title_page'] = 'Distribusi Beban Ajar';
        $data['judul'] = 'DISTRIBUSI BEBAN MENGAJAR SEMESTER ' . $ta->ta_tipe . '<br>' . $prid->nama_prodi . '  TA. ' . $ta->thun_akademik . '<br>POLITEKNIK KAMPAR';

        $this->load->view('distribusi/index', $data);
    }

    public function setting()
    {
        $data['prodi'] = $this->db->get('m_prodi')->result();
        $data['ta'] = $this->db->get('m_takad')->result();
        $data['dstport'] = $this->rbmod->getSetting();
        $data['title_page'] = 'Setting Portal Distribusi Beban Mengajar';
        $data['content'] = 'content/setting';

        $this->form_validation->set_rules('prodi', 'Prodi', 'required', [
            'required' => '<strong>Data gagal ditambahkan!</strong> Prodi harus dipilih.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('distribusi/index', $data);
        } else {
            $prodi = $this->input->post('prodi');
            $takad = $this->input->post('takadid');
            $status = $this->input->post('status');

            $data = [
                'prodi_id' => $prodi,
                'takad_id' => $takad,
                'status_portal' => $status
            ];
            $this->db->insert('r_distribusi_setting', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('distribusi/setting');
        }
    }

    public function changePortal()
    {
        $id = $this->input->get('id');
        $status = $this->input->get('statusportal');
        if ($status == 0) {
            $portal = 1;
        } else {
            $portal = 0;
        }
        $data = [
            'status_portal' => $portal
        ];
        $table = 'r_distribusi_setting';
        $this->rbmod->editDistribusi($table, $id, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Portal berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('distribusi/setting');
    }

    public function changeSubmit()
    {
        $id = $this->input->get('id');
        $status = $this->input->get('statussubmit');
        $prodiid = $this->input->get('kodeprodi');
        if ($status == 0) {
            $submit = 1;
        } else {
            $submit = 0;
        }
        $data = [
            'status_submit' => $submit
        ];
        $table = 'r_distribusi_setting';
        $tabled = 'r_distribusi';
        $tablelp = 'r_distribusi_lp';
        $tablelb = 'r_distribusi_lb';
        $this->rbmod->editDistribusi($table, $id, $data);
        $this->rbmod->submitDistribusi($tabled, $prodiid, $data);
        $this->rbmod->submitDistribusi($tablelp, $prodiid, $data);
        $this->rbmod->submitDistribusi($tablelb, $prodiid, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Portal berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('distribusi/setting');
    }

    public function unduhSk($dosenid)
    {
        $namadosen = $this->db->get_where('m_dosen', ['id_dosen' => $dosenid])->row();
        $status = $this->db->get_where('r_distribusi', ['dosen_id' => $dosenid])->row();
        $sk = $this->db->get_where('r_sk_dosen_mengajar', ['dosen_id' => $dosenid])->row();
        $ta = $this->db->get_where('m_takad', ['id_thnakad' => $status->tahunakad_id])->row();
        $prodi = $this->db->get_where('m_prodi', ['kode_prodi' => $status->prodi_id])->row();

        $w = 40;
        $h = 5;

        $pdf = new R_PDF('p', 'mm', [210, 330]);
        $pdf->AddPage();
        $pdf->SKHeader();
        $pdf->ln(8);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(0, 5, 'KEPUTUSAN', 0, 1, 'C');
        $pdf->Cell(0, 5, 'DIREKTUR POLITEKNIK KAMPAR', 0, 1, 'C');
        $pdf->SetFont('Times', '', 12);
        if ($sk != null) {
            // $pdf->Cell(0, 5, 'Nomor : 076.a/PK.1/KEP/BAAK-AKD/09.2021', 0, 1, 'C');
            $pdf->Cell(0, 5, 'Nomor : ' . $sk->no_sk, 0, 1, 'C');
        } else {
            $pdf->Cell(0, 5, 'Nomor : -', 0, 1, 'C');
        }
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(0, 10, 'TENTANG', 0, 1, 'C');
        $pdf->Cell(0, 5, 'PEMBAGIAN TUGAS MENGAJAR', 0, 1, 'C');
        $pdf->Cell(0, 5, 'SEMESTER ' . strtoupper($ta->ta_tipe) . ' TAHUN AKADEMIK ' . $ta->thun_akademik, 0, 1, 'C');
        $pdf->Cell(0, 5, 'POLITEKNIK KAMPAR', 0, 1, 'C');
        $pdf->ln();
        $pdf->Cell(0, 10, 'DIREKTUR POLITEKNIK KAMPAR', 0, 1, 'C');
        $pdf->PasalSKDosen($w, $h);
        $pdf->FooterSKDosen();
        $pdf->AddPage();

        $pdf->ln(25);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(0, 5, 'MEMUTUSKAN', 0, 1, 'C');
        $pdf->ln(10);
        $x_axis = $pdf->getx();
        $pdf->vcell($w, $h, $x_axis + 15, 'MENETAPKAN');
        $pdf->SetFont('Times', 'B', 12);
        $x_axis = $pdf->getx();
        $pdf->vcell($w - 35, $h, $x_axis, ':');
        $x_axis = $pdf->getx();
        $pdf->vcell($w - 35, $h, $x_axis, '');
        $x_axis = $pdf->getx();
        $pdf->vcell($w + 70, $h, $x_axis, '');
        $pdf->ln(7);
        $pdf->SetFont('Times', 'B', 12);
        $x_axis = $pdf->getx();
        $pdf->vcell($w, $h, $x_axis + 15, 'Pertama');
        $x_axis = $pdf->getx();
        $pdf->vcell($w - 35, $h, $x_axis, ':');
        $pdf->SetFont('Times', '', 12);
        $x_axis = $pdf->getx();
        $pdf->vcell($w - 35, $h, $x_axis, '');
        $x_axis = $pdf->getx();
        $pdf->vcell($w + 70, $h, $x_axis, 'Menugaskan tenaga pengajar Politeknik Kampar untuk mengampu mata kuliah sesuai dengan pembagian tugas mengajar semester ' . $ta->ta_tipe . ' Tahun Akademik ' . $ta->thun_akademik . ' sebagai berikut:');

        $pdf->ln(2);
        $pdf->SetFont('Times', 'B', 12);
        $x_axis = $pdf->getx();
        $pdf->vcell($w, $h, $x_axis + 15, '');
        $x_axis = $pdf->getx();
        $pdf->vcell($w - 35, $h, $x_axis, '');
        $pdf->SetFont('Times', '', 12);
        $x_axis = $pdf->getx();
        $pdf->vcell($w - 35, $h, $x_axis, '');
        $x_axis = $pdf->getx();
        $pdf->vcell($w - 5, $h, $x_axis, 'Nama Dosen');
        $x_axis = $pdf->getx();
        $pdf->vcell($w - 35, $h, $x_axis, ':');
        $x_axis = $pdf->getx();
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell($w + 35, $h, $namadosen->nama_dsn);
        $pdf->ln(7);
        $x_axis = $pdf->getx();
        $pdf->vcell($w, $h, $x_axis + 15, '');
        $x_axis = $pdf->getx();
        $pdf->vcell($w - 35, $h, $x_axis, '');
        $pdf->SetFont('Times', '', 12);
        $x_axis = $pdf->getx();
        $pdf->vcell($w - 35, $h, $x_axis, '');
        $x_axis = $pdf->getx();
        $pdf->vcell($w - 5, $h, $x_axis, 'NIDN/NRP');
        $x_axis = $pdf->getx();
        $pdf->vcell($w - 35, $h, $x_axis, ':');
        $x_axis = $pdf->getx();
        $pdf->vcell($w + 35, $h, $x_axis, $namadosen->nidn . '/' . $namadosen->nrp);
        $pdf->ln(7);
        $pdf->SetFont('Times', 'B', 12);
        $x_axis = $pdf->getx();
        $pdf->vcell($w, $h, $x_axis + 15, '');
        $x_axis = $pdf->getx();
        $pdf->vcell($w - 35, $h, $x_axis, '');
        $pdf->SetFont('Times', '', 12);
        $x_axis = $pdf->getx();
        $pdf->vcell($w - 35, $h, $x_axis, '');
        $x_axis = $pdf->getx();
        $pdf->vcell($w - 5, $h, $x_axis, 'Program Studi');
        $x_axis = $pdf->getx();
        $pdf->vcell($w - 35, $h, $x_axis, ':');
        $x_axis = $pdf->getx();
        $pdf->vcell($w + 35, $h, $x_axis, $prodi->nama_prodi);
        $pdf->ln(7);
        $pdf->SetX(76);
        $pdf->SetWidths(array(8, 25, 45, 35));
        $pdf->SetLineHeight(7);
        $pdf->SetAligns(array('', 'C', 'L', '', '', ''));
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(60, 12, "Mata Kuliah", 1, 0, 'C');
        $pdf->Cell(20, 12, "Semester", 1, 0, 'C');
        $pdf->Cell(30, 6, "SKS", 1, 1, 'C');
        $pdf->SetX(156);
        $pdf->Cell(15, 6, "Teori", 1, 0, 'C');
        $pdf->Cell(15, 6, "Praktek", 1, 1, 'C');
        $pdf->SetFont('Times', '', 12);

        $this->db->join('r_matakuliah b', 'a.matkul_id=b.id', 'inner');
        $this->db->join('m_kelas c', 'a.kelas_id=c.id_kelas', 'inner');
        $distribusi = $this->db->get_where('r_distribusi a', ['a.dosen_id' => $dosenid])->result();
        $this->db->join('r_matakuliah b', 'a.matkul_id=b.id', 'inner');
        $this->db->join('m_kelas c', 'a.kelas_id=c.id_kelas', 'inner');
        $distribusilp = $this->db->get_where('r_distribusi_lp a', ['a.dosen_lintas_id' => $dosenid])->result();
        $tjumlah = 0;
        $pjumlah = 0;
        foreach ($distribusi as $ds) {
            $pdf->SetX(76);
            $cellWidthTable = 60;
            $cellHeightTable = 6;
            if ($pdf->GetStringWidth($ds->matkul . ' ' . $ds->nama_kelas) < $cellWidthTable) {
                $line = 1;
            } else {
                $textLength = strlen($ds->matkul . ' ' . $ds->nama_kelas);
                $errMargin = 10;
                $startChar = 0;
                $maxChar = 0;
                $textArray = array();
                $tmpString = "";

                while ($startChar < $textLength) {
                    while (
                        $pdf->GetStringWidth($tmpString) < ($cellWidthTable - $errMargin) &&
                        ($startChar + $maxChar) < $textLength
                    ) {
                        $maxChar++;
                        $tmpString = substr($ds->matkul . ' ' . $ds->nama_kelas, $startChar, $maxChar);
                    }
                    $startChar = $startChar + $maxChar;
                    array_push($textArray, trim($tmpString));
                    $maxChar = 0;
                    $tmpString = '';
                }

                $line = count($textArray);
            }
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            $pdf->Multicell($cellWidthTable, $cellHeightTable, $ds->matkul . ' ' . $ds->nama_kelas, 1, 'L');
            $pdf->SetXY($xPos + $cellWidthTable, $yPos);
            $pdf->Cell(20, ($line * $cellHeightTable), $ds->semester_id, 1, 0, 'C');
            $pdf->Cell(15, ($line * $cellHeightTable), $ds->teori, 1, 0, 'C');
            $pdf->Cell(15, ($line * $cellHeightTable), $ds->praktek, 1, 1, 'C');
            $tjumlah += $ds->teori;
            $pjumlah += $ds->praktek;
        }
        foreach ($distribusilp as $dslp) {
            $pdf->SetX(76);
            $cellWidthTable = 60;
            $cellHeightTable = 6;
            if ($pdf->GetStringWidth($dslp->matkul . ' ' . $dslp->nama_kelas) < $cellWidthTable) {
                $line = 1;
            } else {
                $textLength = strlen($dslp->matkul . ' ' . $dslp->nama_kelas);
                $errMargin = 10;
                $startChar = 0;
                $maxChar = 0;
                $textArray = array();
                $tmpString = "";

                while ($startChar < $textLength) {
                    while (
                        $pdf->GetStringWidth($tmpString) < ($cellWidthTable - $errMargin) &&
                        ($startChar + $maxChar) < $textLength
                    ) {
                        $maxChar++;
                        $tmpString = substr($dslp->matkul . ' ' . $dslp->nama_kelas, $startChar, $maxChar);
                    }
                    $startChar = $startChar + $maxChar;
                    array_push($textArray, trim($tmpString));
                    $maxChar = 0;
                    $tmpString = '';
                }

                $line = count($textArray);
            }
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            $pdf->Multicell($cellWidthTable, $cellHeightTable, $dslp->matkul . ' ' . $dslp->nama_kelas, 1, 'L');
            $pdf->SetXY($xPos + $cellWidthTable, $yPos);
            $pdf->Cell(20, ($line * $cellHeightTable), $dslp->semester_id, 1, 0, 'C');
            $pdf->Cell(15, ($line * $cellHeightTable), $dslp->teori, 1, 0, 'C');
            $pdf->Cell(15, ($line * $cellHeightTable), $dslp->praktek, 1, 1, 'C');
            $tjumlah += $dslp->teori;
            $pjumlah += $dslp->praktek;
        }

        $pdf->SetX(76);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(80, 6, 'Jumlah', 1, 0, 'C');
        $pdf->Cell(15, 6, $tjumlah, 1, 0, 'C');
        $pdf->Cell(15, 6, $pjumlah, 1, 1, 'C');
        $pdf->SetX(76);
        $pdf->Cell(80, 6, 'Total SKS', 1, 0, 'C');
        $pdf->Cell(30, 6, $tjumlah + $pjumlah, 1, 1, 'C');

        $pdf->ln(7);
        $pdf->SetFont('Times', 'B', 12);
        $x_axis = $pdf->getx();
        $pdf->vcell($w, $h, $x_axis + 15, 'Kedua');
        $x_axis = $pdf->getx();
        $pdf->vcell($w - 35, $h, $x_axis, ':');
        $pdf->SetFont('Times', '', 12);
        $x_axis = $pdf->getx();
        $pdf->vcell($w - 35, $h, $x_axis, '');
        $x_axis = $pdf->getx();
        $pdf->vcell($w + 70, $h, $x_axis, 'Tenaga pengajar tersebut dalam melaksanakan tugasnya bertanggung jawab kepada Direktur.');
        $pdf->ln(2);
        $pdf->SetFont('Times', 'B', 12);
        $x_axis = $pdf->getx();
        $pdf->vcell($w, $h, $x_axis + 15, 'Ketiga');
        $x_axis = $pdf->getx();
        $pdf->vcell($w - 35, $h, $x_axis, ':');
        $pdf->SetFont('Times', '', 12);
        $x_axis = $pdf->getx();
        $pdf->vcell($w - 35, $h, $x_axis, '');
        $x_axis = $pdf->getx();
        $pdf->vcell($w + 70, $h, $x_axis, 'Surat Keputusan ini berlaku sejak mulai ditetapkan dan apabila terdapat kekeliruan dalam penetapannya, akan diadakan perbaikan sebagaimana mestinya.');

        if ($sk != null) {
            $tgl = $this->kalender->Format($sk->tgl_dibuat);
        } else {
            $tgl = '-';
        }

        $pdf->ln(5);
        $pdf->ttd($tgl, $status->status_direktur, $namadosen->id_dosen);
        $pdf->FooterSKDosen();

        $pdf->Output('I', 'SK-Mengajar-Dosen-' . $namadosen->nama_dsn . '.pdf');
    }

    public function import_excel()
    {
        if (isset($_FILES["fileExcel"]["name"])) {
            $path = $_FILES["fileExcel"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $kode = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $matkul = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $kelompok = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $sks = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $teori = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $praktek = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $smtid = $this->input->post('filtersmt');
                    $smtket = $this->db->get_where('m_semester', ['id_semester' => $smtid])->row();
                    $temp_data[] = array(
                        'kurikulum_id' => $this->input->post('kkid'),
                        'semester_id' => $smtid,
                        'kodematkul' => $kode,
                        'matkul' => $matkul,
                        'kel' => $kelompok,
                        'sks' => $sks,
                        'teori' => $teori,
                        'praktek' => $praktek,
                        'smtket' => $smtket->keterangan
                    );
                }
            }

            $this->db->insert_batch('r_matakuliah', $temp_data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Mata kuliah berhasil diimpor!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('distribusi/matakuliah');
        } else {
            echo "Tidak ada file yang masuk";
        }
    }
}
