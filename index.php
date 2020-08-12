<?php


date_default_timezone_set('Asia/Manila');
	
include "config.php";
include "autoload.php";
include "apiroutes.php";
include "routes.php";

$request = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : '';
$userlevel = isset($_SESSION['USER_LEVEL']) ? $_SESSION['USER_LEVEL'] : 'GUEST';


