<?php

$configs = [
	'app' => [
		'APP_NAME' => '',
		'APP_PATH' => __DIR__.'/app/',
		'BASE_PATH' => __DIR__.'/app/base/',
		'VIEW_PATH' => __DIR__.'/app/view/',
		'HELPER_PATH'  => __DIR__.'/app/helper/',
		'CONTROLLER_PATH' => __DIR__.'/app/controller/',
		'INTERFACE_PATH' => __DIR__.'/app/interfaces/',
		'MODEL_PATH' => __DIR__.'/app/model/',
		'ROOT_PATH' => '/HelpdeskEvent',
		'PUBLIC_PATH' => __DIR__.'/public',
		'ACTION_PATH' => __DIR__.'/app/actions/',

	],

	'database' => [
		'DB_HOST' => 'us-cdbr-east-02.cleardb.com',
		'DB_USER' => 'b6746c66ed5b10',
		'DB_PASS' => 'd9074185',
		'DB_NAME' => 'heroku_9aeeb23e54e6e27',
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
