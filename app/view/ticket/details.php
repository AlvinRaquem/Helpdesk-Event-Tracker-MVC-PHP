<?php include VIEW_PATH.'/includes/header.php';?>

<style>
	table tbody tr td {
		color: dimgray;
	}
</style>

<div id="mainBody">
	<span class="pageheader"><i class="fa fa-edit"></i> Ticket No: <?= $detail['IDno'];?></span><hr/>

	<div class="panel col-12">
		<div class="panel-header panel-danger">&nbsp;</div>
		<div class="panel-body">
			<table class="table table-bordered table-striped">
				<tbody>
				<tr>
					<td style="width: 30%;"><strong>Complaint</strong></td>
					<td><strong><?= $detail['c_complaint'];?></strong></td>
				</tr>
				<tr>
					<td><strong>Type</strong></td>
					<td><strong><?= $detail['c_type'];?></strong></td>
				</tr>
				<tr>
					<td><strong>ATM Screen</strong></td>
					<td><strong><?= $detail['c_Screen'];?></strong></td>
				</tr>
				<tr>
					<td><strong>Error Code</strong></td>
					<td><strong><?= $detail['c_errCode'];?></strong></td>
				</tr>
				<tr>
					<td><strong>Level</strong></td>
					<td><strong><?= $detail['c_level'];?></strong></td>
				</tr>
				<tr>
					<td><strong>Received By</strong></td>
					<td><strong><?= $detail['c_rcvby'];?></strong></td>
				</tr>
				<tr>
					<td><strong>Date / Time</strong></td>
					<td><strong><?= $detail['c_RcvDate'];?></strong></td>
				</tr>
				<tr>
					<td><strong>ATM ID</strong></td>
					<td><strong><?= $detail['c_atmID'];?></strong></td>
				</tr>
				<tr>
					<td><strong>Brand / Bank</strong></td>
					<td><strong><?= $atmdetails['Brand']." / ".$atmdetails['Model'];?></strong></td>
				</tr>
				<tr>
					<td><strong>Sites</strong></td>
					<td><strong><?= $atmdetails['Site'];?></strong></td>
				</tr>
				<tr>
					<td><strong>Reported By</strong></td>
					<td><strong><?= $detail['c_repby'];?></strong></td>
				</tr>
				<tr>
					<td><strong>Acknowledged By</strong></td>
					<td><strong><?= $detail['Dispatchby']." / ".$detail['Dispatchdate'];?></strong></td>
				</tr>
				<tr>
					<td><strong>Person Assigned</strong></td>
					<td><strong><?= $detail['c_PersonAssign']." / ".$detail['c_AssignDate'];?></strong></td>
				</tr>
				<tr>
					<td><strong>Status</strong></td>
					<td><strong>
						<?php if($detail['c_Status'] == 'Open'):?>
						<span style="font-size: 10pt;padding: 2pt 5pt;background: maroon;color: white;border-radius: 8px;">
						<?php elseif($detail['c_Status']== 'Closed'):?>
						<span style="font-size: 10pt;padding: 2pt 5pt;background: green;color: white;border-radius: 8px;">
						<?php else:?>
						<span style="font-size: 10pt;padding: 2pt 5pt;background: orange;color: white;border-radius: 8px;">
						<?php endif?>

						<?= $detail['c_Status'];?></span>
							
						</strong></td>
				</tr>
				<tr>
					<td><strong>Target Date</strong></td>
					<td><strong><?= $detail['c_Target'];?></strong></td>
				</tr>
				<tr>
					<td><strong>Diagnosis</strong></td>
					<td><strong><?= $detail['c_diagnosis'];?></strong></td>
				</tr>
				<tr>
					<td><strong>Action Taken</strong></td>
					<td><strong><?= $detail['c_action'];?></strong></td>
				</tr>
				<tr>
					<td><strong>Response</strong></td>
					<td><strong><?= $detail['c_response'];?></strong></td>
				</tr>
				<tr>
					<td><strong>Resolution</strong></td>
					<td><strong><?= $detail['c_resolution'];?></strong></td>
				</tr>
				<tr>
					<td><strong>Updated By</strong></td>
					<td><strong><?= $detail['Modby']." / ".$detail['ModDate'];?></strong></td>
				</tr>
				<tr>
					<td><strong>Last Update</strong></td>
					<td><strong><?= $detail['LastMod']." / ".$detail['LasDate'];?></strong></td>
				</tr>
			<!-- 	<tr>
					<td><strong>Last Comment</strong></td>
					<td><strong><?= $commentdetails['Summary']."<br/>".$commentdetails['SubmitBy']. " / ".$commentdetails['SubmitDate'];?></strong></td>
				</tr> -->
				</tbody>
			</table>
			<br/>
			<a href="updateticket?ticketno=<?=$detail['IDno'];?>"><button class="btn btn-primary"><span class="fa fa-edit"></span> Update Ticket</button></a>
		</div>
	</div>


</div>


</section>
<?php include VIEW_PATH.'/includes/footer.php';?>
<script>
// $('#reportnav').addClass("activenav");
</script>
</body>
</html>
