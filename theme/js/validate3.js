// JavaScript Document


function validate()
 {

 
	var error_msg=0;
	var error_msg1 = "";
	var error_msg2 = "";
	var error_msg3 = "";
	var error_msg4 = "";
	var error_msg5 = "";
	var error_msg6 = "";
	var error_msg7 = "";
    

	
 
	if(document.frmcontact.fname.value=="" || document.frmcontact.fname.value=="Enter Name")
	{ 
	 error_msg=1;	
	 error_msg1="Enter Name";
	 document.getElementById('fname').style.background="#c22b4a";
	 document.getElementById('fname').style.color="#fff";
	  document.getElementById('fname').value=error_msg1;
	}
	if(document.frmcontact.vimage.value=="" || document.frmcontact.vimage=="Enter Code")
	{
	 error_msg=1;	
	 error_msg2="Enter Code";
	 document.getElementById('vimage').style.background="#c22b4a";
	 document.getElementById('vimage').style.color="#fff";
	  document.getElementById('vimage').value=error_msg2;
	}
	else if(document.frmcontact.vimage.value!=document.frmcontact.captcha.value)
	{
	 error_msg=1;	
	 error_msg4="Wrong Code";
	 document.getElementById('vimage').style.background="#c22b4a";
	 document.getElementById('vimage').style.color="#fff";
	  document.getElementById('vimage').value=error_msg4;
	}
	
	
	var ck_email1 = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
	
	if(document.frmcontact.email.value=="")
	{
	 error_msg=1;
	 error_msg3="Enter Email Address";
	 document.getElementById('email').style.background="#c22b4a";
	 document.getElementById('email').style.color="#fff";
	 document.getElementById('email').value=error_msg3;
	}
	else if(!ck_email1.test(document.frmcontact.email.value))
	{
	error_msg=1;
	error_msg3="Enter Valid Email Address";
	document.getElementById('email').style.background="#c22b4a";
	document.getElementById('email').style.color="#fff";
	document.getElementById('email').value=error_msg3;
	}
	
	if(document.frmcontact.enquiry.value=="" || document.frmcontact.enquiry.value=="Enter Message")
	{
	 error_msg=1;	
	 error_msg5="Enter Message";
	 document.getElementById('enquiry').style.background="#c22b4a";
	 document.getElementById('enquiry').style.color="#fff";
	  document.getElementById('enquiry').value=error_msg5;
	}

if(document.frmcontact.subject3.value=="0")
	{
	 error_msg=1;	
	 error_msg7="Select Subject";
	  document.getElementById('selectbox').innerHTML=error_msg7;
	  document.getElementById('selectbox').style.color="#F00";
	}

	if(error_msg==1)
	{												
	return false;
	}
	else
    {
    return true;
	}
  
}
function contactfname()
{
//alert("fdsd");
  if(document.getElementById('fname').value=="Enter Name")
{
document.getElementById('fname').value="";
document.getElementById('fname').style.backgroundColor="";
document.getElementById('fname').style.color="#000";
}
}



function contactemail()
{
  if(document.getElementById('email').value=="Enter Email Address" || document.getElementById('email').value=="Enter Valid Email Address")
{
document.getElementById('email').value="";
document.getElementById('email').style.backgroundColor="";
document.getElementById('email').style.color="#000";
}
}

function contactenq()
{

  if(document.getElementById('enquiry').value=="Enter Message")
{
document.getElementById('enquiry').value="";
document.getElementById('enquiry').style.backgroundColor="";
document.getElementById('enquiry').style.color="#000";
}
}
function contactvimage()
{

  if(document.getElementById('vimage').value=="Enter Code" || document.getElementById('vimage').value=="Wrong Code" )
{
document.getElementById('vimage').value="";
document.getElementById('vimage').style.backgroundColor="";
document.getElementById('vimage').style.color="#000";
}
}
function getvalue()
{
  document.getElementById('selectbox').innerHTML="";
}