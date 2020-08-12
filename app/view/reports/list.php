<?php include VIEW_PATH.'/includes/header.php';?>
<style>

@media (max-width: 900px){
	.responsivediv {
		overflow-x: auto;
	}
}


input,select {
	outline: none;
	border:0.5px solid silver;
	border-radius: 5px;
}

a {
	text-decoration: none;
}

</style>

<div id="mainBody">
	<a href="reports"><span class="pageheader"><i class="fa fa-edit"></i> List</span></a><hr/>

	<div class="panel">
		<div class="panel-header panel-default"><button type="button" id="showfilterModal" class="btn btn-primary"><span class="fa fa-filter"></span> Filter</button>
			<?php 
					echo "<input type=\"button\" value=\"Print Report\" class=\"btn btn-default pull-right\" name=\"B4\"";
					echo  "onClick=\"view=window.open('";
					echo "printreport";
					echo "','NewWin','toolbar=no,status=yes,"; 
					echo "scrollbars = yes, resizable = yes, scroll = yes,width=800,height=500'); \">"; 
			?>
		</div>
		<div class="panel-body">
			<div class="responsivediv">
			<table class="table table-nobordered table-striped">
				 <thead>
				    <tr style="background: mistyrose;color: dimgray;">
				      <th width="8">Ticket #</th>
				      <th width="63">TID <br/> BANK/ SITE</th>
				      <th width="91">REPORTED BY</th>
				      <th width="87">REQUEST</th>
				      <th width="82">RECEIVED</th>
				      <th width="30">SLA</th>
				      <th width="76">RESPONSED / FINISHED</th>
				      <th width="146">ACTION TAKEN</th>
				      <th width="60">STATUS / TELLER</th>
				    </tr>
				  </thead>

				  <tbody>

				  	<?= $reportdis;?>

				  </tbody>

			</table>
		</div>
		</div>
	</div>
</div>

<div class="modal" id="filterModal">
	<div class="modal-content">
	<span class="close-modal">&times;</span>
	<div class="modal-body">
		<form method="POST" action="filteredlist">
		<div class="grid-container">

			<div class="grid-col-6">
				<label style="color: dimgray"><strong>DATE RANGE:</strong></label>
				<input type="date" name="datefrom" class="form-control" style="margin-bottom: 25px;" value="<?= date('Y-m-d',time());?>">

				<select class="form-control" name="type" style="margin-bottom: 25px;">
					<option>--Type--</option>
					<option>ATM Hardware</option>
	               	<option>ATM Software</option>
	                <option>Telecom</option>
	                <option>Cashout</option>
	                <option>Other</option>>
				</select>

				<select class="form-control" name="level" style="margin-bottom: 25px;">
					<option>--Level--</option>
					<option>FLM</option>
					<option>SLM</option>
				</select>

				<select class="form-control" name="status" style="margin-bottom: 25px;">
					<option>--Status--</option>
				    <option>Open</option>
                    <option>In-Progress</option>
                    <option>On-Hold</option>
                    <option>Closed</option>
				</select>

				<select class="form-control" name="otherdetails" style="margin-bottom: 25px;">
					<option>--Other Details--</option>
					<option>Ticket No</option>
					<option>ATM ID</option>
					<option>ATM Brand</option>
					<option>ATM Bank</option>
				</select>

				<select class="form-control" name="sort" style="margin-bottom: 25px;">
					<option value="ASC">Ascending</option>
					<option value="DESC">Descending</option>
				</select>

				
			</div>

			<div class="grid-col-6">
				<label>&nbsp;</label>
				<input type="date" class="form-control" name="dateto" style="margin-bottom: 25px;" value="<?= date('Y-m-d',time());?>">

				<select class="form-control" name="chest" style="margin-bottom: 25px;">
					<option>--Chest--</option>
					<option>LOWER</option>
					<option>UPPER</option>
				</select>

				<select class="form-control" name="personassign" style="margin-bottom: 25px;">
					<option>--Person Assigned--</option>
					<?php foreach($technicians as $tech):?>
						<?php if($tech['user_level'] == 'technician' || $tech['user_level'] == 'teller'):?>
						<option><?= $tech['full_name'];?></option>
						<?php endif?>
					<?php endforeach?>
				</select>

				<select class="form-control" name="errorcode" style="margin-bottom: 25px;">
					<option>--Error Code--</option>
					<?php foreach($errorcodes as $errorcode):?>
						<option><?= $errorcode['errCode'];?></option>
					<?php endforeach?>
				</select>

				<input type="text" class="form-control" name="otherdetails_query" placeholder="Type Here for Other Details" style="margin-bottom: 25px;">
			</div>
			<button type="submit" class="btn btn-primary">Filter</button>
		
		</div>
		</form>
	</div>

	</div>
</div>


</section>
<?php include VIEW_PATH.'/includes/footer.php';?>
<script type="text/javascript">
  $('#reportnav').addClass('activenav');

  $(document).on('click','.close-modal',function(){
	$('.modal').css("display","none");
	})

  $(document).on('click','#showfilterModal',function(){
  	$('#filterModal').css('display','block');
  });
</script>
</body>
</html>
