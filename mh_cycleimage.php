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

class mh_cycleimage extends ecjia_merchant {
    
    public function __construct() {
		parent::__construct();
		RC_Style::enqueue_style('adsense', RC_App::apps_url('statics/styles/mh_cycleimage.css', __FILE__), array());
		
		RC_Script::enqueue_script('smoke');
		RC_Script::enqueue_script('jquery-validate');
		RC_Script::enqueue_script('jquery-form');

		RC_Script::enqueue_script('bootstrap-editable-script', dirname(RC_App::app_dir_url(__FILE__)) . '/merchant/statics/assets/bootstrap-fileupload/bootstrap-fileupload.js', array());
		RC_Style::enqueue_style('bootstrap-fileupload', dirname(RC_App::app_dir_url(__FILE__)) . '/merchant/statics/assets/bootstrap-fileupload/bootstrap-fileupload.css', array(), false, false);
		RC_Script::enqueue_script('mh_cycleimage', RC_App::apps_url('statics/js/mh_cycleimage.js', __FILE__) , array() , false, true);
		
		RC_Script::enqueue_script('adsense', RC_App::apps_url('statics/js/mh_cycleimage.js', __FILE__));
		
	
	}
    
    public function init() {
    	$this->admin_priv('mh_cycleimage_manage');
    	
    	ecjia_screen::get_current_screen()->remove_last_nav_here();
    	ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here('轮播图管理'));
    	$this->assign('ur_here', '轮播图列表');
    	
    	//获取城市
    	$citymanage = new Ecjia\App\Adsense\CityManage('cycleimage');
    	
    	$city_list = $citymanage->getAllCitys();
    	$this->assign('city_list', $city_list);
    	
    	//获取当前城市ID
    	$city_id = $citymanage->getCurrentCity(intval($_GET['city_id']));
    	$this->assign('city_id', $city_id);
    	
    	//获取轮播组
    	$position = new Ecjia\App\Adsense\PositionManage('cycleimage', $city_id);
    	$data = $position->getAllPositions();
    	$this->assign('data', $data);
    	
    	$position_id = intval($_GET['position_id']);
    	if (empty($position_id) && !empty($data)) {
    		$position_id = head($data)['position_id'];
    		$position_code = head($data)['position_code'];
    	}
    	$this->assign('position_id', $position_id);
    	
    	if ($position_id > 0) {
    		//获取投放平台
    		$ad = new Ecjia\App\Adsense\Repositories\AdRepository('cycleimage');
    		$client_list = $ad->getAllClients();
    		$available_clients = $ad->getAvailableClients($position_id);
    	
    		$this->assign('client_list', $client_list);
    		$this->assign('available_clients', $available_clients);
    	
    	
    		$show_client = intval($_GET['show_client']);
    		if (empty($show_client) && !empty($available_clients)) {
    			$show_client = $client_list[head(array_keys($available_clients))];
    		}
    		$this->assign('show_client', $show_client);
    	
    		//对应的轮播图列表
    		$cycleimage_list = $ad->getSpecialAds($position_id, $show_client);
    		$this->assign('cycleimage_list', $cycleimage_list);
    	
    		$position_code = RC_DB::TABLE('merchants_ad_position')->where('position_id', $position_id)->pluck('position_code');
    	}
    	
    	$this->assign('position_code', $position_code);
    	
    	$this->display('mh_cycleimage_list.dwt');
    	
    	
    }

    public function add_group() {
    	$this->admin_priv('cycleimage_update');
    	ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here('添加轮播组'));
    	$this->assign('ur_here', '添加轮播组');
    	$this->assign('action_link', array('href' => RC_Uri::url('adsense/mh_cycleimage/init'), 'text' => '轮播图设置'));
    	
    	$this->assign('form_action', RC_Uri::url('adsense/mh_cycleimage/insert_group'));
    	
    	$this->display('mh_cycleimage_group_info.dwt');
    }

    public function insert_group() {
    	$this->admin_priv('cycleimage_update');
    	
    	$position_name = !empty($_POST['position_name']) ? trim($_POST['position_name']) : '';
    	$position_code = !empty($_POST['position_code']) ? trim($_POST['position_code']) : '';
    	$position_desc = !empty($_POST['position_desc']) ? nl2br(htmlspecialchars($_POST['position_desc'])) : '';
    	$ad_width      = !empty($_POST['ad_width']) ? intval($_POST['ad_width']) : 0;
    	$ad_height     = !empty($_POST['ad_height']) ? intval($_POST['ad_height']) : 0;
    	$max_number    = !empty($_POST['max_number']) ? intval($_POST['max_number']) : 0;
    	$sort_order    = !empty($_POST['sort_order']) ? intval($_POST['sort_order']) : 0;

    	$data = array(
    		'store_id'		=> $_SESSION['store_id'],
    		'position_name' => $position_name,
    		'position_code' => $position_code,
    		'position_desc' => $position_desc,
    		'ad_width'      => $ad_width,
    		'ad_height'     => $ad_height,
    		'max_number'    => $max_number,
    		'type' 			=> 'cycleimage',
    		'sort_order' 	=> $sort_order,
    	);
    	$position_id = RC_DB::table('merchants_ad_position')->insertGetId($data);
    	ecjia_merchant::admin_log($position_name, 'add', 'group_cycleimage');
    	return $this->showmessage('添加轮播组成功', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS, array('pjaxurl' => RC_Uri::url('adsense/mh_cycleimage/edit_group', array('position_id' => $position_id))));
    }    

    public function edit_group() {
    	$this->admin_priv('cycleimage_update');
    	
    	ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here('编辑轮播组'));
    	$this->assign('ur_here', '编辑轮播组');
    	
    	$position_id = intval($_GET['position_id']);
    	$this->assign('action_link', array('href' => RC_Uri::url('adsense/mh_cycleimage/init',array('position_id' => $position_id)), 'text' => '轮播图设置'));
    	$this->assign('position_id', $position_id);
   
    	$data = RC_DB::table('merchants_ad_position')->where('position_id', $position_id)->first();
    	$this->assign('data', $data);
    	
    	$this->assign('form_action', RC_Uri::url('adsense/mh_cycleimage/update_group'));
    	 
    	$this->display('mh_cycleimage_group_info.dwt');
    }
    
    public function update_group() {
    	$this->admin_priv('cycleimage_update');
    	
    	$position_id   = intval($_POST['position_id']);
    	$position_name = !empty($_POST['position_name']) ? trim($_POST['position_name']) : '';
    	$position_code = !empty($_POST['position_code']) ? trim($_POST['position_code']) : '';
    	$position_desc = !empty($_POST['position_desc']) ? nl2br(htmlspecialchars($_POST['position_desc'])) : '';
    	$max_number    = !empty($_POST['max_number']) ? intval($_POST['max_number']) : 0;
    	$sort_order    = !empty($_POST['sort_order']) ? intval($_POST['sort_order']) : 0;
    	$ad_width      = !empty($_POST['ad_width']) ? intval($_POST['ad_width']) : 0;
    	$ad_height     = !empty($_POST['ad_height']) ? intval($_POST['ad_height']) : 0;
     	
    	$data = array(
    		'position_name' => $position_name,
    		'position_code' => $position_code,
    		'position_desc' => $position_desc,
    		'max_number'    => $max_number,
    		'sort_order' 	=> $sort_order,
    		'ad_width'      => $ad_width,
    		'ad_height'     => $ad_height,
    	);
    	
    	RC_DB::table('merchants_ad_position')->where('position_id', $position_id)->update($data);
    	ecjia_merchant::admin_log($position_name, 'edit', 'group_cycleimage');
    	return $this->showmessage('编辑轮播组成功', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS, array('pjaxurl' => RC_Uri::url('adsense/mh_cycleimage/edit_group', array('position_id' => $position_id))));
    }
    
    public function delete_group() {
    	$this->admin_priv('cycleimage_delete');
    	
    	$position_id = intval($_GET['position_id']);
    	$position_name = RC_DB::TABLE('merchants_ad_position')->where('position_id', $position_id)->pluck('position_name');
    	if (RC_DB::table('ad')->where('position_id', $position_id)->count() > 0) {
    		return $this->showmessage('该轮播组已存在轮播图，暂不能删除！', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    	} else {
    		RC_DB::table('merchants_ad_position')->where('position_id', $position_id)->delete();
    		ecjia_merchant::admin_log($position_name, 'remove', 'group_cycleimage');
    		$count = RC_DB::TABLE('merchants_ad_position')->where('type', 'cycleimage')->count();
    		if(!$count){
    			return $this->showmessage('成功删除轮播组', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS,array('pjaxurl' => RC_Uri::url('adsense/mh_cycleimage/init')));
    		}else{
    			return $this->showmessage('成功删除轮播组', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS,array('pjaxurl' => RC_Uri::url('adsense/mh_cycleimage/init')));
    		}
    	}
    }
    
    public function copy() {
    	$this->admin_priv('cycleimage_update');
    	 
    	$position_id = intval($_GET['position_id']);
    	$position_code = RC_DB::TABLE('merchants_ad_position')->where('position_id', $position_id)->pluck('position_code');
    	$position_name = trim($_GET['position_name']);
    	$position_desc = $_GET['position_desc'];
    	$max_number    = intval($_GET['max_number']);
    	$sort_order    = intval($_GET['sort_order']);
    	$ad_width      = intval($_GET['ad_width']);
    	$ad_height     = intval($_GET['ad_height']);
    	
    	$data = array(
    		'store_id'		=> $_SESSION['store_id'],	
    		'position_name' => $position_name,
    		'position_code' => $position_code,
    		'position_desc' => $position_desc,
    		'ad_width'      => $ad_width,
    		'ad_height'     => $ad_height,
    		'max_number'    => $max_number,
    		'type' 			=> 'cycleimage',
    		'sort_order' 	=> $sort_order,
    	);
    	$position_id = RC_DB::table('merchants_ad_position')->insertGetId($data);
    	ecjia_merchant::admin_log($position_name, 'copy', 'group_cycleimage');
    	return $this->showmessage('复制成功', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS, array('pjaxurl' => RC_Uri::url('adsense/mh_cycleimage/edit_group', array('position_id' => $position_id))));
    }
    
}