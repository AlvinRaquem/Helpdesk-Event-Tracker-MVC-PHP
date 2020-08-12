<?php 
include VIEW_PATH.'/includes/header.php';
require_once HELPER_PATH."session.php";
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
@media (max-width: 700px){
	.responsivediv {
		overflow-x: auto;
	}
}
</style>


<div id="mainBody">
	<span class="pageheader"><i class="fa fa-users"></i> Manage Users</span><button type="button" id="showAddModal" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> New User</button><hr/>

	<div class="panel">
	<div class="panel-header panel-danger">&nbsp;</div>
	<div class="panel-body">
	<div class="responsivediv">
		<div class="col-6">
	 <input type="text" class="form-control" id="searchval" placeholder="Search User..." style="margin-bottom: 5px;">

	 </div>

		<table class="table table-bordered table-striped">
			<thead>
			<tr>
			<th>#</th>
			<th>FullName</th>
			<th>UserName</th>
			<th>Email Address</th>
			<th>UserLevel</th>
			<th style="width: 60pt;"></th>
			<th style="width: 70pt;"></th>
			</tr>
			</thead>

			<tbody id="userdata">
			<?php $x=1;?>
				<?php foreach($users as $user):?>
					<tr>
					<td><?= $x++;?></td>
					<td><?= $user['full_name'];?></td>
					<td><?= $user['user_name'];?></td>
					<td><?= $user['email_add'];?></td>
					<td><?= $user['user_level'];?></td>
					<td><button style="padding: 5pt" class="btn btn-warning edituser" data-id="<?= $user['IDno'];?>" data-fullname="<?= $user['full_name'];?>" data-username="<?= $user['user_name'];?>" data-emailadd="<?= $user['email_add'];?>" data-userlevel="<?= $user['user_level'];?>"><span class="fa fa-edit"></span> Edit</button></td>
					<td><button type="button" style="padding: 5pt" class="btn btn-danger removeuser" data-id="<?= $user['IDno'];?>"><span class="fa fa-trash"></span> Remove</button></td>
					</tr>
				<?php endforeach ?>
			</tbody>

		</table>
	</div>
	</div>
	</div>

</div>

<div class="modal" id="addModal">
	<div class="modal-content">
	<span class="close-modal">&times;</span>
	<div class="modal-body">
	<h3><span class="fa fa-plus"></span> ADD NEW USER</h3>
	<form method="POST" action="createnewuser">
		<fieldset>
			<label class="form-label">FullName</label>
			<input type="text" name="fullname" class="form-control" id="fullname" required>
			<label class="form-label">UserName</label>
			<input type="text" name="username" class="form-control" id="username" required>
			<label class="form-label">Email Address</label>
			<input type="email" name="emailadd" class="form-control" id="emailadd" required>
			<label class="form-label">User Level</label>
			<select class="form-control" name="userlevel" id="userlevel">
				<option>admin</option>
				<option>user</option>
				<!-- <option>teller</option>
				<option>technician</option> -->
			</select>
			<label class="form-label">Password</label>
			<input type="password" name="password" class="form-control" id="password" required>
			<hr/>
			<button type="submit" class="btn btn-primary pull-right"><span class="fa fa-check"></span> Create</button>
		</fieldset>


		</form>
	</div>

	</div>
</div>



<div class="modal" id="editModal">
	<div class="modal-content">
	<span class="close-modal">&times;</span>
	<div class="modal-body">
	<h3><span class="fa fa-edit"></span> UPDATE USER</h3>
	<form method="POST" action="updateuser">
		<fieldset>
			<input type="hidden" name="idno" id="editidno">
			<label class="form-label">FullName</label>
			<input type="text" name="fullname" class="form-control" id="editfullname" required>
			<label class="form-label">UserName</label>
			<input type="text" name="username" class="form-control" id="editusername" required>
			<label class="form-label">Email Address</label>
			<input type="email" name="emailadd" class="form-control" id="editemailadd" required>
			<label class="form-label">User Level</label>
			<select class="form-control" name="userlevel" id="edituserlevel">
				<option>admin</option>
				<option>user</option>
				<!-- <option>teller</option>
				<option>technician</option> -->
			</select>
			<label class="form-label">New Password</label>
			<input type="password" name="newpassword" class="form-control" id="newpassword">
			<hr/>
			<button type="submit" class="btn btn-warning pull-right"><span class="fa fa-check"></span> Update</button>
		</fieldset>


		</form>
	</div>

	</div>
</div>


</section>
<?php include VIEW_PATH.'/includes/footer.php';?>
<script type="text/javascript" src="./app/view/js/manage_users.js"></script>
</body>
</html>
