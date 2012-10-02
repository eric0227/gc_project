<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . '/core/abstract_controller.php');

class Controller_test extends Abstract_controller
{
	private $page = '/test.php';
	
	private $data = array();
	
	public function index() {
		log_message('debug', 'index.. ');		
		$this->data['method'] = 'index';
	}
	
	public function test($params = array()) {
		$this->data['method'] = 'test';
	}
		
	public function pre_process($params) {
	
	}
	
	public function post_process($params) {
		$this->data['params'] = $params;
		$this->load->view('' . $this->page, $this->data, false);
	}
}

