<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . '/controllers/test/Toast.php');
require_once(APPPATH . '/services/user_service.php');
require_once(APPPATH . '/models/user_model.php');

class User_service_test extends Toast
{
	private $user_serivce = null;
	private $user = null;

	function __construct()
	{
		parent::__construct(__FILE__);
		
		$this->user_service = new User_service();
		
		$user = new User_model();
		$user->first_name = 'David';
		$user->last_name = 'Lee';
		$user->email = 'david@gnaemarketing.com.au';
		$user->level = 1;
		
		$this->user = $user;
	}
	
	function test_user_insert(){
		$this->user_service->save($this->user);
		$this->message = $this->user;
	}
	function test_user_insert_after(){
		$this->message = $this->user;
	}
}

?>