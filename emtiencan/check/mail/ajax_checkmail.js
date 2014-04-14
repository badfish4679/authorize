<!--Begin
var max=0;
var index=1;
var http = getHTTPObject();
function getHTTPObject() { 
	var xmlhttp;
	/*@cc_on  
	@if(@_jscript_version >= 5) 
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	}catch(e){ 
		try{ 
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E){
			xmlhttp = false; 
		}
	}
	@else
		xmlhttp = false; 
	@end @*/
	if (!xmlhttp && typeof XMLHttpRequest != 'undefined') { 
		try{
			xmlhttp = new XMLHttpRequest(); 
		}catch(e){ 
			xmlhttp = false;
		}
	}
	return xmlhttp; 
}
function checkfrm(){
	if(document.frm.localmail.value==""||document.frm.localpass.value==""||document.frm.splitby.value==""||document.frm.maillist.value==""){
		alert("Pls enter full values");
	}
	else{
		Begin();
	}
}
function Begin(){
	checkemail("begin");
}
function checkemail(Line){
	if(max>1){
		document.frm.maillist.disabled = true;
		document.frm.localmail.disabled = true;
		document.frm.localpass.disabled = true;
		document.frm.checkface.disabled = true;
		document.frm.splitby.disabled  = true;
		document.frm.submit.disabled  = true;
	}
	else{
		document.frm.maillist.disabled = false;
		document.frm.localmail.disabled = false;
		document.frm.localpass.disabled = false;
		document.frm.checkface.disabled = false;
		document.frm.splitby.disabled  = false;
		document.frm.submit.disabled  = false;
	}
	if(Line=="begin"){
		var temp = document.frm.maillist.value;
		var xlist = temp.split("\n");
		max = xlist.length;
		
		temp = temp.replace(xlist[0]+"\n","");
		if(max==1){
			temp = temp.replace(xlist[0],"");
		}
		checkemail(xlist[0]);
		document.frm.maillist.value = temp;
	}
	else{
		var url="checkmail.php";
		var local_mail = document.frm.localmail.value;
		var local_pass = document.frm.localpass.value;
		var Xsplit = document.frm.splitby.value;
		var fb="";
		if(document.frm.checkface.checked){
			fb = "yes";
		}
		else{
			fb = "no";
		}
		http.onreadystatechange = function(){
			if(http.readyState == 4){
				if(http.responseText!=""&&http.responseText!="Pls enter full value"){
					document.getElementById('kq').innerHTML += index+". "+http.responseText;
					index++;
				}
				if(max!=1){
					Begin();
				}

			}
		}
		var para = "xline="+Line+"&xMail="+local_mail+"&xPass="+local_pass+"&xSplit="+Xsplit+"&checkfb="+fb;
		http.open("POST", url, true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.setRequestHeader("Content-length", para.length);
		http.setRequestHeader("Connection", "close");
		http.send(para);
	}
}
//End-->