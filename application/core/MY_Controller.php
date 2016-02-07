<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $sidebar_file = "view_common_sidebar";
	public $main_file = "";

	public function __construct() {
		parent::__construct();
		session_start();

		$this->load->helper('url');
		$this->load->model('User_model');
		$this->load->model('Function_model');
		$this->load->model('Models_model');

		error_reporting(E_ALL ^ E_NOTICE);
	}

	protected function render($main_file, $view_data){
		$this->load->view('view_header', $view_data);
		if(!empty($this->sidebar_file)){
			$this->load->view($this->sidebar_file, $view_data);
		}
		$this->load->view($main_file, $view_data);
		$this->load->view('view_footer');
	}


	public function _check_login() {
		if (empty($_SESSION['uid'])) {
			redirect('login/index');
		}
	}
	
	public function get_menu_by_user_id(){
		
	}
	
	private function _get_all_menu_data() {
		$menus = array(
			array(
				'desc' => 'PHP函数',
				'active_pattern' => '/php_study/i',
				'icon' => 'icon-book',
				'level2_menus' => array(
					array(
						'desc' => '字符串处理',
						'url' => 'php_study/string_demo',
						'active_pattern' => '/php_study\/string_demo/i',
					),
					array(
						'desc' => '数组处理',
						'url' => 'php_study/array_demo',
						'active_pattern' => '/php_study\/array_demo/i',
					),
					array(
						'desc' => 'XML处理',
						'url' => 'php_study/xml_demo',
						'active_pattern' => '/php_study\/xml_demo/i',
					),
				),
			),
			array(
				'desc' => '书籍栏目',
				'active_pattern' => '/book/i',
				'icon' => 'icon-book',
				'level2_menus' => array(
					array(
						'desc' => '书籍管理',
						'url' => 'book/get_book_infos',
						'active_pattern' => '/book\/get_book_infos/i',
					),
					array(
						'desc' => '书籍配置',
						'url' => 'book/book_config',
						'active_pattern' => '/book\/book_config/i',
					),
				),
			),
			array(
				'desc' => '文件栏目',
				'active_pattern' => '/file/i',
				'icon' => 'icon-book',
				'level2_menus' => array(
					array(
						'desc' => '文件管理',
						'url' => 'file/get_file_by_dir',
						'active_pattern' => '/file\/get_file_by_dir/i',
					),
					array(
						'desc' => '文件配置',
						'url' => 'week_report/groups_report_list',
						'active_pattern' => '/week_report\/groups_report_list/i',
					),
					array(
						'desc' => '文件上传',
						'url' => 'file/file_post',
						'active_pattern' => '/file\/file_post/i',
					),
					array(
						'desc' => '文件下载',
						'url' => 'file/file_down',
						'active_pattern' => '/file\/file_down/i',
					),
				),
			),
			array(
				'desc' => '图片管理',
				'active_pattern' => '/week_report/i',
				'icon' => 'icon-book',
				'level2_menus' => array(
					array(
						'desc' => '验证码',
						'url' => 'file/get_file_by_dir',
						'active_pattern' => '/file\/get_file_by_dir/i',
					),
				),
			),
			array(
				'desc' => 'HTTP',
				'active_pattern' => '/http/i',
				'icon' => 'icon-book',
				'level2_menus' => array(
					array(
						'desc' => 'curl示例',
						'url' => 'Http/http_curl',
						'active_pattern' => '/http\/http_curl/i',
					),
					array(
						'desc' => 'QueryList库',
						'url' => 'Http/http_query_list',
						'active_pattern' => '/http\/http_query_list/i',
					),
				),
			),
		);
		return $menus;
	}

	public function get_menu_data1() {
		$menus = array(
			array(
				'desc' => '用户管理',
				'active_pattern' => '/php_study/i',
				'icon' => 'icon-book',
				'level2_menus' => array(
					array(
						'desc' => '查看用户',
						'url' => 'user/get_user_infos',
						'active_pattern' => '/php_study\/string_demo/i',
					),
					array(
						'desc' => '添加用户',
						'url' => 'user/add',
						'active_pattern' => '/php_study\/array_demo/i',
					),
				),
			),
			array(
				'desc' => '角色管理',
				'active_pattern' => '/user/i',
				'icon' => 'icon-book',
				'level2_menus' => array(
					array(
						'desc' => '角色列表',
						'url' => 'role/get_role_list',
						'active_pattern' => '/role\/get_role_list/i',
					),
				),
			),
			array(
				'desc' => '模块管理',
				'active_pattern' => '/book/i',
				'icon' => 'icon-book',
				'level2_menus' => array(
					array(
						'desc' => '查看模块',
						'url' => 'models/get_model_infos',
						'active_pattern' => '/book\/get_book_infos/i',
					),
				),
			),
			array(
				'desc' => '权限管理',
				'active_pattern' => '/file/i',
				'icon' => 'icon-book',
				'level2_menus' => array(
					array(
						'desc' => '分配权限',
						'url' => 'functions/allot_role_modles',
						'active_pattern' => '/functions\/allot_role_modles/i',
					),
					array(
						'desc' => '角色功能',
						'url' => 'functions/get_function_list',
						'active_pattern' => '/functions\/get_function_list/i',
					),
				),
			),
		);
		return $menus;
	}

	public function get_all_models_by_uid($uid) {
		$roles = $this->User_model->get_roles_by_uid($uid);
		$role = explode(";", $roles['roles']);
		$modle_ids = "";
		$role_res = "";
		for ($i = 0; $i < count($role) - 2; $i++) {
			$role_res .= "'" . $role[$i] . "',";
		}
		$role_res = $role_res . "'" . $role[count($role) - 2] . "'";
		$query_res = $this->Function_model->get_modele_ids_by_roleid($role_res);
		$modle_ids = "";
		for ($i = 0; $i < count($query_res); $i++) {
			$modle_ids.=$query_res[$i]['mode_ids'];
		}
		$modle_id_res = array();
		$modle_id = explode(";", $modle_ids);
		for ($j = 0; $j < count($modle_id) - 1; $j++) {
			if (!in_array($modle_id[$j], $modle_id_res)) {
				$modle_id_res[] = $modle_id[$j];
			}
		}
		$modle_str_res = implode("','", $modle_id_res);
		$modle_query_res = $this->Models_model->get_modles_by_ids($modle_str_res);
		$modles_infos = "";
		for ($p = 0; $p < count($modle_query_res); $p++) {
			$modles_infos.=$modle_query_res[$p]['modle_name'] . ";";
		}
		$datas['modles_names'] = $modles_infos;
		$datas['modles_ids'] = $modle_id_res;
		return $datas;
	}

	//判断一个用户，是否有某一个权限
	public function is_user_has_modle($userid, $modleid) {
		$modle_infos = $this->get_all_models_by_uid($userid);
		//判断给定的权限是否在这个用户的权限列表中
		$arr_modle_id = $modle_infos['modles_ids'];
		if (in_array($modleid, $arr_modle_id)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}
