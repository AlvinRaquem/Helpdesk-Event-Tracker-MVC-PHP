<?php

namespace base{
require_once BASE_PATH."view.php";
use base\view;

class route {

	public static $validroutes = [];

	public static function make($route,$function){

		self::$validroutes[]=$route;

		if($_GET['url']==$route){
			$function->__invoke();
		}
		
	}
}

}
