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
	
	function test_modelValue() {
		$this->_assert_not_empty($this->userModel);
		$this->message = $this->userModel;
	}
	
	function test_getTable(){
		$this->message = User_model::$TABLE_NAME;
	}
	
	function test_create_model(){
		$data = array(
			'id' => 1,
			'user_id' => 'admin',
			'password' => '1234',
			'first_name' => 'david',
			'last_name' => 'lee',
			'email' => 'cailhuiris@gmail.com',
			'level' => 1
		);		
		$user = User_model::create_model($data);
		$this->message = $user;
	}
	
	function test_update_field() {
		$id_field = $this->userModel->get_field('id');
		$id_field['update'] = 'ok'; 
		
		$this->userModel->set_field('id', $id_field);
		$id_field = $this->userModel->get_field('id');
			
		$this->_assert_true($id_field['update'], 'ok');
		$this->message = print_r($id_field, true);
	}
	
	function test_set_field() {
		$new_field = array('label' => 'newFile', 'status' => 'ok');
			
		$this->userModel->set_field('new_field', $new_field);		
				
		$this->_assert_not_empty($this->userModel->get_field('new_field'));
		$this->message = print_r($this->userModel->get_field('new_field'), true);
	}
}
