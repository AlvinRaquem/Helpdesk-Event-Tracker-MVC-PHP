<?php

namespace helper{

Class input {

	public function clean($var){
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return $str;
	}

	public function get($var){
		return isset($_GET[$var]) ? $_GET[$var] : null;
	}

	public function post($var){
		return isset($_POST[$var]) ? $_POST[$var] : null;
	}


}

}