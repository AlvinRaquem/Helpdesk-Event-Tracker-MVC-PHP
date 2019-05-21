<?php

$configs = [
	'app' => [
		'APP_NAME' => '',
		'APP_PATH' => __DIR__.'/app/',
		'BASE_PATH' => __DIR__.'/app/base/',
		'VIEW_PATH' => __DIR__.'/app/view/',
		'ROOT_PATH' => '/HelpdeskEvent',
		'PUBLIC_PATH' => __DIR__.'/public',
		'ACTION_PATH' => __DIR__.'/app/actions/',

	],

	'database' => [
		'DB_HOST' => '127.0.0.1',
		'DB_USER' => 'root',
		'DB_PASS' => '',
		'DB_NAME' => 'db_ticket',
		'DB_CHARSET' => 'utf8',
		'DB_CONNECTION_TYPE' => 'pdo',

		// note DB_CONNECTION_TYPE
		// mysqli
		// mssql
		// pdo

	],

];


foreach($configs as $config){
	foreach($config as $key => $val){
		define($key,$val);
	}
}