
var myBtn1=document.getElementById("myBtn1");
var mymodal1=document.getElementById("myModal1");
var close1=document.getElementById("btn_close1");
myBtn1.onclick=function(){
  mymodal1.style.display="block";
}
close1.onclick=function(){
  mymodal1.style.display="none";
}