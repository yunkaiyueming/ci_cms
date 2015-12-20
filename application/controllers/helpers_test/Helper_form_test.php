<?php

class Helper_form_test extends CI_Controller {

	public function test() {
		$this->load->helper('form');
		//有一个破坏html的双引号
		$string = 'Here is a string containing "quoted" text.';
		$string2 = html_escape($string);
		echo '<input type="text" name="myfield" value="' . $string2 . '" />';
		echo '<br/>';

		//创建一个表单
		//<form action="http://cyy.com/ci_cms/email/send" method="post" accept-charset="utf-8">
		echo form_open('email/send');
		echo form_close();
		echo '<br/>';

		//增加了属性
		//<form action="http://cyy.com/ci_cms/email/send" class="email" id="myform" method="post" accept-charset="utf-8">
		$attributes = array('class' => 'email', 'id' => 'myform');
		echo form_open('email/send', $attributes);
		echo form_close();
		echo '<br/>';

		//给表单添加隐藏域
		//
		$hidden = array('username' => 'Joe', 'member_id' => '234');
		echo form_open('email/send', '', $hidden);
		echo form_close();
		echo '<br/>';
	}

}
