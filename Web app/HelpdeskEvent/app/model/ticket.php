<?php

namespace model{

use base\model;
use helper\session;

Class ticket extends model {

	public function createticket($params){
		$columns = [
			'c_complaint',
			'c_type',
			'c_chest',
			'c_level',
			'c_Screen',
			'c_errCode',
			'c_rcvby',
			'c_RcvDate',
			'c_atmID',
			'c_repby',
			'c_RepVia',
			'c_PersonAssign',
			'c_AssignDate',
			'c_Status',
			'c_Target',
			'Dispatchby',
			'Dispatchdate',
		];
		$res = $this->insert('tbl_complaint',$columns,$params)
					->execute();
		return $res;
		//echo $this->getSQL();
	}

	public function ticketinfo($data){
		$fields = ['*'];
		$res = $this->select('tbl_complaint',$fields,$data)
					->where('IDno = ?')
					->first();
		return $res;
	}

	public function getticket_lastcomment($data){
		$fields = ['*'];
		$res = $this->select('tbl_comment',$fields,$data)
					->where('TicNo = ?')
					->last();
		return $res;
	}

	public function getticket_comment($data){
		$fields = ['*'];
		$res = $this->select('tbl_comment',$fields,$data)
					->where('TicNo = ?')
					->get();
		return $res;
	}


	public function updateticketdetails($data){

		$ticketdata = [$data[19]];


		$res = $this->ticketinfo($ticketdata);

		$lastupdateby = $res['LastMod'];
		$lastupdatedate = $res['LasDate'];

		$modby = $res['Modby'];
		$moddate = $res['ModDate'];

		$newupdateby = session::get("SESS_USER_FULL_NAME");
		$newupdatedate = date('Y-m-d H:i:s',time()); 

		if($lastupdateby == ""){
			$data[19] = $newupdateby;
			$data[20] = $newupdatedate;
			$data[21] = $newupdateby;
			$data[22] = $newupdatedate;
		}else{
			$data[19] = $newupdateby;
			$data[20] = $newupdatedate;
			$data[21] = $modby;
			$data[22] = $moddate;
		}

		$data[23] = $ticketdata[0];

		
	
		$columns = [
			'c_complaint',
			'c_type',
			'c_chest',
			'c_level',
			'c_Screen',
			'c_errCode',
			'c_RcvDate',
			'c_repby',
			'c_RepVia',
			'Dispatchby',
			'Dispatchdate',
			'c_PersonAssign',
			'c_AssignDate',
			'c_Status',
			'c_Target',
			'c_diagnosis',
			'c_action',
			'c_response',
			'c_resolution',	
			'Modby',
		    'ModDate',
			'LastMod',
			'LasDate',	
		];

		$res = $this->update('tbl_complaint',$columns,$data)
					->where('IDno = ?')
					->execute();
		return $res;
	}
}

}