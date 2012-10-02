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
			log_message('debug', '$method : '. $method);
			log_message('debug', '$params : '. print_r($params, true));
			
			$this->headerData['method'] = $method;
			$this->headerData['params'] = $params;
			
			$this->header_process($params);
			$this->lefter_process($params);
					
			$this->pre_process($params);	
			if (method_exists($this, $method)) {
				call_user_func_array(array($this, $method), $params);
			}    
			$this->post_process($params);
			
			$this->righter_process($params);
			$this->footer_process($params);
		}
		
		public function header_process($params) {
			return $this->load->view('layout/' . $this->layout->hedaer, $this->headerData, false);
		}
		public function lefter_process($params) {
			return $this->load->view('layout/' . $this->layout->lefter, $this->lefterData, false);
		}
		public function righter_process($params) {
			return $this->load->view('layout/' . $this->layout->righter, $this->righterData, false);
		}
		public function footer_process($params) {
			return $this->load->view('layout/' . $this->layout->footer, $this->footerData, false);
		}
		
		public abstract function pre_process($params);
		
		public abstract function post_process($params);	
	}
?>