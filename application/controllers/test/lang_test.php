<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . '/core/abstract_controller.php');

class Lang_test extends Abstract_controller
{
	function __construct(){
		parent::__construct();
				
		// load test_lang.php
		$this->lang->load('test', 'english');
		$this->load->helper('language');
	}
		
	public function index() {
		log_message('debug', $this->lang->line('test_message'));		
		log_message('debug', $this->lang->line('New_Message'));
				
		echo $this->lang->line('test_message');
		echo ', ';		
		echo $this->lang->line('New_Message');
		echo '<br>';
		
		echo lang('test_message', 'form_item_id1');
		echo ', ';
		echo lang('New_Message', 'form_item_id2');
		
	}
	
	public function pre_process($params) {
	
	}
	
	public function post_process($params) {
	
	}
}

