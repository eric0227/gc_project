<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	require_once APPPATH.'controllers/test/Toast.php';
	
	class Request_test extends Toast {
		public function __construct(){
			parent::__construct('admin');
		}
		
		public function init(){
			parent::init();
		}
		
		public function test_request(){
			global $request;
			$this->message = $request;
		}
		
		public function test_request_set(){
			global $request;
			$request->assign('id', 1);
			$this->message = $request;
		}
		
		public function test_get_request(){
			global $request;
			$this->message = print_r($request->result(), true);
		}
	}
?>