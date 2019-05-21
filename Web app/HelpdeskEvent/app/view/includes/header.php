<?php 
date_default_timezone_set('Asia/Manila');
use helper\session; 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ticketing System">
    <meta name="author" content="asraquem">
    <meta name="keyword" content="Dashboard,Tracker,Management">
  <title></title>
  <link rel="stylesheet" type="text/css" href="public/customcss/main.css">
  <link rel="stylesheet" type="text/css" href="public/customcss/fontawesome/css/all.css">


</head>
<body>


<header>
  <div>


  </div>
</header>

<section>

  
  <aside>
    <span id="toggle-button">&#9776;</span>

      <div id="companylogo">
        <!-- <a href="profile.html"><img src="../user.png"></a> -->
      </div>


      <div id="accountinfo">
        <div class="grid-container">
          <div class="grid-col-5">
            <a href="profile.html"><img src="public/user.png" id="imageinfo"></a>
          </div>
          <div class="grid-col-7" style="margin-top: 20px;" id="nameinfo">

            <span style="font-weight: bold;"><u>Welcome</u></span><br/>
            <span><u><?= strtoupper(session::get('SESS_USER_FULL_NAME'));?></u></span>
          </div>
        </div>

      </div>

    <div id="sidenav">
    <ul>
      <li id="homenav"><a href="cpanel"><i class="fa fa-home"></i> <i class="navtext">Home</i></a></li>
      <li id="createnav"><a href="create"><i class="fa fa-plus"></i> <i class="navtext">Create</i></a></li>
      <li id="pendingnav" class="dropdown"><a href="javascript:void(0)" class="dropbtn"><i class="fa fa-cubes"></i> <i class="navtext">Active Lists</i></a>
          <div class="dropdown-content">
              <a href="flmactive"><span class="fa fa-dot-circle"></span> FLM</a>
              <a href="slmactive"><span class="fa fa-dot-circle"></span> SLM</a>
          </div>
      </li>
      <li id="reportnav" class="dropdown"><a href="javascript:void(0)" class="dropbtn"><i class="fa fa-edit"></i> <i class="navtext"> Reports</i></a>
        <div class="dropdown-content">
            <a href="reports"><span class="fa fa-dot-circle"></span> List</a>
            <a href="export"><span class="fa fa-dot-circle"></span> Export</a>
            <!-- <a href="graphs"><span class="fa fa-dot-circle"></span> Graphs</a> -->
        </div>
       </li>
      <li id="settingnav"><a href="settings"><i class="fa fa-cog"></i> <i class="navtext">Settings</i></a></li>
     <!--  <li style="background:#21262D;">&nbsp;</li> -->
       <li><a href="logout"><i class="fa fa-power-off"></i> <i class="navtext">Sign Out</i></a></li>
    </ul>
  </div>
  </aside>