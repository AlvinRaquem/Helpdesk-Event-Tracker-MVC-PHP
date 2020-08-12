<?php


namespace controller{

require_once BASE_PATH."controller.php";
require_once MODEL_PATH."complaint.php";
require_once HELPER_PATH."input.php";
require_once HELPER_PATH."session.php";
require_once CONTROLLER_PATH."atmcontroller.php";
require_once INTERFACE_PATH."activelist.php";

use base\controller;
use model\complaint;
use helper\input;
use helper\session;
use controller\atmcontroller;
use interfaces\activelist;

Class complaintcontroller extends controller {
	
	public function __construct(){
		parent::__construct(new complaint);
	}

	public function index(){
		$complaints = $this->getList();
		$data = ['complaints'=>$complaints];
		$this->view->make('settings/complaintlist',$data);
	}

	public function getList(){
		$res = $this->model->getList();
		return $res;
	}

	public function displaycomplaintlist_all(){
		$res = $this->getList();

		$x=1;
		$display = "";

		foreach($res as $complaint){
			$display.='<tr>
			<td>'.$x++.'</td>
			<td>'.$complaint['Description'].'</td>
			<td><button style="padding: 5pt" class="btn btn-warning showeditModal" data-description="'.$complaint['Description'].'" data-idno="'.$complaint['IDno'].'"><span class="fa fa-edit"></span> Edit</button></td>
			<td><button style="padding: 5pt" class="btn btn-danger removecomplaint" data-idno="'.$complaint['IDno'].'"><span class="fa fa-trash"></span> Remove</button></td>
			</tr>';
		}

		echo $display;
	}

	public function searchcomplaint(){
		$search = input::post('search');
		$res = $this->model->searchcomplaint($search);

		$x=1;
		$display = "";

		foreach($res as $complaint){
			$display.='<tr>
			<td>'.$x++.'</td>
			<td>'.$complaint['Description'].'</td>
			<td><button style="padding: 5pt" class="btn btn-warning showeditModal" data-description="'.$complaint['Description'].'" data-idno="'.$complaint['IDno'].'"><span class="fa fa-edit"></span> Edit</button></td>
			<td><button style="padding: 5pt" class="btn btn-danger removecomplaint" data-idno="'.$complaint['IDno'].'"><span class="fa fa-trash"></span> Remove</button></td>
			</tr>';
		}

		echo $display;

	}

	public function activeindex($level){
		if($level == 'FLM'){
			$this->view->make('active/flm');
		}else{
			$this->view->make('active/slm');
		}
	}


	public function getactiveList(activelist $activelist){
		$res = $activelist->getActivelist();
		echo $res;
	}

	public function create(){
		$des = input::post("description");
		$data = [$des];
		$res = $this->model->create($data);
		if($res){
			$this->view->redirect("complaint_lists");
		}else{
			echo "Something Went Wrong!";
		}
	}

	public function update(){
		$idno = input::post("idno");
		$des = input::post("description");
		$data = [$des,$idno];
		$res = $this->model->_update($data);
		if($res){
			$this->view->redirect("complaint_lists");
		}else{
			echo "Something Went Wrong!";
		}
	}

	public function remove(){
		$idno = input::post("idno");
		$data = [$idno];
		$res = $this->model->remove($data);
		if($res){
			echo "Success";
		}else{
			echo "Fail";
		}
	}
	
	
}

}