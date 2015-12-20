<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class File extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->_check_login();
	}

	private function _check_login() {
		session_start();
		//print_r($_SESSION);exit;
		if (empty($_SESSION['uid'])) {
			redirect('login/index');
		}
	}

	//根据一个目录获取这个目录下的所有的文件信息
	function get_file_by_dir() {
		$this->load->helper('url');
		error_reporting(E_ALL ^ E_NOTICE);
		$dir = "G:/";  //要获取的目录
		//$view_data=$this->get_all_files($dir);
		$file_infos = array();
		$item_descs = array('time' => '文件名', 'filename' => '操作时间', 'ope' => '操作');
		$view_data['item_descs'] = $item_descs;
		$view_data['title_name'] = '文件管理';
		//先判断指定的路径是不是一个文件夹
		if (is_dir($dir)) {
			//打开一个目录句柄，返回的是资源类型
			if ($dh = opendir($dir)) {
				//返回目录中下一个文件的文件名，成功则返回文件名，失败则返回false
				while (($file = readdir($dh)) != false) {
					//文件名的全路径 包含文件名
					$filePath = $dir . $file;
					//获取文件修改时间
					$fmt = date('Y-m-d H:i:s', filemtime($filePath));
					//将字符串 $filePath 从 GBK 转换编码到 UTF-8
					$filePath = iconv('GBK', "UTF-8", $filePath);
					$file_infos[] = array($filePath, $fmt);
				}
				closedir($dh);
			}
		}

		$menus = array(
			array(
				'desc' => '用户栏目',
				'active_pattern' => '/week_report/i',
				'icon' => 'icon-book',
				'level2_menus' => array(
					array(
						'desc' => '用户管理',
						'url' => 'user/get_user_infos',
						'active_pattern' => '/week_report\/report_list/i',
					),
					array(
						'desc' => '权限设置',
						'url' => 'week_report/groups_report_list',
						'active_pattern' => '/week_report\/groups_report_list/i',
					),
				),
			),
			array(
				'desc' => '书籍栏目',
				'active_pattern' => '/week_report/i',
				'icon' => 'icon-book',
				'level2_menus' => array(
					array(
						'desc' => '书籍管理',
						'url' => 'book/get_book_infos',
						'active_pattern' => '/week_report\/report_list/i',
					),
					array(
						'desc' => '书籍配置',
						'url' => 'week_report/groups_report_list',
						'active_pattern' => '/week_report\/groups_report_list/i',
					),
				),
			),
			array(
				'desc' => '文件栏目',
				'active_pattern' => '/week_report/i',
				'icon' => 'icon-book',
				'level2_menus' => array(
					array(
						'desc' => '文件管理',
						'url' => 'file/get_file_by_dir',
						'active_pattern' => '/week_report\/report_list/i',
					),
					array(
						'desc' => '文件配置',
						'url' => 'week_report/groups_report_list',
						'active_pattern' => '/week_report\/groups_report_list/i',
					),
				),
			),
		);

		$view_data['menus'] = $menus;
		$view_data['file_infos'] = $file_infos;
		return $this->render($view_data);
	}

	public function render($view_data) {
		$this->load->view('view_header', $view_data);
		$this->load->view('file/view_file_list', $view_data);
		$this->load->view('view_footer');
	}

	//迭代得到一个目录下的所有的文件
	public function get_all_files($dir_path) {
		//$dir_path = 'G:\\';
		//共享变量，每次都追加，而不是覆盖
		static $all_file_path = array();
		//检查这个目录变量是否为空
		if (!empty($dir_path)) {
			//列出指定路径中的文件和目录（返回的是一个array）
			$tmp_dirs = scandir($dir_path);
			//print_r($tmp_dirs);
			//循环遍历这个文件夹下的子文件
			foreach ($tmp_dirs as $tmp_dir) {
				//Array ( [0] => . [1] => .. [2] => 1.txt [3] => 222.txt [4] => 3 )因为用scandir($dir_path)返回的数组中会有这两个，所有要去除这两个
				if ($tmp_dir != '.' && $tmp_dir != '..') {
					
					$tmp_file_path = $dir_path . "/" . $tmp_dir; //echo $tmp_file_path."<br>";
					//如果这个子文件还是一个目录，则迭代查询它里面的子文件
					if (is_dir($tmp_file_path)) {
						$this->get_all_files($tmp_file_path);
					} else {
						//把获取到的文件的绝对路径给到共享变量中存起来
						$all_file_path[] = $tmp_file_path;
					}
				}
			}
			return $all_file_path;
		}
	}

	function file_post() {
		$menus = array(
			array(
				'desc' => '用户栏目',
				'active_pattern' => '/week_report/i',
				'icon' => 'icon-book',
				'level2_menus' => array(
					array(
						'desc' => '用户管理',
						'url' => 'user/get_user_infos',
						'active_pattern' => '/week_report\/report_list/i',
					),
					array(
						'desc' => '权限设置',
						'url' => 'week_report/groups_report_list',
						'active_pattern' => '/week_report\/groups_report_list/i',
					),
				),
			),
			array(
				'desc' => '书籍栏目',
				'active_pattern' => '/week_report/i',
				'icon' => 'icon-book',
				'level2_menus' => array(
					array(
						'desc' => '书籍管理',
						'url' => 'book/get_book_infos',
						'active_pattern' => '/week_report\/report_list/i',
					),
					array(
						'desc' => '书籍配置',
						'url' => 'week_report/groups_report_list',
						'active_pattern' => '/week_report\/groups_report_list/i',
					),
				),
			),
			array(
				'desc' => '文件栏目',
				'active_pattern' => '/week_report/i',
				'icon' => 'icon-book',
				'level2_menus' => array(
					array(
						'desc' => '文件管理',
						'url' => 'file/get_file_by_dir',
						'active_pattern' => '/week_report\/report_list/i',
					),
					array(
						'desc' => '文件配置',
						'url' => 'week_report/groups_report_list',
						'active_pattern' => '/week_report\/groups_report_list/i',
					),
				),
			),
		);
		$view_data['menus'] = $menus;

		$this->load->view('view_header', $view_data);
		$this->load->view('file/view_dropzone', $view_data);
		$this->load->view('view_footer');
	}

	//处理上传好的文件（把文件移到自定义的位置，对文件进行所有需要的处理操作）
	function file_post_handle() {
		$submit = $this->input->get_post('submit');
		//上穿的文件放在$_FILES全局变量中
		//print_r($_FILES);
		if (empty($submit)) {
			
		} else {
			//处理提交表单逻辑
			$array_files = $_FILES;
			foreach($array_files['myfile'] as $file_infos) {
				echo $file_infos.'<br/>';
			}
			move_uploaded_file($array_files['myfile']['tmp_name'],'G:/dis_files/'.time().'.txt');
			//$file_content=  file_get_contents($array_files['myfile']['tmp_name']);
			//echo $file_content.'<br/>';
			file_put_contents($array_files['myfile']['tmp_name'], 'ssssssssssss',FILE_APPEND );
			//$files_content=  file_get_contents($array_files['myfile']['tmp_name']);
			//echo $files_content;
			
		}
	}
	
	//下载图片
	function file_down(){
		$filename='G:\phpweb\ci_cms\images\111.jpg';
		header('Content-Type:image/gif');
		header('Content-Disposition:attachment;filename="'.$filename.'"');
		header('Content-Length:'.  filesize($filename));
		readfile($filename);
	}

}
