<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Validate extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('ValidateCode');
	}
	 
	public function create_validate_code(){
		session_start();
		$validate = new ValidateCode(60,20,3);
		$_SESSION['check_code']=$validate->getCheckCode();
		$validate->showImage();
		
	}
}

