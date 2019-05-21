<?php include VIEW_PATH.'/includes/header.php';?>
<link rel="stylesheet" type="text/css" href="public/customcss/activelist.css">

<div id="mainBody">
	<span class="pageheader"><i class="fa fa-cube"></i> SLM Pending</span>
	<span class="badge">
			<span class="label label-danger">Danger</span>
			<span class="label label-warning">Warning</span>
     </span><hr/>

	<table class="table table-noborder">
	<thead>
		<tr style="background: mistyrose;color: dimgray;">
	      <th>TICKET #</th>
	      <th>BRAND</th>
	      <th>BANK/ SITE</th>
	      <th>COMPLAINT</th>
	      <th>RECEIVED</th>
	      <th>TARGET</th>
	      <th>DISPATCH</th>
	      <th>TELLER / TECHNICIAN</th>
    	</tr>
	</thead>
	<tbody id="slmactive">


	</tbody>
	</table>
</div>


</section>
<?php include VIEW_PATH.'/includes/footer.php';?>

<script type="text/javascript">
	
	function getflmactivelist(){
		$.ajax({
			url: 'getactiveList',
			type: 'POST',
			data: '&level=SLM',
			success:function(x){
				$('#slmactive').html(x);
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
