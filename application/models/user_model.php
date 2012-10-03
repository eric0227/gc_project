<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . '/core/abstract_model.php');

class User_model extends Abstract_model {
	public static function get_primary_key() {
		return 'id_user';
	}	
	public static function get_table_name() {
		return 'gc_user';
	}
	
	function __construct($data = array()) {
		parent::__construct($data);
	}
	
	protected $fields = array(
		'id_user'	=> array('label' => 'UserId', 'type' => 'string', 'mandatory' => true, 'length' => 32),
		'password'	=> array('label' => 'Password', 'type' => 'password', 'mandatory' => true, 'length' => 32, 'encrypt' => true),
		'email'		=> array('label' => 'EMail', 'type' => 'email', 'mandatory' => true, 'length' => 100),
		'first_name'=> array('label' => 'First Name', 'type' => 'string', 'mandatory' => false, 'length' => 32),
		'last_name'	=> array('label' => 'Last Name', 'type' => 'string', 'mandatory' => false, 'length' => 32),
		'level'		=> array('label' => 'Level', 'type' => 'int', 'value' => 1, 'mandatory' => true)
	);
	
	public function &get_fields() {
		return $this->fields;
	}
	
	public static function create_model($data) {
		$user = new User_model($data);
		return $user;
	}
}
