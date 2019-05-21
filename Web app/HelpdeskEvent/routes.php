<?php

use base\Route;
use base\view;
use base\auth;
use helper\session;
use helper\input;

use controller\usercontroller;
use controller\ticketcontroller;
use controller\atmcontroller;
use controller\complaintcontroller;
use controller\homecontroller;
use controller\reportcontroller;

use controller\slmcontroller;
use controller\flmcontroller;

$view = new view;
$usercontroller = new usercontroller;
$ticketcontroller = new ticketcontroller;
$atmcontroller = new atmcontroller;
$complaintcontroller = new complaintcontroller;
$homecontroller = new homecontroller;
$reportcontroller = new reportcontroller;

use actions\getUser;


Route::make('testing',function(){
	// $GLOBALS['usercontroller']->testing(new getUser);
	$GLOBALS['usercontroller']->getUsers();
	exit;
});

Route::make('index.php',function(){
	auth::RedirectifLog();
	exit;
});

Route::make('logout',function(){
	auth::logout();
	exit;
});

Route::make('session-expired',function(){
	view::make('session-expired');
	exit;
});

Route::make('access-denied',function(){
	view::make('access-denied');
	exit;
});

Route::make('checkuser',function(){
	$GLOBALS['usercontroller']->checkuser();
	exit;
});

Route::make('settings',function(){
	auth::checkAuth();
	$GLOBALS['view']->make('settings');
	exit;
});

Route::make('changepassword',function(){
	auth::checkAuth();
	$GLOBALS['view']->make('settings/changepassword');
	exit;
});

Route::make('updatepassword',function(){
	auth::checkAuth();
	$GLOBALS['usercontroller']->changepass();
	exit;
});

Route::make('manage_users',function(){
	auth::checkAuth();
	auth::AdminMiddleware();
	$GLOBALS['usercontroller']->index();
	exit;
});

Route::make('displayusers',function(){
	auth::checkAuth();
	auth::AdminMiddleware();
	$GLOBALS['usercontroller']->displayusers();
	exit;
});

Route::make('searchuser',function(){
	auth::checkAuth();
	auth::AdminMiddleware();
	$GLOBALS['usercontroller']->searchuser();
	exit;
});

Route::make('createnewuser',function(){
	auth::checkAuth();
	auth::AdminMiddleware();
	$GLOBALS['usercontroller']->create();
	exit;
});

Route::make('updateuser',function(){
	auth::checkAuth();
	auth::AdminMiddleware();
	$GLOBALS['usercontroller']->update();
	exit;
});

Route::make('removeuser',function(){
	auth::checkAuth();
	auth::AdminMiddleware();
	$GLOBALS['usercontroller']->remove();
	exit;
});

Route::make('atmlist',function(){
	auth::checkAuth();
	auth::AdminMiddleware();
	$GLOBALS['atmcontroller']->index();
	exit;
});

Route::make('complaint_lists',function(){
	auth::checkAuth();
	auth::AdminMiddleware();
	$GLOBALS['complaintcontroller']->index();
	exit;
});

Route::make('displaycomplaintlist_all',function(){
	auth::checkAuth();
	auth::AdminMiddleware();
	$GLOBALS['complaintcontroller']->displaycomplaintlist_all();
	exit;
});

Route::make('searchcomplaint',function(){
	auth::checkAuth();
	auth::AdminMiddleware();
	$GLOBALS['complaintcontroller']->searchcomplaint();
	exit;	
});

Route::make('addcomplaintlist',function(){
	auth::checkAuth();
	auth::AdminMiddleware();
	$GLOBALS['complaintcontroller']->create();
	exit;
});

Route::make('updatecomplaintlist',function(){
	auth::checkAuth();
	auth::AdminMiddleware();
	$GLOBALS['complaintcontroller']->update();
	exit;
});

Route::make('removecomplaint',function(){
	auth::checkAuth();
	auth::AdminMiddleware();
	$GLOBALS['complaintcontroller']->remove();
	exit;
});


Route::make("change_pass",function(){
	auth::checkAuth();
	$GLOBALS['usercontroller']->change_pass();
	exit;
});

Route::make('cpanel',function(){
	auth::checkAuth();
	$GLOBALS['homecontroller']->index();
	exit;
});


Route::make('create',function(){
	auth::checkAuth();
	$GLOBALS['ticketcontroller']->index(new atmcontroller,new usercontroller,new complaintcontroller);
	exit;
});

Route::make('createticket',function(){
	auth::checkAuth();
	$GLOBALS['ticketcontroller']->createticket();
	exit;
});

Route::make('updateticketdetails',function(){
	auth::checkAuth();
	$GLOBALS['ticketcontroller']->updateticketdetails();
	exit;
});


Route::make('displayatmList',function(){
	auth::checkAuth();
	$GLOBALS['atmcontroller']->displayList();
	exit;
});

Route::make('displayatmlist_all',function(){
	auth::checkAuth();
	auth::AdminMiddleware();
	$GLOBALS['atmcontroller']->displayatmlist_all();
	exit;
});

Route::make('searchatm',function(){
	auth::checkAuth();
	auth::AdminMiddleware();
	$GLOBALS['atmcontroller']->searchatm();
	exit;
});


Route::make('newunit',function(){
	auth::checkAuth();
	auth::AdminMiddleware();
	$GLOBALS['view']->make('settings/newunit');
	exit;
});

Route::make('viewunit',function(){
	auth::checkAuth();
	auth::AdminMiddleware();
	$GLOBALS['atmcontroller']->viewunit();
	exit;
});

Route::make('create_newunit',function(){
	auth::checkAuth();
	auth::AdminMiddleware();
	$GLOBALS['atmcontroller']->create();
	exit;
});

Route::make('remove_site',function(){
	auth::checkAuth();
	auth::AdminMiddleware();
	$GLOBALS['atmcontroller']->remove();
	exit;
});

Route::make('update_unit',function(){
	auth::checkAuth();
	auth::AdminMiddleware();
	$GLOBALS['atmcontroller']->update();
	exit;
});

Route::make('searchsite',function(){
	auth::checkAuth();
	$GLOBALS['atmcontroller']->displaySearchSite();
	exit;
});

Route::make('flmactive',function(){
	auth::checkAuth();
	$GLOBALS['complaintcontroller']->activeindex('FLM');
	exit;
});

Route::make('slmactive',function(){
	auth::checkAuth();
	$GLOBALS['complaintcontroller']->activeindex('SLM');
	exit;
});

Route::make('getactiveList',function(){
	auth::checkAuth();
	$level = input::post('level');
	if($level=='SLM'){
		$GLOBALS['complaintcontroller']->getactiveList(new slmcontroller);
	}else{
		$GLOBALS['complaintcontroller']->getactiveList(new flmcontroller);
	}
	
	exit;
});

Route::make('ticketinfo',function(){
	auth::checkAuth();
	$GLOBALS['ticketcontroller']->ticketinfo(new atmcontroller);
	exit;
});

Route::make('updateticket',function(){
	auth::checkAuth();
	$GLOBALS['ticketcontroller']->updateticket(new atmcontroller,new usercontroller);
	exit;
});




Route::make('reports',function(){
	auth::checkAuth();
	$GLOBALS['reportcontroller']->index(new usercontroller);
	exit;
});

Route::make('filteredlist',function(){
	auth::checkAuth();
	$GLOBALS['reportcontroller']->filteredlist(new usercontroller);
	exit;
});


Route::make('printreport',function(){
	auth::checkAuth();
	$GLOBALS['reportcontroller']->printreport();
	exit;
});


Route::make('export',function(){
	auth::checkAuth();
	$GLOBALS['reportcontroller']->export(new atmcontroller);
	exit;
});


// Route::make('graphs',function(){
// 	auth::checkAuth();
// 	$GLOBALS['reportcontroller']->graphs();
// 	exit;
// });

Route::make('generategraph',function(){
	auth::checkAuth();
	$GLOBALS['reportcontroller']->generategraph();
	exit;
});

Route::make('exportrecord',function(){
	auth::checkAuth();
	$GLOBALS['reportcontroller']->exportrecord();
	exit;
});

Route::make('exportbank',function(){
	auth::checkAuth();
	$GLOBALS['reportcontroller']->exportbank();
	exit;
});

Route::make('downloadexcelreport',function(){
	auth::checkAuth();
	$GLOBALS['reportcontroller']->downloadexcelreport();
	exit;	
});

Route::make('getflmchart',function(){
	auth::checkAuth();
	$GLOBALS['homecontroller']->getflmchart();
	exit;
});


Route::make('dash.dashboard',function(){
	auth::checkAuth();
	$GLOBALS['homecontroller']->dashboardcalls();
	exit;
});

Route::make('dash.flmactive',function(){
	auth::checkAuth();
	$GLOBALS['homecontroller']->flmactive();
	exit;
});

Route::make('dash.slmactive',function(){
	auth::checkAuth();
	$GLOBALS['homecontroller']->slmactive();
	exit;
});





// if url is not in list, it will display this view
view::make('notexist');

