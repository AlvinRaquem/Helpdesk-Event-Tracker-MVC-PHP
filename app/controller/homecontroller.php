<?php

namespace controller{
require_once BASE_PATH."controller.php";
require_once MODEL_PATH."home.php";
require_once MODEL_PATH."complaint.php";
require_once HELPER_PATH."input.php";
require_once HELPER_PATH."session.php";

use base\controller;
use model\home;
use helper\input;
use helper\session;
use model\complaint;
use DateTime;

Class homecontroller extends controller {

	private $flmtodaycalls = 0;
	private $flmtodaypending = 0;
	private $flmpercentage = "";
	private $todaynotmet = 0;
	private $slmtodaycalls = 0;
	private $slmtodaypending = 0;
	private $complaint;
	private $atmcontroller;

	public function __construct(){
		parent::__construct(new home);
		$this->complaint = new complaint;
		$this->atmcontroller = new atmcontroller;
	}

	public function index(){
		$this->getflmtodaycalls();
		$this->getflmtodaypending();
		$this->computeflmpercentage();
		$this->gettodaynotmet();
		$this->getslmtodaycalls();
		$this->getslmtodaypending();
		$data = [
		'flmtodaycall'=>$this->flmtodaycalls,
		'flmtodaypending'=>$this->flmtodaypending,
		'flmpercentage'=>$this->flmpercentage,
		'flmtodaynotmet'=>$this->todaynotmet,
		'slmtodaycalls'=>$this->slmtodaycalls,
		'slmtodaypending'=>$this->slmtodaypending,
		];
		$this->view->make('cpanel',$data);
	}

	private function getflmtodaycalls(){
		$this->flmtodaycalls = $this->model->gettodaycalls('FLM');
	}

	private function getflmtodaypending(){
		$this->flmtodaypending = $this->model->gettodaypending('FLM');
	}

	private function computeflmpercentage(){
		if($this->flmtodaycalls != 0){
			$done = $this->flmtodaycalls - $this->flmtodaypending;
			$percentage = number_format(( $done / $this->flmtodaycalls ) * 100,2) . '%';
			$this->flmpercentage = $percentage;
		}else{
			$this->flmpercentage = "--";
		}
		
	}

	private function getslmtodaycalls(){
		$this->slmtodaycalls = $this->model->gettodaycalls('SLM');
	}

	private function getslmtodaypending(){
		$this->slmtodaypending = $this->model->gettodaypending('SLM');
	}

	private function gettodaynotmet(){
		$this->todaynotmet = $this->model->gettodaynotmet();
	}


	public function dashboardcalls(){
		$this->view->make('dashboard/index');
	}

	public function flmactive(){
		$this->view->make('dashboard/flm');
	}

	public function slmactive(){
		$this->view->make('dashboard/slm');
	}

	public function getflmchart(){
		$this->getflmtodaypending();
		$this->getflmtodaycalls();
		$this->computeflmpercentage();
		$modDate=date('Y-m-d H:i:s', time());
		$danger = $warning = 0;

		$pendingflm = $this->complaint->activeListtoday();

		foreach($pendingflm as $complaint){
			$atmid = $complaint['c_atmID'];
			$atmdetails = $this->atmcontroller->getatmdetails($atmid);
			$x_Open = $atmdetails['Opening'];
			$x_Close = $atmdetails['Closing'];
			$x_SLA =$atmdetails['SLA'];

				$timeNow = date('H:i', time());
				$timeRcv = substr($complaint['c_RcvDate'], 11, 2);
				$x_OpenS = substr($x_Open, 0, 2);
				$timeNow = substr($timeNow, 0, 2);
				$x_CloseS = substr($x_Close, 0, 2);
				
				if ($x_OpenS=="00") { $x_OpenS="07"; } //opening store
				if ($x_CloseS=="00") { $x_CloseS="17"; } //opening store
				if ($x_SLA=="") { $x_SLA=2; }
				
				$Date_SLA = substr($complaint['c_RcvDate'], 0, 10);
				$Date_SLA2 = date('Y-m-d');

			
				if ($timeNow > $x_OpenS || $timeNow==$x_OpenS)  //Time now > opening store
				{ 
					if ($timeRcv > $x_CloseS || $timeRcv==$x_CloseS)
					{
						if ($Date_SLA==$Date_SLA2)
						{
							$x_store = "CUTOFF";
						}
						else
						{
							$timeRcv=$x_OpenS;
							
						}
					}
					else
					{		
							$Date_SLA = substr($complaint['c_RcvDate'], 0, 10);
							$Date_SLA2 = date('Y-m-d');
							
							
							if ($Date_SLA==$Date_SLA2)
							{ 
								if ($timeRcv<$x_OpenS)
								{
									$Start_SLA = date('Y-m-d')." ".$x_OpenS.":00:00";
								}
								else
								{
								$Start_SLA = $complaint['c_RcvDate'];}
								}
							else
							 {							
								$Start_SLA = date('Y-m-d')." ".$x_OpenS.":00:00";
							 }
							$End_SLA = $modDate;
							$dtStart = new DateTime($Start_SLA);
							$dtEnd = new DateTime($End_SLA);
							$dteDiff  = $dtStart->diff($dtEnd); 
							$SLA = $dteDiff->format("%H:%I:%S");
							$x_store = $SLA;

							// $display.="".$x_store."<br/>";
							
							$timeFirst  = strtotime($Start_SLA);
							$timeSecond = strtotime($End_SLA);
							$diffInSecs = $timeSecond - $timeFirst;
							
							$Danger = $x_SLA * 3600;
							$Warning = $x_SLA - 1;
							$Warning = $Warning * 3600;
									
							
							if ($diffInSecs > $Danger)
							{
								$danger++;
							
							}
							elseif ($diffInSecs > $Warning)
							{
								$warning++;
								
							}
					
													
					}
				} 
						

		}


	// today calls
	$six = 0;
	$seven = 0;
	$eight = 0;
	$nine = 0;
	$ten = 0;
	$eleven = 0;
	$twelve = 0;
	$thirteen = 0;
	$fourteen = 0;
	$fifteen = 0;
	$sixteen = 0;
	$seventeen = 0;
	$eighteen = 0;
	$nineteen = 0;
	$twenty = 0;
	$twentyone = 0;
	$twentytwo = 0;
	$twentythree = 0;
	$twentyfour = 0;

	$res = $this->model->todaycalls();

	foreach($res as $complaint){
		$ddate = $complaint['c_RcvDate'];
		$ddate = substr($ddate,11);
		$ddate = substr($ddate,0,2);

			switch($ddate){
				case '06':
				$six++;
				break;
				case '07':
				$seven++;
				break;
				case '08':
				$eight++;
				break;
				case '09':
				$nine++;
				break;
				case '10';
				$ten++;
				break;
				case '11':
				$eleven++;
				break;
				case '12':
				$twelve++;
				break;
				case '13':
				$thirteen++;
				break;
				case '14':
				$fourteen++;
				break;
				case '15':
				$fifteen++;
				break;
				case '16':
				$sixteen++;
				break;
				case '17':
				$seventeen++;
				break;
				case '18':
				$eighteen++;
				break;
				case '19':
				$nineteen++;
				break;
				case '20':
				$twenty++;
				break;
				case '21':
				$twentyone++;
				break;
				case '22':
				$twentytwo++;
				break;
				case '23':
				$twentythree++;
				break;
				case '24':
				$twentyfour++;
				break;
			}
	}

	$hours = ['6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	$calls = array($six,$seven,$eight,$nine,$ten,$eleven,$twelve,$thirteen,$fourteen,$fifteen,$sixteen,$seventeen,$eighteen,$nineteen,$twenty,$twentyone,$twentytwo,$twentythree,$twentyfour);

	$data = [
		'totalpendinggraph' => (int)$this->flmtodaypending,
		'totaldonegraph' => (int)($this->flmtodaycalls - $this->flmtodaypending),
		'flmcritical' => $danger,
		'lowcount' => $warning,
		'hours' => $hours,
		'calls_count' => $calls,
		'percentage' => $this->flmpercentage,
	];
	echo json_encode($data);
	}
}

}