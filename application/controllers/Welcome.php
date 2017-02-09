<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->library('session');
		if($this->input->post()){
			$host = $this->input->post('host');
			$user = $this->input->post('user');
			$pass = $this->input->post('pass');
			$database = $this->input->post('db');

			// $mysqli = new mysqli($this->db_hostname, $this->db_username, $this->db_password, $this->school_folder_name);
			// if (mysqli_connect_error()) {
			//     die('Connect Error (' . mysqli_connect_errno() . ') '
			//             . mysqli_connect_error());
			// }

			// $sql = explode(";",$sql_file);// 
			// foreach($sql as $query){
			// 	mysqli_query($mysqli,$query);
			// }
			// $mysqli->close();

			$db = array(
				'dsn'	=> '',
				'hostname' => $host,
				'username' => $user,
				'password' => $pass,
				'database' => $database,
				'dbdriver' => 'mysqli',
				'dbprefix' => '',
				'pconnect' => TRUE,
				'db_debug' => FALSE,
				'cache_on' => FALSE,
				'cachedir' => '',
				'char_set' => 'utf8',
				'dbcollat' => 'utf8_general_ci',
				'swap_pre' => '',
				'encrypt' => FALSE,
				'compress' => FALSE,
				'stricton' => FALSE,
				'failover' => array(),
				'save_queries' => TRUE
			);

			$db_obj = $this->load->database($db, true);
	  	$connected = $db_obj->initialize();
	  	if($connected){
	  		
	  		$ses = array(
	  				"login" => true,
	  				"hostname" => $host,
	  				"username" => $user,
	  				"password" => $pass,
	  				"database" => $database,
	  			);
	  		$this->session->set_userdata($ses);
	  		redirect('home/workspace');
	  	}else{
	  		$data['sys_msg'] = "Connection Failed.";
	  	}
		}

		$this->load->view('layouts/header');
		$this->load->view('welcome_message',$data);
		$this->load->view('layouts/footer');
	}
}
