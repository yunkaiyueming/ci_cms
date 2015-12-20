<?php

function my_crypt($string_data){
	$rand_num = mt_rand(0, 100);
	$new_data = $string_data.$rand_num;
	return md5($new_data);
}

function get_contents($filename){
	return file_get_contents($filename);
}
