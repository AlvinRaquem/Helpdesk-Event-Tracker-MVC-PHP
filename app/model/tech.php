<?php

namespace model{
require_once BASE_PATH."model.php";
use base\model;

Class tech extends model {

	public function getList(){
		$fields = ['*'];
		$res = $this->select('tbl_technician',$fields)
					->orderby('fullname')
					->get();
		return $res;
	}

	public function createnewtech($fullname){

		$res = $this->insert('tbl_technician',['fullname'],[$fullname])
					->execute();
		return $res;
	}

	public function removetech($idno){
		$res = $this->delete('tbl_technician',[$idno])
					->where('idno = ?')
					->execute();

		return $res;
	}

	public function updatetech($data){
		$res = $this->update('tbl_technician',['fullname'],$data)
					->where('idno = ?')
					->execute();
		return $res;
	}

	

}

}