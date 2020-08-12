<?php

namespace controller{

use base\controller;
use model\atm;
use helper\input;


Class atmcontroller extends controller {

	public function __construct(){
		parent::__construct(new atm);
	}

	public function index(){
		$atms = $this->getList();
		$data = ['atms'=>$atms];
		$this->view->make('settings/atmlist',$data);
	}

	public function getList(){
		$res = $this->model->getList();
		return $res;
	}

	public function getbanks(){
		$res = $this->model->getbanks();
		return $res;
	}

	public function displayList(){
		$res = $this->getList();
		$display = "";

		foreach($res as $atm){
			$display.='
			<tr>
			<td>'.$atm['Terminal_ID'].'</td>
			<td>'.$atm['Model'].'</td>
			<td>'.$atm['Site'].'</td>
			<td>'.$atm['Brand'].'</td>
			<td><button type="button" class="btn btn-primary selectatm" data-id="'.$atm['Terminal_ID'].'" data-bank="'.$atm['Model'].'" data-brand="'.$atm['Brand'].'" data-site="'.$atm['Site'].'"><span class=""></span>Select</button></td>
			</tr>
			';
		}

		echo $display;
	}

	public function displayatmlist_all(){
		$res = $this->getList();
		$display = "";
		$x=1;

		foreach($res as $atm){
			$display.='<tr>
			<td>'.$x++.'</td>
			<td>'.$atm['Terminal_ID'].'</td>
			<td>'.$atm['Model'].'</td>
			<td>'.$atm['Site'].'</td>
			<td>'.$atm['Address'].'</td>
			<td>'.$atm['Brand'].'</td>
			<td><a href="viewunit?unitID='.$atm['Terminal_ID'].'"><button style="padding: 5pt" class="btn btn-success"><span class="fa fa-search"></span> View</button></a></td>
			</tr>';
		}

		echo $display;
	}

	public function searchatm(){
		$res = $this->searchsite();
			$display = "";
		$x=1;

		foreach($res as $atm){
			$display.='<tr>
			<td>'.$x++.'</td>
			<td>'.$atm['Terminal_ID'].'</td>
			<td>'.$atm['Model'].'</td>
			<td>'.$atm['Site'].'</td>
			<td>'.$atm['Address'].'</td>
			<td>'.$atm['Brand'].'</td>
			<td><a href="viewunit?unitID='.$atm['Terminal_ID'].'"><button style="padding: 5pt" class="btn btn-success"><span class="fa fa-search"></span> View</button></a></td>
			</tr>';
		}

		echo $display;
	}

	public function searchsite(){
		$site = input::post('site');
		$res = $this->model->searchsite($site);
		return $res;
	}

	public function displaySearchSite(){
		$res = $this->searchsite();
		$display = "";

		foreach($res as $atm){
			$display.='
			<tr>
			<td>'.$atm['Terminal_ID'].'</td>
			<td>'.$atm['Model'].'</td>
			<td>'.$atm['Site'].'</td>
			<td>'.$atm['Brand'].'</td>
			<td><button type="button" class="btn btn-primary selectatm" data-id="'.$atm['Terminal_ID'].'" data-bank="'.$atm['Model'].'" data-brand="'.$atm['Brand'].'" data-site="'.$atm['Site'].'"><span class=""></span>Select</button></td>

			</tr>
			';
		}

		echo $display;
	}

	public function getatmdetails($atmid){
		$data = [$atmid];
		$res = $this->model->getatmdetails($data);
		return $res;
	}

	public function viewunit(){
		$id = input::get('unitID');
		$data = [$id];
		$res = $this->model->viewunit($data);
		$data = ['details'=>$res];
		$this->view->make('settings/viewunit',$data);
	}

	public function create(){
		$idno = input::post('terminalid');
		$brand = input::post('brand');
		$bank = input::post('bank');
		$site = input::post("site");
		$address = input::post("address");
		$city = input::post("city");
		$loc = input::post("location");
		$loc2 = input::post("location2");
		$sla = input::post("sla");
		$open = input::post("opening");
		$close = input::post("closing");
		$conperson = input::post("contactperson");
		$connumber = input::post("contactnumber");

		$data = [$idno,$brand,$bank,$site,$address,$city,$loc,$loc2,$sla,$open,$close,$conperson,$connumber];

		$res = $this->model->create($data);

		if($res){
			$this->view->redirect("atmlist");
		}else{
			echo "Something Went Wrong";
		}
	}

	public function remove(){
		$idno = input::post('idno');
		$data = [$idno];
		$res = $this->model->remove($data);
		if($res){
			echo "success";
		}else{
			echo "fail";
		}
	}

	public function update(){
		$idno = input::post('terminalid');
		$brand = input::post('brand');
		$bank = input::post('bank');
		$site = input::post("site");
		$address = input::post("address");
		$city = input::post("city");
		$loc = input::post("location");
		$loc2 = input::post("location2");
		$sla = input::post("sla");
		$open = input::post("opening");
		$close = input::post("closing");
		$conperson = input::post("contactperson");
		$connumber = input::post("contactnumber");

		$data = [$idno,$brand,$bank,$site,$address,$city,$loc,$loc2,$sla,$open,$close,$conperson,$connumber,$idno];

		$res = $this->model->_update($data);

		if($res){
			$this->view->redirect("atmlist");
		}else{
			echo "Something Went Wrong";
		}
	}

}

}