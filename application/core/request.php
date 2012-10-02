<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Request {
		private static $instance;
		private $request;
		private $language;
		
		private function __construct(){
			$this->initRequest();
		}
		
		private function initRequest(){
			$this->request = array();
			foreach($_GET as $key => $value) $request[$key] = $value;
			foreach($_POST as $key => $value) $request[$key] = $value;
		}
		
		public static function &getInstance(){
			if(Request::$instance == NULL){
				Request::$instance = new Request();
			}
			return Request::$instance;
		}
		
		public function assign($key, $value){
			$this->request[$key] = $value;
		}
		
		public function clear($key){
			unset($this->request[$key]);
		}
		
		public function clearAll($key){
			unset($this->request);
		}
		
		public function get($key){
			if(isset($this->request[$key])) return $this->request[$key];
			else return false;
		}
		
		public function result(){
			return $this->request;
		}
		
		public function getLanguage(){
			
		}
		
		public function getCurrent(){
			// return main or sub
		}
		
		public function __toString(){
			return print_r($this->request, true);
		}
	}
	
	$request = Request::getInstance();
?>