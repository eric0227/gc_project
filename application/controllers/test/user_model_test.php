<?php
require_once(APPPATH . '/controllers/test/Toast.php');

class User_model_test extends Toast
{
	public $userModel = NULL;
	
	function __construct()
	{
		parent::__construct(__FILE__);
		// Load any models, libraries etc. you need here
		$this->load->model('User_model', 'userModel');
	}

	function _pre() {}

	function _post() {}


	/* TESTS BELOW */
	function test_modelLoad() {
		//print_r ($this->userModel);
		$this->_assert_true($this->userModel != null); // true
	}
		
	function test_create_model(){
		$data = $this->makeDumyUser();		
		$user = User_model::create_model($data);
		$this->_assert_true($user != null); // true
		$this->message = $user;
	}
	
	function test_update_field() {
		$id_field = $this->userModel->get_field('id_user');
		$id_field['update'] = 'ok'; 
		
		$this->userModel->set_field('id_user', $id_field);
		$id_field = $this->userModel->get_field('id_user');
			
		$this->_assert_true($id_field['update'], 'ok');
		$this->message = print_r($id_field, true);
	}
	
	function test_set_field() {
		$new_field = array('label' => 'newFile', 'status' => 'ok');
			
		$this->userModel->set_field('new_field', $new_field);
				
		$this->_assert_not_empty($this->userModel->get_field('new_field'));
		$this->message = print_r($this->userModel->get_field('new_field'), true);
	}
	
	function makeDumyUser() {
		return array(
			'id' => 1,
			'user_id' => 'admin',
			'password' => '1234',
			'first_name' => 'first name ',
			'last_name' => 'last name',
			'email' => 'email@gmail.com',
			'level' => 1
		);
	}
}


