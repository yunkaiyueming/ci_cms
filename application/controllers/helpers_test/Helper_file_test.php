<?php

class Helper_file_test extends CI_Controller {

	public function test() {
		//$this->load->helper('file');
		//返回和index.php在同一个目录下的test.txt文件的内容,使用的是原生的php函数
		echo file_get_contents('test.txt');

		$this->load->helper('file');
		$data = 'Some file data<br/>';
		//write_file方法会覆盖文件中已有的内容
		if (!write_file('test.txt', $data)) {
			echo 'Unable to write the file<br/>';
		} else {
			echo 'File written!<br/>';
		}

//		if (delete_files('zcyytest/')) {
//			echo '删除成功！<br/>';
//		} else {
//			echo '删除失败！<br/>';
//		}
		//连这个目录下的文件夹一起删除
//		if (delete_files('zcyytest/', TRUE)) {
//			echo '删除成功！<br/>';
//		} else {
//			echo '删除失败！<br/>';
//		}
		echo APPPATH.'<br/>';
		$controllers = get_filenames(APPPATH.'../'.'zcyytest/');
		print_r($controllers);
		echo '<br/>';
		$models_info = get_dir_file_info(APPPATH.'../'.'zcyytest/');
		print_r($models_info);
		
		echo '<br/>';
	    print_r( get_file_info(APPPATH.'../'.'zcyytest/1.txt'));
		echo '<br/>';
		
		//将文件权限的数字格式（例如 fileperms() 函数的返回值）转换为标准的符号格式。
		echo symbolic_permissions(fileperms('test.txt'));
		echo '<br/>';
		
		//将文件权限的数字格式（例如 fileperms() 函数的返回值）转换为三个字符的八进制表示格式。
		echo octal_permissions(fileperms('test.txt')); 
		echo '<br/>';
		
		
		
	}

}
