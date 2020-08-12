var openListModal = document.getElementById("openListModal");
var ListModal = document.getElementById("ListModal");
var closemodal = document.getElementsByClassName("close-modal");
var modal = document.getElementsByClassName("modal");
var createitem = document.getElementsByClassName("createitem");

openListModal.onclick = ()=>{
ListModal.style.display = "block";
getatmlist();
}

for(let x=0;x<closemodal.length;x++){
closemodal[x].onclick = ()=>{
for(let y=0;y<modal.length;y++){
modal[y].style.display = "none";
}
}
}

function match(x){
if(x.matches){
for(let y = 0 ; y < createitem.length ; y++){
createitem[y].style.width = "100%";
}
}else{

document.getElementById('txtComplaint').style.width = "40%";
document.getElementById('othersblock').style.width = "12%";
document.getElementById('txtcomplaint_others').style.width = "46%";
document.getElementById('txtType').style.width = "19%";
document.getElementById('txtChest').style.width = "19%";
document.getElementById('txtLevel').style.width = "19%";
document.getElementById('txtScreen').style.width = "20%";
document.getElementById('txtErr').style.width = "20%";
document.getElementById('txtRcvBy').style.width = "41%";
document.getElementById('datercvblock').style.width = "8%";
document.getElementById('dtRcv').style.width = "20%";
document.getElementById('timercvblock').style.width = "8%";
document.getElementById('timeRcv').style.width = "20%";
document.getElementById('txtAtmID').style.width = "19%";
document.getElementById('openListModal').style.width = "10%";
document.getElementById('brandblock').style.width = "10%";
document.getElementById('txtBrand').style.width = "12%";
document.getElementById('bankblock').style.width = "10%";
document.getElementById('txtBank').style.width = "12%";
document.getElementById('siteblock').style.width = "10%";
document.getElementById('txtSite').style.width = "13%";
document.getElementById('txtReportedBy').style.width = "49%";
document.getElementById('reportedviablock').style.width = "12%";
document.getElementById('txtreportvia').style.width = "38%";
document.getElementById('txtPersonAssign').style.width = "41%";
document.getElementById('datepersonblock').style.width = "8%";
document.getElementById('dtPersonAssign').style.width = "20%";
document.getElementById('timepersonblock').style.width = "8%";
document.getElementById('timePersonAssign').style.width = "20%";

document.getElementById('txtAcknow').style.width = "41%";
document.getElementById('dateacknowblock').style.width = "8%";
document.getElementById('dateacknow').style.width = "20%";
document.getElementById('timeacknowblock').style.width = "8%";
document.getElementById('timeacknow').style.width = "20%";

}
}


var mediax = window.matchMedia("(max-width: 800px)");
match(mediax);
mediax.addListener(match);


function getatmlist(){
$.ajax({
url: 'displayatmList',
type: 'POST',
success:function(x){
$('#atmlisttable').html(x);
}
})
}

$(document).ready(function(){
getatmlist();
});


$(document).on('click','.selectatm',function(){
let atmid = $(this).data('id');
let bank = $(this).data('bank');
let brand = $(this).data('brand');
let site = $(this).data('site');

$('#txtAtmID').val(atmid);
$('#txtBank').val(bank);
$('#txtBrand').val(brand);
$('#txtSite').val(site);

$('#ListModal').css("display", "none");
});

$(document).on('click','#createticket',function(){
$.ajax({
url: 'createticket',
type: 'POST',
data: $("#createform").serialize(),
success:function(x){
if(x=="success"){
alert("Created Successfully!");
}else{
alert("Something Went Wrong!");
}

window.location.href = window.location.href;
}
})

})


$(document).on('keyup','#searchval',function(){
let searchitem = $('#searchval').val();
if(searchitem == ""){
getatmlist();
}else{
$.ajax({
url: 'searchsite',
type: 'POST',
data: '&site='+searchitem,
success:function(x){
$('#atmlisttable').html(x);
}
})
}
})




