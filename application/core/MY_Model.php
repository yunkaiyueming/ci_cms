<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class MY_Model extends CI_Model {

	public $table_name;

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function get_data_info($order_param = '') {
		if (!empty($order_param)) {
			$this->db->order_by($order_param['field'], $order_param['sort']);
		}

		$query = $this->db->get($this->table_name);
		return $query->result_array();
	}

}

/*
 * 返回查询的SQL语句

情况1：

$this->db->select("*")->from($table)->where('id',$id); 

$info = $this->db->get()->result_array();

echo $this->db->last_query();

return $info ;



情况2：

$query = $db->get_where(self::TABLE, array('username'=>'a'));

echo $db->last_query();

return $query->row_array();



情况3：自定义sql

$sql = "select * from table where id=1 group by type limit 5  order by addtime desc ";

$query = $db->query($sql);

echo $db->last_query();

$info = $query->result_array();

return $info;
 */