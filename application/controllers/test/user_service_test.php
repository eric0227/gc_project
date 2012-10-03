<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . '/controllers/test/Toast.php');
require_once(APPPATH . '/services/user_service.php');
require_once(APPPATH . '/models/user_model.php');

class User_service_test extends Toast
{
	private $user_serivce = null;

	function __construct()
	{
		parent::__construct(__FILE__);
		
		$this->user_service = new User_service();
	}
	
	function test_classname_to_callfunction() {				
		$model_name = 'User_model';		
		$primary_key = call_user_func(array($model_name, 'get_primary_key'));
	}

	function test_user_insert(){
		$model = $this->create_model($this->makeDumyUser());
		$this->user_service->save($model);
		
		$this->_assert_not_empty($model->get_primary_value()); // true		
		$this->message = $model;
	}
	
	function test_get_latest() {
		$model = $this->user_service->get_latest('User_model');
		$this->_assert_not_empty($model->get_primary_value()); // true
		$this->message = $model;
	}
	
	function test_user_update(){
		$model = $this->user_service->get_latest('User_model');		
		$model->set_value('level', '2');
		$this->user_service->save($model);
		
		$model = $this->user_service->get_latest('User_model');
		$this->_assert_true($model->get_value('level'), '2'); // true		
		$this->message = $model;		
	}
	
	public function test_count_all() {
		$count = $this->user_service->count_all('User_model');
		$this->_assert_not_empty($count);
		$this->message = 'count=>' . $count;
	}
	
	public function test_delete() {
		$count = $this->user_service->count_all('User_model');		
		$model = $this->user_service->get_latest('User_model');				
		$this->user_service->delete($model);
		
		$count2 = $this->user_service->count_all('User_model');
		$this->_assert_equals($count, $count2 + 1);		
	}
	
	public function test_find_row() {
		$model = new User_model(array('user_id' => 'admin'));
		$result = $this->user_service->find_row($model);		
		$this->_assert_not_empty($result);
		$this->message = $result;
	}
	
	public function test_find() {
		$model = new User_model(array('user_id' => 'admin'));
		$result = $this->user_service->find($model);
		$this->_assert_not_empty($result);
		$this->message = $result;
	}	
	
	public function test_get_all() {
		//$result = $this->user_service->get_all('User_name');
		$result = $this->user_service->get_all();
		$this->_assert_not_empty($result);
		$this->message = $result;
		
	}
	
	function create_model() {
		return User_model::create_model($this->makeDumyUser()); 
	}
	
	function makeDumyUser() {
		return array(
				'id_user' => 1,
				'user_id' => 'admin',
				'password' => '1234',
				'first_name' => 'first name ',
				'last_name' => 'last name',
				'email' => 'email@gmail.com',
				'level' => 1
		);
	}
}
?>