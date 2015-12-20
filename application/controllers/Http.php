<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Http extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->_check_login();
		$this->load->helper('Common_helper');
	}

	public function http_curl(){
		$url = "http://www.baidu.com";
		$data['info'] = get_file_curl($url);
		$data['menus'] = $this->get_menu_data();
		$this->render_v2('http/view_http_curl', $data);
	} 
	
	public function http_query_list(){
		$this->load->library('CommonQueryList');
		
		$reg = array(
			'title' => array('.titlelnk', 'text'), // 解析文章名 
			'content_url' => array('.titlelnk', 'href')
		); 
		$rang = '.post_item';// 抓取内容的div
		$url = 'http://www.cnblogs.com';
		$data['infos'] = CommonQueryList::http_query_list($url, $reg, $rang);
		
		$data['menus'] = $this->get_menu_data();
		return $this->render_v2('http/view_http_query_list', $data);
	}

}
