<?php

namespace controller{

use base\controller;
use model\tech;
use helper\input;


Class techcontroller extends controller {

	public function __construct(){
		parent::__construct(new tech);
	}

	public function index(){
		$techs = $this->getList();
		$data = ['techs'=>$techs];
		$this->view->make('settings/techlist',$data);
	}

	public function getList(){
		$res = $this->model->getList();
		return $res;
	}

	public function createnewtech(){
		$fullname = input::post('fullname');

		$res = $this->model->createnewtech($fullname);

		if($res){
			$this->view->redirect('technicianlist');
		}
	}

	public function removetech(){
		$idno = input::post('idno');
		$res = $this->model->removetech($idno);

		if($res){
			echo 1;
		}else{
			echo 0;
		}
	}

	public function updatetech(){
		$fullname = input::post('fullname');
		$idno = input::post('idno');

		$res = $this->model->updatetech([$fullname,$idno]);

		if($res){
			$this->view->redirect('technicianlist');
		}

	}

	

}

}