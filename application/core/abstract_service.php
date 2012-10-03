<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class Abstract_service {
	function __construct() {
		log_message('debug', "Model Class Initialized");
		$this->load->database();
	}
	
	public abstract function get_default_model(); 
	
	// save
	public function save(&$model){
		//print_r($model);
		//echo $model->get_primary_value();	

		$primary_value = $model->get_primary_value();
		
		if(!isset($primary_value)) {
			return $this->insert($model);
		} else {
			return $this->update($model);
		}
	}
	
	// insert
	public function insert(&$model){
		$table_name = $model->get_table_name();		
		$data = $model->get_values();
				
		$this->db->insert($table_name, $data);
		
		$primary_key = $model->get_primary_key();
		
		$this->db->select_max($primary_key);		
		$query = $this->db->get($table_name);
		$row = $query->row_array();
		
		$model->set_value($primary_key, $row[$primary_key]);
	}
	
	// update
	public function update($model){		
		$table_name = $model->get_table_name();		
		$data = $model->get_values();		
		$primary_key = $model->get_primary_key();
		$primary_value = $model->get_primary_value();
		
		$this->db->where($primary_key, $primary_value);				
		$this->db->update($table_name, $data);
	}
	
	// delete
	public function delete($model){
		$table_name = $model->get_table_name();		
		$primary_key = $model->get_primary_key();
		$primary_value = $model->get_primary_value();
		
		log_message('debug', "delete => ". $table_name .' where '. $primary_key . '=' . $primary_value );
		
		$this->db->where($primary_key, $primary_value);				
		$this->db->delete($table_name);
	}
	
	// delete
	public function delete_at($id, $model_name){
		if(empty($model_name)) {
			$model_name = $this->get_default_model();
		}		
		$primary_key = call_user_func(array($model_name, 'get_primary_key'));
		$table_name = call_user_func(array($model_name, 'get_table_name'));
	
		$this->db->where($primary_key, $id);
		$this->db->delete($table_name);
	}
	
	public function get($id, $model_name){
		if(empty($model_name)) {
			$model_name = $this->get_default_model();
		}
		$primary_key = call_user_func(array($model_name, 'get_primary_key'));
		$table_name = call_user_func(array($model_name, 'get_table_name'));
		
		$this->db->where($primary_key, $id);
		$row = $this->db->get($table_name)->row_array();
		
		return call_user_func_array(array($model_name, 'create_model'), array($row));
	}
	
	public function find_row($model) {
		$table_name = $model->get_table_name();		
		$data = $model->get_values();
		
		$this->db->where($data);
		$row = $this->db->get($table_name)->row_array();
		
		$model_name = get_class($model);
		
		return call_user_func_array(array($model_name, 'create_model'), array($row));
	}
	
	public function find($model){
		$table_name = $model->get_table_name();		
		$data = $model->get_values();
		
		$models = array();
		
		$this->db->where($data);
		
		$model_name = get_class($model);
		
		foreach ($this->db->get($table_name)->result_array() as $row)
		{			
			$models[] = call_user_func_array(array($model_name, 'create_model'), array($row));
			//$models[] = $class::create_model($row);			
		}
		return $models;
	}

	public function get_last_index($model_name) {
		if(empty($model_name)) {
			$model_name = $this->get_default_model();
		}
		$primary_key = call_user_func(array($model_name, 'get_primary_key'));
		$table_name = call_user_func(array($model_name, 'get_table_name'));
		
		$this->db->select_max($primary_key);
		$query = $this->db->get($table_name);
		$row = $query->row_array();
		
		return $row[$primary_key];
	}
	
	// get latest data
	public function get_latest($model_name) {
		if(empty($model_name)) {
			$model_name = $this->get_default_model();
		}		
		$last_index = $this->get_last_index($model_name);		
		return $this->get($last_index, $model_name);
	}
	
	// count all
	public function count_all($model_name){
		if(empty($model_name)) {
			$model_name = $this->get_default_model();
		}
		$table_name = call_user_func(array($model_name, 'get_table_name'));
		return $this->db->count_all($table_name);
	}
	
	// get all
	public function get_all(){
		if(empty($model_name)) {
			$model_name = $this->get_default_model();
		}
		$table_name = call_user_func(array($model_name, 'get_table_name'));
		$query = $this->db->get($table_name);
		return $query->result();
	}
	
	// validate
	public function validate($model){
		
	}
	
	// getter
	function __get($name){
		$CI = &get_instance();
		return $CI->$name;
	}
	
	// setter
	function __set($name, $value){
	
	}
}

?>