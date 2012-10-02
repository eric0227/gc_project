<?php
require_once(APPPATH . '/controllers/test/Toast.php');

class My_test extends Toast {
	function __construct(){
		parent::__construct(__FILE__);
	}

	function test_code(){
		$this->message = "Wow So .. : ";
	}
}

?>