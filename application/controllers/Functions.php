<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Functions extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->_check_login();
	}

	public function index() {
		//让这个方法的页面缓存20分钟
		//$this->output->cache(20);
		//在这个控制器页面的最低端，显示运行过的SQL语句，以及$_POST信息
		//$this->output->enable_profiler(TRUE);
	}

	//给用户分配角色
	function allot_role() {
		$this->config->load('role');
		$view_data['role_infos'] = $this->config->item('role');
		$view_data['menus'] = $this->get_menu_data1();
		return $this->render_v3('role/view_allot_role', $view_data);
	}

	function add_user_role() {
		$id = $_POST['userid'];
		$roles_infos = $_POST['check_role'];
		$data = "";
		foreach ($roles_infos as $role_info) {
			$data = $data . $role_info . ";";
		}
		$this->load->model('User_model');
		$refletion = $this->User_model->add_user_role($id, $data);
		$this->get_user_infos();
	}

	//给角色分配模块
	function allot_role_modles() {
		$this->config->load('role');
		$role_info = $this->config->item('role');
		$view_data['role_infos'] = $role_info;
		$this->load->model('Function_model');
		$sys_modles = $this->Function_model->get_modele_ids_by_roleid("'1'");
		//echo $sys_modles[0]['mode_ids'];exit();
		$view_data['sys_modles'] = explode(";", $sys_modles[0]['mode_ids']);
		//print_r($sys_modles);exit();
		$this->load->model('Models_model');
		$modle_info = $this->Models_model->get_all_modle_info();
		$view_data['modle_infos'] = $modle_info;
		$view_data['menus'] = $this->get_menu_data1();
		return $this->render_v3('role/view_role_allot_modle', $view_data);
	}

	function add_function_role_modle() {
		$roleid = $_POST['select_role'];
		$modles = $_POST['checkbox_modle'];
		//判断这个角色是否已经分配权限，如果已经分配，则做修改的操作，否则的话是添加的操作
		$this->load->model('Function_model');

		$exits = $this->Function_model->role_is_exit($roleid);
		if ($exits) {
			$modles_res = "";
			foreach ($modles as $modle) {
				$modles_res = $modles_res . $modle . ';';
			}
			$ress = $this->Function_model->update_function_by_roleid($roleid, $modles_res);
			redirect('functions/allot_role_modles');
		} else {
			$modles_res = "";
			foreach ($modles as $modle) {
				$modles_res = $modles_res . $modle . ';';
			}
			$this->load->model('Function_model');
			$arr_data = array(
				'role_id' => $this->security->xss_clean($_POST['select_role']),
				'mode_ids' => $this->security->xss_clean($modles_res),
			);
			$refletion = $this->Function_model->add_function_info($arr_data);
			if ($refletion > 0) {
				redirect('functions/allot_role_modles');
			}
		}
	}

	function get_function_list() {
		$this->load->model('Function_model');
		$function_infos = $this->Function_model->get_all_function_info();
		//获取配置文件的角色信息
		$this->load->config('role');
		$config_role_infos = $this->config->item('role');
		//获取模块的信息
		$this->load->model('Models_model');
		$modle_info_infos = $this->Models_model->get_all_modle_info();
		//根据上面的两个的查询结果，修改权限信息的列表
		foreach ($function_infos as &$function_info) {
			//处理角色
			foreach ($config_role_infos as $config_role_info) {
				if ($function_info['role_id'] == $config_role_info['id']) {
					$function_info['role_id'] = $config_role_info['desc'];
				}
			}
			//处理模块
			$modle_temp = "";
			$modle_ids_arr = explode(";", $function_info['mode_ids']);
			foreach ($modle_ids_arr as $modle_id) {
				foreach ($modle_info_infos as $modle_info_info) {
					if ($modle_id == $modle_info_info['id']) {
						$modle_temp.=$modle_info_info['modle_name'] . ', ';
					}
				}
			}
			$function_info['mode_ids'] = substr($modle_temp, 0, -2);
		}
		$view_data['function_infos'] = $function_infos;
		$item_descs = array('id' => 'id', 'role_id' => '角色', 'mode_ids' => '模块');
		$view_data['item_descs'] = $item_descs;
		$menus = $this->get_menu_data1();
		$view_data['menus'] = $menus;
		return $this->render_v3('function/view_function_list2', $view_data);
	}

}
