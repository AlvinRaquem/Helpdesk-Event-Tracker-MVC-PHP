<?php 
include VIEW_PATH.'/includes/header.php';
use helper\session;


if(isset($_SESSION['user_message'])){
	echo "<script>alert('".session::get('user_message')."')</script>";
}

session::unset_('user_message');

?>

<style>
.form-label{
font-weight: bold;
color: dimgray;
font-size: 14pt;
}

</style>
<div id="mainBody">
	<span class="pageheader"><i class="fa fa-lock"></i> Change Password</span><hr/>
	<div class="col-6">
	<div class="panel">
	<div class="panel-header panel-danger">&nbsp;</div>
	<div class="panel-body">
	<form action="updatepassword" method="POST">
		<input type="hidden" name="idno" value="<?=session::get('SESS_USER_ID');?>">
		<label class="form-label">NEW PASSWORD</label>
		<input type="password" name="password" class="form-control" required>
		<hr/>
		<button type="submit" class="btn btn-primary">Update</button>
	</form>

	</div>

	</div>
	</div>
</div>


</section>
<?php include VIEW_PATH.'/includes/footer.php';?>
<script type="text/javascript">
  $('#settingnav').addClass('activenav');
</script>
</body>
</html>
