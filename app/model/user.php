<?php

namespace model{

use base\model;

use helper\session;

class user extends model {

	public function checkuser($data){
		$fields = ['*'];
		$res = $this->select('tb_user',$fields,$data)
					->where("user_name = ? AND user_level != 'technician' AND user_level != 'teller'")
					->first();
		return $res;

		// $res = $this->select('tb_user a',$fields,$data)->leftJoin('tb_test b','a.id','b.userid')->where("user_name = ? AND pass_word = ?");
		// $res = $this->delete('tb_user',$data)->where("user_name = ? AND pass_word = ?")->orderby('username DESC')->groupby('name,age');
		// echo $this->getSQL();
		
	}

	public function getAllUser(){
		$fields = ['*'];
		$res = $this->select('tb_user',$fields)
					->orderby('full_name')
					->get();
		return $res;
		// $sql = "SELECT * FROM tb_user ORDER BY full_name ASC";
		// $res = $this->rawQuery($sql)->get();
		// var_dump($res);
	}

	public function changepass($data){
		$columns = ['pass_word'];

		$res = $this->update('tb_user',$columns,$data)
					->where('IDno = ?')
					->execute();
		if($res){
			session::set("user_message","Password changed successfully");
		}else{
			session::set("user_message","Something went wrong");
		}
	}

	public function create($data){
		$columns = ['full_name','user_name','email_add','user_level','pass_word'];

		$check = $this->checkifexist($data[1]);

		if($check == 0){
			$res = $this->insert('tb_user',$columns,$data)
					->execute();
			session::set("user_message","Created successfully");
		}else{
			session::set("user_message","Username is already taken");
		}
		
	}

	public function updateuser($data,$newpassword,$idno){

		$oldusername = $this->getoldusername($idno)['user_name'];

		if($oldusername == $data[1]){
				if($newpassword==""){
					$columns = ['full_name','user_name','email_add','user_level'];
				}else{
					$columns = ['full_name','user_name','email_add','user_level','pass_word'];
				}

				$res = $this->update('tb_user',$columns,$data)
							->where('IDno = ?')
				 			->execute();
			     session::set("user_message","Updated successfully");		
		}else{
			$check = $this->checkifexist($data[1]);

			if($check == 0){
				if($newpassword==""){
					$columns = ['full_name','user_name','email_add','user_level'];
				}else{
					$columns = ['full_name','user_name','email_add','user_level','pass_word'];
				}

				$res = $this->update('tb_user',$columns,$data)
							->where('IDno = ?')
							->execute();
			    session::set("user_message","Updated successfully");		
			}else{
				session::set("user_message","Username is already taken");
			}
		}


		

		
	}

	private function checkifexist($username){
		$data = [$username];
		$fields = ['*'];
		$res = $this->select('tb_user',$fields,$data)
					->where('user_name = ?')
					->first();
		$rescount = $this->rowCount();	
	
		if($rescount>0){
			$exist= 1;
		}else{
			$exist = 0;
		}
		return $exist;
	}


	private function getoldusername($id){
		$data = [$id];
		$fields = ['user_name'];
		$res = $this->select('tb_user',$fields,$data)
					->where('IDno = ?')
					->first();
		return $res;
	}

	
	public function remove($id){
		$data = [$id];
		$res = $this->delete('tb_user',$data)
					->where('IDno = ?')
					->execute();
		if($res){
			echo "1";
		}

	}

	public function searchuser($search){
		$data = ['%'.$search.'%','%'.$search.'%','%'.$search.'%'];
		$fields = ['*'];
		$res = $this->select('tb_user',$fields,$data)
					->where('full_name LIKE ? OR user_name LIKE ? OR email_add LIKE ?')
					->get();
		return $res;
	}


}

}