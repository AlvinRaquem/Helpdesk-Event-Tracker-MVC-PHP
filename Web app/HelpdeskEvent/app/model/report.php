<?php

namespace model{

use base\model;

Class report extends model {

	public function index(){
		$fields = ['*'];
		$res = $this->select('tbl_complaint a',$fields)
					->leftjoin('tbl_loc b','a.c_atmID','b.Terminal_ID')
					->where('c_Status <> "Closed"')
					->orderby('IDno','DESC')
					->get();
		return $res;
	}

	public function filterlist($where,$data,$sort){
		$fields = ['*'];
		$res = $this->select('tbl_complaint a',$fields,$data)
					->leftjoin('tbl_loc b','a.c_atmID','b.Terminal_ID')
					->where($where)
					->orderby('IDno',$sort)
					->get();
		return $res;
	}

	public function getErrorCodes(){
		$fields = ['DISTINCT(c_errCode) as errCode'];
		$res = $this->select('tbl_complaint',$fields)
					->orderby('c_errCode')
					->get();
		return $res;
	}

	public function exportrecord($data){
		$fields = ['*'];
		$res = $this->select('tbl_complaint a',$fields,$data)
					->leftjoin('tbl_loc b','a.c_atmID','b.Terminal_ID')
					->where('DATE(a.c_RcvDate) BETWEEN ? AND ?')
					->orderby('IDno','DESC')
					->get();
		return $res;
	}

		public function exportbank($data){
		$fields = ['*'];
		$res = $this->select('tbl_complaint a',$fields,$data)
					->leftjoin('tbl_loc b','a.c_atmID','b.Terminal_ID')
					->where('DATE(a.c_RcvDate) BETWEEN ? AND ? AND b.Model = ?')
					->orderby('IDno','DESC')
					->get();
		return $res;
	}
}

}