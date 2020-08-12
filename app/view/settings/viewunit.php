<?php include VIEW_PATH.'/includes/header.php';?>


<div id="mainBody">
	<span class="pageheader"><i class="fa fa-edit"></i> Unit Informations</span><hr/>

	<div class="panel">
		<div class="panel-header panel-danger"><a href="atmlist">BACK</a></div>
			<div class="panel-body">
				<form action="update_unit" method="POST">
				<div class="grid-container">
				
				<label class="grid-col-2 control-label">Terminal ID</label>
                <div class="grid-col-10" style="margin: 0;padding: 0;">
                	 <table width="100%" border="0">
                	 	 <tr>
                    <td width="100%">
	                    <div style="background: #ccc;">
                	<input type="text" value="<?=$details['Terminal_ID'];?>" name="terminalid" class="form-control createitem" id="terminalid" required>
			                </div>
			            </td>
			        </tr>
			    </table>
            	</div> 

            	<label class="grid-col-2 control-label">Brand</label>
                <div class="grid-col-10" style="margin: 0;padding: 0;">
                	 <table width="100%" border="0">
                    <tr>
                    <td width="100%">
	                    <div style="background: #ccc;">
	                   		<input type="text"  value="<?=$details['Brand'];?>"  name="brand" id="brand" class="form-control createitem" style="width: 45%;" required>
	                   		<input type="text" id="bankblock" disabled class="form-control createitem" placeholder="BANK" style="width: 8%;">
	                   		<input type="text"  value="<?=$details['Model'];?>"  name="bank" id="bank" class="form-control createitem" style="width: 46%;">
	                   	</div>
                    </td>
                    </tr>
                    </table>

                </div>


                <label class="grid-col-2 control-label">Site</label>
                <div class="grid-col-10" style="margin: 0;padding: 0;">
                	 <table width="100%" border="0">
                    <tr>
                    <td width="100%">
	                    <div style="background: #ccc;">
	                    	<input type="text"  value="<?=$details['Site'];?>"  name="site" id="site" class="form-control createitem" style="width: 30%">
	                   		<input type="text" id="addressblock" disabled class="form-control createitem" placeholder="Address" style="width: 9%;">
	                    	<input type="text" value="<?=$details['Address'];?>"  name="address" id="address" class="form-control createitem" style="width: 31%;" required>
	                   		<input type="text" id="cityblock" disabled class="form-control createitem" placeholder="CITY" style="width: 8%;">
	                   		<input type="text" value="<?=$details['City'];?>"  name="city" id="city" class="form-control createitem" style="width: 20%;" required>

	                   	</div>
                    </td>
                    </tr>
                    </table>

                </div>


                <label class="grid-col-2 control-label">Location</label>
                <div class="grid-col-10" style="margin: 0;padding: 0;">
                	<table width="100%" border="0">
                    <tr><td width="100%;">
                      <div style="background: #ccc;">
                	<select class="form-control createitem" name="location" id ="location" style="width:25%;" required>
                    		<option><?= $details['Location'];?></option>
  							<option>Offsite</option>
                            <option>Onsite</option>
        			</select>
        			<select class="form-control createitem" name="location2" id="location2" style="width:25%;" required>
                  			<option><?= $details['LocSLA'];?></option>
          					<option>Metro Manila</option>
                        	<option>Province - South</option>
                            <option>Province - North</option>
        			</select>
        			<input type="text" class="form-control createitem" id="slablock" placeholder="SLA REQ" style="width: 11%;">
        			<select class="form-control createitem" name="sla" id="sla" style="width:37%;" required>
          					<option><?= $details['SLA'];?></option>
                         	<option>1</option>
                         	<option>2</option>
                         	<option>3</option>
                         	<option>4</option>
                         	<option>5</option>
        			</select>
        			
                    </div>
                    </td>
                    </tr>
                    </table>
            	</div>  


            	     <label class="grid-col-2 control-label">Site Operation</label>
                <div class="grid-col-10" style="margin: 0;padding: 0;">
                	 <table width="100%" border="0">
                    <tr>
                    <td width="100%">
	                    <div style="background: #ccc;">
	                   		<input type="text" id="openblock" disabled class="form-control createitem" placeholder="Opening"  style="width:10%;font-weight: bold;padding: 10pt 8pt;">
	                    	<input type="time" value="<?=$details['Opening'];?>"  name="opening" id="opening" class="form-control createitem" style="width: 39%;">
	                   		<input type="text" id="closeblock" disabled class="form-control createitem" placeholder="Closing"  style="width:10%;font-weight: bold;padding: 10pt 8pt;">
	                   		<input type="time" value="<?=$details['Closing'];?>"  name="closing" id="closing" class="form-control createitem" style="width: 39%;">

	                   	</div>
                    </td>
                    </tr>
                    </table>

                </div>


                  <label class="grid-col-2 control-label">Contact Person</label>
                <div class="grid-col-10" style="margin: 0;padding: 0;">
                	 <table width="100%" border="0">
                    <tr>
                    <td width="100%">
	                    <div style="background: #ccc;">
	                   		
	                    	<input type="text" value="<?=$details['Contact_Person'];?>"  name="contactperson" id="contactperson" class="form-control createitem" style="width: 49%;">
	                   		<input type="text" id="contactnumberblock" disabled class="form-control createitem" placeholder="NUMBER" style="width: 10%;">
	                   		<input type="text" value="<?=$details['Contact_No'];?>"  name="contactnumber" id="contactnumber" class="form-control createitem" style="width: 40%;">

	                   	</div>
                    </td>
                    </tr>
                    </table>

                </div>


				</div>
                <div class="grid-container">
                    <div class="grid-col-6">
				<button type="submit" class="btn btn-primary"><span class="fa fa-edit"></span> Update</button>
                    </div>
                    <div class="grid-col-6">
                        <input type="hidden" id="terminalID" value="<?= $details['Terminal_ID'];?>">
                <button type="button" class="btn btn-danger pull-right" id="removesite"><span class="fa fa-trash"></span> Remove</button>
                    </div>
                 </div>
				</form>

				
			</div>
	</div>

</div>


</section>
<?php include VIEW_PATH.'/includes/footer.php';?>
<script type="text/javascript">
  $('#settingnav').addClass('activenav');

  $(document).on('click','#removesite',function(){
  	let terminalid = $('#terminalID').val();

    if(confirm("Are you sure you want to remove this?")){
        $.ajax({
            url: 'remove_site',
            type: 'POST',
            data: '&idno='+terminalid,
            success:function(x){
                window.location.href = "atmlist";
            }
        })
    }

  });

var createitem = document.getElementsByClassName("createitem");

function match(x){
	if(x.matches){
	for(let y = 0 ; y < createitem.length ; y++){
	createitem[y].style.width = "100%";
	}
	}else{
		document.getElementById('brand').style.width = "45%";
		document.getElementById('bankblock').style.width = "8%";
		document.getElementById('bank').style.width = "46%";


		document.getElementById('site').style.width = "30%";
		document.getElementById('addressblock').style.width = "9%";
		document.getElementById('address').style.width = "31%";
		document.getElementById('cityblock').style.width = "8%";
		document.getElementById('city').style.width = "20%";


		document.getElementById('location').style.width = "25%";
		document.getElementById('location2').style.width = "25%";
		document.getElementById('slablock').style.width = "11%";
		document.getElementById('sla').style.width = "37%";
		document.getElementById('openblock').style.width = "10%";
		document.getElementById('opening').style.width = "39%";
		document.getElementById('closeblock').style.width = "10%";
		document.getElementById('closing').style.width = "39%";
		document.getElementById('contactperson').style.width = "49%";
		document.getElementById('contactnumberblock').style.width = "10%";
		document.getElementById('contactnumber').style.width = "40%";

	}
}

var mediax = window.matchMedia("(max-width: 800px)");
match(mediax);
mediax.addListener(match);

</script>
</body>
</html>
