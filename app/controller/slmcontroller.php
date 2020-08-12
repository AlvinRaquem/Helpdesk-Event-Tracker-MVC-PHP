<?php

namespace controller;

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

Class slmcontroller extends controller implements activelist{
	private $atmcontroller;

	public function __construct(){
		parent::__construct(new complaint);
		$this->atmcontroller = new atmcontroller;
	}

	public function getActivelist(){
		$modDate=date('Y-m-d H:i:s', time());
		$res = $this->model->activelist('SLM');
		$display="";

		foreach($res as $complaint){
					if($complaint['c_response']=="0000-00-00 00:00:00"){
						$Target=$complaint["c_Target"];
						$Now=$modDate;
					}else{
						$Target=$complaint["c_response"];
						$Now=$modDate;
					}

					//check if same day

					$dateCreate = date_create($Target);
					$dateNow = date_create($Now);

					$Target = strtotime($Target);
					$Now = strtotime($Now);
					$differenceInSeconds = $Target - $Now;

					if ($differenceInSeconds > 0)
					{ $display.= "<tr class='active'>"; }
					elseif(date_format($dateCreate,"d") == date_format($dateNow,"d"))
					{ $display.= "<tr class='warning'>";
					}else
					{ $display.=  "<tr class='danger'>"; }

					$atmdetails = $this->atmcontroller->getatmdetails($complaint['c_atmID']);

					$x_terID=$atmdetails["Terminal_ID"];
					$x_brand=$atmdetails["Brand"];
					$x_model=$atmdetails["Model"];
					$x_site=$atmdetails["Site"];


					$tickNo=$complaint["IDno"];
					$display.= "<td>"."<a href=ticketinfo?ticketno=".urlencode($tickNo).">$tickNo</a>"."</td>";
					$display.= "<td>".$x_terID."<br />".$x_brand."</td>";
					$display.= "<td>".$x_model."<br />".$x_site."</td>";
					$display.= "<td>".$complaint["c_complaint"]."</td>";
					$display.= "<td>".$complaint["c_RcvDate"]."</td>";
					$display.= "<td>".$complaint["c_Target"]."</td>";
					$display.= "<td>".$complaint["c_rcvby"]."</td>";
					$display.= "<td>".$complaint["c_PersonAssign"]."</td>";
					$display.= "</tr>";
		}

		return $display;	
	}
	
}