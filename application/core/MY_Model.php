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
