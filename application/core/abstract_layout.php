<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface abstract_layout {
		
	public function header($data, $isReturn);
	
	public function lefter($data, $isReturn);
		
	public function righter($data, $isReturn);
	
	public function footer($data, $isReturn);
	
	//public abstract function center($data, $isReturn);	
}
?>
