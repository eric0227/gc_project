<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	require_once APPPATH.'core/request.php';
	require_once APPPATH.'core/smarty.php';

	require_once(APPPATH . '/layout/default_layout.php');
	
	abstract class Abstract_controller extends CI_Controller {
		private $base_url;
		
		protected $layout = NULL;
		protected $headerData = array();
		protected $lefterData = array();
		protected $righterData = array();
		protected $footerData = array();
		
		protected $ajax = false;
		protected $output = 'html'; // html, json

		function __construct(){
			parent::__construct();
			$this->init();
		}
		
		public function init(){
			$this->base_url = $this->config->base_url();
			$this->layout = new Default_layout();
		}

		public function &getLayout() {
			return $this->layout;
		}
		
		public function setLayout($layout) {
			return $this->layout = $layout;
		}
		
		public function _redirect($url){
			echo "
				<script type='text/javascript'>
					location.replace('".$this->base_url.$url."');
				</script>
			";
		}
/*		
		public function _remap($method, $params = array()){
			$this->_header();
			if(method_exists($this, $method)) call_user_func_array(array($this, $method), $params);
			$this->_footer();
		}
*/

		public function _remap($method, $params = array())
		{
			if($_REQUEST['ajax'] == '1') {
				$this->ajax = 1;
			} else {
				$this->ajax = 0;
			}
			
			if($_REQUEST['output'] == 'json') {
				$this->output = 'json';
			} else {
				$this->output = 'html';
			}
			
			log_message('debug','ajax =>'. $this->ajax);
			log_message('debug','output =>'. $this->output);
			log_message('debug', '$method : '. $method);
			log_message('debug', '$params : '. print_r($params, true));
			
			if($this->ajax == 0) {
				$this->headerData['method'] = $method;
				$this->headerData['params'] = $params;
				
				log_message('debug', 'before header_process');
				
				$this->header_process($params);
				
				log_message('debug', 'header_process');
				
				$this->lefter_process($params);
				
				log_message('debug', 'lefter_process');
			}

			$this->pre_process($params);	
			if (method_exists($this, $method)) {
				call_user_func_array(array($this, $method), $params);
			}
			$this->post_process($params);
			
			if($this->ajax == 0) {
				$this->righter_process($params);
				$this->footer_process($params);
			}
		}
		
		public function header_process($params) {
			echo $this->load->view('layout/' . $this->layout->hedaer, $this->headerData, true);
		}
		public function lefter_process($params) {
			echo $this->load->view('layout/' . $this->layout->lefter, $this->lefterData, true);
		}
		public function righter_process($params) {
			echo $this->load->view('layout/' . $this->layout->righter, $this->righterData, true);
		}
		public function footer_process($params) {
			echo $this->load->view('layout/' . $this->layout->footer, $this->footerData, true);
		}
		
		public abstract function pre_process($params);
		
		public abstract function post_process($params);	
	}
?>