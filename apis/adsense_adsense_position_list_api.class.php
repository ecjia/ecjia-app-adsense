<?php
defined('IN_ECJIA') or exit('No permission resources.');
/**
 * 广告位置列表
 * @author will.chen
 *
 */
class adsense_adsense_position_list_api extends Component_Event_Api {
	
    /**
     * @param  array $options	条件参数
     * @return array
     */
	public function call(&$options) {

		return $this->adsense_position_list($options);
	}
	
	/**
	 * 取得广告位列表
	 * @param   array $options	条件参数
	 * @return  array   广告位列表
	 */
	
	private function adsense_position_list($options) {
		$db = RC_Loader::load_app_model('ad_position_model', 'adsense');
		
		$filter = array();
		$filter['keywords']	  = empty($options['keywords']) ? '' : trim($options['keywords']);
		$filter['page_size']  = empty($options['page_size']) ? 15 : intval($options['page_size']);
		$filter['current_page'] = empty($options['current_page']) ? 1 : intval($options['current_page']);
		$filter['position_id']	= empty($options['position_id']) ? '' : $options['position_id'];
		$where = array();
		if (!empty($filter['keywords'])) {
			$where['position_name'] = array('like' => "%".$filter['keywords']."%");
		}
		if (!empty($filter['position_id'])) {
			$where['position_id'] = $filter['position_id'];
		}
		
		$limit = null;
		/* 判断是否需要分页 will.chen*/
		if (isset($options['is_page']) && $options['is_page'] == 1) {
			$count = $db->where($where)->count();
			$page = new ecjia_page($count, $filter['page_size'], 5, '', $filter['current_page']);
			$filter['record_count'] = $count;
			$limit = $page->limit();
		}
		
		$result = $db->where($where)->limit($limit)->select();
		
		if (isset($options['is_page']) && $options['is_page'] == 1) {
			return array('arr' => $result, 'page' => $page->show(15), 'desc' => $page->page_desc());
		} else {
			return array('arr' => $result);
		}
	}
	
}

// end