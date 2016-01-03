<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->helper('url');
		$this->load->model('User_model');
		$this->load->library('ValidateCode');
	}

	function index() {
		if(empty($_SESSION['uid'])){
			return $this->render_v2('login/view_login');
		}else{
			redirect('user/get_user_infos');
		}
	}

	function do_login() {
		$user_name = $this->input->get_post('user_name');
		$pwd = $this->input->get_post('pwd');
		$check_code = $this->input->get_post('check_code');
		$exist_res = $this->User_model->get_user_by_name_pwd($user_name, $pwd);
		if (!empty($exist_res) && (strtolower($check_code) == strtolower($_SESSION['check_code']))) {
			$_SESSION['uid'] = $exist_res['id'];
			$_SESSION['user_name'] = $exist_res['user_name'];
			redirect('book/index');
		} else {
			$view_data['error'] = 'user or pwd is wrong';
			$this->render_v2('login/view_login', $view_data);
		}
	}

	function logout() {
		if (!empty($_SESSION)) {
			session_destroy();
		}
		redirect('login/index');
	}
	
	function sitefunction(){
		$this->load->model('User_model');
		$user_infos = $this->User_model->get_all_user_info();
		$view_data['user_infos'] = $user_infos;
		$item_descs = array('id' => 'id', 'name' => '用户名', 'pwd' => '密码','role'=>'角色', 'ope' => '操作');
		$view_data['item_descs'] = $item_descs;
		$view_data['title_name'] = '用户管理';
		//$menus = $this->get_menu_data1();
		$view_data['menus'] = $menus;
		//return $this->render_v2('user/view_user_list2', $view_data);
		
		$this->config->load('manage_center');
		$view_data['menus']=$this->get_menu_data1();
		$this->render_v3('user/view_user_list2', $view_data);
	}

}
