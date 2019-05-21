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
		padding: 10px;
	}

	.downloadfile {
		font-weight: normal;
		font-size: 8pt;
		padding: 5pt;
		background: green;
		color: white;
		margin-left: 100px;
		border-radius: 10px;
		display: none;
	}

	label {
		font-weight: bold;
		color: dimgray;
	}

</style>

<div id="mainBody">
	<span class="pageheader"><i class="fa fa-file-excel"></i> Export Report(s)</span><hr/>

	<div class="panel">
		<div class="panel-header panel-danger">&nbsp;</div>
		<div class="panel-body">
			<ul>
		<li><span class="openfilterModal" data-option="1">RECORDS LIST</span> <a href="downloadexcelreport"><span id="download_record" class="downloadfile"> Download Excel</span></a></li>
		<li><span class="openfilterModal" data-option="2">BANK REPORT</span> <a href="downloadexcelreport"><span id="download_bank" class="downloadfile" style="margin-left: 98px;"> Download Excel</span></a></li>
		</ul>
		</div>
	</div>

</div>

<div class="modal" id="recordModal">
	<div class="modal-content modal-25">
		<span class="close-modal">&times;</span>
		<div class="modal-body">
			<label>DATE FROM:</label>
			<input type="date" id="datefrom_record" value="<?= date('Y-m-d',time());?>" class='form-control'>
			<label>DATE TO:</label>
			<input type="date" id="dateto_record" value="<?= date('Y-m-d',time());?>" class='form-control'>
			<button class="btn btn-primary" type="button" id="proceed_record"> Proceed</button>
		</div>
	</div>
</div>

<div class="modal" id="bankModal">
	<div class="modal-content modal-25">
		<span class="close-modal">&times;</span>
		<div class="modal-body">
			<label>DATE FROM:</label>
			<input type="date" id="datefrom_bank" value="<?= date('Y-m-d',time());?>" class='form-control'>
			<label>DATE TO:</label>
			<input type="date" id="dateto_bank" value="<?= date('Y-m-d',time());?>" class='form-control'>
			<label>BANK:</label>
			<select class="form-control" id="bank">
				<?php foreach($banks as $bank):?>
					<option><?= $bank['Model'];?></option>
				<?php endforeach?>
			</select>
			<button class="btn btn-primary" type="button" id="proceed_bank"> Proceed</button>
		</div>
	</div>
</div>



</section>
<?php include VIEW_PATH.'/includes/footer.php';?>
<script type="text/javascript">
  $('#reportnav').addClass('activenav');

    $(document).on('click','.close-modal',function(){
$('.modal').css("display","none");
});

      $(document).on('click','.openfilterModal',function(){
  	let option = $(this).data('option');
  		if(option==1){
  			$('#recordModal').css("display","block");
  		}else{
  			$('#bankModal').css("display","block");
  		}
  });

      $(document).on('click','#proceed_record',function(){
      	let datefrom = $('#datefrom_record').val();
      	let dateto = $('#dateto_record').val();

      	$.ajax({
      		url: 'exportrecord',
      		type: 'POST',
      		data: '&datefrom='+datefrom+'&dateto='+dateto,
      		success:function(x){
      			$('.downloadfile').css("display","none");
      			$('#download_record').css("display","inline");
      			$('.modal').css("display","none");
      		}
      	})
      })


       $(document).on('click','#proceed_bank',function(){
      	let datefrom = $('#datefrom_bank').val();
      	let dateto = $('#dateto_bank').val();
      	let bank = $('#bank').val();

      	$.ajax({
      		url: 'exportbank',
      		type: 'POST',
      		data: '&datefrom='+datefrom+'&dateto='+dateto+'&bank='+bank,
      		success:function(x){
      			$('.downloadfile').css("display","none");
      			$('#download_bank').css("display","inline");
      			$('.modal').css("display","none");
      		}
      	})
      })


</script>
</body>
</html>
