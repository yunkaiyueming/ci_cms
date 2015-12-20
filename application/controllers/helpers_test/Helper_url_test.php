<?php

class Helper_url_test extends CI_Controller {

	public function test1() {
		$this->load->helper('url');
		//site_url()参数为字符串
		echo '1:site_url()参数为字符串<br/> ' . site_url('helpers_test/Helper_url_test/test');
		echo '<br/>';
		//site_url()参数为数组
		$segments = array('helpers_test', 'Helper_url_test', 'test');
		echo '2:site_url()参数为数组<br/> ' . site_url($segments);
		echo '<br/>';

		//base_url()和site_url()相同，只是不会加上index.php
		echo '3:base_url()和site_url()相同，只是不会加上index.php<br/> ' . base_url("helpers_test/Helper_url_test/test");
		echo '<br/>';
		echo '4:base_url()和site_url()相同，只是不会加上index.php<br/> ' . base_url($segments);
		echo '<br/>';

		//current_url()返回当前正在浏览的页面的完整 URL （包括分段）
		echo '5:current_url()返回当前正在浏览的页面的完整 URL （包括分段）<br/> ' . current_url();
		echo '<br/>';

		//uri_string()
		echo '6:uri_string返回包含该函数的页面的 URI 分段<br/>' . uri_string() . '<br/>';

		//返回你在配置文件中配置的 index_page 参数
		echo '7:返回你在配置文件中配置的 index_page 参数<br/>' . index_page() . '<br/>';

		//anchor()根据你提供的 URL 生成一个标准的 HTML 链接
		echo '8:根据你提供的 URL 生成一个标准的 HTML 链接<br/>' . anchor('news/local/123', 'My News', 'title="News title"');
		echo '<br/>';
		echo anchor('news/local/123', 'My News', array('title' => 'The best news!'));
		echo '<br/>';
		echo anchor('', 'Click here');
		echo '<br/>';

		//anchor_popup()它生成的 URL 将会在新窗口被打开
		$atts = array(
			'width' => 800,
			'height' => 600,
			'scrollbars' => 'yes',
			'status' => 'yes',
			'resizable' => 'yes',
			'screenx' => 0,
			'screeny' => 0,
			'window_name' => '_blank'
		);

		//anchor_popup()它生成的 URL 将会在新窗口被打开
		echo '9:anchor_popup()它生成的 URL 将会在新窗口被打开<br/>' . anchor_popup('news/local/123', 'Click Me!', $atts);
		echo '<br/>';
		echo anchor_popup('news/local/123', 'Click Me!', array());
		echo '<br/>';

		//mailto()创建一个标准的 HTML e-mail 链接(发邮件)
		echo '10.mailto()创建一个标准的 HTML e-mail 链接<br/>' . mailto('1832427179@qq.com', 'Click Here to Contact Me');
		echo '<br/>';
		$attributes = array('title' => 'Mail me');
		echo mailto('1832427179@qq.com', 'Contact Me', $attributes);
		echo '<br/>';
		
		//和mailto函数一样safe_mailto()它的 mailto 标签使用了一个混淆的写法， 可以防止你的 e-mail 地址被垃圾邮件机器人爬到
		echo '11.和mailto函数一样safe_mailto()它的 mailto 标签使用了一个混淆的写法，可以防止你的 e-mail 地址被垃圾邮件机器人爬到<br/>' . mailto('1832427179@qq.com', 'Click Here to Contact Me');
		echo '<br/>';
		
		//auto_link()将一个字符串中的 URL 和 e-mail 地址自动转换为链接
		//$string = auto_link($string, 'url');
		//$string = auto_link($string, 'email');
		//$string = auto_link($string, 'both', TRUE);
		//auto_link()将一个字符串中的 URL 和 e-mail 地址自动转换为链接
		echo '12:auto_link()将一个字符串中的 URL 和 e-mail 地址自动转换为链接<br/>'.auto_link('http://cyy.com/ci_chm/helpers/url_helper.html#id2','url');
		echo '<br/>';
		
		//url_title()将字符串转换为对人类友好的 URL 字符串格式
		$title = "What's wrong with CSS?";
		echo '13:url_title()将字符串转换为对人类友好的 URL 字符串格式<br/>'.url_title($title);
		echo '<br/>';
		echo url_title($title,'underscore');
		echo '<br/>';
		
		//$url = prep_url('example.com');
		$url = prep_url('example.com');
		echo '14:prep_url(\'example.com\'):<br/>'.$url;
	}
	
	public function test2(){
		$this->load->helper('url');
		//为了让该函数有效，它必须在任何内容输出到浏览器之前被调用。因为输出内容会使用服务器 HTTP 头。
		redirect('http://cyy.com/ci_cms/helpers_test/Helper_url_test/test1', 'location');
	}
	

}
