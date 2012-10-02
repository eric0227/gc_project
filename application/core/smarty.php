<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Smarty {
		private static $instance;
		private $storage;
		
		private function __construct(){
			$this->storage = array();
		}
		
		public function &getInstance(){
			if(Smarty::$instance == NULL)
				Smarty::$instance = new Smarty();
				
			return Smarty::$instance;
		}
		
		public function assign($key, $value){
			$this->storage[$key] = $value;
		}
		
		public function get($key){
			if(isset($this->storage[$key])) return $this->storage[$key];
			else return false;
		}
		
		public function clear($key){
			unset($this->storage[$key]);
		}
		
		public function clearAll(){
			unset($this->storage);
			$this->storage = array();
		}
		
		public function result(){
			return $this->storage;
		}
		
		public function __toString(){
			return print_r($this->storage, true);
		}
	}
	
	$smarty = Smarty::getInstance();
?>