//Created by Alvin S. Raquem
//2019

var toggle = document.getElementById('toggle-button');

var aside = document.querySelector("aside");
var header = document.querySelector("header");

var accountinfo = document.getElementById("accountinfo");

var mainBody = document.getElementById("mainBody");

var dropdowncontent = document.getElementsByClassName("dropdown-content");

var navtext = document.getElementsByClassName("navtext");

var nameinfo = document.getElementById("nameinfo");

var imageinfo = document.getElementById("imageinfo");

toggle.onclick = function(){

if(aside.style.width == "250px"){
aside.style.width = "55px";
header.style.marginLeft = "60px";
nameinfo.style.display = "none";
mainBody.style.margin = "0px 10px 0px 60px";

for(let x=0;x<dropdowncontent.length;x++){
dropdowncontent[x].style.position = "fixed";
dropdowncontent[x].style.left = "55px";
dropdowncontent[x].style.top = "171px";
dropdowncontent[x].style.width = "220px";

}

for(let x=0;x<navtext.length;x++){
navtext[x].style.display = "none";
}


}else{
aside.style.width = "250px";
header.style.marginLeft = "250px";
nameinfo.style.display = "block";
mainBody.style.margin = "0px 10px 0px 260px";

for(let x=0;x<dropdowncontent.length;x++){
dropdowncontent[x].style.position = "relative";
dropdowncontent[x].style.left = "0";
dropdowncontent[x].style.top = "0";
dropdowncontent[x].style.width = "100%";
}

for(let x=0;x<navtext.length;x++){
navtext[x].style.display = "inline-block";
}

}

}


function match(x){
if(x.matches){
aside.style.width = "250px";
header.style.marginLeft = "250px";
nameinfo.style.display = "block";
mainBody.style.margin = "0px 10px 0px 260px";

for(let x=0;x<dropdowncontent.length;x++){
dropdowncontent[x].style.position = "relative";
dropdowncontent[x].style.left = "0";
dropdowncontent[x].style.top = "0";
dropdowncontent[x].style.width = "100%";
}

for(let x=0;x<navtext.length;x++){
navtext[x].style.display = "inline-block";
}


}else{
aside.style.width = "55px";
header.style.marginLeft = "60px";
nameinfo.style.display = "none";
mainBody.style.margin = "0px 10px 0px 60px";

for(let x=0;x<dropdowncontent.length;x++){
dropdowncontent[x].style.position = "fixed";
dropdowncontent[x].style.left = "55px";
dropdowncontent[x].style.top = "171px";
dropdowncontent[x].style.width = "220px";

}

for(let x=0;x<navtext.length;x++){
navtext[x].style.display = "none";
}
}
}

var x = window.matchMedia("(min-width: 801px)");
match(x);
x.addListener(match);


var dropbtn = document.getElementsByClassName("dropbtn");

for(let x = 0 ; x < dropbtn.length ; x++){
dropbtn[x].onclick = function(){
let childdiv = this.nextElementSibling;
childdiv.style.display=="block" ? childdiv.style.display = "none" : childdiv.style.display = "block";	
}
}

