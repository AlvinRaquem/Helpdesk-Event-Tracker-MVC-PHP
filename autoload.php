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

// // for linux
// spl_autoload_register(function($classname){
		
// 		$file = strtr('\\','/',APP_PATH.$class.'.php');

// 		if(file_exists($file)){
// 		require $file;
// 	}
// });

spl_autoload_register('myAutoLoaderPerson');

function myAutoLoaderPerson($className) {
    require_once __DIR__ . APP_PATH.strtr($classname, "\\", "/") . ".php";
}
