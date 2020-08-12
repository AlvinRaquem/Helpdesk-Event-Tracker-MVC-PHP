<?php

namespace model{
require_once BASE_PATH."model.php";
use base\model;

Class atm extends model {

	public function getList(){
		$fields = ['*'];
		$res = $this->select('tbl_loc',$fields)
					->orderby('Terminal_ID')
					->get();
		return $res;
	}

	public function searchsite($site){
		$fields = ['*'];
		$data = ['%'.$site.'%','%'.$site.'%','%'.$site.'%'];
		$res = $this->select('tbl_loc',$fields,$data)
					->where('Terminal_ID LIKE ? OR Site LIKE ? OR Model LIKE ?')
					->orderby('Terminal_ID')
					->get();

		return $res;
	}

	public function getbanks(){
		$fields=['DISTINCT(Model)'];
		$res = $this->select('tbl_loc',$fields)
					->orderby('Model')
					->get();
		return $res;
	}

	public function getatmdetails($data){
		$fields = ['*'];
		$res = $this->select('tbl_loc',$fields,$data)
					->where('Terminal_ID = ?')
					->first();
		return $res;
	}

	public function viewunit($data){
		$res = $this->getatmdetails($data);
		return $res;
	}

	public function create($data){
		$columns = [
			'Terminal_ID',
			'Brand',
			'Model',
			'Site',
			'Address',
			'City',
			'Location',
			'LocSLA',
			'SLA',
			'Opening',
			'Closing',
			'Contact_Person',
			'Contact_No',
		];

		$res = $this->insert('tbl_loc',$columns,$data)
					->execute();
		return $res;
	}

	public function remove($data){
		$res = $this->delete('tbl_loc',$data)
					->where('Terminal_ID = ?')
					->execute();
		return $res;
	}

	public function _update($data){
		$columns = [
			'Terminal_ID',
			'Brand',
			'Model',
			'Site',
			'Address',
			'City',
			'Location',
			'LocSLA',
			'SLA',
			'Opening',
			'Closing',
			'Contact_Person',
			'Contact_No',
		];

		$res = $this->update('tbl_loc',$columns,$data)
					->where('Terminal_ID = ?')
					->execute();
		return $res;
	}

}

}