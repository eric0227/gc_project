<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_factory {
	private $services = array();
	private static $instance = NULL;
	
	private function __construct() {
		// empty	
	}
	
	public static function &getInstance() {
		if(Service_factory::$instance == NULL) {
			Service_factory::$instance = new Service_factory();
		}
		return Service_factory::$instance;
	}
	
	public function setService($name, $service) {
		$this->services[$name] = $service;
	}
	
	public function &getService($name) {
		if(!isset($this->services[$name])) {
			throw new Exception('Can not find Service :' . $name);
		}
		return $this->services[$name];
	}
}
?>