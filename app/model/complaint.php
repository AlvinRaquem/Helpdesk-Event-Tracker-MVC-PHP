<?php

namespace model{
require_once BASE_PATH."model.php";
use base\model;


Class complaint extends model {

	public function getList(){
		$fields = ['*'];
		$res = $this->select('tblcomplaintlist',$fields)->orderby('Description')->get();
		return $res;

	}

	public function activeList($level){
		$fields = ['*'];
		$res = $this->select('tbl_complaint',$fields)
					->where('c_status <> "Closed" AND c_level = "'.$level.'"')
					->orderby('c_Target','ASC')
					->get();
		return $res;
	}

	public function activeListtoday(){
		$fields = ['*'];
		$res = $this->select('tbl_complaint',$fields)
					->where('c_status <> "Closed" AND c_level = "FLM" AND DATE(c_RcvDate) = DATE(NOW())')
					->orderby('c_Target','ASC')
					->get();
		return $res;
	}

	public function create($data){
		$columns = ['Description'];
		$res = $this->insert("tblcomplaintlist",$columns,$data)
					->execute();
		return $res;
	}

	public function _update($data){
		$columns = ['Description'];
		$res = $this->update("tblcomplaintlist",$columns,$data)
					->where("IDno = ?")
					->execute();
		return $res;
	}

	public function remove($data){
		$res = $this->delete('tblcomplaintlist',$data)
					->where('IDno = ?')
					->execute();
		return $res;
	}

	public function searchcomplaint($search){

		$fields = ['*'];
		$data = ['%'.$search.'%'];

		$res = $this->select('tblcomplaintlist',$fields,$data)
					->where('Description LIKE ?')
					->get();
		return $res;
	}


}

}