<?php
include_once APPPATH . '/third_party/fpdf/fpdf.php';
class R_pdf extends FPDF
{

    function SetLineHeight($h)
    {
        $this->lineHeight = $h;
    }

    function SetWidths($w)
    {
        $this->widths = $w;
    }

    function SetAligns($a)
    {
        $this->aligns = $a;
    }


    function SKHeader()
    {
        $this->SetFont('Times', 'B', 15);
        $this->image(base_url() . 'assets/yayasan.png', 10, 16, 25, 30);
        $this->image(base_url() . 'assets/plkm.png', 176, 16, 25, 27);
        $this->Cell(10, 7, '', 0, 1);
        $this->Cell(0, 7, 'YAYASAN DATUK TABANO', 0, 1, 'C');
        $this->ln(1);
        $this->SetFont('Times', 'B', 29);
        $this->Cell(0, 7, 'POLITEKNIK KAMPAR', 0, 1, 'C');
        $this->ln(2);
        $this->SetFont('Times', 'B', 13.5);
        $this->Cell(0, 5, 'Sektretariat Jl. Tengku Muhammad KM 2 Bangkinang Riau 28412', 0, 1, 'C');
        $this->SetFont('Times', '', 10);
        $this->Cell(0, 5, 'Telp. 07623240818 Hp. 085211906621 www.poltek-kampar.ac.id-email:polkam@poltek-kampar.ac.id', 0, 1, 'C');
        $this->SetLineWidth(0);
        $this->Line(12, 45, 200, 45);
        $this->SetLineWidth(1);
        $this->Line(12, 46, 200, 46);
    }

    public function PasalSKDosen($w, $h)
    {
        $pasal1 = [
            'a' => 'Bahwa perkuliahan merupakan proses belajar mengajar sebagai kegiatan yang utama di Politeknik Kampar;',
            'b' => 'Dalam rangka pelaksanaan proses belajar mengajar yang baik di Politeknik Kampar, maka Program Studi telah melakukan pembagian tugas kepada para tenaga pengajar sebagai pengampu mata kuliah;',
            'c' => 'Bahwa sehubungan dengan butir a dan b diatas, maka perlu ditetapkan dengan Surat Keputusan Direktur Politeknik Kampar.'
        ];
        $pasal2 = [
            '1' => 'Undang-Undang Nomor 20 Tahun 2003 tentang Sistem Pendidikan Nasional;',
            '2' => 'Undang-Undang No.12 tahun 2012 tentang Pendidikan Tinggi;',
            '3' => 'Peraturan Pemerintah No. 4 tahun 2014 tentang Penyelenggaraan Pendidikan Tinggi dan Pengelolaan Perguruan Tinggi;',
            '4' => 'Peraturan Pemerintah Republik Indonesia Nomor 66 tahun 2010 Perubahan Atas Peraturan Pemerintah Nomor 17 Tahun 2010 Tentang Pengelolaan Dan Penyelenggaraan Pendidikan;',
            '5' => 'Permendikbud Nomor 49 Tahun 2014 tentang Standar Nasional Pendidikan Tinggi;',
            '6' => 'Keputusan Menteri Pendidikan Nasional Republik Indonesia Nomor 234/U/2000 Tentang Pedoman Pendirian Perguruan Tinggi;',
            '7' => 'Keputusan Direktorat Jenderal Pendidikan Tinggi Departemen Pendidikan Nasional Nomor: 68/D/O/2008 tentang Pemberian Izin Penyelenggaraan Program-program Studi dan Pendirian Politeknik Kampar;',
            '8' => 'Keputusan Ketua Yayasan Datuk Tabano Nomor: 009/YDT.1/KEP/UM-TU/12.2020 tentang Penunjukan dan Pengangkatan Direktur Politeknik Kampar Periode 2020/2024;',
            '9' => 'Keputusan Direktur Politeknik Kampar Nomor : 062/PK.1/KEP/BAAK/08.2020 tentang Peraturan Akademik Politeknik Kampar.',

        ];

        $pasal = [
            'MENIMBANG' => $pasal1,
            'MENGINGAT' => $pasal2

        ];

        $lebar = [$w - 5, $w - 35, $w - 35, $w + 75];
        $x_axis = $this->getx();
        $x = [$x_axis + 15, $x_axis, $x_axis, $x_axis];
        foreach ($pasal as $f => $va) {

            foreach ($va as $h => $vb) {
                for ($i = 0; $i < count($lebar); $i++) {
                    $psl = $h == 'a' || $h == '1' ? $f : '';
                    $titik = $h == 'a' || $h == '1' ? ':' : '';
                    $title = $i == 0 ? ($i == 1 ? ':' : $psl) : ($i == 2 ? $h : ($i == 3 ? $vb : $titik));
                    $font = $i == 0 ? ($i == 1 ? 'B' : 'B') : ($i == 2 ? '' : ($i == 3 ? '' : 'B'));
                    $this->SetFont('Times', $font, 12);
                    $x_axis = $this->getx();
                    $this->vcell($lebar[$i], 5, $i == 0 ? $x_axis + 15 : $x_axis, $title);
                }
                $this->ln(1);
            }
            $this->ln(2);
        }
    }

    public function ttd($tanggal, $status, $dosenid)
    {
        $plus = 30;
        $w = 50;
        $h = 5;
        $this->SetFont('Times', '', 12);
        $x_axis = $this->getx();
        $this->vcell($w + $plus, $h, $x_axis + 15, '');
        $x_axis = $this->getx();
        $this->vcell($w - 20, $h, $x_axis, 'Ditetapkan di');
        $this->SetFont('Times', '', 12);
        $x_axis = $this->getx();
        $this->vcell($w - 47, $h, $x_axis, ':');
        $x_axis = $this->getx();
        $this->vcell($w, $h, $x_axis, 'Bangkinang');
        $this->ln(5);
        $this->SetFont('Times', '', 12);
        $x_axis = $this->getx();
        $this->vcell($w + $plus, $h, $x_axis + 15, '');
        $x_axis = $this->getx();
        $this->vcell($w - 20, $h, $x_axis, 'Pada tanggal');
        $this->SetFont('Times', '', 12);
        $x_axis = $this->getx();
        $this->vcell($w - 47, $h, $x_axis, ': ' . $tanggal);
        $x_axis = $this->getx();
        $this->vcell($w, $h, $x_axis, '');
        $this->ln(5);
        $this->SetFont('Times', 'B', 12);
        $x_axis = $this->getx();
        $this->vcell($w + $plus, $h, $x_axis + 15, '');
        $x_axis = $this->getx();
        $this->vcell($w, $h, $x_axis, 'POLITEKNIK KAMPAR');
        $this->ln(5);
        $this->SetFont('Times', 'B', 12);
        $x_axis = $this->getx();
        $this->vcell($w + $plus, $h, $x_axis + 15, '');
        $x_axis = $this->getx();
        $this->vcell($w, $h, $x_axis, 'DIREKTUR.');

        $x_axis = $this->getx();
        $this->vcell($w + $plus, $h, $x_axis + 15, '');
        $this->ln(5);
        if ($status == 1) {

            $x_axis = $this->getx();
            $this->vcell($w + $plus + 5, $h, $x_axis + 15, '');
            $x_axis = $this->getx();
            $this->vcell($w, $h, $x_axis, $this->image('https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . base_url('distribusi/qr_skdosen/index/'). $dosenid, null, null, 19, '', 'PNG'));
            $this->ln(1);
        } else {
            $this->ln(25);
        }
        $this->SetFont('Times', 'BU', 12);
        $x_axis = $this->getx();
        $this->vcell($w + $plus, $h, $x_axis + 15, '');
        $x_axis = $this->getx();
        $this->vcell($w + 15, $h, $x_axis, 'NINA VERONIKA,S.T.,M.Sc.');
        $this->ln(5);
        $this->SetFont('Times', '', 12);
        $x_axis = $this->getx();
        $this->vcell($w + $plus, $h, $x_axis + 15, '');
        $x_axis = $this->getx();
        $this->vcell($w + 15, $h, $x_axis, 'NRP : 094783947345');
        $this->ln(10);

        $this->SetY(-55);
        $this->SetFont('Times', 'U', 12);
        $this->SetX(25);
        $this->Cell(110, 5, 'Tembusan: Disampaikan Kepada Yth:', 0, 1, 'L');
        $this->SetFont('Times', '', 12);
        $this->SetX(25);
        $this->Cell(110, 5, '1. Wakil Direktur II Bidang Kepegawaian, Keuangan dan Umum', 0, 1, 'L');
        $this->SetX(25);
        $this->Cell(110, 5, '2. Yang bersangkutan', 0, 1, 'L');
        $this->SetX(25);
        $this->Cell(110, 5, '3. Arsip', 0, 1, 'L');
    }

    public function FooterSKDosen()
    {
        $this->SetY(-33);
        $this->SetLineWidth(0);
        $this->SetFont('Arial', 'I', 9);
        $this->Cell(30, 10, '', 0, 0, 'C');
        $this->MultiCell(130, 6, 'Visi : Terwujudnya Politeknik yang unggul, Inovatif dan Terkemuka Berbasis Teknologi Terapan pada Tahun 2032', 1, 'C');
    }
}
