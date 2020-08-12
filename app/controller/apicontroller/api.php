<?php

namespace controller\apicontroller{

use base\controller;
use model\api as apimodel;
use helper\input;
use helper\session;

Class api extends controller {

	public function __construct(){
		parent::__construct(new apimodel);
	}

	public function index(){
		
		$response["account"] = array(); 
		// $response = [];
		$account = array(); 
		$x = 1;

			while ($x < 10)
			{	
				$account['idno'] = $x;
				$account['empid'] = $x."_id";
				$account['fname'] = 'alvin';
				$account['mname'] = 'sison';
				$account['lname'] = 'raquem';
				$account['password'] ='123123';
				
				array_push($response["account"], $account);
				// array_push($response, $account);
				$x++;
			}
			
		$data = json_encode($response);
		$data = json_decode($data);


		echo "<pre>";
		var_dump($data);
		echo "</pre>";

	
		foreach($data->account as $d){
			echo $d->fname."<br/>";
		}

		// 	foreach($data as $d){
		// 	echo $d->fname."<br/>";
		// }
	}
}

}