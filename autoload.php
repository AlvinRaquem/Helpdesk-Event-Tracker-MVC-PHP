<?php

// // for windows
// spl_autoload_register(function($class){

// 	$file = APP_PATH.$class.".php";

// 	if(file_exists($file))
// 		require $file;
// 	// }else if(file_exists(BASE_PATH.$class.".php")){
// 	// 	require BASE_PATH.$class.".php";
// 	// }
// });

// for linux
spl_autoload_register(function($classname){
		
	$file =  APP_PATH.strtr($classname, "\\", "/") . ".php";
	
	$file = str_replace("//","/",$file);
	
	if(file_exists($file)){
		require $file;
	}
	
	$file2 =  BASE_PATH.strtr($classname, "\\", "/") . ".php";
	
	$file2 = str_replace("//","/",$file2);
	
	if(file_exists($file2)){
		require $file2;
	}
	
	$file3 =  strtr($classname, "\\", "/") . ".php";
	
	$file3 = str_replace("//","/",$file3);
	
	if(file_exists($file3)){
		require $file3;
	}
	

});

