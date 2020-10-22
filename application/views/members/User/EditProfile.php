     
<?php
$countryvalue=array("US","AL","DZ","AS","AO","AI","AG","AR","AM","AW","AU","AT","AZ","BS","BH","BD","BB","BY","BE","BZ","BJ","BM","BT",
"BO","BL","BA","BW","BR","VG","BN","BG","BF","BI","KH","CM","CA","CV","KY","TD","CL","CN","CO","CG","CK","CR","HR","CB","CY","CZ","DK",
"DJ","DM","DO","EC","EG","SV","EE","ET","FJ","FI","FR","GF","PF","GA","GM","GE","DE","GH","GI","GR","GD","GP","GU","GT","GN","GW","GY",
"HT","HN","HK","HU","IS","IN","ID","IE","IL","IT","CI","JM","JP","JO","KZ","KE","KI","XK","XE","KW","KG","LA","LV","LB","LS","LT","LU","MK","MG",
"MW","MY","MV","ML","MT","MH","MQ","MR","MU","MX","MD","MN","MS","MA","MZ","NP","NL","NC","NZ","NI","NE","NG","MP","NO","OM","PK",
"PW","PA","PG","PY","PE","PH","PL","XP","PT","PR","QA","RE","RO","XC","RU","RW","XS","SA","SN","CS","SC","SG","SK","SI","SB","ZA","KR",
"ES","LK","NT","VI","EU","VI","KN","LC","MB","VI","VC","SR","SZ","SE","CH","SY","TJ","TW","TZ","TH","XN","TG","TO","VG","TT","XA","TN",
"TR","TM","TC","TV","UG","UA","VC","AE","GB","UY","VI","UZ","VU","VE","VN","VG","WF","WS","XY","YE","ZM","ZW");

$countryname=array("United States","Albania","Algeria","American Samoa",
"Angola","Anguilla","Antigua","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan",
"Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia",
"Bonaire","Bosnia Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi",
"Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Chad","Chile","China","Colombia","Congo",
"Cook Islands","Costa Rica","Croatia","Curacao","Cyprus","Czech Republic",
"Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Estonia","Ethiopia","Fiji","Finland",
"France","French Guiana","French Polynesia",
"Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Grenada","Guadeloupe",
"Guam","Guatemala","Guinea","Guinea Bissau","Guyana",
"Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Ireland (Republic of)","Israel","Italy","Ivory Coast",
"Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo",
"Kosrae Island","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Lithuania","Luxembourg",
"Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta",
"Marshall Islands","Martinique","Mauritania","Mauritius","Mexico","Moldova","Mongolia","Montserrat","Morocco","Mozambique",
"Nepal","Netherlands","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Northern Mariana Islands","Norway",
"Oman","Pakistan","Palau","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Ponape","Portugal","Puerto Rico",
"Qatar","Reunion","Romania","Rota","Russia","Rwanda","Saipan","Saudi Arabia","Senegal","Serbia and Montenegro","Seychelles","Singapore",
"Slovakia","Slovenia","Solomon Islands","South Africa","South Korea","Spain","Sri Lanka","St. Barthelemy","St. Croix","St. Eustatius",
"St. John","St. Kitts and Nevis","St. Lucia","St. Maarten","St. Thomas","St. Vincent and the Grenadines",
"Suriname","Swaziland","Sweden","Switzerland","Syria","Tadjikistan","Taiwan","Tanzania","Thailand","Tinian","Togo","Tonga","Tortola",
"Trinidad and Tobago","Truk","Tunisia","Turkey","Turkmenistan","Turks and Caicos","Tuvalu","Uganda","Ukraine","Union Island",
"United Arab Emirates","United Kingdom","Uruguay","US Virgin Islands","Uzbekistan","Vanuatu","Venezuela","Vietnam",
"Virgin Gorda","Wallis and Futuna","Western Samoa","Yap","Yemen","Zambia","Zimbabwe");

if(!empty($GetAllUserDetails)){
foreach ($GetAllUserDetails as $g) {
    $title = $g->title;
    $firstName = $g->first_name;
    $lastName = $g->last_name;
	$tel=$g->tel;
	$fax=$g->fax;
	$email=$g->email;
	$company1=$g->company;
	$address1=$g->address_1;
	$address2 = $g->address_2;
	$city=$g->city;
	$state=$g->state;
	$zip=$g->zip;
	$country=$g->country;
	$Onmaillist=$g->on_email_list;
	$tax_exempt = $g->tax_exempt;
	$billingname=$g->billing_name;
	$billin_co_name = $g->billing_co_name;
	$bill_address=$g->billing_address_1;
	$bill_address2=$g->billing_address_2;
	$bill_city=$g->billing_city;
	$bill_state=$g->billing_state;
	$bill_zip=$g->billing_zip;
	$bill_country= $g->billing_country;
	$bill_tel=$g->billing_tel;
	$bill_fax=$g->billing_fax;
	$sname=$g->shipping_name;
	$scname=$g->shipping_co_name;
	$sadd1=$g->shipping_address_1;
	$sadd2 = $g->shipping_address_2;
	$scity=$g->shipping_city;
	$sstate=$g->shipping_state;
	$szip=$g->shipping_zip;
	$scountry=$g->shipping_country;
	$stel=$g->shipping_tel;
	$semail=$g->shipping_email;

}}
?>
<script src='https://www.google.com/recaptcha/api.js' async defer>
</script>
<form action="/User/profileEdit" method="post" name="regform" id="regform">
	<section class="content-right">
		<article class="content-right-btm" style="margin-top:0px;">
			<div class="new-products" style="margin-top:0px;">
				<div class="new-products-title">
					<h1>
						<span>
							Account Info
						</span>
					</h1>
				</div>
				<div class="new-products-list">
					<?php
						//get flashdata
						$r = $this->session->flashdata('response');
						if(isset($r)){
					?>
					<p style="font-color:red;">
						<?php 
							echo $r['Message']
						?>
					</p>
					<?php 
						} 
					?>

					<div class="reg_left">
					</div>
					<input type="hidden" name="personID" value="<?php echo isset($personIDA)?$personIDA:'';?>">
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Account Email <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<input name="email" id="email"  value="<?php echo isset($email)?$email:'';?>"  type="text" required>
						</div>
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Password <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<a href="/user/changepassword">
								Change Password
							</a>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Title 
							</p>
						</div>
						<div class="reg_b">
							<input name="title" value="<?php echo isset($title)?$title:'';?>" id="title" type="text">
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								First_name <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<input name="fname" id="fname" type="text"  value="<?php echo isset($firstName)?$firstName:'';?>" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Last_name <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<input name="lname" id="lname" type="text"  value="<?php echo isset($lastName)?$lastName:'';?>" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left_center">
						<div class="reg_a_center" >
							<p>
								Would you like to be included in the mailing list for  product news? (Optional):
							</p>
						</div>
						<div class="reg_b_center_jump">
							<select name="inlist" id="inlist"  >
								<option value="Yes" <?php if(isset($Onmaillist) && $Onmaillist=="Yes"){echo "selected='selected'";}?>>
									Yes
								</option>
								<option value="No" <?php if(isset($Onmaillist) && $Onmaillist=="No"){echo "selected='selected'";}?>>
									No
								</option>
							</select>

						</div>
					</div>
					<!-- <div class="clear"> </div>
					<div class="reg_left_single"  style="padding-left:160px;">
					<div class="reg_a_single"><p>Default Credit Card Account (Optional) </p></div>
					</div>

					<div class="clear"> </div>
					<div class="reg_left">
					<div class="reg_a"><p>Credit Card Type</p></div><div class="reg_b">

						<select name="cc_cardtype" id="cc_cardtype"  class="reg_b_jump">
						   <?php
						$thiscat= isset($cctype)?$cctype:'';
						//echo $thiscat;
						?>
						<option value="0">--- Choose Card ---</option>
						  
						  <option value="Master Card" <?php if($thiscat=="Master Card"){?> selected <?php }?>>Master Card</option>
						  <option value="American Express"<?php if($thiscat=="American Express"){?> selected <?php }?>>American Express</option>
						  <option value="Visa"<?php if($thiscat=="Visa"){?> selected <?php }?>>Visa</option>
						  <option value="Discover Card"<?php if($thiscat=="Discover Card"){?> selected <?php }?>>Discover Card</option>
						   </select>

					</div>
					</div>
					<div class="clear"> </div>
					<div class="reg_left">
					<div class="reg_a"><p>Credit Card Number</p></div><div class="reg_b"><input name="cccardno" id="cccardno" type="text" value="<?php //echo $row1['cc_numb']; ?>" onFocus="clrcreditcard()">

					<input name="cccardno" type="text" value="<?php echo isset($cc_numb)?($cc_numb):'';?>" ><div id="cccardno_t" class="errcls"></div>
					</div>
					</div>
					<div class="clear"> </div>
					<div class="reg_left">
					<div class="reg_a"><p>Card Holder Name</p></div><div class="reg_b"><input value="<?php echo isset($ccname)?$ccname:'';?>" name="cchname" id="cchname" type="text"></div>
					</div>
					<div class="clear"> </div>
					<div class="reg_left">
					<div class="reg_a"><p>Expiration Month</p></div><div class="reg_b">

						<select name="exmonth" id="exmonth" class="reg_b_jump">
					   
						<?php
						$cmonth= isset($expMonth)?$expMonth:'';
						$em=array("01","02","03","04","05","06","07","08","09","10","11","12");
					  for ($i=0;$i<12;$i++){
						echo "<option value=".$em[$i];
						if ($cmonth==$em[$i]){
						  echo " selected";
						}
						echo ">".$em[$i];
					  } ?>
						</select>

					</div>
					</div>
					<div class="clear"> </div>
					<div class="reg_left">
					<div class="reg_a"><p>Expiration Year</p></div><div class="reg_b">
						<select name="expyear" id="expyear"  class="reg_b_jump">
						  <?php
						$thiscat1= isset($expYear)?$expYear:'';
						echo $thiscat1;
						?>
					   <?php $current_year=date("Y");
					   $limit=$current_year+7; ?>
						  <option value="0"> --- Choose --- </option>
						  <?php  for($i=$current_year;$i<=$limit;$i++)
						  { ?>
						  <option value="<?php echo $i;?>"<?php if($thiscat1=="$i"){?> selected <?php }?>><?php echo $i;?></option>
						<?php } ?>
						 
						</select>

					</div>
					</div>
					<div class="clear"> </div>
					<div class="reg_left">
					<div class="reg_a"><p>3 or 4-digit CVV code</p></div><div class="reg_b"><input name="cvv" id="cvv" type="text" value="<?php echo isset($cc_scv)?$cc_scv:'';?>"></div>
					</div> -->
					<div class="clear">
					</div>

					<div class="reg_left_single">
						<div class="reg_a_single">
							<p>
								Default Billing Address:
							</p>
						</div>
						<div class="reg_b_single">
							<input name="cpy" id="cpybill" type="checkbox" >
								<p>
									Copy from personal info
								</p>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Attn <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<input value="<?php echo isset($billingname)?$billingname:'';?>"name="battn" id="battn" type="text" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Company Name <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<input name="bcompany" id="bcompany" type="text" value="<?php echo isset($billin_co_name)?$billin_co_name:'';?>" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Address 1 <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<input name="baddr1" id="baddr1" type="text" value="<?php echo isset($bill_address)?$bill_address:'';?>" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Address 2 
							</p>
						</div>
						<div class="reg_b">
							<input name="baddr2" id="baddr2" type="text" value="<?php echo isset($bill_address2)?$bill_address2:'';?>">
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								City <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<input name="bcity" id="bcity" type="text" value="<?php echo isset($bill_city)?$bill_city:'';?>" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								State <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<input name="bstate" id="bstate" type="text" value="<?php echo isset($bill_state)?$bill_state:'';?>" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Bill to Zip <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<input name="bzip" id="bzip" type="text" value="<?php echo isset($bill_zip)?$bill_zip:'';?>" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Country <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<select name="bcountry" id="bcountry"  class="reg_b_jump" onChange="clrcntry2()" required>
								<option value="0">
									--- Choose country --- 
								</option>
								<?php
									$bcountry= isset($bill_country)?$bill_country:'';
									for ($i=0;$i<count($countryname);$i++)
									{									
										if($bcountry == $countryname[$i])
										{
											echo "<option selected value=\"".$countryname[$i]."\">".$countryname[$i];											
										}
										else
										{
											echo "<option value=\"".$countryname[$i]."\">".$countryname[$i];
										}
									}
								?>
							</select>					  
						</div>
						<div id="bcnt" class="errcls">
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Tel <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<input name="bphone" value="<?php echo isset($bill_tel)?$bill_tel:'';?>" id="bphone" type="text" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Fax
							</p>
						</div>
						<div class="reg_b">
							<input name="bfax" value="<?php echo isset($bill_fax)?$bill_fax:'';?>" id="bfax" type="text" >
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left_single">
						<div class="reg_a_single">
							<p>
								Default Shipping Address:
							</p>
						</div>
						<div class="reg_b_single">
							<input name="copy_personnel" id="copy_personnel" type="checkbox" >
							<p>
								Copy from personal info
							</p>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Attn <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<input name="sattn" id="sattn" value="<?php echo isset($sname)?$sname:'';?>" type="text" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Company Name <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<input name="scompany" id="scompany" value="<?php echo isset($scname)?$scname:'';?>" type="text" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Address 1 <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<input name="saddr1" id="saddr1" value="<?php echo isset($sadd1)?$sadd1:'';?>" type="text" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Address 2
							</p>
						</div>
						<div class="reg_b">
							<input name="saddr2" id="saddr2" value="<?php echo isset($sadd2)?$sadd2:'';?>" type="text">
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								City <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<input name="scity" id="scity" value="<?php echo isset($scity)?$scity:'';?>" type="text" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								State <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<input name="sstate" id="sstate" value="<?php echo isset($sstate)?$sstate:'';?>" type="text" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Ship To Zip <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<input name="szip" id="szip" value="<?php echo isset($szip)?$szip:'';?>" type="text" >
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Country <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<select name="scountry" id="scountry"  class="reg_b_jump" onChange="clrcntry3()" required>
								 <option value="0">
									 --- Choose country --- 
								 </option>
								 <?php
									$scountry= isset($scountry)?$scountry:'';
									for ($i=0;$i<count($countryname);$i++)
									{
										if($scountry == $countryname[$i])
										{
											echo "<option selected value=\"".$countryname[$i]."\">".$countryname[$i];
										}
										else
										{
											echo "<option value=\"".$countryname[$i]."\">".$countryname[$i];
										}
									}
								?>
							</select>
						</div>
						<div id="scnt" class="errcls">
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Tel <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<input name="sphone" id="sphone" type="text"  value="<?php echo isset($stel)?$stel:'';?>" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Email <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<input name="semail" id="semail" type="text" value="<?php echo isset($semail)?$semail:'';?>" required>
						</div>
					</div>				
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>Tax Exempt ID</p>
						</div>
						<div class="reg_b">
							<input name="tax_exempt" id="tax_exempt" type="text" value="<?php echo isset($tax_exempt)?$tax_exempt:'';?>">
						</div>
					</div>				
					<div class="clear"></div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Please fill out this field <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<!--
							<?php 
								echo isset($captchaimage)?$captchaimage:'';
							?> 
							-->
							<div class="g-recaptcha" data-size="compact" data-sitekey="<?php echo $capcha_site_id;?>">
							</div>
							<!--
							<div class="g-recaptcha" data-sitekey="<?php echo $capcha_site_id;?>" data-badge="inline" data-size="invisible" data-callback="setResponse">
							</div>
							-->
						</div>
					</div>					
					<div class="clear">
					</div>
					<div class="reg_left_bottom">
						<p>
							Please check all your account information carefully, before you press Submit button.
						</p>
					</div>
					<div id="er" class="errcls">
					</div>
					<div class="reg_left_btn">
						<input name="eest"  type="reset" value="Reset" class="button" style="color: red;">
						&nbsp;
						&nbsp;
						&nbsp;
						&nbsp;
						<input name="register" type="submit" value="Submit" class="button">
					</div>
					<br>
					<div class="clear">
					</div>
				</div>
			</div>
		</article>
	</section>
</form>
<script type="text/javascript">
  $("form#regform").submit(function(event) {

   var recaptcha = grecaptcha.getResponse();
   if (recaptcha === "") {
      event.preventDefault();
      alert("Please check the recaptcha");
   }
});
</script>
<script type="text/javascript">
    $('#cpybill').click(function() {
    if ($(this).is(':checked')) {
        var fullname = $("#fname").val() +' '+ $("#lname").val();
        var companyname = $("#company").val();
        var addr1 = $("#addr1").val();
        var addr2 = $("#addr2").val();
        var city = $("#city").val();
        var state = $("#state").val();
        var country = $("#country").val();
        var zip = $("#zip").val();
        var tel = $("#phone").val();
        var fax = $("#fax").val();
        copybill(fullname,companyname,addr1,addr2,city,state,country,zip,tel,fax);
    }else{
        var fullname = "";
        var companyname = "";
        var addr1 = "";
        var addr2 = "";
        var city = "";
        var state = "";
        var country = "";
        var zip = "";
        var tel = "";
        var fax = "";
        copybill(fullname,companyname,addr1,addr2,city,state,country,zip,tel,fax);
    }
  });
    function copybill(fullname,companyname,addr1,addr2,city,state,country,zip,tel,fax){
      $("#battn").val(fullname);
      $("#bcompany").val(companyname);
      $("#baddr1").val(addr1);
      $("#baddr2").val(addr2);
      $("#bcity").val(city);
      $("#bstate").val(state);
     // $("#bcountry").val(country);
      $('#bcountry').val(country).prop('selected', true);
      $("#bzip").val(zip);
      $("#bphone").val(tel);
      $("#bfax").val(fax);

    }
    $('#copy_personnel').click(function() {
    if ($(this).is(':checked')) {
        var email = $("#email").val();
        var fullname = $("#fname").val() +' '+ $("#lname").val();
        var companyname = $("#bcompany").val();
        var addr1 = $("#baddr1").val();
        var addr2 = $("#baddr2").val();
        var city = $("#bcity").val();
        var state = $("#bstate").val();
        var country = $("#bcountry").val();
        var zip = $("#bzip").val();
        var tel = $("#bphone").val();
        var fax = $("#bfax").val();
        copysbill(fullname,companyname,addr1,addr2,city,state,country,zip,tel,fax,email);
    }else{
        var email = "";
        var fullname = "";
        var companyname = "";
        var addr1 = "";
        var addr2 = "";
        var city = "";
        var state = "";
        var country = "";
        var zip = "";
        var tel = "";
        var fax = "";
        copysbill(fullname,companyname,addr1,addr2,city,state,country,zip,tel,fax,email);
    }
  });
    function copysbill(fullname,companyname,addr1,addr2,city,state,country,zip,tel,fax,email){
      $("#sattn").val(fullname);
      $("#scompany").val(companyname);
      $("#saddr1").val(addr1);
      $("#saddr2").val(addr2);
      $("#scity").val(city);
      $("#sstate").val(state);
      //$("#bcountry").val(country);
      $('#scountry').val(country).prop('selected', true);
      $("#szip").val(zip);
      $("#sphone").val(tel);
      $("#sfax").val(fax);
      $("#semail").val(email);
    }
</script>