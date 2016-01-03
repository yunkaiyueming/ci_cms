<?php

class Function_model extends MY_Model {

	public $table_name = "function";

	public function __construct() {
		parent::__construct();
	}

	//查询所有数据
	public function get_all_function_info() {
		$order_param = array('field' => 'id', 'sort' => 'asc');
		$data = $this->get_data_info($order_param);
		return $data;
	}

	//添加用户数据
	public function add_function_info($data) {
		$count = $this->db->insert($this->table_name, $data);
		return $count;
	}

	//更新用户数据
	public function update_function_info($id, $data) {
		//$count= $this->db->replace($this->table_name, $data);
		//return $count;
		$count = $this->db->where('id', $id)->update($this->table_name, $data);
		return $count;
	}

	public function delete_function_info($id) {
		$count = $this->db->delete($this->table_name, array('id' => $id));
		return $count;
	}

	public function get_function_info_byid($id) {
		$query = $this->db->get_where($this->table_name, array('id' => $id));
		return $query->row_array();
	}

	public function get_function_info_byid1($id) {
		$this->db->select("*")->from($this->table_name)->where('id', $id);
		$info = $this->db->get()->result_array();
		echo $this->db->last_query();
		return $info;
	}

	public function get_function_info_byid2($id) {
		$query = $this->db->get_where($this->table_name, array('id' => $id));
		echo $this->db->last_query();
		return $query->result_array();
	}

	public function get_function_info_byid3($id) {
		$sql = "select * from $this->table_name where id=$id  ";
		$query = $this->db->query($sql);
		echo $this->db->last_query();
		$info = $query->result_array();
		return $info;
	}

	public function get_function_by_name_pwd($user_name, $pwd) {
		$data = array(
			'user_name' => $user_name,
			'pwd' => $pwd,
		);
		$query = $this->db->get_where($this->table_name, $data);
		return $query->row_array();
	}

	public function add_function_role($id, $roles) {
		$this->db->set('roles', $roles);
		$this->db->where('id', $id);
		$this->db->update($this->table_name);
	}

	public function get_modele_ids_by_roleid($role_ids) {
		$str_query = "select mode_ids from function where role_id in ($role_ids)";
		//echo $str_query;exit();
		$query_res = $this->db->query($str_query);
		return $query_res->result_array();
	}

	public function role_is_exit($role_id) {
		$str_query = "select * from function where role_id=$role_id";
		$query_res = $this->db->query($str_query);
		$res = $query_res->result_array();
		if (count($res) > 0) {
			return true;
		} else {
			return FALSE;
		}
	}
	
	public function update_function_by_roleid($role_id,$modle_ids){
		$this->db->set('mode_ids', $modle_ids);
		$this->db->where('role_id', $role_id);
		$this->db->update($this->table_name);
		$count=$this->db->affected_rows();
		return $count;
	}

}
