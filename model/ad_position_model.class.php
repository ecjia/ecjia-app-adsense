<?php
defined('IN_ECJIA') or exit('No permission resources.');

class ad_position_model extends Component_Model_Model {
	public $table_name = '';
	public function __construct() {
		$this->db_config = RC_Config::load_config('database');
		$this->db_setting = 'default';
		$this->table_name = 'ad_position';
		parent::__construct();
	}
}

// end