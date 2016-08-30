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
	
	/**
	 * 取得广告位置数组（用于生成下拉列表）
	 *
	 * @return  array  
	 */
	public function ad_position_select($option) {
		return $this->field($option['field'])->order($option['order'])->select();
	}
	
	/**
	 * 获取广告位置列表
	 *
	 * @return array
	 */
	public function ad_position_list($option) {
	    return $this->where($option['where'])->order($option['order'])->limit($option['limit'])->select();
	}
	
	/* 广告位管理 */
	public function ad_position_manage($parameter) {
	    if (!isset($parameter['position_id'])) {
	        $id = $this->insert($parameter);
	    } else {
	        $where = array('position_id' => $parameter['position_id']);
	         
	        $this->where($where)->update($parameter);
	        $id = $parameter['position_id'];
	    }
	    return $id;
	}
	
	/* 查询广告位 */
	public function ad_position_info($id) {
	    return $this->find(array('position_id' => $id));
	}
	
	/* 删除广告位 */
	public function ad_position_delete($id) {
	    return $this->delete($id);
	}
	
	/* 判断重复 */
	public function ad_position_count($where) {
	    return $this->where($where)->count();
	}
}

// end