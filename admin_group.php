<?php
//
//    ______         ______           __         __         ______
//   /\  ___\       /\  ___\         /\_\       /\_\       /\  __ \
//   \/\  __\       \/\ \____        \/\_\      \/\_\      \/\ \_\ \
//    \/\_____\      \/\_____\     /\_\/\_\      \/\_\      \/\_\ \_\
//     \/_____/       \/_____/     \/__\/_/       \/_/       \/_/ /_/
//
//   上海商创网络科技有限公司
//
//  ---------------------------------------------------------------------------------
//
//   一、协议的许可和权利
//
//    1. 您可以在完全遵守本协议的基础上，将本软件应用于商业用途；
//    2. 您可以在协议规定的约束和限制范围内修改本产品源代码或界面风格以适应您的要求；
//    3. 您拥有使用本产品中的全部内容资料、商品信息及其他信息的所有权，并独立承担与其内容相关的
//       法律义务；
//    4. 获得商业授权之后，您可以将本软件应用于商业用途，自授权时刻起，在技术支持期限内拥有通过
//       指定的方式获得指定范围内的技术支持服务；
//
//   二、协议的约束和限制
//
//    1. 未获商业授权之前，禁止将本软件用于商业用途（包括但不限于企业法人经营的产品、经营性产品
//       以及以盈利为目的或实现盈利产品）；
//    2. 未获商业授权之前，禁止在本产品的整体或在任何部分基础上发展任何派生版本、修改版本或第三
//       方版本用于重新开发；
//    3. 如果您未能遵守本协议的条款，您的授权将被终止，所被许可的权利将被收回并承担相应法律责任；
//
//   三、有限担保和免责声明
//
//    1. 本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的；
//    2. 用户出于自愿而使用本软件，您必须了解使用本软件的风险，在尚未获得商业授权之前，我们不承
//       诺提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任；
//    3. 上海商创网络科技有限公司不对使用本产品构建的商城中的内容信息承担责任，但在不侵犯用户隐
//       私信息的前提下，保留以任何方式获取用户信息及商品信息的权利；
//
//   有关本产品最终用户授权协议、商业授权与技术服务的详细内容，均由上海商创网络科技有限公司独家
//   提供。上海商创网络科技有限公司拥有在不事先通知的情况下，修改授权协议的权力，修改后的协议对
//   改变之日起的新授权用户生效。电子文本形式的授权协议如同双方书面签署的协议一样，具有完全的和
//   等同的法律效力。您一旦开始修改、安装或使用本产品，即被视为完全理解并接受本协议的各项条款，
//   在享有上述条款授予的权力的同时，受到相关的约束和限制。协议许可范围以外的行为，将直接违反本
//   授权协议并构成侵权，我们有权随时终止授权，责令停止损害，并保留追究相关责任的权力。
//
//  ---------------------------------------------------------------------------------
//
defined('IN_ECJIA') or exit('No permission resources.');

class admin_group extends ecjia_admin {
    
    public function __construct() {
		parent::__construct();
		
		RC_Script::enqueue_script('smoke');
		RC_Script::enqueue_script('bootstrap-placeholder');
		RC_Script::enqueue_script('jquery-validate');
		RC_Script::enqueue_script('jquery-form');
		RC_Script::enqueue_script('jquery-uniform');
		RC_Style::enqueue_style('uniform-aristo');
		RC_Script::enqueue_script('jquery-chosen');
		RC_Style::enqueue_style('chosen');
		
		RC_Script::enqueue_script('bootstrap-editable.min', RC_Uri::admin_url('statics/lib/x-editable/bootstrap-editable/js/bootstrap-editable.min.js'));
		RC_Style::enqueue_style('bootstrap-editable', RC_Uri::admin_url('statics/lib/x-editable/bootstrap-editable/css/bootstrap-editable.css'));
			
		RC_Script::enqueue_script('adsense', RC_App::apps_url('statics/js/group.js', __FILE__));

		ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here('广告组编排', RC_Uri::url('adsense/admin_group/init')));
	}

	
	public function init() {
		$this->admin_priv('cycleimage_manage');
	
		ecjia_screen::get_current_screen()->remove_last_nav_here();
		ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here('广告组编排'));
		$this->assign('ur_here', '广告组列表');
		
		$this->display('adsense_group_list.dwt');
	}
	
	public function add() {
		$this->admin_priv('ad_group_update');
		 
		ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here('添加广告组'));
		$this->assign('ur_here', '添加广告组');
		$this->assign('action_link', array('href' => RC_Uri::url('adsense/admin_cycleimage/init'), 'text' => '轮播图设置'));
		 
		$city_list = $this->get_select_city();
		$this->assign('city_list', $city_list);
		
		$this->assign('form_action', RC_Uri::url('adsense/admin_cycleimage/insert_group'));
		 
		$this->display('adsense_group_info.dwt');
	}
	
	
	public function insert() {
		$this->admin_priv('ad_group_update');
		 
		$position_name = !empty($_POST['position_name']) ? trim($_POST['position_name']) : '';
		$position_code = !empty($_POST['position_code']) ? trim($_POST['position_code']) : '';
		$position_desc = !empty($_POST['position_desc']) ? nl2br(htmlspecialchars($_POST['position_desc'])) : '';
		$ad_width      = !empty($_POST['ad_width']) ? intval($_POST['ad_width']) : 0;
		$ad_height     = !empty($_POST['ad_height']) ? intval($_POST['ad_height']) : 0;
		$max_number    = !empty($_POST['max_number']) ? intval($_POST['max_number']) : 0;
		$sort_order    = !empty($_POST['sort_order']) ? intval($_POST['sort_order']) : 0;
		$city_id       = !empty($_POST['city_id']) ? intval($_POST['city_id']) : 0;
		$city_name     = RC_DB::TABLE('region')->where('region_id', $city_id)->pluck('region_name');
		if(!$city_name){
			$city_name = '默认';
		}
		$query = RC_DB::table('ad_position')->where('position_code', $position_code)->where('city_id', $city_id)->where('type', 'cycleimage')->count();
		if ($query > 0) {
			return $this->showmessage('该轮播组代号已存在', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
		}
		 
		$data = array(
				'position_name' => $position_name,
				'position_code' => $position_code,
				'ad_width'      => $ad_width,
				'ad_height'     => $ad_height,
				'max_number'    => $max_number,
				'position_desc' => $position_desc,
				'city_id' 		=> $city_id,
				'city_name' 	=> $city_name,
				'type' 			=> 'cycleimage',
				'sort_order' 	=> $sort_order,
		);
		$position_id = RC_DB::table('ad_position')->insertGetId($data);
		return $this->showmessage('添加轮播组成功', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS, array('pjaxurl' => RC_Uri::url('adsense/admin_cycleimage/edit_group', array('position_id' => $position_id, 'city_id' => $city_id))));
	}
	
	public function edit() {
		$this->admin_priv('ad_group_update');
		 
		ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here('编辑轮播组'));
		$this->assign('ur_here', '编辑轮播组');
		 
		ecjia_screen::get_current_screen()->add_help_tab(array(
		'id'		=> 'overview',
		'title'		=> RC_Lang::get('cycleimage::flashplay.overview'),
		'content'	=> '<p>欢迎访问ECJia智能后台编辑轮播组页面，可以在此页面编辑相应的轮播组信息。</p>'
				));
		 
		ecjia_screen::get_current_screen()->set_help_sidebar(
		'<p><strong>' . RC_Lang::get('cycleimage::flashplay.more_info') . '</strong></p>' .
		'<p>' . __('<a href="https://ecjia.com/wiki/帮助:ECJia智能后台:轮播图管理" target="_blank">关于编辑轮播组帮助文档</a>') . '</p>'
				);
		 
		$city_id     = $_GET['city_id'];
		$position_id = $_GET['position_id'];
		$this->assign('action_link', array('href' => RC_Uri::url('adsense/admin_cycleimage/init',array('city_id' => $city_id, 'position_id' => $position_id)), 'text' => '轮播图设置'));
		$this->assign('city_id', $city_id);
		$this->assign('position_id', $position_id);
		 
		$city_list = $this->get_select_city();
		$this->assign('city_list', $city_list);
		 
		$data = RC_DB::table('ad_position')->where('position_id', $position_id)->first();
		$this->assign('data', $data);
		 
		$this->assign('form_action', RC_Uri::url('adsense/admin_cycleimage/update_group'));
	
		$this->display('adsense_group_info.dwt');
	}
	
	public function update() {
		$this->admin_priv('ad_group_update');
	
		$position_name = !empty($_POST['position_name']) ? trim($_POST['position_name']) : '';
		$position_code = !empty($_POST['position_code']) ? trim($_POST['position_code']) : '';
		$position_desc = !empty($_POST['position_desc']) ? nl2br(htmlspecialchars($_POST['position_desc'])) : '';
		$ad_width      = !empty($_POST['ad_width']) ? intval($_POST['ad_width']) : 0;
		$ad_height     = !empty($_POST['ad_height']) ? intval($_POST['ad_height']) : 0;
		$max_number    = !empty($_POST['max_number']) ? intval($_POST['max_number']) : 0;
		$sort_order    = !empty($_POST['sort_order']) ? intval($_POST['sort_order']) : 0;
		$city_id       = !empty($_POST['city_id']) ? intval($_POST['city_id']) : 0;
		$city_name     = RC_DB::TABLE('region')->where('region_id', $city_id)->pluck('region_name');
		if(!$city_name){
			$city_name = '默认';
		}
		$position_id   = intval($_POST['position_id']);
		$query = RC_DB::table('ad_position')->where('position_code', $position_code)->where('type', 'cycleimage')->where('city_id', $city_id)->where('position_id', '!=', $position_id)->count();
		if ($query > 0) {
			return $this->showmessage('该轮播组代号已存在', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
		}
		 
		$data = array(
				'position_name' => $position_name,
				'ad_width'      => $ad_width,
				'ad_height'     => $ad_height,
				'max_number'    => $max_number,
				'position_desc' => $position_desc,
				'city_id' 		=> $city_id,
				'city_name' 	=> $city_name,
				'sort_order' 	=> $sort_order,
		);
		 
		RC_DB::table('ad_position')->where('position_id', $position_id)->update($data);
		 
		return $this->showmessage('编辑轮播组成功', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS, array('pjaxurl' => RC_Uri::url('adsense/admin_cycleimage/edit_group', array('position_id' => $position_id,'city_id' => $city_id))));
	}
	
	public function delete() {
		$this->admin_priv('ad_group_delete');
		 
		$position_id = intval($_GET['position_id']);
		$city_id = intval($_GET['city_id']);
		if (RC_DB::table('ad')->where('position_id', $position_id)->count() > 0) {
			return $this->showmessage('该轮播组已存在轮播图，暂不能删除！', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
		} else {
			RC_DB::table('ad_position')->where('position_id', $position_id)->delete();
		}
		 
		$count = RC_DB::TABLE('ad_position')->where('type', 'cycleimage')->where('city_id', $city_id)->count();
		if(!$count){
			return $this->showmessage('成功删除轮播组', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS,array('pjaxurl' => RC_Uri::url('adsense/admin_cycleimage/init')));
		}else{
			return $this->showmessage('成功删除轮播组', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS,array('pjaxurl' => RC_Uri::url('adsense/admin_cycleimage/init',array('city_id' => $city_id))));
		}
		 
	}
	
	
	/**
	 * 添加商品关联
	 */
	public function add_link_goods() {
		$this->admin_priv('goods_update', ecjia::MSGTYPE_JSON);
	
		$goods_id		= intval($_GET['goods_id']);
		$linked_array 	= !empty($_GET['linked_array']) ? $_GET['linked_array'] : '';
	
		$this->db_link_goods->where(array('link_goods_id' => $goods_id))->update(array('is_double' => 0));
		$this->db_link_goods->where(array('goods_id' => $goods_id))->delete();
	
		$data = array();
		if (!empty($linked_array)) {
			foreach ($linked_array AS $val) {
				$is_double = $val['is_double'] ? 1 : 0;
				if (!empty($is_double)) {
					/* 双向关联,先干掉与本商品关联的商品，再添加关联给与本商品关联的商品 */
					$this->db_link_goods->where(array('goods_id' => $val, 'link_goods_id' => $goods_id))->delete();
					$data[] = array(
							'goods_id'		=> $val['id'],
							'link_goods_id'	=> $goods_id,
							'is_double'		=> $is_double,
							'admin_id'		=> $_SESSION['admin_id'],
					);
				}
				$data[] = array(
						'goods_id'		=> $goods_id,
						'link_goods_id'	=> $val['id'],
						'is_double'		=> $is_double,
						'admin_id'		=> $_SESSION['admin_id'],
				);
			}
		}
		if (!empty($data)) {
			$this->db_link_goods->batch_insert($data);
		}
		$goods_name = $this->db_goods->where(array('goods_id'=>$goods_id))->get_field('goods_name');
	
		/* 释放app缓存*/
		$goods_cache_array = $this->orm_goods_db->get_cache_item('goods_list_cache_key_array');
		if (!empty($goods_cache_array)) {
			foreach ($goods_cache_array as $val) {
				$this->orm_goods_db->delete_cache_item($val);
			}
			$this->orm_goods_db->delete_cache_item('goods_list_cache_key_array');
		}
		/*释放商品基本信息缓存*/
		$cache_goods_basic_info_key = 'goods_basic_info_'.$goods_id;
		$cache_basic_info_id = sprintf('%X', crc32($cache_goods_basic_info_key));
		$this->orm_goods_db->delete_cache_item('goods_list_cache_key_array');
	
		ecjia_admin::admin_log('增加关联商品，被设置的商品名称是'.$goods_name, 'setup', 'goods');
	
	
		$pjaxurl = RC_Uri::url('goods/admin/edit_link_goods', array('goods_id' => $goods_id));
		return $this->showmessage(RC_Lang::get('goods::goods.edit_success'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS, array('pjaxurl' => $pjaxurl));
	}
	
	/**
	 * 搜索商品，仅返回名称及ID
	 */
	public function get_position_list() {
		$filter = $_GET['JSON'];
		$arr = RC_Api::api('adsense', 'get_position_list', $filter);
		$opt = array();
		if (!empty($arr)) {
			foreach ($arr AS $key => $val) {
				$opt[] = array(
					'value' => $val['goods_id'],
					'text'  => $val['goods_name'],
					'data'  => $val['shop_price']
				);
			}
		}
		return $this->showmessage('', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS, array('content' => $opt));
	}
	
	/**
	 * 获取热门城市
	 */
	private function get_select_city() {
		$data = explode(',', ecjia::config('mobile_recommend_city'));
		$data = RC_DB::table('region')->whereIn('region_id', $data)->get();
		$regions = array ();
		if (!empty($data)) {
			foreach ($data as $row) {
				$regions[$row['region_id']] = addslashes($row['region_name']);
			}
		}
		return $regions;
	}
	
	private function get_show_client(){
		$client_list = array(
				'iPhone' => Ecjia\App\Adsense\Client::IPHONE,
				'Android'=> Ecjia\App\Adsense\Client::ANDROID,
				'H5' 	 => Ecjia\App\Adsense\Client::H5,
				'PC'     => Ecjia\App\Adsense\Client::PC
		);
		return $client_list;
	}
	
	
    
}