<?php

use base\Route;
use base\view;
use base\auth;
use helper\session;

use controller\apicontroller\api;

$api = new api;


Route::make('api.testing',function(){
	$data = [['name'=>'alvin','age'=>0],['name'=>'alvin','age'=>0]];

	$dataobjec = (object)$data;
	echo "<pre>";
	var_dump($dataobjec);
	echo "</pre>";


	$dataarray = (Array)$dataobjec;
	echo "<pre>";
	var_dump($dataarray);
	echo "</pre>";

	exit;
});


Route::make('api.test',function(){
	$GLOBALS['api']->index();
	exit;
});


?>