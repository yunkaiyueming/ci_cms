<?php

/* 通过该类的对象抓取网页数据 */
require_once(APPPATH . 'third_party/QueryList/QueryList.class.php');

class CommonQueryList {

	public static function http_query_list($url, $reg, $rang) {
		$hj = QueryList::Query($url, $reg, $rang, 'UTF-8');
		$cn_blogs = $hj->data;
		return $cn_blogs;
	}

}
