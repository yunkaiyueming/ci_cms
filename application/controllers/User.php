<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
			
	public function __construct() {
		parent::__construct();
		$this->_check_login();
	}

	public function index() {
		//让这个方法的页面缓存20分钟
		//$this->output->cache(20);
		//在这个控制器页面的最低端，显示运行过的SQL语句，以及$_POST信息
		//$this->output->enable_profiler(TRUE);
		$this->get_user_infos();
	}

	public function get_user_infos() {
		$this->load->model('User_model');
		$user_infos = $this->User_model->get_all_user_info();
		
		//处理角色信息
		$this->load->config('role');
		$config_role_infos = $this->config->item('role');

		foreach($user_infos as &$user_info){
			$roles_temp="";
			$user_roles_arr = explode(";", $user_info['roles']);
			foreach($user_roles_arr as $role_id){
				foreach($config_role_infos as $config_role_info){
					if($role_id==$config_role_info['id']){
						$roles_temp .= $config_role_info['desc'].', ';
					}
				}
			}
			
			$user_info['roles']= substr($roles_temp, 0, -2) ;
		}
		
		$view_data['user_infos'] = $user_infos;
		$item_descs = array('id' => 'id', 'name' => '用户名', 'pwd' => '密码','role'=>'角色', 'ope' => '操作');
		$view_data['item_descs'] = $item_descs;
		$view_data['title_name'] = '用户管理';
		$menus = $this->get_menu_data1();
		$view_data['menus'] = $menus;
		return $this->render('user/view_user_list2', $view_data);
	}

	public function add() {
		$this->load->helper('url');
		$this->load->model('User_model');
		$view_data['title_name'] = '用户管理';
		$menus = $this->get_menu_data1();
		$view_data['menus'] = $menus;
		$this->render('user/view_user_add', $view_data);
	}

	public function add_user_info() {
		$this->load->helper('url');
		//$clean_user_name = $this->security->xss_clean($_POST['user_name']);
		$view_data = array(
			'user_name' => $this->security->xss_clean($_POST['user_name']),
			'pwd' => htmlspecialchars($_POST['pwd']),
			'roles'=>htmlspecialchars($_POST['role']),
		);

		$this->load->model('User_model');
		$view_data['count'] = $this->User_model->add_user_info($view_data);
		if ($view_data['count'] > 0) {
			redirect('user/get_user_infos');
		}
	}

	public function delete_user_info() {
		$this->load->helper('url');
		$this->load->model('User_model');
		$view_data['count'] = $this->User_model->delete_user_info($_GET['id']);
		if ($view_data['count'] > 0) {
			redirect('user/get_user_infos');
		}
	}

	public function update() {
		$this->load->helper('url');
		$data['id'] = $_GET['id'];
		$this->load->model('User_model');
		$view_data['user_info'] = $this->User_model->get_user_info_byid($_GET['id']);
		$view_data['title_name'] = '用户管理';
		$menus = $this->get_menu_data1();
		$view_data['menus'] = $menus;
		return $this->render('user/view_user_update', $view_data);
	}

	public function update_user_info() {
		$this->load->helper('url');
		$id = $_POST['id'];
		$data = array(
			'user_name' => $_POST['user_name'],
			'pwd' => $_POST['pwd']
		);
		$this->load->model('User_model');
		$view_data['count'] = $this->User_model->update_user_info($id, $data);
		if ($view_data['count'] > 0) {
			redirect('user/get_user_infos');
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
		//查询该用户已经分配的角色
		$this->load->model('User_model');
		$user_has_role_info=$this->User_model->get_roles_by_uid($_GET['id']);
		$user_str_has_role=  str_replace(";", "#", $user_has_role_info['roles'])  ;
		$this->config->load('role');
		$view_data['role_infos'] = $this->config->item('role');
		$view_data['menus']=$this->get_menu_data1();
		$view_data['user_str_has_role']=$user_str_has_role;
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
	
	function test_get_modles_by_uid(){
		$this->get_all_models_by_uid('3');
	}

}
