<?php

class Kalender
{
	function HariIndonesia($date)
	{
		$hari = array ( 1 => 'Senin',
			'Selasa',
			'Rabu',
			'Kamis',
			'Jumat',
			'Sabtu',
			'Minggu'
		);

		return $hari[$date];
	}

	public function Hari($date)
	{
		$hari   = date('l', microtime($date));
		$hari_indonesia = array('Monday'  => 'Senin',
			'Tuesday'  => 'Selasa',
			'Wednesday' => 'Rabu',
			'Thursday' => 'Kamis',
			'Friday' => 'Jumat',
			'Saturday' => 'Sabtu',
			'Sunday' => 'Minggu');

		return $hari_indonesia[$hari];
	}

	function BulanIndonesia($date)
	{
		$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		return $bulan[(int)$date];
	}

	public function Format($date)
	{
		$hari=date('d',strtotime($date));
		$bulan=date('m',strtotime($date));
		$tahun=date('Y',strtotime($date));

		return $hari.' '.$this->BulanIndonesia($bulan).' '.$tahun;
	}
	
}