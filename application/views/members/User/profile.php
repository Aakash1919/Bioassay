<!-- WC200228: This page is no longer needed, using profileEdit instead of this page -->
<section class="content-right">
	<article class="content-right-btm" style="margin-top:0px;">
		<div class="new-products" style="margin-top:0px;">
			<div class="new-products-title">
				<h1>
					<span>
						My Profile
					</span>
				</h1>
			</div>
			<div class="new-products-list">
				<div style="padding: 15px;">
					<div class="mycart">
						<ul style="list-style:none;" class="profileDetails">
							<div class="leftlinks">
								<a href="/user/profileEdit?personID=<?php echo isset($personIDA)?$this->encrypt->encode($personIDA):'';?>">
									Edit your Profile
								</a>
								<br>
								<a href="/user/changepassword?personID=<?php echo isset($personIDA)?$this->encrypt->encode($personIDA):'';?>">
									Change Password
								</a>
							</div>
							<div class="clear">
							</div>
							<div class="details">
								<label  style="width:300px;">
									Name
								</label>  
								<div class="clear">
								</div>
								<label  style="width:300px;">
									Phone
								</label>  
								<div class="clear">
								</div>
								<label  style="width:300px;">
									Fax
								</label>  
								<div class="clear">
								</div>
								<label  style="width:300px;">
									Email
								</label>  
								<div class="clear">
								</div>
								<label  style="width:300px;">
									Company
								</label>  
								<div class="clear">
								</div>
								<label  style="width:300px;">
									Address
								</label>  
								<div class="clear">
								</div>
								<label  style="width:300px;">
								</label>  
								<div class="clear">
								</div>
								<label  style="width:300px;">
									City
								</label> 
								<div class="clear">
								</div>
								<label  style="width:300px;">
									State
								</label>  
								<div class="clear">
								</div>
								<label  style="width:300px;">
									Zip
								</label>  
								<div class="clear">
								</div>
								<label  style="width:300px;">
									Country
								</label>  
								<div class="clear">
								</div>
								<label  style="width:300px;">
									On Mail List
								</label>  
								<div class="clear">
								</div>
								<!-- 
								<br>
								<label  style="width:300px;">
									Credit Card
								</label>
								<br>
								<label  style="width:300px;">
									Credit Card Name 
								</label>
								<br>
								<label  style="width:300px;">
									Expiration Date
								</label>

								<br>
								<label  style="width:300px;">
								CVV Code 
								</label> 
								-->
								<br>
								<label  style="width:300px;">
									Billing Name 
								</label>
								<br>
								<label  style="width:300px;">
									Billing Company Name 
								</label>
								<br>
								<label  style="width:300px;">
									Billing Address 
								</label>
								<br>
								<label  style="width:300px;">
									Billing Address 
								</label>
								<br>
								<label  style="width:300px;">
									Billing City 
								</label>
								<br>
								<label  style="width:300px;">
									Billing State 
								</label>
								<br>
								<label  style="width:300px;">
									Billing Zip 
								</label>
								<br>
								<label  style="width:300px;">
									Billing Country 
								</label>
								<br>
								<label  style="width:300px;">
									Billing Telephone 
								</label>
								<br>
								<label  style="width:300px;">
									Billing Fax 
								</label>
								<br>
								<label  style="width:300px;">
									Shipping Name 
								</label>
								<br>
								<label  style="width:300px;">
									Shipping Company Name 
								</label>
								<br>
								<label  style="width:300px;">
									Shipping Address 
								</label>
								<br>
								<label  style="width:300px;">
									Shipping Address 
								</label>
								<br>
								<label  style="width:300px;">
									Shipping City 
								</label>
								<br>
								<label  style="width:300px;">
									Shipping State 
								</label>
								<br>
								<label  style="width:300px;">
									Shipping Zip 
								</label>
								<br>
								<label  style="width:300px;">
									Shipping Country 
								</label>
								<br>
								<label  style="width:300px;">
									Shipping Telephone 
								</label>
								<br>
								<label  style="width:300px;">
									Shipping Email 
								</label>
								<br>
								<label  style="width:300px;">
									mod_date 
								</label>
								<br>
							</div>
							<div  class="details">	   
								<?php
								if(!empty($GetAllUserDetails))
								{
									foreach ($GetAllUserDetails as $g)
									{
										$name = $g->title.' '.$g->full_name;
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
										//$cctype = $g->cc_type;
										//$ccname=$g->cc_name;
										//$exp=$g->exp_mo.' '.$g->exp_yr;
										//$cc_scv=$g->cc_scv_numb;
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

									}
								}
								?>
								<label> 
									<?php 
										echo isset($name)?$name:'-';
									?>
								</label>
								<div class="clear">
								</div>
								<label> 
									<?php 
										echo isset($tel)?$tel:'-';
									?>
								</label>
								<div class="clear">
								</div>
								<label> 
									<?php 
										echo isset($fax)?$fax:'-';
									?>
								</label>
								<div class="clear">
								</div>
								<label> 
									<?php 
										echo isset($email)?$email:'-';
									?>
								</label>
								<div class="clear">
								</div>
								<label>
									<?php 
										echo isset($company1)?$company1:'-';
									?>
								</label>
								<div class="clear">
								</div>
								<label> 
									<?php 
										echo isset($address1)?$address1:'-';
									?>
								</label>
								<div class="clear">
								</div>
								<label> 
									<?php 
										echo isset($address2)?$address2:'-';
									?>
								</label>
								<div class="clear">
								</div>
								<label>
									<?php 
										echo isset($city)?$city:'-';
									?>
								</label>
								<div class="clear">
								</div>
								<label> 
									<?php 
										echo isset($state)?$state:'-';
									?>
								</label>
								<div class="clear">
								</div>
								<label> 
									<?php 
										echo isset($zip)?$zip:'-';
									?>
								</label>
								<div class="clear">
								</div>
								<label>
									<?php 
										echo isset($country)?$country:'-';
									?>
								</label>
								<div class="clear">
								</div>
								<label>
									<?php 
										echo isset($Onmaillist)?$Onmaillist:'-';
									?>
								</label>
								<div class="clear">
								</div>

								<!-- 
								<br>
								<label style="margi-left:40px;"> 
									<?php 
										echo isset($cctype)?$cctype:'-';
									?>
									</label>
								<br>
								<label style="margi-left:40px;">
									<?php 
										echo isset($ccname)?$ccname:'-';
									?>
									</label>
								<br>
								<label style="margi-left:40px;">
									<?php 
										echo isset($exp)?$exp:'-';
									?>
									</label>
								<br>
								<label style="margi-left:40px;"> 
									<?php 
										echo isset($cc_scv)?$cc_scv:'-';
									?>
								</label> 
								-->
								<br>
								<label style="margi-left:40px;"> 
									<?php 
										echo isset($billingname)?$billingname:'-';
									?> 
									</label>
								<br>
								<label style="margi-left:40px;">
									<?php 
										echo isset($billin_co_name)?$billin_co_name:'-';
									?> 
								</label>
								<br>
								<label style="margi-left:40px;"> 
									<?php 
										echo isset($bill_address)?$bill_address:'-';
									?>
								</label>
								<br>
								<label style="margi-left:40px;"> 
									<?php 
										echo isset($bill_address2)?$bill_address2:'-';
									?> 
								</label>
								<br>
								<label style="margi-left:40px;"> 
									<?php 
										echo isset($bill_city)?$bill_city:'-';
									?> 
								</label>
								<br>
								<label style="margi-left:40px;"> 
									<?php 
										echo isset($bill_state)?$bill_state:'-';
									?>
								</label>
								<br>
								<label style="margi-left:40px;"> 
									<?php 
										echo isset($bill_zip)?$bill_zip:'-';
									?> 
								</label>
								<br>
								<label style="margi-left:40px;">
									<?php 
										echo isset($bill_country)?$bill_country:'-';
									?> 
								</label>
								<br>
								<label style="margi-left:40px;"> 
									<?php 
										echo isset($bill_tel)?$bill_tel:'-';
									?>
								</label>
								<br>
								<label style="margi-left:40px;"> 
									<?php 
										echo isset($bill_fax)?$bill_fax:'-';
									?> 
								</label>
								<br>
								<label style="margi-left:40px;"> 
									<?php 
										echo isset($sname)?$sname:'-';
									?> 
								</label>
								<br>
								<label style="margi-left:40px;"> 
									<?php 
										echo isset($scname)?$scname:'-';
									?>
								</label>
								<br>
								<label style="margi-left:40px;"> 
									<?php 
										echo isset($sadd1)?$sadd1:'-';
									?> 
								</label>
								<br>
								<label style="margi-left:40px;">
									<?php 
										echo isset($sadd2)?$sadd2:'-';
									?> 
								</label>
								<br>
								<label style="margi-left:40px;"> 
									<?php 
										echo isset($scity)?$scity:'-';
									?>
								</label>
								<br>
								<label style="margi-left:40px;"> 
									<?php 
										echo isset($sstate)?$sstate:'-';
									?> 
								</label>
								<br>
								<label style="margi-left:40px;"> 
									<?php 
										echo isset($szip)?$szip:'-';
									?> 
								</label>
								<br>
								<label style="margi-left:40px;"> 
									<?php 
										echo isset($scountry)?$scountry:'-';
									?>
								</label>
								<br>
								<label style="margi-left:40px;"> 
									<?php 
										echo isset($stel)?$stel:'-';
									?> 
								</label>
								<br>
								<label style="margi-left:40px;">
									<?php 
										echo isset($semail)?$semail:'-';
									?> 
								</label>
							</div>
						</ul>
					</div>
					<div class="clear">
					</div>
				</div>
			</div>
		</div>
	</article>
</section>
<style type="text/css">
.details{
  width: 100px;;
  float: left;
  border: none;
}
.leftlinks{
  border: none;
  float: left;
}
</style>