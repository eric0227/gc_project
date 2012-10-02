<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class Abstract_service {
	function __construct() {
		log_message('debug', "Model Class Initialized");
		$this->load->database();
	}
	
	// save
	public function save($model){
		$primary_value = $model->get_primary_value();
		
		if(empty($model->$primary_key)){
			return $this->insert($model);
		} else {
			return $this->update($model);
		}
	}
	
	// insert
	public function insert($model){
		$table_name = $model->get_table_name();		
		$data = $model->get_values();
				
		$this->db->insert($table_name, $data);
		
	}
	
	// update
	public function update($model){		
		$table_name = $model->get_table_name();		
		$data = $model->get_values();		
		$primary_key = $this->get_primary_key();
		$primary_value = $this->get_primary_value();
		
		$this->db->where($primary_key, $primary_value);				
		$this->db->update($table_name, $data);
	}
	
	// delete
	public function delete($model){		
		$table_name = $model->get_table_name();		
		$primary_key = $model->get_primary_key();
		$primary_value = $model->get_primary_value();
		
		$this->db->where($primary_key, $primary_value);				
		$this->db->delete($table_name);
	}
	
	public function get($model_name, $id){		
		$this->db->where($model_name::$PRIMARY_KEY, $id);
		$row = $this->db->get($model_name::$TABLE_NAME)->row_array();
	
		return $model_name::create_model($row);
	}

	public function find_row($model){
		$table_name = $model->get_table_name();		
		$data = $model.get_values();
		
		$this->db->where($data);
		$row = $this->db->get($table_name)->row_array();
		
		$class = get_class($model);
		
		return $class::create_model($row);
	}
	
	public function find($model){
		$table_name = $model->get_table_name();		
		$data = $model.get_values();
		
		$models = array();
		
		$this->db->where($data);
		
		$class = get_class($model);
		
		foreach ($this->db->get($table_name)->result_array() as $row)
		{
			$models[] = $class::create_model($row);			
		}
		return $models;
	}
		
	// get latest data
	public function get_latest($model){
		$table_name = $this->get_table_name();
		$primary_key = $this->get_primary_key();
		
		$this->db->order_by($primary_key, 'desc');
		$row = $this->db->get($table_name)->row_array();
		
		foreach($row as $name => $value){
			$model->$name = $value;
		}
		
		return $model;
	}
	
	// count all
	public function count_all($model){
		$table_name = $model->get_table_name();
		return $this->db->count_all($model);
	}
	
	// get all
	public function get_all($model){
		$table_name = $model->get_table_name();
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