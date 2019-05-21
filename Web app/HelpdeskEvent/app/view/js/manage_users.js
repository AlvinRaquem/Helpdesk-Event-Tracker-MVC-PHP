
function getusers(){
$.ajax({
url: 'displayusers',
type: 'GET',
success:function(x){
$('#userdata').html(x);
}
})
}

$(document).on('keyup','#searchval',function(){
let searchval = $('#searchval').val();

if(searchval == ""){
getusers();
}else{
$.ajax({
url: 'searchuser',
type: 'POST',
data: '&search='+searchval,
success:function(x){
$('#userdata').html(x);
}
})
}
});


$('#settingnav').addClass('activenav');

let showAddModal = document.getElementById("showAddModal");
let addModal = document.getElementById("addModal");

showAddModal.onclick = function(){
addModal.style.display = "block";
}

$(document).on('click','.close-modal',function(){
$('.modal').css("display","none");
})

$(document).on('click','.edituser',function(){
let idno = $(this).data('id');
let fullname = $(this).data('fullname');
let username = $(this).data('username');
let emailadd = $(this).data('emailadd');
let userlevel = $(this).data('userlevel');

$('#editidno').val(idno);
$("#editfullname").val(fullname);
$('#editusername').val(username);
$('#editemailadd').val(emailadd);
$('#edituserlevel').val(userlevel);

$('#editModal').css("display","block");
})

$(document).on('click','.removeuser',function(){
let idno = $(this).data('id');

let currentid = "<?= session::get('SESS_USER_ID');?>";

if(idno == currentid){
alert("you can't remove your account");
}else{
if(confirm("Are you sure you want to remove this user?")){
$.ajax({
url: 'removeuser',
type: 'POST',
data: '&idno='+idno,
success:function(x){
window.location.href = window.location.href;
}
})
}
} 	

});