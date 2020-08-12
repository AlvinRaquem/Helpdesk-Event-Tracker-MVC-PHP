<?php include VIEW_PATH.'/includes/header.php';?>

<style>
@media (max-width: 500px){
.col-6 {
width: 100%;
}
}

@media (max-width: 800px) and (min-width: 501px){
.col-6 {
width: 100%;
}
}
}

</style>

<div id="mainBody">
	<span class="pageheader"><i class="fa fa-file-signature"></i> Complaint List(s)</span>
	<button type="button" id="showAddModal" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> New Complaint</button><hr/>

	<div class="col-12">
			<div class="panel">
	<div class="panel-header panel-danger">&nbsp;</div>
	<div class="panel-body">
		<div class="col-6">
	 <input type="text" class="form-control" id="searchval" placeholder="Search Complaint..." style="margin-bottom: 5px;">

	 </div>
		<table class="table table-bordered table-striped">
			<thead>
			<tr>
			<th>#</th>
			<th>Description</th>
			
			<th style="width: 60pt;"></th>
			<th style="width: 70pt;"></th>
			</tr>
			</thead>

			<tbody id="complaintlist_data">
			<?php $x=1;?>
				<?php foreach($complaints as $complaint):?>
					<tr>
					<td><?= $x++;?></td>
					<td><?= $complaint['Description'];?></td>
					<td><button style="padding: 5pt" class="btn btn-warning showeditModal" data-description="<?= $complaint['Description'];?>" data-idno="<?= $complaint['IDno'];?>"><span class="fa fa-edit"></span> Edit</button></td>
					<td><button style="padding: 5pt" class="btn btn-danger removecomplaint" data-idno="<?= $complaint['IDno'];?>"><span class="fa fa-trash"></span> Remove</button></td>
					</tr>
				<?php endforeach ?>
			</tbody>

		</table>
	</div>
	</div>
	</div>
<!-- 
	<div class="col-6">
				<div class="panel">
				<div class="panel-header panel-success"></div>
				<div class="panel-body">

				</div>
	</div>

	</div> -->

</div>

<div class="modal" id="addModal">
	<div class="modal-content modal-25">
		<span class="close-modal">&times;</span>
		<div class="modal-body">
			<form method="POST" action="addcomplaintlist">
			<label style="color: dimgray;font-weight: bold;">Description</label>
			<input style="margin-bottom: 10px;"  type="text" class="form-control" name="description" required>

			<button class="btn btn-primary" type="submit"><span class="fa fa-plus"></span> Create</button>
			</form> 
		</div>
	</div>
</div>


<div class="modal" id="editModal">
	<div class="modal-content modal-25">
		<span class="close-modal">&times;</span>
		<div class="modal-body">
			<form method="POST" action="updatecomplaintlist">
				<input type="hidden" name="idno" id="editidno">
			<label style="color: dimgray;font-weight: bold;">Description</label>
			<input style="margin-bottom: 10px;" type="text" class="form-control" id="editdes" name="description" required>

			<button class="btn btn-primary" type="submit"><span class="fa fa-edit"></span> Update</button>
			</form> 
		</div>
	</div>
</div>



</section>
<?php include VIEW_PATH.'/includes/footer.php';?>
<script type="text/javascript" src="./app/view/js/complaintlist.js"></script>
</body>
</html>
