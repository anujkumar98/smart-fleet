// initialize varaible
var myBtn=document.getElementById("myBtn");
var mymodal=document.getElementById("myModal");
var close=document.getElementById("btn_close");
myBtn.onclick=function(){
  mymodal.style.display="block";
}
close.onclick=function(){
  mymodal.style.display="none";
}