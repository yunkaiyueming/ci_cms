<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct() {
		parent::__construct();
		session_start();
		error_reporting(0);
		$this->load->helper('url');
		$this->load->model('User_model');
		$this->load->library('ValidateCode');
	}

	function index() {
		if (empty($_SESSION['uid'])) {
			$this->render('');
		} else {
			redirect('user/get_user_infos');
		}
	}

	function do_login() {
		$user_name = $this->input->get_post('user_name');
		$pwd = $this->input->get_post('pwd');
		$check_code=$this->input->get_post('check_code');
		$exist_res = $this->User_model->get_user_by_name_pwd($user_name, $pwd);
//		echo $check_code;
//		echo '<br/>';
//        echo $_SESSION['check_code'];
		
		if (!empty($exist_res)&&(strtolower($check_code)==  strtolower($_SESSION['check_code']))) {
			$_SESSION['uid'] = $exist_res['id'];
			$_SESSION['user_name'] = $exist_res['user_name'];
			
           // $_SESSION['checkCodde']=$exist_res['checkCodde'];
			redirect('user/index');
		} else {
			$view_data['error'] = 'user or pwd is wrong';
			$this->render($view_data);
		}
	}

	function logout() {
		if (!empty($_SESSION)) {
			session_destroy();
		}
		redirect('login/index');
	}

	public function render($view_data) {
		$this->load->view('view_header', $view_data);
		$this->load->view('login/view_login', $view_data);
		$this->load->view('view_footer');
	}

}
