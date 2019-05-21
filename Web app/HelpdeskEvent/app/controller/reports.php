<?php

namespace controller{

use base\controller;
use model\report;
use helper\input;
use helper\session;
use controller\atmcontroller;

Class reportcontroller extends controller {

	private $atmcontroller;

	public function __construct(){
		parent::__construct(new report);
		$this->atmcontroller = new atmcontroller;
	}

	public function list(){
		$display = "";
		$res = $this->model->list();

		foreach($res as $complaint){
			$atmdetails = $this->atmcontroller->getatmdetails($complaint['c_atmID']);
			$display.='<tr>
			<td><a href="ticketinfo?ticketno='.$complaint['IDno'].'">'.$complaint['IDno'].'</a></td>
			<td>
				<ul>
				<li><h6>'.$atmdetails['Terminal_ID'].'</h6></li>
				<li><h6>'.$atmdetails['Model'].'</h6></li>
				<li><h6>'.$atmdetails['Site'].'</h6></li>
				</ul>
			</td>

			<td><h6>'.$complaint['c_repby'].'</h6></td>
			<td>
				<ul>
				<li><h6>'.$atmdetails['c_complaint'].'</h6></li>
				<li><h6>'.$atmdetails['c_type'].'</h6></li>
				</ul>
			</td>
			<td><h6>'.$complaint['c_RcvDate'].'</h6></td>

			</tr>';
		}

		$data = ['reportdis'=>$display];
		$this->view->make('repo')

	}


}

}