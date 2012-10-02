<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . '/controllers/test/Toast.php');

require_once(APPPATH . '/core/service_factory.php');
require_once(APPPATH . '/services/user_service.php');

class Service_factory_test extends Toast
{
	private $serviceFactory = null;
	
	function __construct()
	{
		parent::__construct(__FILE__);
		// Load any models, libraries etc. you need here
		
		$this->serviceFactory = Service_factory::getInstance();
	}

	function _pre() {}

	function _post() {}

	/* TESTS BELOW */
	function test_setService() {
		$userService = new User_service();		
		
		$this->serviceFactory->setService('userService', $userService);
		
		$userService2 = $this->serviceFactory->getService('userService');
		
		$this->_assert_equals($userService, $userService2);
		
		try {
			$this->serviceFactory->getService('execeptionTest');
			
			$this->_fail('Dont throw Exception');
		} catch(Exception $e) {
			//$this->message($e);
			//print_r($e);
		}
	}
}

?>