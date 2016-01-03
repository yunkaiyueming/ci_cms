<?php

class User_model extends MY_Model {

	public $table_name = "user";

	public function __construct() {
		parent::__construct();
	}

	//查询所有数据
	public function get_all_user_info() {
		$order_param = array('field' => 'id', 'sort' => 'asc');
		$data = $this->get_data_info($order_param);
		return $data;
	}

	//添加用户数据
	public function add_user_info($data) {
		$count = $this->db->insert($this->table_name, $data);
		return $count;
	}

	//更新用户数据
	public function update_user_info($id, $data) {
		//$count= $this->db->replace($this->table_name, $data);
		//return $count;
		$count = $this->db->where('id', $id)->update($this->table_name, $data);
		return $count;
	}

	public function delete_user_info($id) {
		$count = $this->db->delete($this->table_name, array('id' => $id));
		return $count;
	}

	public function get_user_info_byid($id) {
		$query = $this->db->get_where($this->table_name, array('id' => $id));
		return $query->row_array();
	}

	public function get_user_info_byid1($id) {
		$this->db->select("*")->from($this->table_name)->where('id', $id);
		$info = $this->db->get()->result_array();
		echo $this->db->last_query();
		return $info;
	}

	public function get_user_info_byid2($id) {
		$query = $this->db->get_where($this->table_name, array('id' => $id));
		echo $this->db->last_query();
		return $query->result_array();
	}

	public function get_user_info_byid3($id) {
		$sql = "select * from $this->table_name where id=$id  ";
		$query = $this->db->query($sql);
		echo $this->db->last_query();
		$info = $query->result_array();
		return $info;
	}

	public function get_user_by_name_pwd($user_name, $pwd) {
		$data = array(
			'user_name' => $user_name,
			'pwd' => $pwd,
		);
		$query = $this->db->get_where($this->table_name, $data);
		return $query->row_array();
	}
	
	public function add_user_role($id,$roles){
		$this->db->set('roles', $roles);
        $this->db->where('id', $id);
        $this->db->update($this->table_name); 
		
	}
	
	public function get_roles_by_uid($uid){
		$this->db->select("roles")->from($this->table_name)->where('id', $uid);
		$info = $this->db->get()->row_array();
		//print_r($info);
		return $info;
	}
}
