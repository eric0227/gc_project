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
		log_message('debug','test..');
		
		$this->data['method'] = 'test';
	}
		
	public function pre_process($params) {
		log_message('debug','pre_process');
	}
	
	public function post_process($params) {
		log_message('debug','post_process');
		
		$this->data['params'] = $params;
		echo $this->load->view($this->page, $this->data, true);
	}
}

