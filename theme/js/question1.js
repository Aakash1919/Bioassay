function qvalidate()
{
	
	
	var error_msg=0;
	var error_msg1="";
	var error_msg2="";
	var error_msg3="";
	var error_msg4="";
	var error_msg5="";
	var error_msg6 = "";
	var error_msg7 = "";
	var error_msg8 = "";
	var error_msg9 = "";
	var error_msg10 = "";
	var error_msg11 = "";
	var error_msg12 = "";
	var error_msg13 = "";
	var error_msg14 = "";
	var error_msg16 = "";
	var error_msg15 = "";
	var error_msg17 = "";
	var error_msg18 = "";
	var error_msg19 = "";
	var error_msg20 = "";
	var error_msg21 = "";
	var error_msg22 = "";
	var error_msg23 = "";
	var error_msg24 = "";
	var error_msg25 = "";
	var error_msg26 = "";
	var error_msg27 = "";
	var error_msg28 = "";
	var error_msg29 = "";
	//alert("hfghfg");
	 if(document.regform.fname.value=="" ||document.regform.fname.value=="Enter your first name")
	{
		
		//alert("hfghfg");
	 error_msg=1;
	 error_msg1="Enter your first name";
	
	 document.getElementById('fname').style.color="#f7290e";
	 document.getElementById('fname').value=error_msg1;

	}
	 if(document.regform.lname.value=="" ||document.regform.lname.value=="Enter your last name")
	{
	 error_msg=1;
	 error_msg1="Enter your last name";
	
	 document.getElementById('lname').style.color="#f7290e";
	 document.getElementById('lname').value=error_msg1;

	}
	
	
	 if(document.regform.company.value=="" || document.regform.company.value=="Enter Company name")
	{
	 error_msg=1;
	 error_msg2="Enter Company name";
	
	 document.getElementById('company').style.color="#f7290e";
	 document.getElementById('company').value=error_msg2;

	}
	
	
	
	/* if(document.regform.fax.value=="" || document.regform.fax.value=="Enter Fax number")
	{
	 error_msg=1;
	 error_msg3="Enter Fax number";
	
	 document.getElementById('fax').style.color="#f7290e";
	 document.getElementById('fax').value=error_msg3;

	}
 else if(isNaN(document.regform.fax.value))
	{
	  error_msg=1;
	 error_msg7="Enter only digits";

	 document.getElementById('fax').style.color="#f7290e";
	 document.getElementById('fax').value=error_msg7;
	}
	*/
	
	 if(document.regform.addr1.value=="" || document.regform.addr1.value=="Enter Address")
	{
	 error_msg=1;
	 error_msg9="Enter Address";
	
	 document.getElementById('addr1').style.color="#f7290e";
	 document.getElementById('addr1').value=error_msg9;

	}
	
	 if(document.regform.city.value=="" || document.regform.city.value=="Enter City")
	{
	 error_msg=1;
	 error_msg15="Enter City";
	
	 document.getElementById('city').style.color="#f7290e";
	 document.getElementById('city').value=error_msg15;

	}
	
	
	
	 if(document.regform.state.value=="" || document.regform.state.value=="Enter State" )
	{
	 error_msg=1;
	 error_msg15="Enter State";
	
	 document.getElementById('state').style.color="#f7290e";
	 document.getElementById('state').value=error_msg15;

	}
	var ck_email1 = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
	
	if(document.regform.email.value=="" || document.regform.email.value=="Enter email" ||document.regform.email.value=="Enter valid email" )
	{
	 error_msg=1;
	  error_msg4="Enter email";
	
	 document.getElementById('email').style.color="#f7290e";
	 document.getElementById('email').value=error_msg4;
	}
	else if(!ck_email1.test(document.regform.email.value))
	{
	error_msg=1;
	 error_msg5="Enter valid email";
	
	document.getElementById('email').style.color="#f7290e";
	document.getElementById('email').value=error_msg5;
	}else if(document.regform.email.value=="Email id Already Exist"){
		error_msg=1;
	 error_msg5="Email id Already Exist";
	
	document.getElementById('email').style.color="#f7290e";
	document.getElementById('email').value=error_msg5;
	}
	
	
	if(document.regform.zip.value=="" ||document.regform.zip.value=="Enter Zip code")
	{
	 error_msg=1;
	 error_msg6="Enter Zip code";
	
	 document.getElementById('zip').style.color="#f7290e";
	 document.getElementById('zip').value=error_msg6;
	}
	
	if(document.regform.phone.value=="" ||document.regform.phone.value=="Enter phone number" ||document.regform.phone.value=="Enter valid phone number")
	{
	 error_msg=1;
	 error_msg6="Enter phone number";
	
	 document.getElementById('phone').style.color="#f7290e";
	 document.getElementById('phone').value=error_msg6;
	}
	/*else if(isNaN(document.regform.phone.value))
	{
	  error_msg=1;
	 error_msg7="Enter only digits";

	 document.getElementById('phone').style.color="#f7290e";
	 document.getElementById('phone').value=error_msg7;
	}*/
	else if (document.regform.phone.value.length<10)
	{
	 error_msg=1;
	 error_msg8="Enter valid phone number";
	
	 document.getElementById('phone').style.color="#f7290e";
	 document.getElementById('phone').value=error_msg8;
	}	
	if(isNaN(document.regform.cccardno.value))
	{
	  error_msg=1;
	 error_msg29="Enter only digits";

	// document.getElementById('cccardno').style.color="#f7290e";
	// document.getElementById('cccardno').value=error_msg29;
	 document.getElementById('cccardno_t').innerHTML=error_msg29;
	}
	
	if(document.regform.country.selectedIndex==0)
	{
		
	 error_msg=1;
	 error_msg10="Choose Country";	
	 document.getElementById('cnt').innerHTML=error_msg10;


	}	
	
	
	
	 if(document.regform.state.value=="" || document.regform.state.value=="Enter State")
	{
	 error_msg=1;
	 error_msg15="Enter State";
	
	 document.getElementById('state').style.color="#f7290e";
	 document.getElementById('state').value=error_msg15;

	}
	
	// Billing info
	
	 if(document.regform.cpybill.checked==false)
	{
	 if(document.regform.battn.value=="")
	{
	 error_msg=1;
	 error_msg1="Enter Contact person name";
	
	 document.getElementById('battn').style.color="#f7290e";
	 document.getElementById('battn').value=error_msg1;

	}
	 if(document.regform.bcompany.value=="" ||document.regform.bcompany.value=="Enter billing company name" ||document.regform.bcompany.value=="Enter Company name")
	{
	 error_msg=1;
	 error_msg1="Enter billing company name";
	
	 document.getElementById('bcompany').style.color="#f7290e";
	 document.getElementById('bcompany').value=error_msg1;

	}
	
	
	 if(document.regform.baddr1.value=="" ||document.regform.baddr1.value=="Enter Billing address")
	{
	 error_msg=1;
	 error_msg2="Enter Billing address";
	
	 document.getElementById('baddr1').style.color="#f7290e";
	 document.getElementById('baddr1').value=error_msg2;

	}
	
	
	
	 /* if(document.regform.bfax.value=="" ||document.regform.bfax.value=="Enter Fax number")
	{
	 error_msg=1;
	 error_msg3="Enter Fax number";
	
	 document.getElementById('bfax').style.color="#f7290e";
	 document.getElementById('bfax').value=error_msg3;

	}
	else if(isNaN(document.regform.bfax.value))
	{
	  error_msg=1;
	 error_msg7="Enter only digits";

	 document.getElementById('bfax').style.color="#f7290e";
	 document.getElementById('bfax').value=error_msg7;
	}*/
	
	
	
	
	 if(document.regform.bcity.value=="" || document.regform.bcity.value=="Enter City")
	{
	 error_msg=1;
	 error_msg15="Enter City";
	
	 document.getElementById('bcity').style.color="#f7290e";
	 document.getElementById('bcity').value=error_msg15;

	}
	
	
	
	 if(document.regform.bstate.value=="" || document.regform.bstate.value=="Enter State")
	{
	 error_msg=1;
	 error_msg15="Enter State";
	
	 document.getElementById('bstate').style.color="#f7290e";
	 document.getElementById('bstate').value=error_msg15;

	}
	
	
	if(document.regform.bzip.value=="" ||document.regform.bzip.value=="Enter Zip code")
	{
	 error_msg=1;
	 error_msg6="Enter Zip code";
	
	 document.getElementById('bzip').style.color="#f7290e";
	 document.getElementById('bzip').value=error_msg6;
	}
	
	if(document.regform.bphone.value=="" || document.regform.bphone.value=="Enter phone number")
	{
	 error_msg=1;
	 error_msg6="Enter phone number";
	
	 document.getElementById('bphone').style.color="#f7290e";
	 document.getElementById('bphone').value=error_msg6;
	}
	/*else if(isNaN(document.regform.bphone.value))
	{
	  error_msg=1;
	 error_msg7="Enter only digits";

	 document.getElementById('bphone').style.color="#f7290e";
	 document.getElementById('bphone').value=error_msg7;
	}*/
	else if (document.regform.bphone.value.length<10)
	{
	 error_msg=1;
	 error_msg8="Enter valid phone number";
	
	 document.getElementById('bphone').style.color="#f7290e";
	 document.getElementById('bphone').value=error_msg8;
	}	
	
	if(document.regform.bcountry.value==0)
	{
		//alert("dfsd");
	 error_msg=1;
	 error_msg10="Choose Country";	
	 document.getElementById('bcnt').innerHTML=error_msg10;

	}	
	}
	
	
	//SHIPPING 
	
	 if(document.regform.copy_personnel.checked==false)
	{
	 if(document.regform.sattn.value=="" ||document.regform.sattn.value=="Enter Contact person name" )
	{
	 error_msg=1;
	 error_msg1="Enter Contact person name";
	
	 document.getElementById('sattn').style.color="#f7290e";
	 document.getElementById('sattn').value=error_msg1;

	}
	 if(document.regform.scompany.value=="" ||document.regform.scompany.value=="Enter  company name"||document.regform.scompany.value=="Enter Company name")
	{
	 error_msg=1;
	 error_msg1="Enter  company name";
	
	 document.getElementById('scompany').style.color="#f7290e";
	 document.getElementById('scompany').value=error_msg1;

	}
	
	
	if(document.regform.saddr1.value=="" || document.regform.saddr1.value=="Enter Shipping address")
	{
	 error_msg=1;
	 error_msg2="Enter Shipping address";
	
	 document.getElementById('saddr1').style.color="#f7290e";
	 document.getElementById('saddr1').value=error_msg2;

	}
	
	  if(document.regform.scity.value=="" || document.regform.scity.value=="Enter City" )
	{
	 error_msg=1;
	 error_msg15="Enter City";
	
	 document.getElementById('scity').style.color="#f7290e";
	 document.getElementById('scity').value=error_msg15;

	}
	
	
	
	 if(document.regform.sstate.value=="" ||document.regform.sstate.value=="Enter State")
	{
	 error_msg=1;
	 error_msg15="Enter State";
	
	 document.getElementById('sstate').style.color="#f7290e";
	 document.getElementById('sstate').value=error_msg15;

	}
	
	
	if(document.regform.szip.value=="" || document.regform.szip.value=="Enter Zip code" )
	{
	 error_msg=1;
	 error_msg6="Enter Zip code";
	
	 document.getElementById('szip').style.color="#f7290e";
	 document.getElementById('szip').value=error_msg6;
	}
//var sp1=(/[^0-9.,-]/g, '')
	if(document.regform.sphone.value=="" ||document.regform.sphone.value=="Enter phone number" ||document.regform.sphone.value=="Enter valid phone number")
	{
	 error_msg=1;
	 error_msg6="Enter phone number";
	
	 document.getElementById('sphone').style.color="#f7290e";
	 document.getElementById('sphone').value=error_msg6;
	}
	
	/*else if(isNAN(document.regform.sphone.value))
	{
	  error_msg=1;
	 error_msg7="Enter only digits";

	 document.getElementById('sphone').style.color="#f7290e";
	 document.getElementById('sphone').value=error_msg7;
	}
	*/
	else if (document.regform.sphone.value.length<10)
	{
	 error_msg=1;
	 error_msg8="Enter valid phone number";
	
	 document.getElementById('sphone').style.color="#f7290e";
	 document.getElementById('sphone').value=error_msg8;
	}	
	
	if(document.regform.scountry.value==0)
	{
		//alert("dfsd");
	 error_msg=1;
	 error_msg10="Choose Country";	
	 document.getElementById('scnt').innerHTML=error_msg10;

	}	
	
	
	
	if(document.regform.semail.value=="" ||document.regform.semail.value=="Enter email" || document.regform.semail.value=="Enter valid email")
	{
	 error_msg=1;
	  error_msg4="Enter email";
	
	 document.getElementById('semail').style.color="#f7290e";
	 document.getElementById('semail').value=error_msg4;
	}
	else if(!ck_email1.test(document.regform.semail.value))
	{
	error_msg=1;
	 error_msg5="Enter valid email";
	
	document.getElementById('semail').style.color="#f7290e";
	document.getElementById('semail').value=error_msg5;
	}	
	}
	
	if(error_msg==1)
	{		
	document.getElementById('er').innerHTML="Fill the fields";
											
	return false;
	}
	else
    {
		document.getElementById('er').innerHTML="";
    return true;
	}
 
}


function phone_check(sphone)
{
sphone = sphone.replace(/[^0-9.,-]/g, '');
document.regform.sphone.value=sphone;

}
function phone_bill1(phone)
{
phone = phone.replace(/[^0-9.,-]/g, '');
document.regform.phone.value=phone;

}
function fax_bill1(fax)
{
fax = fax.replace(/[^0-9.,-]/g, '');
document.regform.fax.value=fax;

}
function phone_bill(bphone)
{
bphone = bphone.replace(/[^0-9.,-]/g, '');
document.regform.bphone.value=bphone;

}
function fax_bill(bfax)
{
bfax = bfax.replace(/[^0-9.,-]/g, '');
document.regform.bfax.value=bfax;

}


function clearFname()
{
  if(document.getElementById('fname').value=="Enter your first name")
	{
		document.getElementById('fname').value="";
	
		document.getElementById('fname').style.color="#000";
		
	}
}

function clearLname()
{
  if(document.getElementById('lname').value=="Enter your last name")
	{
		document.getElementById('lname').value="";
		
		document.getElementById('lname').style.color="#000";
		
	}
}

function clremail()
{
  if(document.getElementById('email').value=="Enter email" || document.getElementById('email').value=="Enter valid email" ||document.getElementById('email').value=="Email id Already Exist")
	{
		document.getElementById('email').value="";
	
		document.getElementById('email').style.color="#000";
		
	}
}

function clrsemail()
{
  if(document.getElementById('semail').value=="Enter email" || document.getElementById('semail').value=="Enter valid email" ||document.getElementById('semail').value=="Email id Already Exist")
	{
		document.getElementById('semail').value="";
	
		document.getElementById('semail').style.color="#000";
		
	}
}


function clrpsd()
{
  if(document.getElementById('passwrd').value=="Enter Your password")
	{
		document.getElementById('passwrd').value="chk";
	
		document.getElementById('passwrd').style.color="#000";
		document.getElementById('passwrd').type="password";
		//document.getElementById('city').type='password';
		
	}
}


function clrpsd2()
{
  if(document.getElementById('passwrd1').value=="Retype password" ||document.getElementById('passwrd1').value=="passwords must be equal" )
	{
		document.getElementById('passwrd1').value="";
	
		document.getElementById('passwrd1').style.color="#000";
		document.getElementById('passwrd1').type="password";
		
	}
}

function clrpsd()
{
  if(document.getElementById('passwrd').value=="Enter Your password")
	{
		document.getElementById('passwrd').value="";
	
		document.getElementById('passwrd').style.color="#000";
		document.getElementById('passwrd').type="password";
		
	}
}

function  clearph1()
{
  if(document.getElementById('phone').value=="Enter phone number" || document.getElementById('phone').value=="Enter only digits" || document.getElementById('phone').value=="Enter valid phone number")
	{
		document.getElementById('phone').value="";
	
		document.getElementById('phone').style.color="#000";
		
	}
}

function  clearph2()
{
  if(document.getElementById('bphone').value=="Enter phone number" || document.getElementById('bphone').value=="Enter only digits" || document.getElementById('bphone').value=="Enter valid phone number")
	{
		document.getElementById('bphone').value="";
	
		document.getElementById('bphone').style.color="#000";
		
	}
}

function  clearph3()
{
  if(document.getElementById('sphone').value=="Enter phone number" || document.getElementById('sphone').value=="Enter only digits" || document.getElementById('sphone').value=="Enter valid phone number")
	{
		document.getElementById('sphone').value="";
	
		document.getElementById('sphone').style.color="#000";
		
	}
}

 /*function  clearfax1()
{
  if(document.getElementById('fax').value=="Enter Fax number" || document.getElementById('fax').value=="Enter only digits" )
	{
		document.getElementById('fax').value="";
	
		document.getElementById('fax').style.color="#000";
		
	}
}
function  clearfax2()
{
  if(document.getElementById('bfax').value=="Enter Fax number" || document.getElementById('bfax').value=="Enter only digits" )
	{
		document.getElementById('bfax').value="";
	
		document.getElementById('bfax').style.color="#000";
		
	}
}

 */  function  clrcmpny()
{
  if(document.getElementById('company').value=="Enter Company name")
	{
		document.getElementById('company').value="";
	
		document.getElementById('company').style.color="#000";
		
	}
}

function  clrcmpny2()
{
  if(document.getElementById('bcompany').value=="Enter billing company name")
	{
		document.getElementById('bcompany').value="";
	
		document.getElementById('bcompany').style.color="#000";
		
	}
}

function  clrcmpny3()
{
  if(document.getElementById('scompany').value=="Enter  company name")
	{
		document.getElementById('scompany').value="";
	
		document.getElementById('scompany').style.color="#000";
		
	}
}

function  clrcaddr1()
{
  if(document.getElementById('addr1').value=="Enter Address")
	{
		document.getElementById('addr1').value="";
	
		document.getElementById('addr1').style.color="#000";
		
	}
}

function  clrcaddr2()
{
  if(document.getElementById('baddr1').value=="Enter Billing address")
	{
		document.getElementById('baddr1').value="";
	
		document.getElementById('baddr1').style.color="#000";
		
	}
}


function  clrcaddr3()
{
  if(document.getElementById('saddr1').value=="Enter Shipping address")
	{
		document.getElementById('saddr1').value="";
	
		document.getElementById('saddr1').style.color="#000";
		
	}
}



function  clrcity()
{
  if(document.getElementById('city').value=="Enter City")
	{
		document.getElementById('city').value="";
	
		document.getElementById('city').style.color="#000";
		
		
	}
}

function  clrcity2()
{
  if(document.getElementById('bcity').value=="Enter City")
	{
		document.getElementById('bcity').value="";
	
		document.getElementById('bcity').style.color="#000";
		
	}
}
function  clrcity3()
{
  if(document.getElementById('scity').value=="Enter City")
	{
		document.getElementById('scity').value="";
	
		document.getElementById('scity').style.color="#000";
		
	}
}

function  clrstate()
{
  if(document.getElementById('state').value=="Enter State")
	{
		document.getElementById('state').value="";
	
		document.getElementById('state').style.color="#000";
		
	}
}

function  clrstate2()
{
  if(document.getElementById('bstate').value=="Enter State")
	{
		document.getElementById('bstate').value="";
	
		document.getElementById('bstate').style.color="#000";
		
	}
}

function  clrstate3()
{
  if(document.getElementById('sstate').value=="Enter State")
	{
		document.getElementById('sstate').value="";
	
		document.getElementById('sstate').style.color="#000";
		
	}
}


function  clrzip()
{
  if(document.getElementById('zip').value=="Enter Zip code")
	{
		document.getElementById('zip').value="";
	
		document.getElementById('zip').style.color="#000";
		
	}
}

function  clrzip2()
{
  if(document.getElementById('bzip').value=="Enter Zip code")
	{
		document.getElementById('bzip').value="";
	
		document.getElementById('bzip').style.color="#000";
		
	}
}

function  clrzip3()
{
  if(document.getElementById('szip').value=="Enter Zip code")
	{
		document.getElementById('szip').value="";
	
		document.getElementById('szip').style.color="#000";
		
	}
}


function clrcntry()
{
  document.getElementById('cnt').innerHTML="";
	
}
function clrcreditcard()
{
  document.getElementById('cccardno_t').innerHTML="";
	
}
function clrcntry2()
{
  document.getElementById('bcnt').innerHTML="";
	
}

function clrcntry3()
{
  document.getElementById('scnt').innerHTML="";
	
}


function  clrattn()
{
  if(document.getElementById('battn').value=="Enter Contact person name")
	{
		document.getElementById('battn').value="";
	
		document.getElementById('battn').style.color="#000";
		
	}
}
function  clrattn2()
{
  if(document.getElementById('sattn').value=="Enter Contact person name")
	{
		document.getElementById('sattn').value="";
	
		document.getElementById('sattn').style.color="#000";
		
	}
}

function cleardivv(g)
{
        var dv=g;
		//alert(dv);
		document.getElementById(dv).innerHTML="";
	}	
		
	



function clearHeight()
{
  if(document.getElementById('height').value=="Enter Height")
	{
		document.getElementById('height').value="";
		document.getElementById('height').style.backgroundColor="";
		document.getElementById('height').style.color="#FFF";
		
	}
}







/*function check_fname(nm1)
{
	nm=nm1.replace(/[^a-zA-Z.\s ]/g,'')
	document.regform.name.value=nm;
	document.regform.name.focus();
}
*/
function check_phone(price)
{
	price1=price.replace(/[^0-9.]/g,'')
	document.regform.phone.value=price1;
	document.regform.phone.focus();
}




function contactforms()
{
	//alert("kkkkk");
	var error_msg=0;
	var error_msg1="";
	var error_msg2="";
	var error_msg3="";
	var error_msg4="";
	var error_msg5="";
	var error_msg6 = "";
	var error_msg7 = "";
	var error_msg8 = "";
	var error_msg9 = "";
	var error_msg10 = "";

	
	
	 if(document.contact.name.value=="")
	{
	 error_msg=1;
	 error_msg1="Enter Name";
	 document.getElementById('vname').style.backgroundColor="#c22b4a";
	 document.getElementById('vname').style.color="#fff";
	 document.getElementById('vname') .value=error_msg1;

	}
	
	var ck_email1 = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
	
	if(document.contact.email.value=="")
	{
	 error_msg=1;
	 error_msg2="Enter Email";
	 document.getElementById('vemail').style.backgroundColor="#c22b4a";
	 document.getElementById('vemail').style.color="#fff";
	 document.getElementById('vemail').value=error_msg2;
	}
	else if(!ck_email1.test(document.contact.email.value))
	{
	error_msg=1;
	error_msg3="Enter valid email";
	document.getElementById('vemail').style.backgroundColor="#c22b4a";
	document.getElementById('vemail').style.color="#fff";
	document.getElementById('vemail').value=error_msg3;
	}
	
		if(document.contact.phone.value=="")
	{
	 error_msg=1;
	 error_msg5="Enter phone number";
	 document.getElementById('vphone').style.backgroundColor="#c22b4a";
	 document.getElementById('vphone').style.color="#fff";
	 document.getElementById('vphone').value=error_msg5;
	}
	else if(isNaN(document.contact.phone.value))
	{
	  error_msg=1;
	 error_msg6="Enter only digits";
	 document.getElementById('vphone').style.backgroundColor="#c22b4a";
	 document.getElementById('vphone').style.color="#fff";
	 document.getElementById('vphone').value=error_msg6;
	}
	else if (document.contact.phone.value.length<10)
	{
	error_msg=1;
	 error_msg7="Enter valid phone number";
	 document.getElementById('vphone').style.backgroundColor="#c22b4a";
	 document.getElementById('vphone').style.color="#fff";
	 document.getElementById('vphone').value=error_msg7;
	}
	
	
	
	  if(document.contact.comment.value=="")
	{
	 error_msg=1;
	 error_msg11="Enter Comment";
	 document.getElementById('vcomment').style.backgroundColor="#c22b4a";
	 document.getElementById('vcomment').style.color="#fff";
	 document.getElementById('vcomment').value=error_msg11;
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





function clearComment()
{
  if(document.getElementById('vcomment').value=="Enter Comment")
	{
		document.getElementById('vcomment').value="";
		document.getElementById('vcomment').style.backgroundColor="";
		document.getElementById('vcomment').style.color="#FFF";
		
	}
}

function ck_fname(price)
{
	price1=price.replace(/[^a-zA-Z.]/g,'')
	document.contact.fname.value=price1;
	document.contact.fname.focus();
	
}



function check_name(price)
{
	price1=price.replace(/[^a-zA-Z.]/g,'')
	document.contact.fname.value=price1;
	document.contact.fname.focus();
}



	$(document).ready( function() {
	
		// When site loaded, load the Popupbox First
        $('#cpybill').click(function()
        {
            
              if(this.checked==true)
              {
          	 
             
              billing();  
              }
			  else
			  {clearbilling();}
        });
		
		
 });

$(document).ready( function() {
	
		// When site loaded, load the Popupbox First
        $('#copy_personnel').click(function()
        {
            
              if(this.checked==true)
              {
          	 
             
              shipping();
              }
			  else
			  {clearshipping();}
        });
		
		
 });
 function billing()
 {
	 document.getElementById('battn').value= document.getElementById('fname').value +" " + document.getElementById('lname').value ;
	 document.getElementById('bcompany').value= document.getElementById('company').value;
	 document.getElementById('baddr1').value= document.getElementById('addr1').value;
	 document.getElementById('baddr2').value= document.getElementById('addr2').value;
	 document.getElementById('bcity').value= document.getElementById('city').value;
	 document.getElementById('bstate').value= document.getElementById('state').value;
	 document.getElementById('bzip').value= document.getElementById('zip').value;
	 document.getElementById('bphone').value= document.getElementById('phone').value;
	 document.getElementById('bfax').value= document.getElementById('fax').value;
	 document.getElementById('bcountry').value= document.getElementById('country').value;
 }
 
function clearbilling()
{
	document.getElementById('battn').value="";
	 document.getElementById('bcompany').value="";
	 document.getElementById('baddr1').value="";
	 document.getElementById('baddr2').value="";
	 document.getElementById('bcity').value="";
	 document.getElementById('bstate').value="";
	 document.getElementById('bzip').value="";
	 document.getElementById('bphone').value="";
	 document.getElementById('bfax').value="";
	 document.getElementById('bcountry').value=0;
	}
	
	
	function shipping()
 {
	 document.getElementById('sattn').value= document.getElementById('fname').value +" " + document.getElementById('lname').value ;
	 document.getElementById('scompany').value= document.getElementById('company').value;
	 document.getElementById('saddr1').value= document.getElementById('addr1').value;
	 document.getElementById('saddr2').value= document.getElementById('addr2').value;
	 document.getElementById('scity').value= document.getElementById('city').value;
	 document.getElementById('sstate').value= document.getElementById('state').value;
	 document.getElementById('szip').value= document.getElementById('zip').value;
	 document.getElementById('sphone').value= document.getElementById('phone').value;
	 document.getElementById('semail').value= document.getElementById('email').value;
	 document.getElementById('scountry').value= document.getElementById('country').value;
 }
 function clearshipping()
{
	document.getElementById('sattn').value="";
	 document.getElementById('scompany').value="";
	 document.getElementById('saddr1').value="";
	 document.getElementById('saddr2').value="";
	 document.getElementById('scity').value="";
	 document.getElementById('sstate').value="";
	 document.getElementById('szip').value="";
	 document.getElementById('sphone').value="";
	 document.getElementById('semail').value= "";
	 document.getElementById('scountry').value=0;
	}
	