<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller {

	public function get_all_books() {
		$this->load->model('Book_model');

		$book_infos = $this->Book_model->get_all_book_info();
		$view_data['book_infos'] = $book_infos;
		return $this->load->view('book/view_book_list', $view_data);
	}

}
