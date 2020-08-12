<?php include VIEW_PATH.'/includes/header.php';?>

<style type="text/css">
	
	ul li span {
		font-weight: bold;
		font-size: 14pt;
		color: dimgray;
		cursor: pointer;
	}

	input, select {
		margin-bottom: 10px;
	}

	ul li {
		width: 100%;
		padding: 5px;
	}

</style>

<div id="mainBody">
	<span class="pageheader"><i class="fa fa-chart-bar"></i> Graphs</span><hr/>


	<div class="panel">
		<div class="panel-header panel-danger">&nbsp;</div>
		<div class="panel-body">
		<ul>
		<li><span class="openfilterModal" data-option="1">NO. OF CALLS</span></li>
		<li><span class="openfilterModal" data-option="2">TOP 10 COMPLAINTS</span></li>
		<li><span class="openfilterModal" data-option="3">SLM TASK DONE BY TECHNICIAN/TELLER</span></li>
		</ul>
		</div>
	</div>

</div>

<div class="modal" id="filterModal">
	<div class="modal-content modal-25">
		<span class="close-modal">&times;</span>
		<div class="modal-body">
		<input type="hidden" id="optionID">
		<select class="form-control" id="optiondes">
			<option>Yearly</option>
			<option>Monthly</option>
		</select>
		<select class="form-control" id="month" style="display: none;">
			<option>January</option>
			<option>February</option>
			<option>March</option>
			<option>April</option>
			<option>May</option>
			<option>June</option>
			<option>July</option>
			<option>August</option>
			<option>September</option>
			<option>October</option>
			<option>November</option>
			<option>December</option>
		</select>
		<input type="number" id="year" class="form-control" id="year" value="<?= date('Y',time());?>">
		<button class="btn btn-primary" type="button" id="Proceed"> Proceed</button>
		</div>
	</div>
</div>


</section>
<?php include VIEW_PATH.'/includes/footer.php';?>

<script type="text/javascript">
  $('#reportnav').addClass('activenav');

  $(document).on('change','#optiondes',function(){
  	let optiondes = $('#optiondes').val();

  	if(optiondes == "Yearly"){
  		$('#month').css("display","none");
  	}else{
  		$('#month').css("display","block");
  	}
  });

  $(document).on('click','#Proceed',function(){
  	let optionID = $('#optionID').val();
  	let optiondes = $('#optiondes').val();
  	let month = $('#month').val();
  	let year = $('#year').val();

  	$.ajax({
  		url: 'generategraph',
  		type: 'POST',
  		data: '&optionID='+optionID+'&optiondes='+optiondes+'&month='+month+'&year='+year,
  		success:function(x){
  			
  		}
  	});
  });

  $(document).on('click','.openfilterModal',function(){
  	let option = $(this).data('option');
  	$('#optionID').val(option);
  	$('#filterModal').css("display","block");
  });

  $(document).on('click','.close-modal',function(){
$('.modal').css("display","none");
});
</script>



</body>
</html>
