<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . '/core/abstract_layout.php');

class Default_layout {
	
	public $hedaer = 'default/header';
	public $lefter = 'default/lefter';
	public $righter = 'default/righter';
	public $footer = 'default/footer';
	public $center = 'default/center';
	
	public function __construct($template = array()) {
		if(!empty($template['hedaer'])) {
			$this->hedaer = $template['hedaer'];
		}
		if(!empty($template['lefter'])) {
			$this->lefter = $template['lefter'];
		}
		if(!empty($template['righter'])) {
			$this->righter = $template['righter'];
		}
		if(!empty($template['footer'])) {
			$this->footer = $template['footer'];
		}
		if(!empty($template['center'])) {
			$this->center = $template['center'];
		}
	}
}
?>