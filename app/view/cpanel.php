<?php include VIEW_PATH.'/includes/header.php';?>
<link href="public/customcss/create.css" rel="stylesheet" type="text/css">


<div id="mainBody">
			<span class="pageheader"><i class="fa fa-home"></i> Home Page</span><hr/>

				<div class="panel">
				<div class="panel-header panel-default"><span class="panel-title" style="color: dimgray">FLM (First Line Maintenance)</span></div>
				<div class="panel-body">
						<div class="grid-container">

								<div class="grid-col-3">
						<div class="card-dash card-success">
						<!-- 	<span class="dash-icon fa fa-phone"></span> -->
							<span class="dash-count"><?= $flmtodaycall;?></span>
							<span class="dash-item">Today's Calls</span>
						</div>
					</div>

					

					<div class="grid-col-3">
							<div class="card-dash card-warning">
								<!-- <span class="dash-icon fa fa-cogs"></span> -->
								<span class="dash-count"><?= $flmtodaypending;?></span>
								<span class="dash-item">Pending</span>					
							</div>
					</div>

					<div class="grid-col-3">
							<div class="card-dash card-primary">
							<!-- 	<span class="dash-icon fa fa-edit"></span> -->
								<span class="dash-count"><?= $flmpercentage;?></span>
								<span class="dash-item">Percentage</span>
							</div>
					</div>

					<div class="grid-col-3">
							<div class="card-dash card-danger">
							<!-- 	<span class="dash-icon fa fa-edit"></span> -->
								<span class="dash-count"><?= $flmtodaynotmet;?></span>
								<span class="dash-item">SLA not met</span>
							</div>
					</div>


						</div>
				</div>
			</div>
			<div class="panel">
				<div class="panel-header panel-default"><span class="panel-title" style="color: dimgray;">SLM (Second Line Maintenance)</span></div>
				<div class="panel-body">
						<div class="grid-container">
								<div class="grid-col-6">
										<div class="card-dash card-success">
										<!-- 	<span class="dash-icon fa fa-edit"></span> -->
											<span class="dash-count"><?= $slmtodaycalls;?></span>
											<span class="dash-item">Today's Call</span>
										</div>
								</div>

								<div class="grid-col-6">
										<div class="card-dash card-warning">
										<!-- 	<span class="dash-icon fa fa-edit"></span> -->
											<span class="dash-count"><?= $slmtodaypending;?></span>
											<span class="dash-item">Pending</span>
										</div>
								</div>

						</div>
				</div>
			</div>


				<div class="panel">
				<div class="panel-header panel-danger"><span class="panel-title" style="color: dimgray;">Dashboard</span></div>
				<div class="panel-body">
						<div class="grid-container">
								<div class="grid-col-3">
										<div class="card-dash card-primary">
										<!-- 	<span class="dash-icon fa fa-edit"></span> -->
											<a href="dash.dashboard" target="_blank"><span class="dash-count" style="top: 10%;">Dashboard Calls</span></a>
											<span class="dash-item"></span>
										</div>
								</div>

								<div class="grid-col-3">
										<div class="card-dash card-primary">
										<!-- 	<span class="dash-icon fa fa-edit"></span> -->
											<a href="dash.flmactive" target="_blank"><span class="dash-count">FLM Calls</span></a>
											<span class="dash-item"></span>
										</div>
								</div>

								<div class="grid-col-3">
										<div class="card-dash card-primary">
										<!-- 	<span class="dash-icon fa fa-edit"></span> -->
											<a href="dash.slmactive" target="_blank"><span class="dash-count">SLM Calls</span></a>
											<span class="dash-item"></span>
										</div>
								</div>

									<div class="grid-col-3" style="display: none;">
										<div class="card-dash card-primary">
										<!-- 	<span class="dash-icon fa fa-edit"></span> -->
											<a href="dash.tech" target="_blank"><span class="dash-count">Tech Tasks</span></a>
											<span class="dash-item"></span>
										</div>
								</div>

									<div class="grid-col-3" style="display: none;">
										<div class="card-dash card-primary">
										<!-- 	<span class="dash-icon fa fa-edit"></span> -->
											<a href="dash.teller" target="_new"><span class="dash-count">Teller Tasks</span></a>
											<span class="dash-item"></span>
										</div>
								</div>


						</div>
				</div>
			</div>

</div>
      

</section>
<?php include VIEW_PATH.'/includes/footer.php';?>
<script type="text/javascript">
	
	$('#homenav').addClass('activenav');

</script>
</body>
</html>
