<script src='https://www.google.com/recaptcha/api.js' async defer>
</script>
<form action="/user/register" method="post" name="regform" id="regform">
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
					<div style="padding: 15px;">
						<p>
							<?php 
								echo isset($response)?$response:'';
							?>
						</p>
						<div class="reg_left">
							<div class="reg_a">
							</div>
							<div class="reg_b">
								If you already have an account, please <a href ="/user/login">login</a>.
							</div>
						</div>
						<div class="clear">
						</div>
						<div class="reg_left">
							<div class="reg_a">
								<!--<p>Account ID</p>-->
							</div>
							<div class="reg_b">
								<p>
									New Account 
								</p>
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
								<input name="email" id="email"  value="<?php echo set_value('email'); ?>"   type="email" required='required'>
								<span class="error">
									<?php 
										echo form_error('email'); 
									?>
								</span>
							</div>
						</div>
						<div class="clear">
						</div>
						<div class="reg_left">
							<div class="reg_a">
								<p>
									Account Password <span>*</span>
								</p>
							</div>
							<div class="reg_b">
								<input name="password" id="password" type="password" value="<?php echo set_value('password'); ?>" required='required'>
								<span class="error">
									<?php 
										echo form_error('password'); 
									?>
								</span>
							</div>
						</div>
						<div class="clear">
						</div>
						<div class="reg_left">
							<div class="reg_a">
								<p>
									Confirm Password <span>*</span>
								</p>
							</div>
							<div class="reg_b">
								<input name="confirm_password" id="confirm_password" type="password" value="<?php echo set_value('confirm_password'); ?>" required='required'>
								<span class="error">
									<?php 
										echo form_error('confirm_password'); 
									?>
								</span>
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
								<input name="title" id="title" type="text" value="<?php echo set_value('title'); ?>" >
								<span class="error">
									<?php 
										echo form_error('title'); 
									?>
								</span>
							</div>
						</div>
						<div class="clear">
						</div>
						<div class="reg_left">
							<div class="reg_a">
								<p>
									First name <span>*</span>
								</p>
							</div>
							<div class="reg_b">
								<input name="fname" id="fname" type="text" value="<?php echo set_value('fname'); ?>" required='required'>
								<span class="error">
									<?php 
										echo form_error('fname'); 
									?>
								</span>
							</div>
						</div>
						<div class="clear">
						</div>
						<div class="reg_left">
							<div class="reg_a">
								<p>
									Last name <span>*</span>
								</p>
							</div>
							<div class="reg_b">
								<input name="lname" id="lname" type="text" value="<?php echo set_value('lname'); ?>" required='required'>
								<span class="error">
									<?php 
										echo form_error('lname'); 
									?>
								</span>
							</div>
						</div>
						<div class="clear">
						</div>
						<!--
						<div class="reg_left">
							<div class="reg_a">
								<p>
									Tel <span>*</span>
								</p>
							</div>
							<div class="reg_b">
								<input name="phone"  id="phone" type="text" value="<?php echo set_value('phone'); ?>"  required='required'>
								<span class="error">
									<?php 
										echo form_error('phone'); 
									?>
								</span>
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
								<input name="fax" id="fax" type="text" value="<?php echo set_value('fax'); ?>" >
								<span class="error">
									<?php 
										echo form_error('fax'); 
									?>
								</span>
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
								<input name="company" id="company" type="text" value="<?php echo set_value('company'); ?>" required='required'>
								<span class="error">
									<?php 
										echo form_error('company'); 
									?>
								</span>
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
								<input name="addr1" id="addr1" type="text" value="<?php echo set_value('addr1'); ?>" required='required'>
								<span class="error">
									<?php 
										echo form_error('addr1'); 
									?>
								</span>
							</div>
						</div>
			<div class="clear"> </div>
			<div class="reg_left">
			  <div class="reg_a"><p>Address 2</p></div><div class="reg_b"><input name="addr2" id="addr2" type="text" value="<?php echo set_value('addr2'); ?>">
				<span class="error"><?php echo form_error('addr2'); ?></span>
			  </div>
			</div>
			<div class="clear"> </div>
			<div class="reg_left">
			  <div class="reg_a"><p>City <span>*</span></p></div><div class="reg_b"><input name="city" id="city" type="text" value="<?php echo set_value('city'); ?>" required='required'>
				<span class="error"><?php echo form_error('city'); ?></span>
			  </div>
			</div>
			<div class="clear"> </div>
			<div class="reg_left">
			  <div class="reg_a"><p>State <span>*</span></p></div><div class="reg_b"><input name="state" id="state" type="text" value="<?php echo set_value('state'); ?>" required='required'>
				<span class="error"><?php echo form_error('state'); ?></span>
			  </div>
			</div>
			<div class="clear"> </div>
			<div class="reg_left">
			  <div class="reg_a"><p>Zip <span>*</span></p></div><div class="reg_b"><input name="zip" id="zip" type="text" value="<?php echo set_value('zip'); ?>" required='required'>
				<span class="error"><?php echo form_error('zip'); ?></span>
			  </div>
			</div>
			<div class="clear"> </div>
			<div class="reg_left">
			  <div class="reg_a"><p>Country <span>*</span></p></div>
			  <div class="reg_b">

				<select name="country" id="country" class="reg_b_jump" required='required'>
				  <option value=""> --- Choose country --- </option>
				  <?php
				  for ($i=0;$i<count($countryname);$i++)
				  {
					$country = set_value('country');
					if($country == $countryname[$i])
					{
					  echo "<option selected='selected' value=\"".$countryname[$i]."\">".$countryname[$i];
					}
					else
					{
					  echo "<option value=\"".$countryname[$i]."\">".$countryname[$i];
					}
				  }
				  ?>
				</select>
				<span class="error"><?php echo form_error('country'); ?></span>
			  </div>
			  <div id="cnt" class="errcls"></div>
			</div>
						-->
						<div class="reg_left_center">
							<div class="reg_a_center" >
								<p>
									Would you like to be included in the mailing list for  product news? (Optional)
								</p>
							</div>
							<div class="reg_b_center_jump">
								<select name="inlist" id="inlist">
									<option value="Yes">
										Yes
									</option>
									<option value="No">
										No
									</option>
								</select>
							</div>
						</div>
						<div class="clear">
						</div>

			<!-- <div class="reg_left_single"  style="padding-left:120px;">
			  <div class="reg_a_single"><p>Credit Card Account (Optional)</p></div>
			</div>

			<div class="clear"> </div>
			<div class="reg_left">
			  <div class="reg_a"><p>Credit Card Type</p></div><div class="reg_b">

				<select name="cc_cardtype" id="cc_cardtype"  class="reg_b_jump">

				  <option>--- Choose Card ---</option>

				  <option value="Master Card">Master Card</option>
				  <option value="American Express">American Express</option>
				  <option value="Visa">Visa</option>
				  <option value="Discover Card">Discover Card</option>
				</select>

			  </div>
			</div>
			<div class="clear"> </div>
			<div class="reg_left">
			  <div class="reg_a"><p>Credit Card Number <br />(no dash or space)</p></div><div class="reg_b"><input name="cccardno" id="cccardno" type="text" value="" onFocus="clrcreditcard()"/></div><div id="cccardno_t" class="errcls"></div>
			</div>
			<div class="clear"> </div>
			<div class="reg_left">
			  <div class="reg_a"><p>Card Holder Name</p></div><div class="reg_b"><input name="cchname" id="cchname" type="text" value=""></div>
			</div>
			<div class="clear"> </div>
			<div class="reg_left">
			  <div class="reg_a"><p>Expiration Month</p></div><div class="reg_b">

				<select name="exmonth" id="exmonth" class="reg_b_jump">
				   <option value=""> --- Choose --- </option>
				  <?php $em=array("01","02","03","04","05","06","07","08","09","10","11","12");
				  for ($i=0;$i<12;$i++){
					echo "<option value=".$em[$i];
		// if ($_REQUEST['exp_mo']==$em[$i]){
		//   echo " selected";
		// }
					echo ">".$em[$i];
				  } ?>
				</select>

			  </div>
			</div>
			<div class="clear"> </div>
			<div class="reg_left">
			  <div class="reg_a"><p>Expiration Year</p></div><div class="reg_b">
				<select name="expyear" id="expyear"  class="reg_b_jump">
				 <?php $current_year=date("Y");
				 $limit=$current_year+7; ?>
				 <option value=""> --- Choose --- </option>
				 <?php  for($i=$current_year;$i<=$limit;$i++)
				 { ?>

				   <option value="<?php echo $i;?>"><?php echo $i;?></option>
				 <?php } ?>

			   </select>

			 </div>
		   </div>
		   <div class="clear"> </div>
		   <div class="reg_left">
			<div class="reg_a"><p>3 or 4-digit CVV code</p></div><div class="reg_b"><input name="cvv" id="cvv" type="text" value=""></div>
		  </div> -->
						<div class="clear">
						</div>

						<div class="reg_left_single">
							<div class="reg_a_single">
								<p>
									Default Billing Address
								</p>
							</div>
							<div class="reg_b_single">
								<!--
									<input name="cpy" id="cpybill" type="checkbox" value="Copy">
										<p>
											Copy from personal info
										</p>
								-->
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
								<input name="battn" id="battn" type="text" value="<?php echo set_value('battn'); ?>" required="required" >
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
							<input name="bcompany" id="bcompany" type="text" value="<?php echo set_value('bcompany'); ?>" required="required">
								<span class="error">
									<?php 
										echo form_error('bcompany'); 
									?>
								</span>
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
								<input name="baddr1" id="baddr1" type="text" value="<?php echo set_value('baddr1'); ?>" required="required">
									<span class="error">
										<?php 
											echo form_error('baddr1'); 
										?>
									</span>
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
							<div class="reg_b"><input name="baddr2" id="baddr2"  type="text" value="<?php echo set_value('baddr2'); ?>" >
								<span class="error">
									<?php 
										echo form_error('baddr2'); 
									?>
								</span>
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
								<input name="bcity" id="bcity" type="text" value="<?php echo set_value('bcity'); ?>" required="required">
								<span class="error">
									<?php 
										echo form_error('bcity'); 
									?>
								</span>
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
								<input name="bstate" id="bstate" type="text" value="<?php echo set_value('bstate'); ?>" required="required">
								<span class="error">
									<?php 
										echo form_error('bstate'); 
									?>
							</span>
							</div>
						</div>
						<div class="clear">
						</div>
						<div class="reg_left">
							<div class="reg_a">
								<p>
									Zip <span>*</span>
								</p>
							</div>
							<div class="reg_b">
								<input name="bzip" id="bzip" type="text" value="<?php echo set_value('bzip'); ?>" required="required">
								<span class="error">
									<?php 
										echo form_error('bzip'); 
									?>
								</span>
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
								<select name="bcountry" id="bcountry" class="reg_b_jump" required='required'>
									<option value="">
										 --- Choose country --- 
									</option>
									<?php
										for ($i=0;$i<count($countryname);$i++)
										{
											$country = set_value('bcountry');
											if($country == $countryname[$i])
											{
												echo "<option selected='selected' value=\"".$countryname[$i]."\">".$countryname[$i];
											}
											else
											{
												echo "<option value=\"".$countryname[$i]."\">".$countryname[$i];
											}
										}
									?>
								</select>
								<span class="error">
									<?php 
										echo form_error('bcountry'); 
									?>
								</span>
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
								<input name="bphone" id="bphone" type="text" value="" required="required">
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
								<input name="bfax" id="bfax" type="text" value="">
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
								<input name="copy_personnel" id="copy_personnel" type="checkbox" value="">
								<p>
									Copy from Billing info
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
								<input name="sattn" id="sattn" type="text" value="" required="required">
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
								<input name="scompany" id="scompany" type="text" value="" required="required">
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
								<input name="saddr1" id="saddr1" type="text" value="" required="required">
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
								<input name="saddr2" id="saddr2" type="text" value="" >
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
								<input name="scity" id="scity" type="text" value="" required="required">
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
								<input name="sstate" id="sstate" type="text" value="" required="required">
							</div>
						</div>
						<div class="clear">
						</div>
						<div class="reg_left">
							<div class="reg_a">
								<p>
									Zip <span>*</span>
								</p>
							</div>
							<div class="reg_b">
								<input name="szip" id="szip" type="text" value="" required="required">
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
								<select name="scountry" id="scountry"  class="reg_b_jump" required>
									<option value=""> 
										 --- Choose country --- 
										</option>
										 <?php
											for ($i=0;$i<count($countryname);$i++)
											{

											// if($_SESSION["scountry"] == $countryname[$i])
											// {
											//   echo "<option selected='selected' value=\"".$countryname[$i]."\">".$countryname[$i];
											// }
											// else
											// {
												echo "<option value=\"".$countryname[$i]."\">".$countryname[$i];
											// }
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
								<input name="sphone" id="sphone" type="text" value="" required="required" >
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
								<input name="semail" id="semail" type="text" value="" required="required">
							</div>
						</div>
						<div class="clear">
						</div>
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
							<input class="button" name="register" type="submit" value="Submit">
						</div>
						<div class="clear">
						</div>
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
  //   $('#cpybill').click(function() {
  //   if ($(this).is(':checked')) {
  //       var fullname = $("#fname").val() +' '+ $("#lname").val();
  //       var companyname = $("#company").val();
  //       var addr1 = $("#addr1").val();
  //       var addr2 = $("#addr2").val();
  //       var city = $("#city").val();
  //       var state = $("#state").val();
  //       var country = $("#country").val();
  //       var zip = $("#zip").val();
  //       var tel = $("#phone").val();
  //       var fax = $("#fax").val();
  //       copybill(fullname,companyname,addr1,addr2,city,state,country,zip,tel,fax);
  //   }else{
  //       var fullname = "";
  //       var companyname = "";
  //       var addr1 = "";
  //       var addr2 = "";
  //       var city = "";
  //       var state = "";
  //       var country = "";
  //       var zip = "";
  //       var tel = "";
  //       var fax = "";
  //       copybill(fullname,companyname,addr1,addr2,city,state,country,zip,tel,fax);
  //   }
  // });
  //   function copybill(fullname,companyname,addr1,addr2,city,state,country,zip,tel,fax){
  //     $("#battn").val(fullname);
  //     $("#bcompany").val(companyname);
  //     $("#baddr1").val(addr1);
  //     $("#baddr2").val(addr2);
  //     $("#bcity").val(city);
  //     $("#bstate").val(state);
  //     //$("#bcountry").val(country);
  //     $('#bcountry').val(country).prop('selected', true);
  //     $("#bzip").val(zip);
  //     $("#bphone").val(tel);
  //     $("#bfax").val(fax);

  //   }
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
<!-- <script>
var onloadCallback = function() {
    grecaptcha.execute();
};

function setResponse(response) { 
    document.getElementById('captcha-response').value = response; 
}
</script> -->