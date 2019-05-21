<?php include VIEW_PATH.'/includes/header.php';?>
<style>
@media (max-width: 700px){
	.responsivediv {
		overflow-x: auto;
	}
}
</style>

<div id="mainBody">
	<span class="pageheader"><i class="fa fa-map-marker-alt"></i> Unit List(s)</span>
	<a href="newunit"><button type="button" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> New Unit</button></a><hr/>
		<div class="panel">
	<div class="panel-header panel-danger">&nbsp;</div>
	<div class="panel-body">
			<div class="responsivediv">
	<div class="col-6">
	 <input type="text" class="form-control" id="searchval" placeholder="Search Site...">

	 </div>

		<table class="table table-bordered table-striped" style="margin-top: 50px;">
			<thead>
			<tr>
			<th>#</th>
			<th>TerminalID</th>
			<th>Bank</th>
			<th>Site</th>
			<th>Address</th>
			<th>Brand</th>
			<th style="width: 60pt;"></th>
			</tr>
			</thead>

			<tbody id="atmdata">
			<?php $x=1;?>
				<?php foreach($atms as $atm):?>
					<tr>
					<td><?= $x++;?></td>
					<td><?= $atm['Terminal_ID'];?></td>
					<td><?= $atm['Model'];?></td>
					<td><?= $atm['Site'];?></td>
					<td><?= $atm['Address'];?></td>
					<td><?= $atm['Brand'];?></td>
					<td><a href="viewunit?unitID=<?= $atm['Terminal_ID'];?>"><button style="padding: 5pt" class="btn btn-success"><span class="fa fa-search"></span> View</button></a></td>
					</tr>
				<?php endforeach ?>
			</tbody>

		</table>
	</div>
	</div>
	</div>

</div>


</section>
<?php include VIEW_PATH.'/includes/footer.php';?>
<script type="text/javascript" src="./app/view/js/atmlist.js"></script>
</body>
</html>
