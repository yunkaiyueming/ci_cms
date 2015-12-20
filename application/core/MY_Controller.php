<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public $sidebar_file = "";

	public function __construct() {
		//error_reporting(0);
		parent::__construct();
		session_start();
	}

	protected function render_v2($main_file, $view_data){
		$this->load->view('view_header', $view_data);
		$this->laod->view($this->$sidebar_file, $view_data);
		$this->load->view($main_file, $view_data);
		$this->load->view('view_footer');
	}

	public function check_login(){

	}

	public function get_menu_data(){
		$menus = array(
			array(
				'desc' => '用户栏目',
				'active_pattern' => '/week_report/i',
				'icon' => 'icon-book',
				'level2_menus' => array(
					array(
						'desc' => '用户管理',
						'url' => 'user/get_user_infos',
						'active_pattern' => '/week_report\/report_list/i',
					),
					array(
						'desc' => '权限设置',
						'url' => 'week_report/groups_report_list',
						'active_pattern' => '/week_report\/groups_report_list/i',
					),
				),
			),

			array(
				'desc' => '书籍栏目',
				'active_pattern' => '/week_report/i',
				'icon' => 'icon-book',
				'level2_menus' => array(
					array(
						'desc' => '书籍管理',
						'url' => 'book/get_book_infos',
						'active_pattern' => '/week_report\/report_list/i',
					),
					array(
						'desc' => '书籍配置',
						'url' => 'week_report/groups_report_list',
						'active_pattern' => '/week_report\/groups_report_list/i',
					),
				),
			),

			array(
				'desc' => '文件栏目',
				'active_pattern' => '/week_report/i',
				'icon' => 'icon-book',
				'level2_menus' => array(
					array(
						'desc' => '文件管理',
						'url' => 'file/get_file_by_dir',
						'active_pattern' => '/week_report\/report_list/i',
					),
					array(
						'desc' => '文件配置',
						'url' => 'week_report/groups_report_list',
						'active_pattern' => '/week_report\/groups_report_list/i',
					),
				),
			),
		);
	}
	
}
