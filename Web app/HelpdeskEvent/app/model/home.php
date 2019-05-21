<?php

namespace model{

use base\model;

Class home extends model {

	public function gettodaycalls($level){
		$fields = ['*'];
		$res = $this->select('tbl_complaint',$fields)
					->where('DATE(c_RcvDate) = DATE(NOW()) AND c_level = "'.$level.'"')
					->get();
		$rescount = count($res) ? count($res) : 0;
		return $rescount;
	}

	public function gettodaypending($level){
		$fields = ['*'];
		$res = $this->select('tbl_complaint',$fields)
					->where('DATE(c_RcvDate) = DATE(NOW()) AND c_level = "'.$level.'" AND c_status <> "Closed"')
					->get();
		$rescount = count($res) ? count($res) : 0;
		return $rescount;
	}

	public function gettodaynotmet(){
		$fields = ['*'];
		$res = $this->select('tbl_complaint',$fields)
					->where("c_level='FLM' AND DATE(c_RcvDate) < DATE(CURDATE()) AND c_Status='Open'")
					->get();
		$rescount = count($res) ? count($res) : 0;
		return $rescount;		
	}

	public function todaycalls(){
		$fields = ['c_RcvDate'];
		$res = $this->select('tbl_complaint',$fields)
					->where("c_level = 'FLM' AND DATE(c_RcvDate) = DATE(NOW())")
					->get();
		return $res;
	}

}

}