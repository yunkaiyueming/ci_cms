<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Models extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->_check_login();
	}

	public function index() {
		//让这个方法的页面缓存20分钟
		//$this->output->cache(20);
		//在这个控制器页面的最低端，显示运行过的SQL语句，以及$_POST信息
		//$this->output->enable_profiler(TRUE);
		$this->get_model_infos();
	}

	public function get_model_infos() {
		$this->load->model('Models_model');
		$user_infos = $this->Models_model->get_all_modle_info();
		$view_data['user_infos'] = $user_infos;
		$item_descs = array('id' => 'id', 'modle_name' => '模块儿名', 'modle_desc' => '模块描述','操作'=>'操作');
		$view_data['item_descs'] = $item_descs;
		//$view_data['title_name'] = '用户管理';
		$menus = $this->get_menu_data1();
		$view_data['menus'] = $menus;
		return $this->render('modle/view_modle_list', $view_data);
	}

	public function add() {
		$this->load->helper('url');
		$this->load->model('Models_model');
		//$view_data['title_name'] = '用户管理';
		$menus = $this->get_menu_data1();
		$view_data['menus'] = $menus;
		$this->render('modle/view_model_add', $view_data);
	}

	public function add_model_info() {
		$this->load->helper('url');
		//$clean_user_name = $this->security->xss_clean($_POST['user_name']);
		$view_data = array(
			'modle_name' => $this->security->xss_clean($_POST['model_name']),
			'modle_desc' => htmlspecialchars($_POST['model_desc']),
		);

		$this->load->model('Models_model');
		$view_data['count'] = $this->Models_model->add_modle_info($view_data);
		if ($view_data['count'] > 0) {
			redirect('models/get_model_infos');
		}
	}

	public function delete_model_info() {
		$this->load->helper('url');
		$this->load->model('Models_model');
		$view_data['count'] = $this->Models_model->delete_models_info($_GET['id']);
		if ($view_data['count'] > 0) {
			redirect('Models/get_model_infos');
		}
	}

	public function update() {
		$this->load->helper('url');
		$data['id'] = $_GET['id'];
		$this->load->model('Models_model');
		$view_data['modle_info'] = $this->Models_model->get_modle_info_byid($_GET['id']);
		//$view_data['title_name'] = '用户管理';
		$menus = $this->get_menu_data1();
		$view_data['menus'] = $menus;
		return $this->render('modle/view_modle_update', $view_data);
	}

	public function update_model_info() {
		$this->load->helper('url');
		$id = $_POST['id'];
		$data = array(
			'modle_name' => $_POST['modle_name'],
			'modle_desc' => $_POST['modle_desc']
		);
		$this->load->model('Models_model');
		$view_data['count'] = $this->Models_model->update_modle_info($id, $data);
		if ($view_data['count'] > 0) {
			redirect('Models/get_model_infos');
		}
	}

	function test() {
		$this->load->helper('Common');
		$pwd = $this->input->get_post('pwd');
		$encrypt_pwd = my_crypt($pwd);
		log_message('info', 'The purpose of some variable is to provide some value.');
	}

	function test_send_mail() {
		$this->load->helper('my_email');
		echo MY_Email::send_email('hongcheng_test', 'hello,ci', '', '1835373375@qq.com');
	}

	function test_sql() {
		$this->load->model('User_model');
		$data1 = $this->User_model->get_user_info_byid1('4');
		$data2 = $this->User_model->get_user_info_byid2('4');
		$data3 = $this->User_model->get_user_info_byid3('4');
		print_r($data1);
		echo '<br/>';
		print_r($data2);
		echo '<br/>';
		print_r($data3);
		echo '<br/>';
	}
	
	//给用户分配角色
	function allot_role(){
		$this->config->load('role');
		$view_data['role_infos'] = $this->config->item('role');
		$view_data['menus']=$this->get_menu_data1();
		return $this->render('role/view_allot_role', $view_data);
	}
	
	function add_user_role(){
		$id=$_POST['userid'];
		$roles_infos=$_POST['check_role'];
		$data="";
		foreach ($roles_infos as $role_info){
			$data=$data.$role_info.";";
		}
		$this->load->model('User_model');
		$refletion=$this->User_model->add_user_role($id,$data);
		$this->get_user_infos();
	}

}

