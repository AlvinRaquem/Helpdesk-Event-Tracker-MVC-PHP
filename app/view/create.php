<?php include VIEW_PATH.'/includes/header.php';?>

<style>


@media (max-width: 800px) and (min-width: 451px){
  .modal-50 {
    width: 80%;
  }

  #refreshtext {
    display: none;
  }

  table#atmlist td {
    font-size: 8pt;
  }

  table#atmlist td button {
    padding: 2pt;
    font-size: 6pt;
  }

}
</style>


<div id="mainBody">
		<span class="pageheader"><i class="fa fa-plus"></i> Create Ticket</span><hr/>

		<div class="panel col-12">
			<div class="panel-header panel-danger">&nbsp;</div>
			<div class="panel-body">
				<form method="POST" action="createticket">
	
			<div class="grid-container">

				<label class="grid-col-2 control-label">Complaint</label>
                <div class="grid-col-10" style="margin: 0;padding: 0;">
                	<table border="0" width="100%">
                    <tr><td width="100%">
                      <div style="background: #ccc;">
                	<select class="form-control createitem" name="txtComplaint" id="txtComplaint" style="width:40%" required>
                        <option>---</option>
                        <?php foreach($complaints as $complaint) :?>
                          <option><?= $complaint['Description'];?></option>
                        <?php endforeach?>     
        			</select>
        			<input type="text" id="othersblock" class="form-control createitem" style="width:12%;font-weight: bold;" disabled value="OTHERS">
        			<input type="text" class="form-control createitem" name="txtcomplaint_others" id="txtcomplaint_others" style="width:46%;" placeholder="PLEASE FILL UP IF OTHERS">
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
                	<select class="form-control createitem" name="txtType" id ="txtType" style="width:19%;" required>
                    		 <option></option>
          					     <option>ATM Hardware</option>
                   	 		 <option>ATM Software</option>
                    		 <option>Telecom</option>
                     		 <option>Cashout</option>
                     		 <option>Other</option>>
        			</select>
        			<select class="form-control createitem" name="txtChest" id="txtChest" style="width:19%;" required>
                  			 <option></option>
          					     <option>Upper Chest</option>
                   	 		 <option>Lower Chest</option>
        			</select>
        			<select class="form-control createitem" name="txtLevel" id="txtLevel" style="width:19%;" required>
          					 <option></option>
                          <option>FLM</option>
                   	 		 <option>SLM</option>
        			</select>
        				<input type="text" class="form-control createitem" id="txtScreen" name="txtScreen" placeholder="ATM Screen Status" value="" style="width:20%;">
        				 <input type="text" class="form-control createitem" id="txtErr" name="txtErr" placeholder="Error Code" value="" style="width:20%;">
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
                	 <select class="form-control createitem" id="txtRcvBy" name="txtRcvBy" style="width:41%;padding: 10pt 0pt;" required>
          					<option></option>
                    <?php foreach($users as $user):?>
                      
                      <option><?= $user['full_name'];?></option>
                   
                    <?php endforeach?>
        			</select>
        			<input type="text" class="form-control createitem" id="datercvblock" disabled value="DATE" style="width:8%;font-weight: bold;padding: 10pt 8pt;">
        			<input type="date" class="form-control createitem" name="dtRcv" id="dtRcv" style="width:20%;" required>
                    <input type="text" class="form-control createitem" id="timercvblock" disabled value="TIME" style="width:8%;font-weight: bold;padding: 10pt 8pt;">
                    <input type="time" class="form-control createitem" name="timeRcv" id="timeRcv" style="width:20%;" required>
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
                      <input type="text" class="form-control createitem" name="txtAtmID" id="txtAtmID" style="width: 19%;" placeholder="ATM ID" required>
                        <button class="createitem" id="openListModal" type="button" style="width: 10%;padding: 9pt 0pt;cursor: pointer;">Select</button>
                         <input type="text" class="form-control createitem" id="brandblock" disabled value="BRAND" style="width:10%;color: blue;font-weight: bold;" required>
                         <input type="text" class="form-control createitem" id="txtBrand" style="width:12%;" required>
                         <input type="text" class="form-control createitem" id="bankblock" disabled value="BANK" style="width:10%;color: blue;font-weight: bold;">
                          <input type="text" class="form-control createitem" id="txtBank" style="width:12%;" required>
                         <input type="text" class="form-control createitem" disabled id="siteblock" value="SITE" style="width:10%;color: blue;font-weight: bold;">
                          <input type="text" class="form-control createitem" id="txtSite" style="width:13%;" required>
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
                       <input type="text" class="form-control createitem" name="txtReportedBy" id="txtReportedBy" style="width:49%;" placeholder="( Type Here )" required>
                       <input type="text" class="form-control createitem" disabled id="reportedviablock" value="REPORTED VIA" style="width: 16%;">
                       <select class="form-control createitem" name="txtreportvia" id="txtreportvia" style="width: 34%;">
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
                    <option></option>
                    <?php foreach($techs as $tech):?>
          
                      <option><?= $tech['fullname'];?></option>
                  
                    <?php endforeach?>
              </select>
              <input type="text" class="form-control createitem" disabled id="dateacknowblock" value="DATE" style="width:8%;font-weight: bold;padding: 10pt 8pt;">
              <input type="date" class="form-control createitem" name="dateacknow" id="dateacknow" style="width:20%;">
                    <input type="text" class="form-control createitem" id="timeacknowblock" disabled value="TIME" style="width:8%;font-weight: bold;padding: 10pt 8pt;">
                    <input type="time" class="form-control createitem" name="timeacknow" id="timeacknow" style="width:20%;">
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
                    <option></option>
                    <?php foreach($techs as $tech):?>
                      
                      <option><?= $tech['fullname'];?></option>
             
                    <?php endforeach?>
              </select>
              <input type="text" class="form-control createitem" disabled id="datepersonblock" value="DATE" style="width:8%;font-weight: bold;padding: 10pt 8pt;">
              <input type="date" class="form-control createitem" name="dtPersonAssign" id="dtPersonAssign" style="width:20%;">
                    <input type="text" class="form-control createitem" id="timepersonblock" disabled value="TIME" style="width:8%;font-weight: bold;padding: 10pt 8pt;">
                    <input type="time" class="form-control createitem" name="timePersonAssign" id="timePersonAssign" style="width:20%;">
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
                       <input type="date" class="form-control createitem" name="txtTargetDate" id="txtTargetDate" style="width:99%;" required>
                     </div>
                    </td>
                  </tr>
                </table>

                </div>


                <button type="submit" class="btn btn-primary">CREATE</button> 


			</div>

		</form>
		</div>


</div>



<div class="modal" id="ListModal">
  <div class="modal-content modal-80">
    <span class="close-modal">&times;</span>
    <div class="modal-body">

        <input type="text" class="form-control" id="searchval" placeholder="Search Site" style="margin-bottom: 10px;border: 0.5px solid lightgray;border-radius: 10px;outline: none;width: 50%;">
   
        <table class="table table-nobordered table-striped" id="atmlist">
          <thead>
            <tr style="background: mistyrose;color: dimgray;">
              <th>Terminal ID</th>
              <th>Bank</th>
              <th>Site</th> 
              <th>Brand</th>
              <th></th>

            </tr>
          </thead>

          <tbody id="atmlisttable">
         
          </tbody>

        </table>

    </div>
  </div>
</div>

</section>
<?php include VIEW_PATH.'/includes/footer.php';?>
<script src="./app/view/js/create.js"></script>
<script type="text/javascript">
  
  $('#createnav').addClass('activenav');

</script>
</body>
</html>
