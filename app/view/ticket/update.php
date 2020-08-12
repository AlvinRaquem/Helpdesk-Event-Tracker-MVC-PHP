<?php include VIEW_PATH.'/includes/header.php';?>


<div id="mainBody">
	<span class="pageheader"><i class="fa fa-edit"></i> Ticket No: <?= $detail['IDno'];?></span><hr/>

		<div class="panel">
			<div class="panel-header panel-danger"><a href="ticketinfo?ticketno=<?=$detail['IDno'];?>">BACK</a></div>
			<div class="panel-body">
				<form method="POST" action="updateticketdetails">
					<div class="grid-container">
							<input type="hidden" name="txtIDno" value="<?=$detail['IDno'];?>">
							<label class="grid-col-2 control-label">Complaint</label>
			                <div class="grid-col-10" style="margin: 0;padding: 0;">
			                	<table border="0" width="100%">
			                    <tr><td width="100%">
			                      <div style="background: #ccc;">
			                			<input type="text" class="form-control" style="width: 99%;" name="complaint" value="<?= $detail['c_complaint'];?>">	
			           		 		</div>
			                    </td>
			                    
			                    </tr>
			                    </table>
			                   
			            	</div> 

			            			<label class="grid-col-2 control-label">Type</label>
				                <div class="grid-col-10" style="margin: 0;padding: 0;">
				                	<table width="100%" border="0">
				                    <tr><td width="100%;">
				                      <div style="background: #ccc;">
				                	<select class="form-control createitem" name="txtType" id ="txtType" style="width:19%;">
				                    		 <option><?= $detail['c_type'];?></option>
				          					 <option>ATM Hardware</option>
				                   	 		 <option>ATM Software</option>
				                    		 <option>Telecom</option>
				                     		 <option>Cashout</option>
				                     		 <option>Other</option>>
				        			</select>
				        			<select class="form-control createitem" name="txtChest" id="txtChest" style="width:19%;">
				                  			 <option><?= $detail['c_chest'];?></option>
				          					 <option>Upper Chest</option>
				                   	 		 <option>Lower Chest</option>
				        			</select>
				        			<select class="form-control createitem" name="txtLevel" id="txtLevel" style="width:19%;">
				          					 <option><?= $detail['c_level'];?></option>
				                          <option>FLM</option>
				                   	 		 <option>SLM</option>
				        			</select>
				        				<input type="text" class="form-control createitem" id="txtScreen" name="txtScreen" placeholder="ATM Screen Status" value="<?= $detail['c_Screen'];?>" style="width:20%;">
				        				 <input type="text" class="form-control createitem" id="txtErr" name="txtErr" placeholder="Error Code" value="<?= $detail['c_errCode'];?>" style="width:20%;">
				                    </div>
				                    </td>
				                    </tr>
				                    </table>
				            	</div>


				            	  <label class="grid-col-2 control-label">Received By</label>
				                <div class="grid-col-10" style="margin: 0;padding: 0;">
				                	<table width="100%" border="0">
				                    <tr><td width="100%">
				                  <div style="background: #ccc;">
				                	 <select class="form-control createitem" id="txtRcvBy" name="txtRcvBy" style="width:41%;padding: 10pt 0pt;" disabled>
				          					<option><?= $detail['c_rcvby'];?></option>
				                    <?php foreach($users as $user):?>
				                       <?php if($user['user_level'] == 'admin' || $user['user_level'] == 'user'):?>
				                      <option><?= $user['full_name'];?></option>
				                    <?php endif?>
				                    <?php endforeach?>
				        			</select>
				        			<input type="text" class="form-control createitem" id="datercvblock" disabled value="DATE" style="width:8%;font-weight: bold;padding: 10pt 8pt;">
				        			<input type="date" class="form-control createitem" name="dtRcv" id="dtRcv" style="width:20%;" value="<?= substr($detail['c_RcvDate'],0,10);?>">
				                    <input type="text" class="form-control createitem" id="timercvblock" disabled value="TIME" style="width:8%;font-weight: bold;padding: 10pt 8pt;">
				                    <input type="time" class="form-control createitem" name="timeRcv" id="timeRcv" style="width:20%;" value="<?= substr($detail['c_RcvDate'],11,14);?>">
				                    
				                  </div>
				                    </td>
				                      </tr>
				                    </table>
				            	</div>  

				            	       <label class="grid-col-2 control-label">Location</label>
					                <div class="grid-col-10" style="margin: 0;padding: 0;">
					                  <table width="100%" border="0">
					                    <tr><td width="100%">
					                    	<div style="background: #ccc;">
					                    		 <input type="text" class="form-control createitem" name="txtAtmID" id="txtAtmID" style="width: 19%;" readonly value="<?=$atmdetails['Terminal_ID'];?>" disabled>
					                    		    <input type="text" class="form-control createitem" id="brandblock" disabled value="BRAND" style="width:10%;color: blue;font-weight: bold;">
					                    		     <input type="text" class="form-control createitem" id="txtBrand" style="width:12%;" disabled value="<?=$atmdetails['Brand'];?>">
					                         <input type="text" class="form-control createitem" id="bankblock" disabled value="BANK" style="width:10%;color: blue;font-weight: bold;">
					                          <input type="text" class="form-control createitem" id="txtBank" style="width:16%;" value="<?=$atmdetails['Model'];?>" disabled>
					                         <input type="text" class="form-control createitem" disabled id="siteblock" value="SITE" style="width:10%;color: blue;font-weight: bold;">
					                          <input type="text" class="form-control createitem" id="txtSite" style="width:20%;" disabled value="<?=$atmdetails['Site'];?>">

					                    	</div>
					                    </td>
					                    </tr>
					                    </table>
					              </div>


					                   <label class="grid-col-2 control-label">Reported By</label>
					                <div class="grid-col-10" style="margin: 0;padding: 0;">
					                   <table width="100%" border="0">
					                    <tr><td width="100%">
					                       <div style="background: #ccc;">
					                       <input type="text" class="form-control createitem" name="txtReportedBy" id="txtReportedBy" style="width:49%;" value="<?= $detail['c_repby'];?>">
					                       <input type="text" class="form-control createitem" disabled id="reportedviablock" value="REPORTED VIA" style="width: 16%;">
					                       <select class="form-control createitem" name="txtreportvia" id="txtreportvia" style="width: 34%;">
					                          <option><?=$detail['c_RepVia'];?></option>
					                          <option>Call</option>
					                          <option>Text</option>
					                          <option>Email</option>
					                       </select>
					                     </div>
					                    </td>
					                  </tr>
					                </table>

                				</div>


				                  <label class="grid-col-2 control-label">Acknowledged by</label>
				                <div class="grid-col-10" style="margin: 0;padding: 0;">
				                  <table width="100%" border="0">
				                    <tr><td width="100%">
				                   <div style="background: #ccc;">
				                   <select class="form-control createitem" id="txtAcknow" name="txtAcknow" style="width:41%;padding: 10pt 0pt;">
				                    <option><?= $detail['Dispatchby'];?></option>
				                    <?php foreach($users as $user):?>
				                      <?php if($user['user_level'] == 'teller' || $user['user_level'] == 'technician'):?>
				                      <option><?= $user['full_name'];?></option>
				                    <?php endif?>
				                    <?php endforeach?>
				              </select>
				              <input type="text" class="form-control createitem" disabled id="dateacknowblock" value="DATE" style="width:8%;font-weight: bold;padding: 10pt 8pt;">
				              <input type="date" class="form-control createitem" name="dateacknow" id="dateacknow" style="width:20%;" value="<?= substr($detail['Dispatchdate'],0,10);?>">
				                    <input type="text" class="form-control createitem" id="timeacknowblock" disabled value="TIME" style="width:8%;font-weight: bold;padding: 10pt 8pt;">
				                    <input type="time" class="form-control createitem" name="timeacknow" id="timeacknow" style="width:20%;" value="<?= substr($detail['Dispatchdate'],11,14);?>">
				                  </div>
				                  </td>
				                  
				                      </tr>
				                    </table>
				              </div>  



				                            <label class="grid-col-2 control-label">Person Assigned</label>
						                <div class="grid-col-10" style="margin: 0;padding: 0;">
						                  <table width="100%" border="0">
						                    <tr><td width="100%">
						                   <div style="background: #ccc;">
						                   <select class="form-control createitem" id="txtPersonAssign" name="txtPersonAssign" style="width:41%;padding: 10pt 0pt;">
						                    <option><?= $detail['c_PersonAssign'];?></option>
						                    <?php foreach($users as $user):?>
						                      <?php if($user['user_level'] == 'teller' || $user['user_level'] == 'technician'):?>
						                      <option><?= $user['full_name'];?></option>
						                    <?php endif?>
						                    <?php endforeach?>
						              </select>
						              <input type="text" class="form-control createitem" disabled id="datepersonblock" value="DATE" style="width:8%;font-weight: bold;padding: 10pt 8pt;">
						              <input type="date" class="form-control createitem" name="dtPersonAssign" id="dtPersonAssign" style="width:20%;" value="<?= substr($detail['c_AssignDate'],0,10);?>">
						                    <input type="text" class="form-control createitem" id="timepersonblock" disabled value="TIME" style="width:8%;font-weight: bold;padding: 10pt 8pt;">
						                    <input type="time" class="form-control createitem" name="timePersonAssign" id="timePersonAssign" style="width:20%;" value="<?= substr($detail['c_AssignDate'],11,14);?>">
						                  </div>
						                  </td>
						                  
						                      </tr>
						                    </table>
						              </div>  



					                <label class="grid-col-2 control-label">Status</label>
					                <div class="grid-col-10" style="margin: 0;padding: 0;">
					                   <table width="100%" border="0">
					                    <tr><td width="100%">
					                       <div style="background: #ccc;">
					                       <select class="form-control createitem" name="txtStatus" id="txtStatus" style="width: 99%;">
					                       	<option><?= $detail['c_Status'];?></option>
					                        <option>Open</option>
					                        <option>In-Progress</option>
					                        <option>On-Hold</option>
					                        <option>Closed</option>
					                       </select>
					                     </div>
					                    </td>
					                  </tr>
					                </table>

					                </div>


				                <label class="grid-col-2 control-label">Target Date</label>
				                <div class="grid-col-10" style="margin: 0;padding: 0;">
				                   <table width="100%" border="0">
				                    <tr><td width="100%">
				                       <div style="background: #ccc;">
				                       <input type="date" class="form-control createitem" name="txtTargetDate" id="txtTargetDate" style="width:99%;" value="<?= $detail['c_Target'];?>">
				                     </div>
				                    </td>
				                  </tr>
				                </table>

				                </div>



				                <label class="grid-col-2 control-label">Diagnosis</label>
				                <div class="grid-col-10" style="margin: 0;padding: 0;">
				                   <table width="100%" border="0">
				                    <tr><td width="100%">
				                       <div style="background: #ccc;">
				                       <input type="text" class="form-control createitem" name="txtDiagnosis" id="txtDiagnosis" style="width:99%;" value="<?= $detail['c_diagnosis'];?>">
				                     </div>
				                    </td>
				                  </tr>
				                </table>

				                </div>



				                <label class="grid-col-2 control-label">Action Taken</label>
				                <div class="grid-col-10" style="margin: 0;padding: 0;">
				                   <table width="100%" border="0">
				                    <tr><td width="100%">
				                       <div style="background: #ccc;">
				                       <textarea value="<?= $detail['c_action'];?>" class="form-control createitem" name="txtactionTaken" id="txtactionTaken" style="width:99%;"></textarea> 
				                     </div>
				                    </td>
				                  </tr>
				                </table>

				                </div>


				        

	                            <label class="grid-col-2 control-label">Response</label>
			                <div class="grid-col-10" style="margin: 0;padding: 0;">
			                  <table width="100%" border="0">
			                    <tr><td width="100%">
			                   <div style="background: #ccc;">
			                
			              <input type="text" class="form-control createitem" disabled id="dateresponseblock" value="DATE" style="width:15%;font-weight: bold;padding: 10pt 8pt;">
			              <input type="date" class="form-control createitem" name="dtResponse" id="dtResponse" style="width:33%;" value="<?= substr($detail['c_response'],0,10);?>">
			                    <input type="text" class="form-control createitem" id="timeresponseblock" disabled value="TIME" style="width:15%;font-weight: bold;padding: 10pt 8pt;">
			                    <input type="time" class="form-control createitem" name="timeResponse" id="timeResponse" style="width:35%;" value="<?= substr($detail['c_response'],11,14);?>">
			                  </div>
			                  </td>
			                  
			                      </tr>
			                    </table>
			              </div>  


			                 <label class="grid-col-2 control-label">Resolution</label>
			                <div class="grid-col-10" style="margin: 0;padding: 0;">
			                  <table width="100%" border="0">
			                    <tr><td width="100%">
			                   <div style="background: #ccc;">
			                
			              <input type="text" class="form-control createitem" disabled id="dateresolutionblock" value="DATE" style="width:15%;font-weight: bold;padding: 10pt 8pt;">
			              <input type="date" class="form-control createitem" name="dtResolution" id="dtResolution" style="width:33%;" value="<?= substr($detail['c_resolution'],0,10);?>">
			                    <input type="text" class="form-control createitem" id="timeresolutionblock" disabled value="TIME" style="width:15%;font-weight: bold;padding: 10pt 8pt;">
			                    <input type="time" class="form-control createitem" name="timeResolution" id="timeResolution" style="width:35%;" value="<?= substr($detail['c_resolution'],11,14);?>">
			                  </div>
			                  </td>
			                  
			                      </tr>
			                    </table>
			              </div>  

			              <button class="btn btn-primary"> Update</button>
					</div>
				</form>

			</div>
		</div>

<!-- 
		<div class="panel">
			<div class="panel-header panel-default"></div>
			<div class="panel-body">


			</div>

		</div> -->


</div>


</section>
<?php include VIEW_PATH.'/includes/footer.php';?>
<script>
$('#pendingnav').addClass("activenav");

var createitem = document.getElementsByClassName("createitem");


function match(x){
if(x.matches){
for(let y = 0 ; y < createitem.length ; y++){
createitem[y].style.width = "100%";
}
}else{

document.getElementById('txtType').style.width = "19%";
document.getElementById('txtChest').style.width = "19%";
document.getElementById('txtLevel').style.width = "19%";
document.getElementById('txtScreen').style.width = "20%";
document.getElementById('txtErr').style.width = "20%";
document.getElementById('txtRcvBy').style.width = "41%";
document.getElementById('datercvblock').style.width = "8%";
document.getElementById('dtRcv').style.width = "20%";
document.getElementById('timercvblock').style.width = "8%";
document.getElementById('timeRcv').style.width = "20%";
document.getElementById('txtAtmID').style.width = "19%";
document.getElementById('brandblock').style.width = "10%";
document.getElementById('txtBrand').style.width = "12%";
document.getElementById('bankblock').style.width = "10%";
document.getElementById('txtBank').style.width = "16%";
document.getElementById('siteblock').style.width = "10%";
document.getElementById('txtSite').style.width = "20%";
document.getElementById('txtReportedBy').style.width = "49%";
document.getElementById('reportedviablock').style.width = "16%";
document.getElementById('txtreportvia').style.width = "34%";
document.getElementById('txtPersonAssign').style.width = "41%";
document.getElementById('datepersonblock').style.width = "8%";
document.getElementById('dtPersonAssign').style.width = "20%";
document.getElementById('timepersonblock').style.width = "8%";
document.getElementById('timePersonAssign').style.width = "20%";
document.getElementById('txtAcknow').style.width = "41%";
document.getElementById('dateacknowblock').style.width = "8%";
document.getElementById('dateacknow').style.width = "20%";
document.getElementById('timeacknowblock').style.width = "8%";
document.getElementById('timeacknow').style.width = "20%";
document.getElementById('dateresponseblock').style.width = "15%";
document.getElementById('dtResponse').style.width = "33%";
document.getElementById('timeresponseblock').style.width = "15%";
document.getElementById('timeResponse').style.width = "35%";
document.getElementById('dateresolutionblock').style.width = "15%";
document.getElementById('dtResolution').style.width = "33%";
document.getElementById('timeresolutionblock').style.width = "15%";
document.getElementById('timeResolution').style.width = "35%";
}


var mediax = window.matchMedia("(max-width: 800px)");
match(mediax);
mediax.addListener(match);

</script>
</body>
</html>
