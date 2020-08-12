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
		
		$file =  APP_PATH.str_replace($classname, "\\", "/") . ".php";
	
	$file = str_replace($file,"//","/");
	
	echo $file."<br/>";

		if(file_exists($file)){
		require $file;
	}
});

