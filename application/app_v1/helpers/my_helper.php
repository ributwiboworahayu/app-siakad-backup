<?php
function menu($level)
{
	$CI =& get_instance();
	$role=$CI->session->userdata('id_jabatan');
	$uk=$CI->db->query("SELECT * FROM user_akses a INNER JOIN user_menu b ON a.kode_menu=b.kode_menu WHERE a.level=$level GROUP BY b.parent ASC")->result();
	$kd = array();
	$no=0;
	$list.=' <li class="pcoded-hasmenu">
	<a href="">
	<span class="pcoded-micon"><i class="feather icon-map"></i></span>
	<span class="pcoded-mtext">dashboard</span>
	</a>
	</li>';
	foreach ($uk as $ua) {
		$kode_menu=explode('-', $ua->kode_menu);
		$kd[]=$kode_menu[0];


		$data=$CI->db->get_where('user_menu', array('tipe' =>0 ,'kode_menu'=>$kd[$no]))->result();
		foreach ($data as $parent) {
			// $list.=' <div class="pcoded-navigatio-lavel">'.$parent->nama_menu.'</div>';
			$data1=$CI->db->query("SELECT * FROM user_akses a INNER JOIN user_menu b ON a.kode_menu=b.kode_menu WHERE b.parent='".$kd[$no]."' AND tipe=1 AND a.level=$level")->result();
			foreach ($data1 as $child) {
				if ($child->url=='#') {
					$list.='<li class="pcoded-hasmenu">
					<a href="javascript:void(0)">
					<span class="pcoded-micon"><i class="feather icon-home"></i></span>
					<span class="pcoded-mtext">'.$child->nama_menu.'</span>
					</a>';
					$data2=$CI->db->query("SELECT * FROM user_akses a INNER JOIN user_menu b ON a.kode_menu=b.kode_menu WHERE b.parent='$kd[$no]' AND tipe=2 AND a.level=$level")->result();
					$list.='<ul class="pcoded-submenu">';
					foreach ($data2 as $subchild) {
						$list.='<li class=""> 
						<a href="'.base_url($subchild->url).'">
						<span class="pcoded-mtext">'.$subchild->nama_menu.'</span>
						</a></li>';
					}
					$list.='</ul></li>';
				}else{
					$list.='<li class="">
					<a href="'.base_url($child->url).'">
					<span class="pcoded-micon"><i class="feather icon-list"></i></span>
					<span class="pcoded-mtext">'.$child->nama_menu.'</span>
					</a>
					</li>';
				}
				
			}
			$no++;
		}
	}

	$list.='</ul>';
	
	return $list;
}

function menu_a($level)
{
	$CI =& get_instance();
	$role=$CI->session->userdata('id_jabatan');
	$uk=$CI->db->query("SELECT * FROM user_akses a INNER JOIN user_menu b ON a.kode_menu=b.kode_menu WHERE a.level=$level GROUP BY b.parent DESC")->result();
	$kd = array();
	$no=0;
	$list='';
	$list.=' <li class="">
	<a href="'.base_url().'welcome/role">
	<span class="pcoded-micon"><i class="feather icon-map"></i></span>
	<span class="pcoded-mtext">dashboard</span>
	</a>
	</li>';
	foreach ($uk as $ua) {
		$kode_menu=explode('-', $ua->kode_menu);
		$kd[]=$kode_menu[0];
		$get_parent=$CI->db->get_where('user_menu', array('tipe' =>0 ,'kode_menu'=>$kd[$no],'sub_main'=>0))->result();
		foreach ($get_parent as $parent) {
			$list.='<li class="pcoded-hasmenu">
			<a href="javascript:void(0)">
			<span class="pcoded-micon"><i class="feather icon-credit-card"></i></span>
			<span class="pcoded-mtext">'.$parent->nama_menu.'</span>
			<span class="pcoded-mcaret"></span>
			</a><ul class="pcoded-submenu">';
			$data1=$CI->db->query("SELECT * FROM user_akses a INNER JOIN user_menu b ON a.kode_menu=b.kode_menu WHERE b.parent='".$kd[$no]."' AND tipe=1 AND a.level=$level AND sub_main=$parent->id")->result();
			foreach ($data1 as $child) {
				if ($child->url=='#') {
					$list.='<li class="pcoded-hasmenu">
					<a href="javascript:void(0)" data-i18n="nav.bootstrap-table.main">
					<span class="pcoded-micon"><i class="ti-receipt"></i></span>
					<span class="pcoded-mtext">'.$child->nama_menu.'</span>
					<span class="pcoded-mcaret"></span>
					</a>
					<ul class="pcoded-submenu">';
					$data2=$CI->db->query("SELECT * FROM user_akses a INNER JOIN user_menu b ON a.kode_menu=b.kode_menu WHERE b.parent='$kd[$no]' AND tipe=2 AND a.level=$level AND sub_main=$child->id")->result();
					foreach ($data2 as $subchild) {
						$list.=' <li class=" ">
						<a href="'.base_url($subchild->url).'" data-i18n="nav.bootstrap-table.basic-table">
						<span class="pcoded-micon"><i class="ti-angle-right"></i></span>
						<span class="pcoded-mtext">'.$subchild->nama_menu.'</span>
						<span class="pcoded-mcaret"></span>
						</a>
						</li>';
					}


					$list.='</ul>
					</li>';
				}else{
					$list.='<li class=" ">
					<a href="'.base_url($child->url).'" data-i18n="nav.foo-table.main">
					<span class="pcoded-micon"><i class="ti-view-list-alt"></i></span>
					<span class="pcoded-mtext">'.$child->nama_menu.'</span>
					<span class="pcoded-mcaret"></span>
					</a>
					</li>
					';
				}
			}

			$list.='</ul></li>';
		}
		$no++;
	}
	return $list;
}

function getDetailProdi($id)
{
	$CI =& get_instance();
	$get=$CI->db->get_where('m_prodi', array('kode_prodi' =>$id))->row();

	return $get->singkatan;
}

function getDetailSemester($id)
{
	$CI =& get_instance();

	$get=$CI->db->get_where('m_semester', array('id_semester' =>$id))->row();

	return $get->nama_semester;
}

function getDetailAKD($id)
{
	$CI =& get_instance();

	$get=$CI->db->get_where('m_takad', array('id_thnakad' =>$id))->row();

	return $get->thun_akademik.'-'.$get->ta_tipe;
}
function getDetailAKD2($id)
{
	$CI =& get_instance();

	$get=$CI->db->get_where('m_takad', array('id_thnakad' =>$id))->row();

	return $get->thun_akademik;
}
function GetUserMHS($email)
{
	$CI =& get_instance();
	$get=$CI->db->get_where('m_mahasiswa', array('email' =>$email))->row_array();
	return $get;
}

function GetUsernameAkun($email)
{
	$CI =& get_instance();
	$get=$CI->db->get_where('users', array('email' =>$email))->row();
	return $get->username;
}
function cek_akunUser($email)
{
	$CI =& get_instance();
	$get=$CI->db->get_where('users', array('email' =>$email));
	if ($get->num_rows()>0) {
		return TRUE;
	} else {
		return FALSE;
	}
	
}

function GetLevel($email)
{
	$CI =& get_instance();
	$get=$CI->db->query("SELECT * FROM user_trakses a INNER JOIN user_level b ON a.level_id=b.id_level WHERE a.email='$email'");
	foreach ($get->result() as $rs) {
		$list.='<li>'.$rs->level.'</li>';
	}

	return '<ol>'.$list.'</ol>';
}

function hasLOGIN()
{
	$CI =& get_instance();
	$valid_login=$CI->session->userdata('login');
	if($valid_login !=TRUE && $CI->session->userdata('email')==''){
		redirect(base_url());
	}
}

function tgl_format($data){
	$tgl=substr($data,0,10);
	$format=date("d M Y",strtotime($tgl));
	$time=substr($data,11,5);

	return $format.' '.$time;
}

function cekVDReg($id_reg,$vd)
{
	$CI =& get_instance();
	$getData=$CI->db->get_where('tr_rurregis', array('ru_reg_id' =>$id_reg,'validator'=>$vd ))->row();
	if ($getData->status==0) {
		$btn=' <h5><button class="btn btn-danger btn-round">Belum Validasi</button></h5>';
	}else{
		$btn=' <h5><button class="btn btn-success btn-round">Sudah Validasi</button></h5>';
	}
	return $btn;
}

function getDataValidator($id)
{
	$CI =& get_instance();
	$level=$CI->session->userdata('id_jabatan');
	$email=$CI->session->userdata('email');
	$getLevelKet=$CI->master->viewData('user_trakses', array('email' =>$email,'level_id'=>$level ),true)->row();

	if ($getLevelKet->keterangan!=0) {
		if ($level==2) {

			if ($getLevelKet->keterangan==11) {
				$data=['ru_reg_id'=>$id,'validator'=>3];
			} else if ($getLevelKet->keterangan==12) {
				$data=['ru_reg_id'=>$id,'validator'=>2];
			} else {
				$data=['ru_reg_id'=>$id,'validator'=>1];
			}
		} else if ($level ==4) {
			$data=['ru_reg_id'=>$id,'validator'=>9];
		}

	} else {

		if ($level==3) {
			$data=['ru_reg_id'=>$id,'validator'=>5];
		} else if ($level==6) {
			$data=['ru_reg_id'=>$id,'validator'=>4];
		} else if ($level==7) {
			$data=['ru_reg_id'=>$id,'validator'=>8];
		} else {
			$data=['ru_reg_id'=>$id,'validator'=>7];
		}

	}

	return $data;
}
function array_split($array, $pieces=2) 
{   
	if ($pieces < 2) 
		return array($array); 
	$newCount = ceil(count($array)/$pieces); 
	$a = array_slice($array, 0, $newCount); 
	$b = array_split(array_slice($array, $newCount), $pieces-1); 
	return array_merge(array($a),$b); 
}

function encrypt( $q ) {
	$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
	$qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
	return( $qEncoded );
}

function decrypt( $q ) {
	$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
	$qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
	return( $qDecoded );
}

function buat_captcha()
{
	$CI =& get_instance();
	$vals = array(
			// 'word'     => '',
            'img_path' => 'captcha/',
            'img_url' => base_url().'captcha/',
          'font_path' => FCPATH . 'captcha/font/FingerPaint-Regular.ttf',
            'font_size' => 40,
            'word_length'   => 8,
            'img_width' => '200',
            'img_height' => 50,
            'expiration' => 7200,
             'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
        )
        );
        $cap = create_captcha($vals);
        $image = $cap['image'];
        $CI->session->set_userdata('kode_captcha', $cap['word']);
        return $image;
}

function lastSeen($timestamp){  
      $time_ago = strtotime($timestamp);  
      $current_time = time();  
      $time_difference = $current_time - $time_ago;  
      $seconds = $time_difference;  
      $minutes      = round($seconds / 60 );        // value 60 is seconds  
      $hours        = round($seconds / 3600);       //value 3600 is 60 minutes * 60 sec  
      $days         = round($seconds / 86400);      //86400 = 24 * 60 * 60;  
      $weeks        = round($seconds / 604800);     // 7*24*60*60;  
      $months       = round($seconds / 2629440);    //((365+365+365+365+366)/5/12)*24*60*60  
      $years        = round($seconds / 31553280);   //(365+365+365+365+366)/5 * 24 * 60 * 60  
      if($seconds <= 60) {  
       return "Just Now";  
      } else if($minutes <=60) {  
       if($minutes==1){  
         return "one minute ago";  
       }else {  
         return "$minutes minutes ago";  
       }  
      } else if($hours <=24) {  
       if($hours==1) {  
         return "an hour ago";  
       } else {  
         return "$hours hrs ago";  
       }  
      }else if($days <= 7) {  
       if($days==1) {  
         return "yesterday";  
       }else {  
         return "$days days ago";  
       }  
      }else if($weeks <= 4.3) {  //4.3 == 52/12
       if($weeks==1){  
         return "a week ago";  
       }else {  
         return "$weeks weeks ago";  
       }  
      } else if($months <=12){  
       if($months==1){  
         return "a month ago";  
       }else{  
         return "$months months ago";  
       }  
      }else {  
       if($years==1){  
         return "one year ago";  
       }else {  
         return "$years years ago";  
       }  
      }  
 } 


 function Pusher()
 {
 	// require_once(APPPATH.'views/vendor/autoload.php');
		$options = array(
			'cluster' => 'ap1',
			'useTLS' => true
		);
		$pusher = new Pusher\Pusher(
			'0c05194b1bccd2968406',
			'43a3a214a666770de4f4',
			'1156145',
			$options
		);

		$data['message'] = 'success';
		$pusher->trigger('my-channel', 'my-event', $data);
		return true;


 }

?>