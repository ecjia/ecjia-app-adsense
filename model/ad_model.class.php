<?php
defined('IN_ECJIA') or exit('No permission resources.');

class ad_model extends Component_Model_Model {
	public $table_name = '';
	public function __construct() {
		$this->db_config = RC_Config::load_config('database');
		$this->db_setting = 'default';
		$this->table_name = 'ad';
		parent::__construct();
	}	
	
	/* 判断重复 */
	public function ad_count($where) {
	    return $this->where($where)->count();
	}
	
	/* 广告管理 */
	public function ad_manage($parameter) {
	    if (!isset($parameter['ad_id'])) {
	        $id = $this->insert($parameter);
	    } else {
	        $where = array('ad_id' => $parameter['ad_id']);
	
	        $this->where($where)->update($parameter);
	        $id = $parameter['ad_id'];
	    }
	    return $id;
	}
	
	/* 查询广告 */
	public function ad_info($id) {
	    return $this->find(array('ad_id' => $id));
	}
	
	/* 删除广告 */
	public function ad_delete($id) {
	    return $this->delete($id);
	}
}

// end