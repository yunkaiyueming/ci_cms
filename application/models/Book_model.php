<?php

class Book_model extends CI_Model {

	public $table_name = "book";

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	//查询所有用户信息数据
	public function get_all_book_info() {
		$query = $this->db->get($this->table_name);
		return $query->result_array();
	}

	//添加书籍数据
	public function add_book_info($data) {
		$count = $this->db->insert($this->table_name, $data);
		return $count;
	}

	//更新书籍数据
	public function update_book_info($id, $data) {
		$count = $this->db->where('id', $id)->update($this->table_name, $data);
		return $count;
	}

	public function delete_book_info($id) {
		$count = $this->db->delete($this->table_name, array('id' => $id));
		return $count;
	}

	public function get_book_info_byid($id) {
		$query = $this->db->get_where($this->table_name, array('id' => $id));
		return $query->row_array();
	}

}
