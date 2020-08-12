<?php

namespace base{

Class view {

	private $data = [];

	public function redirect($path){
		header("Location:./".$path."");
	}

	public function make($template,$params=[]){

		$file = VIEW_PATH.$template.".php";
		if(file_exists($file)){
			
			if(count($params)>0){
				foreach($params as $key => $val){
					$this->data[$key]=$val;	
				}
				extract($this->data);
			}
			
			include $file;
		}else{
			header("Location:./notexist");
		}
	}

}

}