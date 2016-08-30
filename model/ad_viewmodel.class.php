<?php
defined('IN_ECJIA') or exit('No permission resources.');

class ad_viewmodel extends Component_Model_View {
	public $table_name = '';
	public $view = array();
	public function __construct() {
		$this->db_config = RC_Config::load_config('database');
		$this->db_setting = 'default';
		$this->table_name = 'ad';
		$this->table_alias_name = 'ad';

		$this->view = array(
			'ad_position' => array(
				'type'  => Component_Model_View::TYPE_LEFT_JOIN,
				'alias' => 'p',
				'on'    => 'p.position_id  = ad.position_id',
			),
		);
		parent::__construct();
	}

	/**
	 * 取得广告列表数组
	 *
	 * @return  array
	 */
	public function ad_list($option) {
	    return $this->field($option['field'])->where($option['where'])->group($option['group'])->order($option['order'])->limit($option['limit'])->select();
	}
	
	public function ad_count($where) {
		return $this->where($where)->count();
	}
}

// end