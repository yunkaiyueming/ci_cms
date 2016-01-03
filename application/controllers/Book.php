<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper();
		$this->_check_login();
	}
	
	public function index(){
		$this->get_book_infos();
	}

	public function get_book_infos() {
		$this->load->helper('url');
		$this->load->model('Book_model');
		$this->config->load('book_type');
		$book_infos = $this->Book_model->get_all_book_info();
		$view_data['book_infos'] = $book_infos;
		$item_descs = array('id' => 'id', 'book_name' => '书名', 'type_name' => '类型名', 'author' => '作者', 'publish_date' => '出版日期', 'ope' => '操作');
		$view_data['item_descs'] = $item_descs;
		//$view_data['title_name'] = '用户管理';
		$view_data['book_type']=$this->config->item('book_type');
		$menus = $this->get_menu_data();
		$view_data['menus'] = $menus;
		return $this->render_v2('book/view_book_list2', $view_data);
	}

	public function add() {
		$this->load->helper('url');
		$this->load->view('book/view_book_add');
	}

	public function add_book_info() {
		$this->load->helper('url');
		$view_data = array(
			//'id'=>$_POST['id'],
			'book_name' => $_POST['book_name'],
			'type_name' => $_POST['type_name'],
			'author' => $_POST['author'],
			'publish_date' => $_POST['publish_date']
		);
		$this->load->model('Book_model');
		$view_data['count'] = $this->Book_model->add_book_info($view_data);
		if ($view_data['count'] > 0) {
			redirect('book/get_book_infos');
		}
	}

	public function delete_book_info() {
		$this->load->helper('url');
		$this->load->model('Book_model');
		$view_data['count'] = $this->Book_model->delete_book_info($_GET['id']);
		if ($view_data['count'] > 0) {
			redirect('book/get_book_infos');
		}
	}

	public function update() {
		$this->load->helper('url');
		$data['id'] = $_GET['id'];
		$this->load->model('Book_model');
		$view_data['book_info'] = $this->Book_model->get_book_info_byid($_GET['id']);
		$this->load->view('book/view_book_update', $view_data);
	}

	public function update_book_info() {
		$this->load->helper('url');
		$id = $_POST['id'];
		$data = array(
			'book_name' => $_POST['book_name'],
			'type_name' => $_POST['type_name'],
			'author' => $_POST['author'],
			'publish_date' => $_POST['publish_date']
		);
		$this->load->model('Book_model');
		$view_data['count'] = $this->Book_model->update_book_info($id, $data);
		if ($view_data['count'] > 0) {
			redirect('book/get_book_infos');
		}
	}

	public function ajax_get_book_by_type(){
		$this->load->model('Book_model');
		$book_type = $this->input->get_post('book_type');
        $item_descs = array('id',  '书名', '类型名',  '作者',  '出版日期',  '操作');
		$book_infos['item_descs'] = $item_descs;
		$book_infos['book_infos'] = $this->Book_model->ajax_get_book_by_type($book_type);
		//print_r($book_infos);
		$json_data=json_encode($book_infos);
        echo $json_data;
	}
}
