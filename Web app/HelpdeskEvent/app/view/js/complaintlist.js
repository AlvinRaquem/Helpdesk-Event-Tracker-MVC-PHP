
function getcomplaintlist(){
$.ajax({
url: 'displaycomplaintlist_all',
type: 'GET',
success:function(x){
$('#complaintlist_data').html(x);
}
})
}

$(document).on('keyup','#searchval',function(){
let searchval = $('#searchval').val();

if(searchval == ""){
getcomplaintlist();
}else{
$.ajax({
url: 'searchcomplaint',
type: 'POST',
data: '&search='+searchval,
success:function(x){
$('#complaintlist_data').html(x);
}
})
}
});



$('#settingnav').addClass('activenav');

$(document).on('click','.close-modal',function(){
$('.modal').css("display","none");
});

let showAddModal = document.getElementById("showAddModal");
let addModal = document.getElementById("addModal");

showAddModal.onclick = function(){
addModal.style.display = "block";
}

$(document).on('click','.showeditModal',function(){
$('#editidno').val($(this).data('idno'));
$('#editdes').val($(this).data('description'));
$('#editModal').css("display","block");
});

$(document).on('click','.removecomplaint',function(){
let idno = $(this).data('idno');

if(confirm("Are you sure you want to remove this?")){
$.ajax({
url: 'removecomplaint',
type: 'POST',
data: '&idno='+idno,
success:function(x){
window.location.href = window.location.href;
}
})
}
})