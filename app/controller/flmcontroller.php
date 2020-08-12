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

use DateTime;

Class flmcontroller extends controller implements activelist{
	private $atmcontroller;

	public function __construct(){
		parent::__construct(new complaint);
		$this->atmcontroller = new atmcontroller;
	}

	public function getActivelist(){
		$modDate=date('Y-m-d H:i:s', time());
		$res = $this->model->activelist('FLM');
		$display = "";
		$x_store = "";
		foreach($res as $complaint){
			$atmid = $complaint['c_atmID'];

			$atmdetails = $this->atmcontroller->getatmdetails($atmid);
			$x_terID=$atmdetails["Terminal_ID"];
			$x_brand=$atmdetails["Brand"];
			$x_model=$atmdetails["Model"];
			$x_site=$atmdetails["Site"];
			$x_add= $atmdetails["Address"];
			$x_Open = $atmdetails['Opening'];
			$x_Close = $atmdetails['Closing'];
			$x_SLA =$atmdetails['SLA'];
			$x_brand = substr($x_brand, 0, 3);


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
				
				// $display.="".$timeNow."<br/>";
				// $display.="".$x_OpenS."<br/>";

			
				if ($timeNow > $x_OpenS || $timeNow==$x_OpenS)  //Time now > opening store
				{ 
					if ($timeRcv > $x_CloseS || $timeRcv==$x_CloseS)
					{
						if ($Date_SLA==$Date_SLA2)
						{
							$x_store = "CUTOFF";
							$display.=  "<tr class=\"active\">";
							//echo $Date_SLA."/".$Date_SLA2;
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
							
							////Reversal
							// $dteStart = new DateTime($SLA); 
							// if ($x_SLA>9) 
							// {
							// $x_SLA= "0".$x_SLA.":00:00";
							// $dteEnd   = new DateTime($x_SLA);
							// }
							// else {
							// $x_SLA= $x_SLA.":00:00";
							// $dteEnd   = new DateTime($x_SLA);
							// }
							// //$dteEnd   = new DateTime("02:00:00"); 
     		// 				$dteDiff  = $dteStart->diff($dteEnd); 
							// $x_store = $dteDiff->format("%H:%I:%S");
							
							
							
							if ($diffInSecs > $Danger)
							{
								$display.= "<tr class=\"danger\">";
							
							}
							elseif ($diffInSecs > $Warning)
							{
								$display.= "<tr class=\"warning\">";
								
							}
							else
							{
								$display.=  "<tr class=\"active\">";
								
							}
													
					}
				} 
				else 
				{
					$x_store="WAIT-OPEN";
					$display.=  "<tr class=\"active\">";
					 
				} 			
						
				$tickNo=$complaint["IDno"];
				$display.= "<td>"."<a href=ticketinfo?ticketno=".urlencode($tickNo).">$tickNo</a>"."</td>";
				$display.= "<td>".$x_terID."<br />".$x_brand."</td>";
				$display.= "<td>".$x_model."<br />".$x_site."</td>";
				$display.= "<td>".$complaint["c_complaint"]."</td>";
				$display.= "<td>".$complaint["c_RcvDate"]."</td>";
				$display.= "<td>".$x_store."</td>";
				$display.= "<td>".$complaint["c_rcvby"]."</td>";
				$display.= "<td>".$complaint["c_PersonAssign"]."</td>";
				$display.= "</tr>";
	

		}

		return $display;

	}

}

}