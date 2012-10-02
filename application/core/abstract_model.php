<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class Abstract_model {
	
	// construct
	public function __construct($data = array()){
		if(empty($data)){
			return;
		}
		
		$fields = &$this->get_fields();
		
		foreach($data as $name => $value){
			if(isset($fields[$name])){
				$fields[$name]['value'] = $value;
			}
		}
	}
	
	// get fields
	public abstract function &get_fields();
		
	public function &get_field($name) {
		$fields = &$this->get_fields();
		
		if(!isset($fields[$name])) {
			//throw Exception('Can not find fields :' . $name);
		}
		return $fields[$name];
	}
	
	public function set_field($name, $field) {
		$fields = &$this->get_fields();
	
		$fields[$name] = $field;	
	}
	
	// get primary key
	public function get_primary_key(){
		return $PRIMARY_KEY;
	}
	
	// get primary value
	public function get_primary_value(){
		return $this->get_value($PRIMARY_KEY);
	}
	
	// get table name
	public function get_table_name(){
		return $TABLE_NAME;
	}
	
	public function check_vaild_all() {		
		return true;
	}
	
	public function check_vaild($name, $value) {
		return true;
	}
		
	public function __set($name, $value) {
		$this->set_value($name, $value);
	}
	
	public function __get($name) {
		return $this->get_value($name);
	}
	
	public function set_value($name, $value) {
		$field = &$this->get_field($name);
		if($field) {
			$field['value'] = $value;
		} else {
			//throw new Exception('Can not find Filed :'.$name);
		}
	}
	
	public function &get_value($name) {
		$field = &$this->get_field($name);
		if($field) {
			return $field['value'];
		} else {
			//throw new Exception('Can not find Filed :'.$name);
		}
	}
	
	public function get_values() {
		$values = array();		
		$fields = &$this->get_fields();
		
		foreach($fields as $name => $field){
			$values[$name] = $field['value'];
		}
		return $values;		
	}
	

	public function __toString() {
		$result = "";
		
		$fields = $this->get_fields();
		foreach($fields as $name => $field) {
			$value = isset($field['value'])? $field['value']: '';
			$result .= $name . '=' . $value. ', ';
		}		
		return substr($result, 0, -2);
	}
}

?>