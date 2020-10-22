function qvalidate_qtn()
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
		var error_msg30 = "";
	//alert("hfghfg");
	
	
	
	var ck_email1 = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
	
	
	// Billing info
	
	
	 if(document.regform.battn.value=="")
	{
		//alert(document.regform.battn.value);
	 error_msg=1;
	 error_msg1="Enter Contact person name";
	
	 document.getElementById('battn').style.color="#f7290e";
	 document.getElementById('battn').value=error_msg1;

	}
	
	/* if (document.regform.fedex_accnt.value!="" && document.regform.fedex_accnt.value.length<9)
	{
	 error_msg=1;
	 error_msg30="Enter valid Fedex number";
	
	 document.getElementById('fedex_accnt').style.color="#f7290e";
	 document.getElementById('fedex_accnt').value=error_msg30;
	}	
		else if(isNaN(document.regform.fedex_accnt.value))
	{
	  error_msg=1;
	 error_msg7="Enter only digits";

	 document.getElementById('fedex_accnt').style.color="#f7290e";
	 document.getElementById('fedex_accnt').value=error_msg7;
	}
	
	if (document.regform.fedex_accnt.value!="")
	{
	 if(document.regform.fedex_accnt.value=="123456789" || document.regform.fedex_accnt.value=="987654321" || document.regform.fedex_accnt.value=="012345678" || document.regform.fedex_accnt.value=="111111111"|| document.regform.fedex_accnt.value=="222222222" || document.regform.fedex_accnt.value=="333333333"|| document.regform.fedex_accnt.value=="444444444"|| document.regform.fedex_accnt.value=="555555555"|| document.regform.fedex_accnt.value=="666666666"|| document.regform.fedex_accnt.value=="777777777"|| document.regform.fedex_accnt.value=="888888888"|| document.regform.fedex_accnt.value=="999999999"|| document.regform.fedex_accnt.value=="000000000")
	{
	  error_msg=1;
	 error_msg7="Enter valid Account number";

	 document.getElementById('fedex_accnt').style.color="#f7290e";
	 document.getElementById('fedex_accnt').value=error_msg7;
	}
	
	}
	*/
	
	
	 if(document.regform.bcompany.value=="")
	{
	 error_msg=1;
	 error_msg1="Enter billing company name";
	
	 document.getElementById('bcompany').style.color="#f7290e";
	 document.getElementById('bcompany').value=error_msg1;

	}
	
	
	 if(document.regform.baddr1.value=="")
	{
	 error_msg=1;
	 error_msg2="Enter Billing address";
	
	 document.getElementById('baddr1').style.color="#f7290e";
	 document.getElementById('baddr1').value=error_msg2;

	}
	
	
	
	 if(document.regform.bfax.value=="")
	{
	 error_msg=1;
	 error_msg3="Enter Fax number";
	
	 document.getElementById('bfax').style.color="#f7290e";
	 document.getElementById('bfax').value=error_msg3;

	}
	/*else if(isNaN(document.regform.bfax.value))
	{
	  error_msg=1;
	 error_msg7="Enter only digits";

	 document.getElementById('bfax').style.color="#f7290e";
	 document.getElementById('bfax').value=error_msg7;
	}
	
	*/
	
	
	 if(document.regform.bcity.value=="")
	{
	 error_msg=1;
	 error_msg15="Enter City";
	
	 document.getElementById('bcity').style.color="#f7290e";
	 document.getElementById('bcity').value=error_msg15;

	}
	
	
	
	 if(document.regform.bstate.value=="")
	{
	 error_msg=1;
	 error_msg15="Enter State";
	
	 document.getElementById('bstate').style.color="#f7290e";
	 document.getElementById('bstate').value=error_msg15;

	}
	
	
	if(document.regform.bzip.value=="")
	{
	 error_msg=1;
	 error_msg6="Enter Zip code";
	
	 document.getElementById('bzip').style.color="#f7290e";
	 document.getElementById('bzip').value=error_msg6;
	}
	
	if(document.regform.bphone.value=="")
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

	
	

	
	
	//SHIPPING 
	
	 if(document.regform.sattn.value=="")
	{
	 error_msg=1;
	 error_msg1="Enter Contact person name";
	
	 document.getElementById('sattn').style.color="#f7290e";
	 document.getElementById('sattn').value=error_msg1;

	}
	 if(document.regform.scompany.value=="")
	{
	 error_msg=1;
	 error_msg1="Enter  company name";
	
	 document.getElementById('scompany').style.color="#f7290e";
	 document.getElementById('scompany').value=error_msg1;

	}
	
	
	if(document.regform.saddr1.value=="")
	{
	 error_msg=1;
	 error_msg2="Enter Shipping address";
	
	 document.getElementById('saddr1').style.color="#f7290e";
	 document.getElementById('saddr1').value=error_msg2;

	}
	
	  if(document.regform.scity.value=="")
	{
	 error_msg=1;
	 error_msg15="Enter City";
	
	 document.getElementById('scity').style.color="#f7290e";
	 document.getElementById('scity').value=error_msg15;

	}
	
	
	
	 if(document.regform.sstate.value=="")
	{
	 error_msg=1;
	 error_msg15="Enter State";
	
	 document.getElementById('sstate').style.color="#f7290e";
	 document.getElementById('sstate').value=error_msg15;

	}
	
	
	
	
	if(document.regform.szip.value=="")
	{
	 error_msg=1;
	 error_msg6="Enter Zip code";
	
	 document.getElementById('szip').style.color="#f7290e";
	 document.getElementById('szip').value=error_msg6;
	}
	
	if(document.regform.sphone.value=="")
	{
	 error_msg=1;
	 error_msg6="Enter phone number";
	
	 document.getElementById('sphone').style.color="#f7290e";
	 document.getElementById('sphone').value=error_msg6;
	}
/*	else if(isNaN(document.regform.sphone.value))
	{
	  error_msg=1;
	 error_msg7="Enter only digits";

	 document.getElementById('sphone').style.color="#f7290e";
	 document.getElementById('sphone').value=error_msg7;
	}*/
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
	
	
	
	if(document.regform.semail.value=="")
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
	
	
	if(error_msg==1)
	{		
 document.getElementById('fedex_accnt').focus();
											
	return false;
	}
	else
    {
		
    return true;
	}
 
}

function phone_check(sphone)
{
sphone = sphone.replace(/[^0-9.,-.,x]/g, '');
document.regform.sphone.value=sphone;

}
function phone_bill(bphone)
{
bphone = bphone.replace(/[^0-9.,-.,x]/g, '');
document.regform.bphone.value=bphone;

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
  if(document.getElementById('email').value=="Enter email" || document.getElementById('email').value=="Enter valid email")
	{
		document.getElementById('email').value="";
	
		document.getElementById('email').style.color="#000";
		
	}
}

function clrsemail()
{
  if(document.getElementById('semail').value=="Enter email" || document.getElementById('semail').value=="Enter valid email")
	{
		document.getElementById('semail').value="";
	
		document.getElementById('semail').style.color="#000";
		
	}
}


function clrbemail()
{
  if(document.getElementById('bemail').value=="Enter email" || document.getElementById('bemail').value=="Enter valid email")
	{
		document.getElementById('bemail').value="";
	
		document.getElementById('bemail').style.color="#000";
		
	}
}

function clrpsd()
{
  if(document.getElementById('passwrd').value=="Enter Your password")
	{
		document.getElementById('passwrd').value="";
	
		document.getElementById('passwrd').style.color="#000";
		
	}
}

function clrponum()
{
  if(document.getElementById('po_num').value=="Enter PO #")
	{
		document.getElementById('po_num').value="";
	
		document.getElementById('po_num').style.color="#000";
		
	}
}


function clrpsd2()
{
  if(document.getElementById('passwrd1').value=="Retype password" ||document.getElementById('passwrd1').value=="passwords must be equal" )
	{
		document.getElementById('passwrd1').value="";
	
		document.getElementById('passwrd1').style.color="#000";
		
	}
}

function clrpsd()
{
  if(document.getElementById('passwrd').value=="Enter Your password")
	{
		document.getElementById('passwrd').value="";
	
		document.getElementById('passwrd').style.color="#000";
		
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

function  clearfax1()
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

function  clrcmpny()
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
function clrcntry2()
{
  document.getElementById('bcnt').innerHTML="";
	
}

function clrcntry3()
{
  document.getElementById('scnt').innerHTML="";
	
}

function clrfx()
{
  if(document.getElementById('fedex_accnt').value=="Enter valid Fedex number" || document.getElementById('fedex_accnt').value=="Enter Fedex number" || document.getElementById('fedex_accnt').value=="Enter only digits")
	{
		document.getElementById('fedex_accnt').value="";
	
		document.getElementById('fedex_accnt').style.color="#000";
		
	}
}
/*
function clrshp()
{
	document.getElementById('fedx').innerHTML="";
}*/
function  clrattn2()
{
  if(document.getElementById('sattn').value=="Enter Contact person name")
	{
		document.getElementById('sattn').value="";
	
		document.getElementById('sattn').style.color="#000";
		
	}
}
function  clrattn()
{
  if(document.getElementById('battn').value=="Enter Contact person name")
	{
		document.getElementById('battn').value="";
	
		document.getElementById('battn').style.color="#000";
		
	}
}


function cleardivv(g)
{
        var dv=g;
		//alert(dv);
		document.getElementById(dv).innerHTML="";
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

function acc_check(x)
{
	var radios = document.regform.fedex_service;
	//alert(radios);
	if(x == "")
	{
		
for (var i = 0; i < radios.length; i++) 
    {
  //radios[i].disabled = true;
	}	
	}
	else
	{
	for (var i = 0; i < radios.length; i++) 
    {
 // radios[i].disabled = false;	
	}
	}
		
}



function mod10( cardNumber ) { // LUHN Formula for validation of credit card numbers.
    var ar = new Array( cardNumber.length );
    var i = 0,sum = 0;


    for( i = 0; i < cardNumber.length; ++i ) {
        ar[i] = parseInt(cardNumber.charAt(i));
    }
    for( i = ar.length -2; i >= 0; i-=2 ) { // you have to start from the right, and work back.
        ar[i] *= 2;							 // every second digit starting with the right most (check digit)
        if( ar[i] > 9 ) ar[i]-=9;			 // will be doubled, and summed with the skipped digits.
    }										 // if the double digit is > 9, ADD those individual digits together 


    for( i = 0; i < ar.length; ++i ) {
        sum += ar[i];						 // if the sum is divisible by 10 mod10 succeeds
    }
    return (((sum%10)==0)?true:false);	 	
}



function expired( month, year ) {
    var now = new Date();							// this function is designed to be Y2K compliant.
    var expiresIn = new Date(year,month,0,0,0);		// create an expired on date object with valid thru expiration date
    expiresIn.setMonth(expiresIn.getMonth()+1);		// adjust the month, to first day, hour, minute & second of expired month
    if( now.getTime() < expiresIn.getTime() ) return false;
    return true;									// then we get the miliseconds, and do a long integer comparison
}