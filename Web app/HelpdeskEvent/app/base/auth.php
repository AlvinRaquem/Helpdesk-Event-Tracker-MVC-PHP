<?php

namespace base {
use helper\session;
use base\view;

Class auth {
	
	public function __construct(){
		if(session_id()=="")
			session_start();
	}

	public static function checkAuth(){
		
		if((isset($_SESSION['LAST_ACTIVITY'])) && (time() - session::get("LAST_ACTIVITY") > 7200)){
			// request 30 minutes ago
			session_destroy();
			view::redirect("session-expired");
			exit();
		}

		//Check whether the session variable SESS_MEMBER_ID is present or not
		if((!isset($_SESSION['SESS_USER_ID'])) || (trim(session::get("SESS_USER_ID")) == '')) {
			view::redirect("./");
			exit();
		}
		session::set("LAST_ACTIVITY",time());//RENEW THE TIME
	}

	public static function logout(){
		session_destroy();
		view::redirect("./");
		exit();			
	}

	public static function RedirectifLog(){
		if(isset($_SESSION['SESS_USER_ID'])){
			view::redirect("cpanel");
		}else{
			view::make('index');
		}
	}

	public static function middleware($privilege){
		// if(session::get("SESS_USER_TYPE") != $usertype && session::get("SESS_USER_TYPE")!="Superadmin"){
		// 	view::redirect("access-denied");
		// 	exit();
		// }

		if($privilege == 0 && session::get("SESS_USER_TYPE") != "Superadmin"){
			view::redirect("access-denied");
			exit();
		}
	}

    public static function SuperAdminMiddleware(){
    	if(session::get("SESS_USER_TYPE") != 'superadmin'){
			view::redirect("access-denied");
			exit();
		}
    }

	public static function AdminMiddleware(){
		if(session::get("SESS_USER_TYPE") != 'admin'){
			view::redirect("access-denied");
			exit();
		}
	}

	public static function UserMiddleware(){
		if(session::get("SESS_USER_TYPE") != 'User'){
			view::redirect("access-denied");
			exit();
		}
	}
}
}