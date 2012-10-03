<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'core/abstract_service.php');
require_once(APPPATH . 'models/user_model.php');

class User_service extends Abstract_service {
	
	public function get_default_model() {
		return 'User_model';
	}
	
	public function __construct() {
		parent::__construct();
	}
}
?>
