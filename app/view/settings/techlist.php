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
@media (max-width: 700px){
	.responsivediv {
		overflow-x: auto;
	}
}
</style>


<div id="mainBody">
	<span class="pageheader"><i class="fa fa-users"></i> Manage Technician(s)</span><button type="button" id="showAddModal" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> New User</button><hr/>

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
			
			<th style="width: 60pt;"></th>
			<th style="width: 70pt;"></th>
			</tr>
			</thead>

			<tbody id="userdata">
			<?php $x=1;?>
				<?php foreach($techs as $tech):?>
					<tr>
					<td><?= $x++;?></td>
					<td><?= $tech['fullname'];?></td>
					
					<td><button style="padding: 5pt" class="btn btn-warning edittech" data-id="<?= $tech['idno'];?>" data-fullname="<?= $tech['fullname'];?>"><span class="fa fa-edit"></span> Edit</button></td>
					<td><button type="button" style="padding: 5pt" class="btn btn-danger removetech" data-id="<?= $tech['idno'];?>"><span class="fa fa-trash"></span> Remove</button></td>
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
	<h3><span class="fa fa-plus"></span> ADD NEW TECHNICIAN</h3>
	<form method="POST" action="createnewtech">
		<fieldset>
			<label class="form-label">FullName</label>
			<input type="text" name="fullname" class="form-control" id="fullname" required>
			
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
	<h3><span class="fa fa-edit"></span> UPDATE TECHNICIAN</h3>
	<form method="POST" action="updatetech">
		<fieldset>
			<input type="hidden" name="idno" id="editidno">
			<label class="form-label">FullName</label>
			<input type="text" name="fullname" class="form-control" id="editfullname" required>
			
			<hr/>
			<button type="submit" class="btn btn-warning pull-right"><span class="fa fa-check"></span> Update</button>
		</fieldset>


		</form>
	</div>

	</div>
</div>


</section>
<?php include VIEW_PATH.'/includes/footer.php';?>
<script type="text/javascript">


let showAddModal = document.getElementById("showAddModal");
let addModal = document.getElementById("addModal");

showAddModal.onclick = function(){
addModal.style.display = "block";
}

$(document).on('click','.close-modal',function(){
$('.modal').css("display","none");
})


$(document).on('click','.edittech',function(){
let idno = $(this).data('id');
let fullname = $(this).data('fullname');

$('#editidno').val(idno);
$("#editfullname").val(fullname);

$('#editModal').css("display","block");
})



	$(document).on('click','.removetech',function(){
let idno = $(this).data('id');

let currentid = "<?= session::get('SESS_USER_ID');?>";

if(idno == currentid){
alert("you can't remove your account");
}else{
if(confirm("Are you sure you want to remove this user?")){
$.ajax({
url: 'removetech',
type: 'POST',
data: '&idno='+idno,
success:function(x){
window.location.href = window.location.href;
}
})
}
} 	

});


</script>
</body>
</html>
