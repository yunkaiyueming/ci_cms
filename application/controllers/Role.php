<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->_check_login();
	}

	public function index() {
		//让这个方法的页面缓存20分钟
		//$this->output->cache(20);
		//在这个控制器页面的最低端，显示运行过的SQL语句，以及$_POST信息
		//$this->output->enable_profiler(TRUE);
		$this->get_role_list();
	}

	public function get_role_list() {
		$this->config->load('role');
		$role_infos = $this->config->item('role');
		$view_data['role_infos'] = $role_infos;
		$item_descs = array('id' => 'id', 'desc' => '角色描述');
		$view_data['item_descs'] = $item_descs;
		//$view_data['title_name'] = '用户管理';
		$menus = $this->get_menu_data1();
		$view_data['menus'] = $menus;
		return $this->render_v2('role/view_role_list', $view_data);
	}
}
