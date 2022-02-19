<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chating extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies

	}

	// List all your items
	public function index( $offset = 0 )
	{
		$data['title_page']="send telegram";
		$data['content']='telegram';
		$this->load->view('template',$data);
	}

	// Add a new item
	public function kirim()
	{
		$chat_id                  =	-1001284274192;
		$text='<pre>'.$this->input->post('pesan').'</pre>
		<pre>Pesan Ini Di Kirim melalui Sistem Akademik POLKAM </pre>

			<a href="http://siak.poltek-kampar.ac.id">http://siak.poltek-kampar.ac.id</a>
			';
		
		$parse_mode               ='HTML';
		$disable_web_page_preview = null;
		$reply_to_message_id      = null;
		$reply_markup             = null;

		$data = array(
			'chat_id'                  => urlencode($chat_id),
			'text'                     => $text,
			'parse_mode'               =>urlencode($parse_mode),
			'disable_web_page_preview' => urlencode($disable_web_page_preview),
			'reply_to_message_id'      => urlencode($reply_to_message_id),
			'reply_markup'             => urlencode($reply_markup)
		);

		// $url = "https://api.telegram.org/bot1301714740:AAE8EQa45GCVOindrIKOr15khzZGOt5vMFc/sendMessage";
		$url = "https://api.telegram.org/bot1225703219:AAEwyCW7t0QnhS7BuoCKDfj09Pl1HO7WxtM/sendMessage";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, count($data));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);

		$this->output->set_content_type('application/json')->set_output(json_encode(['status'=>true,'msg'=>'Pesan Telah Di Kirim Ke telegram','pesan'=>$text]));
	}

	//Update one item
	public function update( $id = NULL )
	{

	}

	//Delete one item
	public function delete( $id = NULL )
	{

	}
}

/* End of file Chating.php */
/* Location: .//tmp/fz3temp-2/Chating.php */
