<?php

function my_crypt($string_data){
	$rand_num = mt_rand(0, 100);
	$new_data = $string_data.$rand_num;
	return md5($new_data);
}

function get_contents($filename){
	return file_get_contents($filename);
}

function get_file_curl($url){
	$ch = curl_init();  
	curl_setopt($ch, CURLOPT_URL, $url);  
	curl_setopt($ch, CURLOPT_HEADER, false);  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果把这行注释掉的话，就会直接输出  
	$result=curl_exec($ch);  
	curl_close($ch);  
	return $result;
}
