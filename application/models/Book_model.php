<?php

class Book_model extends MY_Model {

	public $table_name = "book";

	public function __construct() {
		parent::__construct();
	}

	//查询所有书籍信息数据
	public function get_all_book_info() {
		return $this->get_data_info();
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

	public function ajax_get_book_by_type($book_type) {
		$this->db->like('type_name', $book_type);
		$query = $this->db->get($this->table_name);
		//echo $this->db->last_query();exit;
		return $query->result_array();
	}

}
