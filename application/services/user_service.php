<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . '/core/abstract_service.php');

class User_service extends Abstract_service {
	public function __construct() {
		parent::__construct();
	}
		
	public function get_permission_name($level){
		switch($level){
			case 1 :
				return 'admin';
			break;
			default;
				return 'guest';
			break;
		}
	}
}
?>
