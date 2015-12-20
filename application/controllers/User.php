<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->_check_login();
	}
	
	private function _check_login(){
		if(empty($_SESSION['uid'])){
			redirect('login/index');
		}
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
		$view_data['user_infos'] = $user_infos;
		$item_descs = array('id'=>'id','name'=>'用户名', 'pwd'=>'方法', 'ope'=>'操作');
		$view_data['item_descs'] = $item_descs;
		$view_data['title_name'] = '用户管理';
		
		$menus = $this->get_menu_data();
		$view_data['menus'] = $menus;

		return $this->render_v2('user/view_user_list2', $view_data);
	}

	public function add() {
		$this->load->helper('url');
		$this->load->model('User_model');
		$view_data['title_name'] = '用户管理';
		
		$menus = $this->get_menu_data();
		$view_data['menus'] = $menus;

		$this->render_v2('user/view_user_add', $view_data);
	}

	public function add_user_info() {
		$this->load->helper('url');
		//$clean_user_name = $this->security->xss_clean($_POST['user_name']);
		$view_data = array(
			'user_name' => $this->security->xss_clean($_POST['user_name']),
			'pwd' => htmlspecialchars($_POST['pwd']),
		);

		$this->load->model('User_model');
		$view_data['count'] = $this->User_model->add_user_info($view_data);
		if($view_data['count']>0){
			redirect('user/get_user_infos');
		}
	}

	public function delete_user_info() {
		$this->load->helper('url');
		$this->load->model('User_model');
		$view_data['count'] = $this->User_model->delete_user_info($_GET['id']);
		if($view_data['count']>0){
			redirect('user/get_user_infos');
		}
	}

	public function update() {
		$this->load->helper('url');
		$data['id']=$_GET['id'];
		$this->load->model('User_model');
		$view_data['user_info']=$this->User_model->get_user_info_byid($_GET['id']);
		$view_data['title_name'] = '用户管理';
		
		$menus = $this->get_menu_data();
		$view_data['menus'] = $menus;

		return $this->render_v2('user/view_user_update',$view_data);
	}

	public function update_user_info() {
		$this->load->helper('url');
		$id=$_POST['id'];
		$data = array(
			'user_name' => $_POST['user_name'],
			'pwd' => $_POST['pwd']
		);

		$this->load->model('User_model');
		$view_data['count']=  $this->User_model->update_user_info($id,$data);
		if($view_data['count']>0){
			redirect('user/get_user_infos');
		}
	}
	
	function test(){
		$this->load->helper('Common');
		$pwd = $this->input->get_post('pwd');
		$encrypt_pwd = my_crypt($pwd);
		//echo $encrypt_pwd;
		log_message('info', 'The purpose of some variable is to provide some value.');
	}
	
	function test_send_mail(){
		$this->load->helper('my_email');
		echo MY_Email::send_email('hongcheng_test', 'hello,ci', '', '1835373375@qq.com');
	}
	
	function test_sql(){
		$this->load->model('User_model');
		$data1=$this->User_model->get_user_info_byid1('4');
		$data2=$this->User_model->get_user_info_byid2('4');
		$data3=$this->User_model->get_user_info_byid3('4');
		print_r($data1);
		echo '<br/>';
		
		print_r($data2);
		echo '<br/>';
		
		print_r($data3);
		echo '<br/>';
		
	}

}
