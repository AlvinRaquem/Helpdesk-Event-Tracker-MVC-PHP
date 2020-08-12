$('#settingnav').addClass('activenav');

function getatmlist(){
$.ajax({
url: 'displayatmlist_all',
type: 'GET',
success:function(x){
$('#atmdata').html(x);
}
})
}

$(document).on('keyup','#searchval',function(){
let searchval = $('#searchval').val();

if(searchval == ""){
getatmlist();
}else{
$.ajax({
url: 'searchatm',
type: 'POST',
data: '&site='+searchval,
success:function(x){
$('#atmdata').html(x);
}
})
}
});