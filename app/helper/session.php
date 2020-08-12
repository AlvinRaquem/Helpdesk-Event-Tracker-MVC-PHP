<?php

namespace helper{

class session {

	public function __construct(){
		if(session_id()=="")
			session_start();
	}

	public static function set($key,$val){
	  	$_SESSION[$key] = $val;
	}

	public static function get($key){
		return $_SESSION[$key];
	}


	public static function unset_($key){
		 unset($_SESSION[$key]);
	}


	public static function destroy(){
		return session_destroy();
	}

}

}