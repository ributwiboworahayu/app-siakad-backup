<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		 $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key

	}

	public function index($value='')
	{
		echo "hello";
	}

	 public function users_get()
    {
        // Users from a data store e.g. database
        $users = [
            ['id' => 1, 'name' => 'John', 'email' => 'john@example.com', 'fact' => 'Loves coding'],
            ['id' => 2, 'name' => 'Jim', 'email' => 'jim@example.com', 'fact' => 'Developed on CodeIgniter'],
            ['id' => 3, 'name' => 'Jane', 'email' => 'jane@example.com', 'fact' => 'Lives in the USA', ['hobbies' => ['guitar', 'cycling']]],
        ];

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users)
            {
                // Set the response and exit
                $this->response(['mahasiswa'=>$users], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.
        else {
            $id = (int) $id;

            // Validate the id.
            if ($id <= 0)
            {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the user from the array, using the id as key for retrieval.
            // Usually a model is to be used for this.

            $user = NULL;

            if (!empty($users))
            {
                foreach ($users as $key => $value)
                {
                    if (isset($value['id']) && $value['id'] === $id)
                    {
                        $user = $value;
                    }
                }
            }

            if (!empty($user))
            {
                $this->set_response(['mahasiswa'=>$users], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'User could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }

	// // Add a new item
	// public function GetMahasiswa()
	// {	
	// 	$this->db->select('a.*,b.singkatan,c.nama_semester,d.nama_kelas');
	// 	$this->db->from('m_mahasiswa a');
	// 	$this->db->join('m_prodi b', 'a.prodi_id=b.kode_prodi', 'inner');
	// 	$this->db->join('m_semester c', 'a.semester_id=c.id_semester', 'inner');
	// 	$this->db->join('m_kelas d', 'a.kelas_id=d.id_kelas', 'inner');
	// 	$GetData=$this->db->get()->result();
	// 	$data=$GetData;
	// 	header("Access-Control-Allow-Headers: Authorization, Content-Type");
	// 	header("Access-Control-Allow-Origin: *");
	// 	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	// }

	// //Update one item
	// public function GetMhsByid()
	// {
	// 	$id_mhs=$this->input->get('id');
	// 	$this->db->select('*');
	// 	$this->db->from('m_mahasiswa');
	// 	$this->db->where('id_mhs', $id_mhs);
	// 	$Hasil=$this->db->get()->row();

	// 	$this->output->set_content_type('application/json')->set_output(json_encode($Hasil));

	// }

	// //Delete one item
	// public function delete( $id = NULL )
	// {

	// }
}

/* End of file Api.php */
/* Location: .//C/Users/web-master/AppData/Local/Temp/fz3temp-2/Api.php */
