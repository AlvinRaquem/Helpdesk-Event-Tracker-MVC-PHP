<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<style>
table, td, th {
	text-align:center;
    border: 1px solid #BBB ;
	border-spacing: 0px;
    border-collapse: separate;
	font:"Lucida Console", Monaco, monospace;
	font-size:14px;
}

th {
    background-color: #BBB;
    color: white;
}

@media print{
	.noprint{
		display:none !important;	
	}
	a{
		text-decoration:none !important;
		color:black;	
	}
	
	table,td,th{
		font-size:8px;
	}
}
@page 
{
	size: auto;   /* auto is the initial value */
	margin: 0mm;  /* this affects the margin in the printer settings */
	size: landscape;
}

td:nth-child(n+6):nth-child(-n+7),td:nth-child(n+9){
	text-align:left !important;	
}


</style>



<body>
Helpdesk Event Report<br />
<a href="javascript:window.print()" class = "noprint">print this page</a>
<br />
<br />
<?php

	if(!isset($_SESSION['printreport'])) {
   		}
    $contents = $_SESSION['printreport'];
	echo $contents;

date_default_timezone_set('Asia/Taipei');
	$modDate=date('Y-m-d H:i', time());
?>
<br />
printed by :<?php echo $_SESSION['SESS_USER_FULL_NAME']; ?> <br />

Date : <?php echo $modDate; ?>

</body>
</html>