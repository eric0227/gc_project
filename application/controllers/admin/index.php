<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	require_once APPPATH.'controllers/test/Toast.php';
	
	class Index extends Toast {
		public function __construct(){
			parent::__construct('admin');
		}
		
		public function init(){
			parent::init();
		}
		
		public function action($message, $message2){
			echo $message;
			echo $message2;
		}
		
		public function _header(){
			$this->load->view('test/header');
		}
		
		public function _footer(){
			$this->load->view('test/footer');
		}
		
		public function test_header(){
			$this->message = 'Loaded header file';
		}
		
		public function test_footer(){
			$this->message = 'Loaded footer file';
		}
	}
?>