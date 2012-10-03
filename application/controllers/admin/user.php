<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . '/core/abstract_controller.php');
require_once(APPPATH . '/services/user_service.php');

class User extends Abstract_controller
{
	private $user_service;
	private $page = '/admin/user.php';	
	private $data = array();
	
	function __construct() {
		parent::__construct();
		$this->user_service = new User_service();
	}
	
	public function index() {
		log_message('debug', 'user page.. ');		
		$this->data['method'] = 'index';
	}
	
	public function pre_process($params) {
		$user_list = $this->user_service->get_all();
		$this->data['user_list'] = $user_list;  
	}
	
	public function post_process($params) {
		$this->data['params'] = $params;
		$this->load->view('' . $this->page, $this->data, false);
	}
}
