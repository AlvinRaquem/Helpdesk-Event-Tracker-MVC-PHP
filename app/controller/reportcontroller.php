<?php

namespace controller{

require_once BASE_PATH."controller.php";
require_once MODEL_PATH."report.php";
require_once HELPER_PATH."input.php";
require_once HELPER_PATH."session.php";
require_once CONTROLLER_PATH."atmcontroller.php";
require_once CONTROLLER_PATH."usercontroller.php";

use base\controller;
use model\report;
use helper\input;
use helper\session;
use controller\atmcontroller;
use controller\usercontroller;

Class reportcontroller extends controller {

	private $atmcontroller;

	public function __construct(){
		parent::__construct(new report);
	}

	public function index(usercontroller $usercontroller){
		$display = "";
		$res = $this->model->index();
		$printdata = "";
		$x = 1;
		$sladis = "";
		foreach($res as $complaint){
		
	
	 //call-response how many days or hours before action based on received call date and time
			 $strStart=$complaint["c_RcvDate"];
			 $strEnd=$complaint["c_response"];
			 if ($strEnd!="0000-00-00 00:00:00")
			 {				
			 
			 $timeFirst  = strtotime($strStart);
			$timeSecond = strtotime($strEnd);
			$diff = $timeSecond - $timeFirst;
			 	 
			 $dteStart = date_create($strStart); 
				 $dteEnd   = date_create($strEnd); 
				 $dteDiff  = $dteStart->diff($dteEnd); 
			 $SLA = $dteDiff->format("%D days %H:%I:%S");

			 	$sladis = $diff > 0 ? $SLA : "";
			} 

			if($complaint['c_level'] == 'SLM')
				$sladis = "";
					
			$display.='<tr>
			<td><a href="ticketinfo?ticketno='.$complaint['IDno'].'">'.$complaint['IDno'].'</a></td>
			<td>
				<h6>
				<li>'.$complaint['Terminal_ID'].'</li>
				<li>'.$complaint['Model'].'</li>
				<li>'.$complaint['Site'].'</li>
				</h6>
			</td>

			<td><h6>'.$complaint['c_repby'].'</h6></td>
			<td>
				<h6>
				<li>'.$complaint['c_complaint'].'</li>
				<li>'.$complaint['c_type'].'</li>
				</h6>
			</td>
			<td><h6>'.$complaint['c_RcvDate'].'</h6></td>
			<td><h6>'.$sladis.'</h6></td>
	        <td><h6>
				<li>'.$complaint['c_resolution'].'</li>
				<li>'.$complaint['c_response'].'</li>
			</h6></td>
			<td><h6>'.$complaint['c_action'].'</h6></td>
			<td><h6>
				<li>'.$complaint['c_Status'].'</li>
				<li>'.$complaint['c_PersonAssign'].'</li>
			</h6></td>
			</tr>';

			$printdata.="<tr>".
					"<td style='font-size:8pt;'>".$x++."</td>".
					"<td style='font-size:8pt;'>".$complaint["IDno"]."</td>".
					"<td style='font-size:8pt;'><ul><li>".$complaint['Terminal_ID']."</li>".
					"<li>".$complaint['Site']."</li>".
					"<li>".$complaint['Model']."</li></ul></td>".
					"<td style='font-size:8pt;'>".$complaint["c_level"]."</td>".
					"<td style='font-size:8pt;'>".$complaint["c_complaint"]."</td>".
					"<td style='font-size:8pt;'>".$complaint["c_repby"]."</td>".
					"<td style='font-size:8pt;'>".$complaint["c_PersonAssign"]."</td>".
					"<td style='font-size:8pt;'>".$complaint["c_RcvDate"]."</td>".
					"<td style='font-size:8pt;'>".$complaint["c_response"]."</td>".
					"<td style='font-size:8pt;'>".$complaint["c_resolution"]."</td>".
					"<td style='font-size:8pt;'>".$sladis."</td>".
					"<td style='font-size:8pt;'>".$complaint["c_action"]."</td>".
					"<td style='font-size:8pt;'>".$complaint["c_Status"]."</td>".
					"</tr>";	

		}


		$printdisplay = "<table width='100%' border='1'>".
			"<tr bgcolor='#0066FF'><th style='font-size:8pt;'>No</th>".
			"<th style='font-size:8pt;'>TICKET #</th>".
			"<th style='font-size:8pt;'>SITE</th>".
			"<th style='font-size:8pt;'>LEVEL</th>".
			"<th style='font-size:8pt;'>REPORTED ERROR</th>".
			"<th style='font-size:8pt;'>REPORTED BY</th>".
			"<th style='font-size:8pt;'>ASSIGNED PERSON</th>".
			"<th style='font-size:8pt;'>CALL / DATE-TIME</th>".
			"<th style='font-size:8pt;'>RESPONSE DATE-TIME</th>".
			"<th style='font-size:8pt;'>COMPLETED DATE-TIME</th>".
			"<th style='font-size:8pt;'>SLA</th>".
			"<th style='font-size:8pt;'>ACTION TAKEN</th>".
			"<th style='font-size:8pt;'>STATUS</th>".
			"</tr>
			</thead>
			<tbody>";
			$printdisplay.= $printdata;
			$printdisplay.='</tbody></table>';

		session::set('printreport',$printdisplay);
		$users = $usercontroller->getAllUser();
		$errorcodes = $this->getErrorCodes();
		$data = ['reportdis' => $display,'technicians' => $users,'errorcodes'=>$errorcodes];
		$this->view->make('reports/list',$data);

	}


	public function filteredlist(usercontroller $usercontroller){
		$datefrom = input::post("datefrom");
		$dateto = input::post("dateto");
		$type = input::post("type");
		$chest = input::post("chest");
		$level = input::post("level");
		$personassign = input::post("personassign");
		$status = input::post("status");
		$errorcode = input::post("errorcode");
		$otherdetails = input::post("otherdetails");
		$otherdetails_query = input::post("otherdetails_query");
		$sort = input::post("sort");

		$data = [];

		$whereclause = "DATE(a.c_RcvDate) BETWEEN ? AND ?";
		$data[] = $datefrom;
		$data[] = $dateto;

		if($type == "--Type--"){
			$whereclause.= "";
		}else{
			$whereclause.=" AND a.c_type = ?";
			$data[] = $type;
		}

		if($chest == "--Chest--"){
			$whereclause.= "";
		}else{
			$whereclause.=" AND a.c_chest = ?";
			$data[] = $chest;
		}

		if($level == "--Level--"){
			$whereclause.= "";
		}else{
			$whereclause.=" AND a.c_level = ?";
			$data[] = $level;
		}

		if($personassign == "--Person Assigned--"){
			$whereclause.= "";
		}else{
			$whereclause.=" AND a.c_PersonAssign = ?";
			$data[] = $personassign;
		}

		if($status == "--Status--"){
			$whereclause.= "";
		}else{
			$whereclause.=" AND a.c_Status = ?";
			$data[] = $status;
		}

		if($errorcode == "--Error Code--"){
			$whereclause.= "";
		}else{
			$whereclause.=" AND a.c_errCode = ?";
			$data[] = $errorcode;
		}

		if($otherdetails == "--Other Details--"){
			$whereclause.="";
		}else{
			switch ($otherdetails) {
				case 'Ticket No':
					$whereclause.=" AND a.IDno LIKE ?";
					break;
				case 'ATM ID':
					$whereclause.=" AND a.c_atmID LIKE ?";
					break;
				case 'ATM Brand':
					$whereclause.=" AND b.Brand LIKE ?";
					break;
				case 'ATM Bank':
					$whereclause.=" AND b.Model LIKE ?";
					break;

				default:
					# code...
					break;
			}

			$data[] = '%'.$otherdetails_query.'%';
		}

		$res = $this->model->filterlist($whereclause,$data,$sort);
		$display = '';
		$printdata = "";
		$SLA = "";
		$x = 1;
			foreach($res as $complaint){
		
	

	 			//call-response how many days or hours before action based on received call date and time
			 $strStart=$complaint["c_RcvDate"];
			 $strEnd=$complaint["c_response"];
			 if ($strEnd!="0000-00-00 00:00:00")
			 {				
			 
			 $timeFirst  = strtotime($strStart);
			$timeSecond = strtotime($strEnd);
			$diff = $timeSecond - $timeFirst;
			 	 
			 $dteStart = date_create($strStart); 
				 $dteEnd   = date_create($strEnd); 
				 $dteDiff  = $dteStart->diff($dteEnd); 
			 $SLA = $dteDiff->format("%D days %H:%I:%S");
		
			
			 } 

			 if ($complaint['c_level']=="SLM"){
			 		$SLA = "";
			 }
						 
			 $display.='<tr>
			<td><a href="ticketinfo?ticketno='.$complaint['IDno'].'">'.$complaint['IDno'].'</a></td>
			<td>
				<h6>
				<li>'.$complaint['Terminal_ID'].'</li>
				<li>'.$complaint['Model'].'</li>
				<li>'.$complaint['Site'].'</li>
				</h6>
			</td>

			<td><h6>'.$complaint['c_repby'].'</h6></td>
			<td>
				<h6>
				<li>'.$complaint['c_complaint'].'</li>
				<li>'.$complaint['c_type'].'</li>
				</h6>
			</td>
			<td><h6>'.$complaint['c_RcvDate'].'</h6></td>
			<td><h6>'.$SLA.'<td><h6>
				<li>'.$complaint['c_resolution'].'</li>
				<li>'.$complaint['c_response'].'</li>
			</h6></td>
			<td><h6>'.$complaint['c_action'].'</h6></td>
			<td><h6>
				<li>'.$complaint['c_Status'].'</li>
				<li>'.$complaint['c_PersonAssign'].'</li>
			</h6></td>
			</tr>';

			$printdata.="<tr>".
				"<td style='font-size:8pt;'>".$x++."</td>".
				"<td style='font-size:8pt;'>".$complaint["IDno"]."</td>".
				"<td style='font-size:8pt;'><ul><li>".$complaint['Terminal_ID']."</li>".
				"<li>".$complaint['Site']."</li>".
				"<li>".$complaint['Model']."</li></ul></td>".
				"<td style='font-size:8pt;'>".$complaint["c_level"]."</td>".
				"<td style='font-size:8pt;'>".$complaint["c_complaint"]."</td>".
				"<td style='font-size:8pt;'>".$complaint["c_repby"]."</td>".
				"<td style='font-size:8pt;'>".$complaint["c_PersonAssign"]."</td>".
				"<td style='font-size:8pt;'>".$complaint["c_RcvDate"]."</td>".
				"<td style='font-size:8pt;'>".$complaint["c_response"]."</td>".
				"<td style='font-size:8pt;'>".$complaint["c_resolution"]."</td>".
				"<td style='font-size:8pt;'>".$SLA."</td>".
				"<td style='font-size:8pt;'>".$complaint["c_action"]."</td>".
				"<td style='font-size:8pt;'>".$complaint["c_Status"]."</td>".
				"</tr>";	
		}

		$printdisplay = "<table width='100%' border='1'>".
		"<tr bgcolor='#0066FF'><th style='font-size:8pt;'>No</th>".
		"<th style='font-size:8pt;'>TICKET #</th>".
		"<th style='font-size:8pt;'>SITE</th>".
		"<th style='font-size:8pt;'>LEVEL</th>".
		"<th style='font-size:8pt;'>REPORTED ERROR</th>".
		"<th style='font-size:8pt;'>REPORTED BY</th>".
		"<th style='font-size:8pt;'>ASSIGNED PERSON</th>".
		"<th style='font-size:8pt;'>CALL / DATE-TIME</th>".
		"<th style='font-size:8pt;'>RESPONSE DATE-TIME</th>".
		"<th style='font-size:8pt;'>COMPLETED DATE-TIME</th>".
		"<th style='font-size:8pt;'>SLA</th>".
		"<th style='font-size:8pt;'>ACTION TAKEN</th>".
		"<th style='font-size:8pt;'>STATUS</th>".
		"</tr>
		</thead>
		<tbody>";
		$printdisplay.= $printdata;
		$printdisplay.='</tbody></table>';

		session::set('printreport',$printdisplay);
		$users = $usercontroller->getAllUser();
		$data = ['reportdis' => $display,'technicians' => $users];
		$this->view->make('reports/list',$data);

	}


	public function printreport(){
	//	echo session::get("printreport");
		$this->view->make('reports/printreport');
	}

	public function export(atmcontroller $atmcontroller){
		$banks = $atmcontroller->getbanks();
		$data = ['banks'=>$banks];
		$this->view->make('reports/export',$data);
	}

	private function getErrorCodes(){
		$res = $this->model->getErrorCodes();
		return $res;
	}

	public function graphs(){
		$this->view->make('reports/graphs');
	}

	public function generategraph(){
		var_dump($_POST);
	}

	public function exportrecord(){
		$datefrom = input::post('datefrom');
		$dateto = input::post('dateto');

		$data = [$datefrom,$dateto];
		$res = $this->model->exportrecord($data);

		$display = '<table style="width:100%">
		<thead>
			<tr>
			<th style="text-align:left">DATE FROM:</th>
			<th style="text-align:left">'.$datefrom.'</th>
			</tr>
			<tr>
			<th style="text-align:left">DATE TO:</th>
			<th style="text-align:left">'.$dateto.'</th>
			</tr>
			<tr style="background:dimgray;color:white;padding:2px;">
				<th>ATM OFFSITE</th>
				<th>Bank</th>
				<th>ID</th>
				<th>LEVEL</th>
				<th>REPORTED ERROR</th>
				<th>REPORTED BY</th>
				<th>ATM SCREEN</th>
				<th>CALL / DATE-TIME</th>
				<th>RECEIVED / DATE-TIME</th>
				<th>DISPATCH / DATE-TIME</th>
				<th>RESPONSE DATE-TIME</th>
				<th>COMPLETED DATE-TIME</th>
				<th>SLA</th>
				<th>Action Taken</th>
				<th>STATUS</th>
			</tr>
		</thead>

		<tbody>';


		foreach($res as $complaint){
			$SLA = "";
			$strStart=$complaint["c_RcvDate"];
			$strEnd=$complaint["c_response"];
			if ($strEnd!="0000-00-00 00:00:00"){				
			 
			$timeFirst  = strtotime($strStart);
			$timeSecond = strtotime($strEnd);
			$diff = $timeSecond - $timeFirst;
			 	 
			$dteStart = date_create($strStart); 
			$dteEnd   = date_create($strEnd); 
			$dteDiff  = $dteStart->diff($dteEnd); 
			$SLA = $dteDiff->format("%H:%I:%S");
			}

			if($complaint['c_level']=="SLM"){
				$SLA = "";
			}
			$display.='<tr>
			<td>'.$complaint['Site'].'</td>
			<td>'.$complaint['Model'].'</td>
			<td>'.$complaint['Terminal_ID'].'</td>
			<td>'.$complaint['c_level'].'</td>
			<td>'.$complaint['c_complaint'].'</td>
			<td>'.$complaint['c_repby'].'</td>
			<td>'.$complaint['c_Screen'].'</td>
			<td>'.$complaint['c_RcvDate'].'</td>
			<td>'.$complaint['Dispatchdate'].'</td>
			<td>'.$complaint['c_AssignDate'].'</td>
			<td>'.$complaint['c_response'].'</td>
			<td>'.$complaint['c_resolution'].'</td>
			<td>'.$SLA.'</td>
			<td>'.$complaint['c_action'].'</td>
			<td>'.$complaint['c_Status'].'</td>
			</tr>';
		}


		$display.='</tbody></table>';

		session::set("exportdisplay",$display);

		echo "ok";
	}


	public function exportbank(){
		$datefrom = input::post('datefrom');
		$dateto = input::post('dateto');
		$bank = input::post('bank');

		$data = [$datefrom,$dateto,$bank];
		$res = $this->model->exportbank($data);

		$display = '<table style="width:100%">
		<thead>
			<tr>
			<th style="text-align:left">DATE FROM:</th>
			<th style="text-align:left">'.$datefrom.'</th>
			</tr>
			<tr>
			<th style="text-align:left">DATE TO:</th>
			<th style="text-align:left">'.$dateto.'</th>
			</tr>
			<tr>
			<th style="text-align:left">BANK:</th>
			<th style="text-align:left">'.$bank.'</th>
			</tr>
			<tr style="background:dimgray;color:white;padding:2px;">
				<th>ATM OFFSITE</th>
				<th>ID</th>
				<th>LEVEL</th>
				<th>REPORTED ERROR</th>
				<th>REPORTED BY</th>
				<th>ATM SCREEN</th>
				<th>CALL / DATE-TIME</th>
				<th>RECEIVED / DATE-TIME</th>
				<th>DISPATCH / DATE-TIME</th>
				<th>RESPONSE DATE-TIME</th>
				<th>COMPLETED DATE-TIME</th>
				<th>SLA</th>
				<th>Action Taken</th>
				<th>STATUS</th>
			</tr>
		</thead>

		<tbody>';


		foreach($res as $complaint){
			$SLA = "";
			$strStart=$complaint["c_RcvDate"];
			$strEnd=$complaint["c_response"];
			if ($strEnd!="0000-00-00 00:00:00"){				
			 
			$timeFirst  = strtotime($strStart);
			$timeSecond = strtotime($strEnd);
			$diff = $timeSecond - $timeFirst;
			 	 
			$dteStart = date_create($strStart); 
			$dteEnd   = date_create($strEnd); 
			$dteDiff  = $dteStart->diff($dteEnd); 
			$SLA = $dteDiff->format("%H:%I:%S");
			}

			if($complaint['c_level']=="SLM"){
				$SLA = "";
			}
			$display.='<tr>
			<td>'.$complaint['Site'].'</td>
			<td>'.$complaint['Terminal_ID'].'</td>
			<td>'.$complaint['c_level'].'</td>
			<td>'.$complaint['c_complaint'].'</td>
			<td>'.$complaint['c_repby'].'</td>
			<td>'.$complaint['c_Screen'].'</td>
			<td>'.$complaint['c_RcvDate'].'</td>
			<td>'.$complaint['Dispatchdate'].'</td>
			<td>'.$complaint['c_AssignDate'].'</td>
			<td>'.$complaint['c_response'].'</td>
			<td>'.$complaint['c_resolution'].'</td>
			<td>'.$SLA.'</td>
			<td>'.$complaint['c_action'].'</td>
			<td>'.$complaint['c_Status'].'</td>
			</tr>';
		}


		$display.='</tbody></table>';

		session::set("exportdisplay",$display);

		echo "ok";
	}

	public function downloadexcelreport(){
		$xDate = date("Ydm");

		$filename ="Reports_".$xDate."_.xls";
		$contents = session::get("exportdisplay");
		header('Content-type: application/ms-excel');
		header('Content-Disposition: attachment; filename='.$filename);
		echo $contents;
	}


}

}