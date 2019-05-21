<?php include VIEW_PATH.'/includes/dashheader.php';?>
<link rel="stylesheet" type="text/css" href="public/customcss/activelist.css">

<style>
	th {
		font-size: 18pt;
	}

	td {
		font-size: 16pt;
	}
	
</style>

<div style="margin: 10px;">

<span class="pageheader"><i class="fa fa-cube"></i> FLM Pending</span>
	<span class="badge">
			<span class="label label-danger" style="font-size: 12pt;">Danger</span>
			<span class="label label-warning" style="font-size: 12pt;">Warning</span>
     </span><hr/>

	<table class="table table-noborder">
	<thead>
		<tr style="background: mistyrose;color: dimgray;">
      <th>TICKET #</th>
      <th>BRAND</th>
      <th>BANK/ SITE</th>
      <th>COMPLAINT</th>
      <th>RECEIVED</th>
      <th>DURATION</th>
      <th>DISPATCH</th>
      <th>TELLER / TECHNICIAN</th>
    </tr>

	</thead>
	<tbody id="flmactive">


	</tbody>
	</table>


</div>

<?php include VIEW_PATH.'/includes/footer.php';?>


<script type="text/javascript">
	
	function getflmactivelist(){
		$.ajax({
			url: 'getactiveList',
			type: 'POST',
			data: '&level=FLM',
			success:function(x){
				$('#flmactive').html(x);
			}
		})
	}

	$(document).ready(function(){
		getflmactivelist();
		setInterval(function(){
			getflmactivelist();
		},1000);
	});


	$('#pendingnav').addClass("activenav");

</script>

</body>
</html>
