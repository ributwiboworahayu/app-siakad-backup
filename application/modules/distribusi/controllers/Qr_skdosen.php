<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Qr_skdosen extends MX_Controller
{
    public function index($dosenid = '')
    {
        if ($dosenid == '') {
            redirect(base_url());
        } else {
            $this->load->library('kalender');
            $data['title'] = 'QR SK Dosen';
            $data['sk'] = $this->db->get_where('r_sk_dosen_mengajar', ['dosen_id' => $dosenid])->row();
            if ($data['sk'] == null) {
                $data['tglsk'] = '';
            } else {

                $data['tglsk'] = $this->kalender->Format($data['sk']->tgl_dibuat);
            }
            $data['ta'] = $this->db->get_where('m_takad', ['status' => 1])->row();
            $this->db->join('m_dosen', 'm_dosen.email=user_trakses.email');
            $data['userttd'] = $this->db->get_where('user_trakses', ['level_id' => 12])->row();
            $this->load->view('content/qr-content', $data);
        }
    }
}
