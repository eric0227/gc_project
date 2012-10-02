<?php
require_once(APPPATH . '/controllers/test/Toast.php');

/*
 * CREATE TABLE gc_test (
	idx			INT				NOT NULL AUTO_INCREMENT,
	id			VARCHAR(32)	,
	title		VARCHAR(32)	,
	content		text,
	level		INT(2)			default 1,
	primary key (idx)
)
 */

class Db_test extends Toast
{
	public static $TABLE = "test";
	
	function __construct()
	{
		parent::__construct(__FILE__);
		// Load any models, libraries etc. you need here
		$this->load->database();
	}

	function _pre() {}

	function _post() {}


	/* TESTS BELOW */
	function test_connectDB() {
		$this->_assert_not_empty($this->db); // true
	}
	
	function test_insert() {
		$data = $this->makeDumyData();
				
		$result = $this->db->insert(Db_test::$TABLE, $data);
				
		$this->_assert_true($result == 1); // true
		$this->message = "Inserte ok."; 		
	}
	
	function test_delete() {
				
		$result = $this->db->where('level = 5');
		$count = $this->db->count_all_results(Db_test::$TABLE);
		log_message('debug', 'COUNT : '. $count); 
		
		$result = $this->db->where('level = 5');
		$result = $this->db->delete(Db_test::$TABLE);
		log_message('debug', 'DELETE COUNT : '. $result);
	
		$this->_assert_true($result == $count); // true
		$this->message = "Delete ok.";		
	}
	
	function makeDumyData() {
		return  array(
			'id'=>'test',
			'title'=>'TITLE..',
			'content'=>'CONTENT..',
			'level'=>5			
		);
	}
}
	
?>