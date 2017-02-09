<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	public function workspace($tbname = false, $action = false, $field = false)
	{
		$this->load->library('session');

		if(!$this->session->userdata('login')){
			redirect('welcome');
		}

		$host = $this->session->userdata('hostname');
		$user = $this->session->userdata('username');
		$pass = $this->session->userdata('password');
		$database = $this->session->userdata('database');

		# Database Connection
		$db = array(
				'dsn'	=> '',
				'hostname' => $host,
				'username' => $user,
				'password' => $pass,
				'database' => $database,
				'dbdriver' => 'mysqli',
				'dbprefix' => '',
				'pconnect' => TRUE,
				'db_debug' => TRUE,
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
		
		$CI =& get_instance();
		$this->db2 = $CI->load->database($db, TRUE);
		$data['tables'] = $tables = ($this->db2->list_tables());
		$data['fields'] = [];
		$data['tbname'] = $tbname;
		$data['field'] = $field;
		if($tbname && $this->db2->table_exists($tbname)){
			$data['fields'] = $this->db2->list_fields($tbname);
		}

		# Catch Action
		if($action){
			switch (strtolower($action)) {
				case 'reshuffle':
					
					if ($this->db2->field_exists($field, $tbname)){
						
						$pk = $this->_get_pk($tbname);
						$r = $this->db2->query(" SELECT $pk, $field FROM $tbname")->result();
						$ctr = 0;
						if($r){
							foreach ($r as $k => $v) {
								$str = ucfirst( strtolower( str_shuffle($v->$field) ) );
								$this->db2->where($pk,$v->$pk)->update($tbname,[$field=>$str]);
								if($this->db2->affected_rows() > 0){
									$ctr++;
								}
							}
						}

						$data['sys_msg'] = "$ctr records updated";

					}else{
						$data['sys_msg'] = "Field do not exist";
					}

					break;

				case 'remove':
					if ($this->db2->field_exists($field, $tbname)){
						
						$this->db2->query("update $tbname set $tbname = ''");
						$ctr = $this->db2->affected_rows();

						$data['sys_msg'] = "$ctr records updated";

					}else{
						$data['sys_msg'] = "Field do not exist";
					}
				break;
				
				default:
					# code...
					break;
			}
		}

		$this->load->view('layouts/header');
		$this->load->view('workspace',$data);
		$this->load->view('layouts/footer');
	}

	private function _get_pk($table)
	{
		$fds = $this->db2->field_data($table);
		if($fds){
			foreach ($fds as $k => $v) {
				if($v->primary_key == "1"){
					return $v->name;
				}
			}
		}

		return NULL;
	}
}
