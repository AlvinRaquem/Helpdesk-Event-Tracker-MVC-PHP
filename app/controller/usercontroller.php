<?php


namespace controller;

require_once BASE_PATH."controller.php";
require_once MODEL_PATH."user.php";
require_once HELPER_PATH."input.php";
require_once APP_PATH."actions/getUser.php";

use base\controller;
use model\user;
use helper\input;

use actions\getUser;

class usercontroller extends controller {

		public function __construct(){
			parent::__construct(new user);		
		}

		public function index(){
			$users = $this->getAllUser();
			$data = ['users'=>$users];
			$this->view->make('settings/manage_users',$data);
		}

		public function checkuser(){
			$username = input::post("username");
			$pass = input::post("password");
			$data = [$username];
			// $user = $this->model->checkuser($data,"Officer");
			$user = $this->model->checkuser($data);
			$usercount = count($user);
			if($usercount>0){
	
				if (password_verify($pass, $user['pass_word'])) {
			  		$this->session->set('SESS_USER_FULL_NAME',$user['full_name']);
					$this->session->set('SESS_USER_ID',$user['IDno']);
					$this->session->set('SESS_USER_TYPE',$user['user_level']);
					$this->session->set('SESS_USER_NAME',$user['user_name']);
					$this->session->set('LAST_ACTIVITY',time());
				
					session_write_close();
					echo $usercount;
				}
				else {
				   echo "0";
				}
			}


			
		}



		public function changepass(){
			$idno = input::post('idno');
			$password = input::post('password');

			$options = [
			    'salt' => $this->generateSalt($password), //write your own code to generate a suitable salt
			    'cost' => 12 // the default cost is 10
			];

			$hash = password_hash($password, PASSWORD_DEFAULT, $options);

			$data = [$hash,$idno];
			$res = $this->model->changepass($data);
			$this->view->redirect('changepassword');
		}


		public function getAllUser(){
			$res = $this->model->getAllUser();
			return $res;
		}

		public function displayusers(){
			$res = $this->getAllUser();

			$display = "";
			$x=1;
			foreach($res as $user){
				$display.='<tr>
				<td>'.$x++.'</td>
				<td>'.$user['full_name'].'</td>
				<td>'.$user['user_name'].'</td>
				<td>'.$user['email_add'].'</td>
				<td>'.$user['user_level'].'</td>
				<td><button style="padding: 5pt" class="btn btn-warning edituser" data-id="'.$user['IDno'].'" data-fullname="'.$user['full_name'].'" data-username="'.$user['user_name'].'" data-emailadd="'.$user['email_add'].'" data-userlevel="'.$user['user_level'].'"><span class="fa fa-edit"></span> Edit</button></td>
				<td><button type="button" style="padding: 5pt" class="btn btn-danger removeuser" data-id="'.$user['IDno'].'"><span class="fa fa-trash"></span> Remove</button></td>
				</tr>';
			}

			echo $display;
		}

		public function searchuser(){
			$search = input::post('search');
			$res = $this->model->searchuser($search);

			$display = "";
			$x=1;
			foreach($res as $user){
				$display.='<tr>
				<td>'.$x++.'</td>
				<td>'.$user['full_name'].'</td>
				<td>'.$user['user_name'].'</td>
				<td>'.$user['email_add'].'</td>
				<td>'.$user['user_level'].'</td>
				<td><button style="padding: 5pt" class="btn btn-warning edituser" data-id="'.$user['IDno'].'" data-fullname="'.$user['full_name'].'" data-username="'.$user['user_name'].'" data-emailadd="'.$user['email_add'].'" data-userlevel="'.$user['user_level'].'"><span class="fa fa-edit"></span> Edit</button></td>
				<td><button type="button" style="padding: 5pt" class="btn btn-danger removeuser" data-id="'.$user['IDno'].'"><span class="fa fa-trash"></span> Remove</button></td>
				</tr>';
			}

			echo $display;

		}


		public function getUsers(){
			$res = $this->model->getAllUser();
			$usercount = count($res) == true ? count($res) : 0;
				$users = array();
				$data = array("users"=>$users);
			if($usercount>0){
				$data = array("users"=>$res);
			}

			$this->view->make("users",$data);
		}

		public function create(){
			$fullname = input::post("fullname");
			$username = input::post("username");
			$emailadd = input::post("emailadd");
			$userlevel = input::post("userlevel");
			$password = input::post("password");

			$options = [
			    'salt' => $this->generateSalt($password), //write your own code to generate a suitable salt
			    'cost' => 12 // the default cost is 10
			];

			$hash = password_hash($password, PASSWORD_DEFAULT, $options);

			$data = [$fullname,$username,$emailadd,$userlevel,$hash];
			$res = $this->model->create($data);
			$this->view->redirect('manage_users');
		}

		public function update(){
			$idno = input::post("idno");
			$fullname = input::post("fullname");
			$username = input::post("username");
			$emailadd = input::post("emailadd");
			$userlevel = input::post("userlevel");
			$newpassword = input::post("newpassword");

			if($newpassword==""){
				$hash = "";
				$data = [$fullname,$username,$emailadd,$userlevel,$idno];
			}else{
				$options = [
				    'salt' => $this->generateSalt($newpassword), //write your own code to generate a suitable salt
				    'cost' => 12 // the default cost is 10
				];

				$hash = password_hash($newpassword, PASSWORD_DEFAULT, $options);
				$data = [$fullname,$username,$emailadd,$userlevel,$hash,$idno];
			}
			$res = $this->model->updateuser($data,$hash,$idno);
			$this->view->redirect('manage_users');			

		}

		public function remove(){
			$idno = input::post("idno");
			$res = $this->model->remove($idno);
		}

		public function getusercount($type){
			$res = $this->model->getusercount($type);
			$rescount = count($res) == true ? count($res) : 0;
			return $rescount;
		}

		public function testing(getUser $getUseraction){
			$getUseraction->execute();
		}

		private function generateSalt($password){
			 $salt = base64_encode(openssl_random_pseudo_bytes(128, $password));
			 while(!$password){
			    $salt = base64_encode(openssl_random_pseudo_bytes(128, $password));
			}
			return $salt;
		
		}
		

		public function __destruct(){

		}



}

