<?php

namespace controller;

use base\controller;
use model\ticket;
use helper\input;
use controller\atmcontroller;
use controller\usercontroller;
use controller\complaintcontroller;
use controller\techcontroller;

Class ticketcontroller extends controller {

	public function __construct(){
		parent::__construct(new ticket);
	}

	public function index(atmcontroller $atmcontroller,usercontroller $usercontroller,complaintcontroller $complaintcontroller,techcontroller $techcontroller){
		$atmlist = $atmcontroller->getList();
		$users = $usercontroller->getAllUser();
		$complaintlist = $complaintcontroller->getList();
		$techs = $techcontroller->getList();
		$data = ['atmlist'=>$atmlist,'users'=>$users,'complaints'=>$complaintlist,'techs'=>$techs];
		$this->view->make('create',$data);
	}

	public function createticket(){
		$complaint = input::post("txtComplaint")." ".input::post("txtcomplaint_others");
		$type = input::post("txtType");
		$Chest = input::post("txtChest");
		$level = input::post("txtLevel");
		$screen = input::post("txtScreen");
		$errorcode = input::post("txtErr");
		$receivedby = input::post("txtRcvBy");
		$datetimereceived =  input::post("dtRcv")." ".input::post("timeRcv");
		$atmid = input::post("txtAtmID");
		$reportedby = input::post("txtReportedBy");
		$repvia = input::post("txtreportvia");
		$personassign = input::post("txtPersonAssign");
		$datetimepersonassign = input::post("dtPersonAssign")." ".input::post("timePersonAssign");
		$status = input::post("txtStatus");
		$targetdate = input::post("txtTargetDate");
		$txtAcknow = input::post("txtAcknow");
		$datetimeacknow =  input::post("dateacknow")." ".input::post("timeacknow");

		if(input::post("datetimepersonassign")==""){
			$datetimepersonassign = "0000-00-00 00:00:00";
		}

		if(input::post("dtPersonAssign")==""){
			$datetimeacknow = "0000-00-00 00:00:00";
		}


		$data = [$complaint,$type,$Chest,$level,$screen,$errorcode,$receivedby,$datetimereceived,$atmid,$reportedby,$repvia
			,$personassign,$datetimepersonassign,$status,$targetdate,$txtAcknow,$datetimeacknow];

		if($this->model->createticket($data)){
			echo "success";
		}else{
			echo "fail";
		}


	}


	public function ticketinfo(atmcontroller $atmcontroller){
		$ticketno = input::get('ticketno');
		$data = [$ticketno];
		$res = $this->model->ticketinfo($data);
		$atmdetails = $atmcontroller->getatmdetails($res['c_atmID']);
		$lastcomment = $this->getticket_lastcomment($ticketno);
		$data = ['detail'=>$res,'atmdetails'=>$atmdetails,'commentdetails'=>$lastcomment];
		$this->view->make('ticket/details',$data);
	}

	public function getticket_lastcomment($ticketno){
		$data = [$ticketno];
		$res = $this->model->getticket_lastcomment($data);
		return $res;
	}

	public function updateticket(atmcontroller $atmcontroller,usercontroller $usercontroller,techcontroller $techcontroller){
		$ticketno = input::get('ticketno');
		$data = [$ticketno];
		$res = $this->model->ticketinfo($data);
		$atmdetails = $atmcontroller->getatmdetails($res['c_atmID']);
		$users = $usercontroller->getAllUser();
		$comments = $this->model->getticket_comment($data);
		$techs = $techcontroller->getList();
		$data = ['detail'=>$res,'atmdetails'=>$atmdetails,'comments'=>$comments,'users'=>$users,'techs'=>$techs];
		$this->view->make('ticket/update',$data);
	}


	public function updateticketdetails(){

		$complaint = input::post("complaint");
		$type = input::post("txtType");
		$chest = input::post("txtChest");
		$level = input::post("txtLevel");
		$screen = input::post("txtScreen");
		$errorcode = input::post("txtErr");
		$datetimereceived = input::post("dtRcv")." ".input::post("timeRcv");
		$reportedby = input::post("txtReportedBy");
		$repvia = input::post("txtreportvia");
		$acknowledgeby = input::post("txtAcknow");
		$datetimeacknow =  input::post("dateacknow")." ".input::post("timeacknow");
		$personassign = input::post("txtPersonAssign");
		$datetimepersonassign = input::post("dtPersonAssign")." ".input::post("timePersonAssign");
		$status = input::post("txtStatus");
		$targetdate = input::post("txtTargetDate");
		$diagnosis = input::post("txtDiagnosis");
		$actiontaken = input::post("txtactionTaken");
		$datetimeresponse = input::post("dtResponse")." ".input::post("timeResponse");
		$datetimeresolution = input::post("dtResolution")." ".input::post("timeResolution");
		$ticketno = input::post("txtIDno");

		$data = [$complaint,$type,$chest,$level,$screen,$errorcode,$datetimereceived,$reportedby,$repvia,$acknowledgeby,$datetimeacknow,$personassign,$datetimepersonassign,$status,$targetdate,$diagnosis,$actiontaken,$datetimeresponse,$datetimeresolution,$ticketno];

		$res = $this->model->updateticketdetails($data);

		if($res){
			$this->view->redirect("updateticket?ticketno=".$ticketno."");
		}else{
			echo "Something Went Wrong!";
		}

	}


}