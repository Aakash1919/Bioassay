<?php
$cart=$this->cart->contents();
$paymenttype="Credit Card";
$pre = $this->session->userdata('PreviousInfo');
if(!empty($userInfo)){
  foreach ($userInfo as $g) {
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
  
  }}
if(!empty($pre)){
  $name = $_SESSION['PreviousInfo']['sattn'];
  $tel=$_SESSION['PreviousInfo']['sphone'];
  $fedex = $_SESSION['PreviousInfo']['fedex_accnt'];
  $fedexService = $_SESSION['PreviousInfo']['fedex_service'];
  $po_num = $_SESSION['PreviousInfo']['po_num'];
  $fax=$_SESSION['PreviousInfo']['bfax'];
  $email=$_SESSION['PreviousInfo']['semail'];
  $address1=$_SESSION['PreviousInfo']['saddr1'];
  $address2 = $_SESSION['PreviousInfo']['saddr2'];
  $city=$_SESSION['PreviousInfo']['scity'];
  $state=$_SESSION['PreviousInfo']['sstate'];
  $zip=$_SESSION['PreviousInfo']['szip'];
  $country=$_SESSION['PreviousInfo']['scountry'];
  $cctype = $_SESSION['PreviousInfo']['cardtype'];
  $ccname=$_SESSION['PreviousInfo']['cardholdername'];
  $exp=$_SESSION['PreviousInfo']['month'].' '.$_SESSION['PreviousInfo']['year'];
  $expmonth = $_SESSION['PreviousInfo']['month'];
  $expyear = $_SESSION['PreviousInfo']['year'];
  $cardNumber = $_SESSION['PreviousInfo']['cardnumber'];
  $cc_scv=$_SESSION['PreviousInfo']['csc1'];;
  $billingname=$_SESSION['PreviousInfo']['battn'];
  $billin_co_name = $_SESSION['PreviousInfo']['bcompany'];
  $bill_address=$_SESSION['PreviousInfo']['baddr1'];
  $bill_address2=$_SESSION['PreviousInfo']['baddr2'];
  $bill_city=$_SESSION['PreviousInfo']['bcity'];
  $bill_state=$_SESSION['PreviousInfo']['bstate'];
  $bill_zip=$_SESSION['PreviousInfo']['bzip'];
  $bill_country= $_SESSION['PreviousInfo']['bcountry'];
  $bill_tel=$_SESSION['PreviousInfo']['bphone'];
  $bill_fax=$_SESSION['PreviousInfo']['bfax'];
  $sname=$_SESSION['PreviousInfo']['sattn'];
  $scname=$_SESSION['PreviousInfo']['scompany'];
  $sadd1=$_SESSION['PreviousInfo']['saddr1'];
  $sadd2 =$_SESSION['PreviousInfo']['saddr2'];
  $scity=$_SESSION['PreviousInfo']['scity'];
  $sstate=$_SESSION['PreviousInfo']['sstate'];
  $szip=$_SESSION['PreviousInfo']['szip'];
  $scountry=$_SESSION['PreviousInfo']['scountry'];
  $stel=$_SESSION['PreviousInfo']['sphone'];
  $semail=$_SESSION['PreviousInfo']['semail'];
  $paymenttype =$_SESSION['PreviousInfo']['payment_type']; 
  $stax = $_SESSION['PreviousInfo']['sales_tax_exempt_num'];
  $stax1 = $_SESSION['PreviousInfo']['sales_tax_exempt_num1'];
  
}

$countries=array("United States","Albania","Algeria","American Samoa",
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
     
      $personID = $this->session->userdata('person_id');
      if(!empty($personID)){
        $BoxTitle = "Checkout";
     
      }else{
        $BoxTitle = "Guest Checkout";
      }
?>
<form  method="post" name="regform" id="trsform" action="/checkout/billingQuotationProcess">
	<section class="content-right">
		<article class="content-right-btm" style="margin-top:0px;">
			<div class="new-products" style="margin-top:0px;">
				<div class="new-products-title">
					<h1>
						<span>
							<?php 
								echo isset($BoxTitle)?$BoxTitle:'Checkout';
							?>
						</span>
					</h1>
				</div>
				<div class="messagr">
					<?php 
						if(isset($_GET['msg']))
						{ 
							echo "<h1> <font color='green'>Quotation has been submitted.</font></h1>";
						}
					?>
				</div>
				<div class="messagr">
					<?php 
						if(isset($_GET['po']))
						{
							echo "<h1> <font color='green'>Your request for Purchase Order has been received, Thank You</font></h1>"; 
						}
					?>
				</div>
				<div class="new-products-list">
					<table width="100%" style="border: 1px solid #333; text-align:center; font-family:Tahoma, sans-serif; font-size:12px;">
						<tr style="background:#589d3f; border:1px solid #333; bordercolor=#333333;">
							<td style="height:20px;border-right:1px solid #333">
								Product Name
							</td>
							<td style="border-right:1px solid #333;">
								Catalog No
							</td>
							<td style="border-right:1px solid #333;">
								Shipping Method
							</td>
							<td style="border-right:1px solid #333;">
								Price
							</td>
							<td style="border-right:1px solid #333;">
								QTY
							</td>
							<td style="border-right:1px solid #333;">
								Subtotal
							</td>
						</tr>


						<?php
							if(!empty($cart))
							{
								foreach ($cart as $c) 
								{
						?>
						<tr style="border-bottom:1px solid #333;">
							<td style="height:20px; border-right:1px solid #333;">
								<?php 
									echo $c['name'];
								?>
							</td>
							<td style="border-right:1px solid #333;">
								<?php 
									echo $c['catalog'];
								?>
							</td>
							<td style="border-right:1px solid #333;">
								<?php 
									echo $c['shippingmt'];
								?>
							</td>
							<td style="border-right:1px solid #333;">
								$ <?php 
									echo $c['price'];
								?>
							</td>
							<td style="border-right:1px solid #333;">
								<?php 
									echo $c['qty'];
								?>
							</td>
							<td>
								$ <?php 
									echo $c['subtotal'];
								?>
							</td>
						</tr>
						<?php
								}  
							?>
						<?php
							$beforediscount = $this->session->userdata('PromotionStatus');
							// echo "<pre>";
							// print_r($this->session->userdata('discount_data'));
							// print_r($cart);
							// echo "</pre>";
								if(isset($beforediscount) && $beforediscount!=false)
								{
									$promotioncode = $this->session->userdata('PromotionCode');
									$discountamount = 0;
									$oldPrice = $this->session->userdata('OldPrice');
									$totalPricebd = $this->session->userdata('OldPrice');

									$diss = $this->session->userdata('discount_data');
									if(!empty($diss)){
									foreach ($diss  as $d) {
										$status = $d['Status'];

											if($status == 'true'){
										  $codedate = $d['Data'][0]->expirydate;
										  if(empty($codedate)){
												$codedate = date('Y-m-d',time());
											}
											$expd = strtotime($codedate);
											$dtoday = time();
											
											if( $dtoday > $expd ){
												
											}else{
												$percentage = $d['Data'][0]->discountpercent;
												$productid = $d['Data'][0]->product_id;
												foreach($cart as $c){
													if($c['id']==$productid){
														$p = $c['price'];
														$a = (($p/100)*$percentage)*$c['qty'];
														$discountamount += $a;
													}
												}
											}
										}
										}
										
									}

									$discountprice =number_format($totalPricebd,2) - number_format($discountamount,2);
									$totalPricebd  = $totalPricebd - $discountprice;
							?>
						<!-- this will print the old price before promotion -->
						<tr style="border-bottom:solid 1px #333;">
							<td colspan="5" style="height:20px;text-align:right;border-right:1px solid #333;padding-right:5px;padding-top:5px;">
								Total Price
							</td>
							<td>
								$<?php 
									echo isset($oldPrice)?$this->cart->format_number($oldPrice):$this->cart->format_number($this->cart->total()); 
								?>
							</td>
						</tr>
						<!-- This will print the discounted price -->
						<?php 
									if(!empty($discountamount))
										{
						?>
						<tr style="border-bottom:solid 1px #333;">
							<td colspan="5" style="height:20px;text-align:right;border-right:1px solid #333;padding-right:5px;padding-top:5px;">
								Discount
							</td>
							<td>
								-$<?php 
											echo isset($discountamount)?$discountamount:'';
								?>
							</td>
						</tr>
							  
						  <?php
										}
								}
						?>
						<tr style="border-bottom:solid 1px #333;">
							<td colspan="5" style="height:20px;text-align:right;border-right:1px solid #333;padding-right:5px;padding-top:5px;">
								<!--Shipping Method: 
								<?php 
									echo isset($cart)?$c['shippingmt']:'RT';
								?> - item(s) shipped at ambient temperature; Ice - item(s) shipped on ice pads/dry ice. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->Subtotal:
							</td>
							<td>
								$<?php 
									if(!empty($discountamount))
									{
										echo isset($cart)?$this->cart->format_number($this->cart->total()) - $discountamount:''; 
									}
									else
									{
										echo isset($cart)?$this->cart->format_number($this->cart->total()):''; 
									}


							?>
							</td>
						</tr>
						<?php
							} 
						?>

					</table>
					<div class="clear">
					</div>


					<div class="reg_left" style="padding-top: 15px;">
						<div class="reg_a">
							<p>
								Promotion Code: 
							</p>
						</div>
						<div class="reg_cf1">
							<input name="discount" id="discode" type="text" style="text-align:center;width:150px" class="mycart_titleii" OnFocus="clearall(this.value,this.id);"  value="<?php echo isset($promotioncode)?$promotioncode:'';?>">
							<input class="button" type="button" id="discode_" value="Submit" onClick="dis_check(this.value,this.id)" name="disn">
						</div>
						<div class="reg_left">
						<div class="reg_a">
						</div>
						<div class="reg_b">
						<?php 
							$dis = $this->session->userdata('discount_data');
							if(!empty($dis)){
							foreach ($dis  as $d) {
								$status = $d['Status'];
								if($status == 'false'){
									echo "<p style='margin-top:10px;'> <b>Invalid Code for ".$this->Products_Model->getname($d['Product_Id'])."</b></p>";
									}
									if($status == 'true'){
								  $codedate = $d['Data'][0]->expirydate;
								  if(empty($codedate)){
										$codedate = date('Y-m-d',time());
									}
									$expd = strtotime($codedate);
									$dtoday = time();
									
									if( $dtoday > $expd ){
										echo "<p> Code Expired for ".$this->Products_Model->getname($d['Product_Id'])."</p>";
									}
									}
								}
								
							}
						?>
					</div>
				</div>
						<div class="clear">
						</div>
					</div>
					<!-- Aakash Started here -->
					<?php 
						$promotionCode = $this->session->userdata('PromotionCode');
						if(isset($promotionCode))
						{
					?>
					<div class="reg_left">
						<div class="reg_a">
						</div>
						<div class="reg_b">
							<p>
								<b>Promotio Code Applied:&nbsp;<?php echo @$promotionCode;?> <a href="/checkout/removeDiscountCode">Remove</a></b>
							</p>
						</div>
					</div>
					<div class="clear">
					</div>
					<br />
					<?php
						} 
					?>
					<!-- Aakash ended here -->
					<?php
						$uid = $this->session->userdata('person_id');
						if(!empty($uid))
						{
					?>								 
					<div class="reg_left">
						<div class="reg_a"> 
							<p>
								<b>Order placed by:</b>
							</p>
						</div>
						<div class="reg_b">
							<?php 
								echo isset($name)?$name:'';
							?>
						</div>
					</div>
					<?php
						}
						else
						{
					?>							  
					<?php
						}
					?>

					<div class="clear">
					</div>
					<br />
					<div class="reg_left">
						<div class="reg_a">
						</div>
						<div class="reg_b">
							<p>
								For collect shipments, please enter a valid FedEx account number (no dashes or spaces) below
							</p>
						</div>
					</div>
					<div class="reg_left"> 
						<div class="reg_a">
							<p>
								Fedex Account# 
							</p>
						</div>
						<div class="reg_b">
							<input name="fedex_accnt" id="fedex_accnt" type="text" maxlength="9" value="<?php echo isset($fedex)?$fedex:'';?>">
						</div>
					</div>
					<div class="clear">
					</div>

					<div class="reg_left">
						<div class="reg_a">
							<p>
								Choose FedEx Service<span>*</span>
							</p>
						</div>
						<div class="reg_cf1">
							<?php
								$fedex_service_sel = array("2nd Day Air","Standard Overnight","Priority Overnight");
								for ($i=0;$i<count($fedex_service_sel);$i++) 
								{
									if (!isset($fedexService)) 
									{
										if ($i == 0) 
										{
										  echo "<input type=\"radio\" name=\"fedex_service\" checked   value=\"".$fedex_service_sel[$i]."\"  onClick=\"clrshp();\">". $fedex_service_sel[$i];
										} 
										else 
										{
											echo "<br><input type=\"radio\" name=\"fedex_service\" value=\"".$fedex_service_sel[$i]."\"  onClick=\"clrshp();\">".$fedex_service_sel[$i];
										}

									} 
									else 
									{
										if ($fedexService==$fedex_service_sel[$i]) 
										{
											echo "<br><input type=\"radio\" name=\"fedex_service\" value=\"".$fedex_service_sel[$i]."\" checked onClick=\"clrshp();\">".$fedex_service_sel[$i];

										} else 
										{
											echo "<br><input type=\"radio\" name=\"fedex_service\" value=\"".$fedex_service_sel[$i]."\"  onClick=\"clrshp();\">".$fedex_service_sel[$i];
										}
									}
								}
							   ?>
							<div id="fedx" class="errcls">
							</div>
						</div>
					</div>
					<div class="clear">
					</div>
					<div id="ajxdiv">
					</div>
					<div class="clear">
					</div>
					<?php
						$uid = $this->session->userdata('person_id');
						if(!empty($uid))
						{
					?>
					<?php
						}
						else
						{
					?>
					<div class="reg_left">
						<div class="reg_a">
						</div>
						<div class="reg_b">
							For payment by purchase order, please <a href ="/user/login">login</a>.
						</div>
					</div>
					<?php
						}
					?>

					<div class="reg_left">
						<div class="reg_a">
							<p>
								Payment Type<span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<select name="payment_type" id="paymenttype" class="reg_b_jump" required >
								<?php
									if(!empty($uid))
									{
								?>								 
								<option value="Purchase Order" <?php if($paymenttype=="Purchase Order"){echo "selected";} ?>>
									Purchase Order
								</option>
								<option value="Credit Card" <?php if($paymenttype=="Credit Card"){echo "selected";} ?>>
									Credit Card
								</option> 
								<option value="Paypal" <?php if($paymenttype=="Paypal"){echo "selected";} ?>>
									Paypal
								</option>
								<?php
									}
									else
									{
								?>							  
								<option value="Credit Card" <?php if($paymenttype=="Credit Card"){echo "selected";} ?>>
									Credit Card
								</option>  
								<option value="Paypal" <?php if($paymenttype=="Paypal"){echo "selected";} ?>>
									Paypal
								</option>
								<?php
									}
								?>
							</select>
						  
						</div>
						<div id="pt" class="errcls">
						</div>
					</div>
					<div class="clear">
					</div>
					<!--
					<div id ="po_details" >
						<div class="reg_left"> 
							<div class="reg_a">
								<p>
									PO Number <span>* </span>
								</p>
							</div>
							<div class="reg_b">
								<input name="po_num" id="po_num" type="text" value="" onFocus="clrpo()" required>
							</div>
						</div>
					</div> 
					-->
					<div class="clear"> 
					</div>
					<br />
					<?php
						if(!empty($uid))
						{
							$profileid = $this->User_Model->checkAuthProfileID($uid);
							$paymentprofileid = $this->User_Model->checkAuthProfilePaymentID($uid);
							if(!empty($profileid) && !empty($paymentprofileid))
							{
						  
					  ?>
					<div id="lastcard" class="reg_left">
						<div class="reg_a">
							<p>
								Last card used to make a purchase <?php echo isset($cardfourdigit)?'(*******'.$cardfourdigit.')':'';?>
							</p>
						</div>
						<div class="reg_b">
							<input id="cccheck" name="cccheck" type="checkbox" value="1">
						</div>
					</div>
					<?php
							}
						}
					  ?>
					<div class="clear">
					</div>
					<div id="credit_card_details"> 
						<div class="reg_left">
							<div class="reg_a">
							</div>
							<div class="reg_b">
								<b>Credit Card:</b>
							</div>
						</div>
						<div class="clear">
						</div>
						<div class="reg_left">
							<div class="reg_a">
								<p>
									Credit Card Type<span>*</span>
								</p>
							</div>
							<div class="reg_b"> 
								<select name="cardtype"  class="reg_b_jump" id="ctype">
									<option value="Master Card">
										Master Card
									</option>
									<option value="American Express" >
										American Express
									</option>
									<option value="Visa">
										Visa
									</option>
									<option value="Discover Card">
										Discover Card
									</option>
								</select> 
							</div>
							<div id="ct" class="errcls">
							</div>
						</div>
						<div class="clear">
						</div>
						<div class="reg_left">
						<div class="reg_a">
							<p>
								Credit Card  Number<span>*</span>
							</p>
						</div>
						<div class="reg_b" >
							<input name="cardnumber" id="cardnumber" type="text" value="<?php echo isset($cardNumber)?$cardNumber:'';?>" required>
							<!-- 
							<input id="addcreditcarddet" type="text"  value="" onClick="clrcreditcard()" required>
							<input name="cardnumber" id="cccardno44" type="hidden" value=""  > 
							-->
						</div>
						</div>
						<div class="clear">
						</div>
						<div class="reg_left">
							<div class="reg_a">
							<p>
								Name on Card<span>*</span>
							</p>
							</div>
							<div class="reg_b">
								<input name="cardholdername" id="cname" type="text"  value="<?php echo isset($ccname)?$ccname:'';?>" required>
							</div>
							</div>
						<div class="clear">
						</div>
						<div class="reg_left">
							<div class="reg_a">
							<p>
								CVV Code<span>*</span>
							</p>
							</div>
							<div class="reg_b">
								<input name="csc1"  type="text"  id="vcsc" value="<?php echo isset($cc_scv)?$cc_scv:'';?>" required>
							</div>
						</div>
						<div class="clear">
						</div>
						<div class="reg_left">
							<div class="reg_a">
								<p>
									Expiration Date <span>*</span>:
								</p>
							</div>
							<div class="reg_b">
								<select  class="reg_b_jump2" name="month"    id="cmonth">
									<?php 
										echo isset($expmonth)?'<option value="'.$expmonth.'" selected="selected">'.$expmonth.'</option>':'';
									?>
									<?php 
										$em=array("01","02","03","04","05","06","07","08","09","10","11","12");
										for ($i=0;$i<12;$i++)
										{
											echo "<option value=".$em[$i];
											echo ">".$em[$i];
										} 
									?>
								</select>
								<select name="year" id="cyear"  class="reg_b_jump22" required>
									<?php 
										echo isset($expyear)?'<option value="'.$expyear.'" selected="selected">'.$expyear.'</option>':'';
									?>
									<?php 
										$current_year=date("Y");
										$limit=$current_year+7;
									?>
									<option value="">
										--- Choose --- 
									</option>
									<?php  
										for($i=$current_year;$i<=$limit;$i++)
										{
									?>
									<option value="<?php echo $i;?>" ><?php echo $i;?>
									</option>
									<?php 
										} 
									?>
								</select>
							</div>
							<div id="exm" class="errcls">
							</div>
							<div id="vyear" class="errcls" style="width:300px;">
							</div>
						</div>
					</div>
					<div class="clear"> 
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p id="poNumberid">
								PO#
							</p>
						</div>
						<div class="reg_b">
							<input id="po_num" type="text" name="po_num" value="<?php echo isset($po_num)?$po_num:'';?>">
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
						</div>
						<div class="reg_b">
							<b>Ship to:</b>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left"> 
						<div class="reg_a">
							<p>
								Attn <span>* </span>
							</p>
						</div>
						<div class="reg_b">
							<input name="sattn" id="sattn" type="text" value="<?php echo isset($sname)?$sname:'';?>" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Company Name <span>* </span>
							</p>
						</div>
						<div class="reg_b">
							<input  name="scompany" id="scompany" type="text" value="<?php echo isset($scname)?$scname:'';?>" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Address 1 <span>* </span>
							</p>
						</div>
						<div class="reg_b">
							<input name="saddr1" id="saddr1" type="text" value="<?php echo isset($sadd1)?$sadd1:'';?>" required>
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
							<input name="saddr2" id="saddr2" type="text" value="<?php echo isset($sadd2)?$sadd2:'';?>">
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								City <span>* </span>
							</p>
						</div>
						<div class="reg_b">
							<input name="scity" id="scity" type="text" value="<?php echo isset($scity)?$scity:'';?>" required>
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
							<input name="sstate" id="sstate"  type="text" value="<?php echo isset($sstate)?$sstate:'';?>" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Zip <span>* </span>
							</p>
						</div>
						<div class="reg_b">
							<input name="szip" id="szip" type="text" value="<?php echo isset($szip)?$szip:'';?>" required>
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
								<?php  
									if(isset($scountry) && $scountry!='0')
									{
										echo '<option value="'.$scountry.'" selected="selected">'.$scountry.'</option>';
									}
									else
									{
										echo ' <option value=""> --- Choose country --- </option>';
									};
								?>
								<?php
									foreach ($countries as $k => $value) 
									{
										echo '<option value="'.$value.'">'.$value.'</option>';
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
								Tel <span>* </span>
							</p>
						</div>
						<div class="reg_b">
							<input name="sphone" id="sphone"type="text" value="<?php echo isset($stel)?$stel:'';?>" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Email<span>* </span>
							</p>
						</div>
						<div class="reg_b">
							<input name="semail" id="semail" type="text" value="<?php echo isset($semail)?$semail:'';?>" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left" id="taxExempt" style="display:none;">
						<div class="reg_a">
							<p>
								If you are a tax exempt entity, please enter your exemption number here
							</p>
						</div>
						<div class="reg_b">
							<input name="sales_tax_exempt_num1" class="tax_exempt" type="text" value="<?php echo isset($stax1)?$stax1:'';?>">
						</div>
					</div>
					<div class="clear">
					</div>
					<div id="billingInfo">
						<div class="reg_left">
							<div class="reg_a">
							</div>
							<div class="reg_b_buttons">
								<p style="padding-bottom: 5px;">
									Bill to :
								</p>
								<input style="display: inline-block;" name="copy_personnel" id="copy_personnel" type="checkbox" value="">
								<p style="display: inline-block;">
									Copy from shipping info
								</p>
							</div>
						</div>
						<div class="clear">
						</div>

						<div class="reg_left">
							<div class="reg_a">
								<p>
									Attn <span>* </span>
								</p>
							</div>
							<div class="reg_b">
								<input name="battn" id="battn" type="text" value="<?php echo isset($billingname)?$billingname:'';?>" required>
							</div>
						</div>
						<div class="clear">
						</div>
						<div class="reg_left">
							<div class="reg_a">
								<p>
									Company Name <span>* </span>
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
									Address 1 <span>* </span>
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
									City <span>* </span>
								</p>
							</div>
							<div class="reg_b">
								<input name="bcity" id="bcity" type="text" value="<?php echo isset($bill_city)?$bill_city:'';?>"  required>
							</div>
						</div>
						<div class="clear">
						</div>
						<div class="reg_left">
							<div class="reg_a">
								<p>
									State <span>* </span>
								</p>
							</div>
							<div class="reg_b">
								<input name="bstate" id="bstate"type="text" value="<?php echo isset($bill_state)?$bill_state:'';?>" required>
							</div>
						</div>
						<div class="clear">
						</div>
						<div class="reg_left">
							<div class="reg_a">
								<p>
									Zip <span>* </span>
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
									Country <span>* </span>
								</p>
							</div>
							<div class="reg_b">
								<select name="bcountry" id="bcountry"  class="reg_b_jump" required>
									<?php 
										if(isset($bill_country) && $bill_country!='0')
										{ 
											echo '<option value="'.$bill_country.'" selected="selected">'.$bill_country.'</option>';
										}
										else
										{
											echo ' <option value=""> --- Choose country --- </option>';
										};
									?>
									<?php
										foreach ($countries as $k => $value) 
										{
											echo '<option value="'.$value.'">'.$value.'</option>';
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
									Tel <span>* </span>
								</p>
							</div>
							<div class="reg_b">
								<input name="bphone" id="bphone" type="text" value="<?php echo isset($bill_tel)?$bill_tel:'';?>" required>
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
								<input name="bfax" id="bfax" type="text" value="<?php echo isset($bill_fax)?$bill_fax:'';?>">
							</div>
						</div>
						<div class="clear">
						</div>
						<div class="reg_left">
							<div class="reg_a">
								<p>
									If you are a tax exempt entity, please enter your exemption number here
								</p>
							</div>
							<div class="reg_b">
								<input name="sales_tax_exempt_num"  class="tax_exempt" type="text" value="<?php echo isset($stax)?$stax:'';?>">
							</div>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Notes (e.g. special handling)
							</p>
						</div>
						<div class="reg_b">
							<textarea name="cmnts"  id="cmnts" class="text-area"></textarea>
						</div>
					</div>
					<div class="clear">
					</div>
					<input type="hidden" name="dataValue" id="dataValue" />
  					<input type="hidden" name="dataDescriptor" id="dataDescriptor" />
					<div class="reg_left">
						<div class="reg_a">
						</div>
						<div class="reg_b">
							<p>
								Please check all your account information carefully, before you press Submit button.
							</p>
						</div>
					</div>
					<div class="reg_left">
						<div class="reg_a">
						</div>
						<div class="reg_b_buttons">
							<input name="" type="reset" value="Reset" class="button" style="color:red;">
							&nbsp;
							&nbsp;
							&nbsp;
							&nbsp; 
							<input name="bill_qtn" onclick="checkAcceptJs()" type="button" value="Continue" class="button">
						</div>
					</div>
					<br>
					<div class="clear">
					</div>
				</div>
			</div>
		</article>
	</section>
</form>
<div class="clear">
</div>
<script type="text/javascript"> 
  $('#cccheck').click(function() {
    if($('#cccheck').is(':checked')){
       $("#credit_card_details").hide();
       $("#addcreditcarddet").removeAttr("required");
        $("#cname").removeAttr("required");
        $("#vcsc").removeAttr("required");
        $("#cardnumber").removeAttr("required");
        $("#po_details").hide();
        $("#po_num").removeAttr("required");
        $("#cyear").removeAttr("required");
  }else{
     $("#credit_card_details").show();
  }
});
  $(document).ready(function(e){ 

        var payment_type = $("#paymenttype").val();
        var action= ""
       
        if(payment_type == ""){
        $("#credit_card_details").hide();
        $("#addcreditcarddet").removeAttr("required");
        $("#cardnumber").removeAttr("required");
        $("#cname").removeAttr("required");
        $("#vcsc").removeAttr("required");

        $("#battn").attr("required","required");
        $("#bcompany").attr("required","required");
        $("#baddr1").attr("required","required");
        $("#bcity").attr("required","required");
        $("#bstate").attr("required","required");
        $("#bzip").attr("required","required");
        $("#bcountry").attr("required","required");
        $("#bphone").attr("required","required");

        $("#po_details").hide();
        $("#lastcard").hide();
        $('#taxExempt').hide();
        $("#billingInfo").show();
        $("#po_num").removeAttr("required");
        var paragraph = document.getElementById("poNumberid");
        paragraph.innerHTML ="PO#";
      }else if(payment_type == "Paypal"){
        $("#credit_card_details").hide();
         $("#lastcard").hide();
        $("#addcreditcarddet").removeAttr("required");
        $("#cname").removeAttr("required");
        $("#cardnumber").removeAttr("required");
        $("#vcsc").removeAttr("required");


        $("#battn").removeAttr("required");
        $("#bcompany").removeAttr("required");
        $("#baddr1").removeAttr("required");
        $("#baddr2").removeAttr("required");
        $("#bcity").removeAttr("required");
        $("#bstate").removeAttr("required");
        $("#bzip").removeAttr("required");
        $("#bcountry").removeAttr("required");
        $("#bphone").removeAttr("required");


        $("#po_details").hide();
        $("#billingInfo").hide();
        $('#taxExempt').show();
        $("#po_num").removeAttr("required");
        $("#cyear").removeAttr("required");
        var paragraph = document.getElementById("poNumberid");
        paragraph.innerHTML ="PO#";
      }else if(payment_type == "Credit Card"){
        $("#credit_card_details").show();
        $("#lastcard").show();
        $("#addcreditcarddet").attr("required","required");
        $("#cname").attr("required","required");
        $("#battn").attr("required","required");
        $("#bcompany").attr("required","required");
        $("#baddr1").attr("required","required");
        $("#bcity").attr("required","required");
        $("#bstate").attr("required","required");
        $("#bzip").attr("required","required");
        $("#bcountry").attr("required","required");
        $("#bphone").attr("required","required");
        $("#cardnumber").attr("required","required");
        $("#vcsc").attr("required","required");
        $("#po_details").hide();
        $('#taxExempt').hide();
        $("#billingInfo").show();
        $("#po_num").removeAttr("required");
        var paragraph = document.getElementById("poNumberid");
        paragraph.innerHTML ="PO#";
      }else if(payment_type == "Purchase Order"){
        $("#credit_card_details").hide();
        $("#lastcard").hide();
        $("#cardnumber").removeAttr("required");
        $("#addcreditcarddet").removeAttr("required");
        $("#cname").removeAttr("required");
        $("#battn").attr("required","required");
        $("#bcompany").attr("required","required");
        $("#baddr1").attr("required","required");
        $("#bcity").attr("required","required");
        $("#bstate").attr("required","required");
        $("#bzip").attr("required","required");
        $("#bcountry").attr("required","required");
        $("#bphone").attr("required","required");
        $("#vcsc").removeAttr("required");
        $("#po_details").show();
        $("#billingInfo").show();
        $('#taxExempt').hide();
        $("#cyear").removeAttr("required");
        $("#po_num").attr("required","required");
        var paragraph = document.getElementById("poNumberid");
        paragraph.innerHTML ="PO# <span>*</span>";
      }
    $("#paymenttype").change(function(e){
      var payment_type = $(this).val(); 
      if(payment_type == ""){
        $("#credit_card_details").hide();
        $("#addcreditcarddet").removeAttr("required");
        $("#cardnumber").removeAttr("required");
        $("#cname").removeAttr("required");
        $("#vcsc").removeAttr("required");

        $("#battn").attr("required","required");
        $("#bcompany").attr("required","required");
        $("#baddr1").attr("required","required");
        $("#bcity").attr("required","required");
        $("#bstate").attr("required","required");
        $("#bzip").attr("required","required");
        $("#bcountry").attr("required","required");
        $("#bphone").attr("required","required");

        $("#po_details").hide();
        $("#lastcard").hide();
        $("#billingInfo").show();
        $('#taxExempt').hide();
        $("#po_num").removeAttr("required");
        var paragraph = document.getElementById("poNumberid");
        paragraph.innerHTML ="PO#";
      }else if(payment_type == "Paypal"){
        $("#credit_card_details").hide();
         $("#lastcard").hide();
        $("#addcreditcarddet").removeAttr("required");
        $("#cname").removeAttr("required");
        $("#cardnumber").removeAttr("required");
        $("#vcsc").removeAttr("required");


        $("#battn").removeAttr("required");
        $("#bcompany").removeAttr("required");
        $("#baddr1").removeAttr("required");
        $("#baddr2").removeAttr("required");
        $("#bcity").removeAttr("required");
        $("#bstate").removeAttr("required");
        $("#bzip").removeAttr("required");
        $("#bcountry").removeAttr("required");
        $("#bphone").removeAttr("required");


        $("#po_details").hide();
        $("#billingInfo").hide();
        $('#taxExempt').show();
        $("#po_num").removeAttr("required");
        $("#cyear").removeAttr("required");
        var paragraph = document.getElementById("poNumberid");
        paragraph.innerHTML ="PO#";
      }else if(payment_type == "Credit Card"){
        $("#credit_card_details").show();
        $("#lastcard").show();
        $("#addcreditcarddet").attr("required","required");
        $("#cname").attr("required","required");
        $("#battn").attr("required","required");
        $("#bcompany").attr("required","required");
        $("#baddr1").attr("required","required");
        $("#bcity").attr("required","required");
        $("#bstate").attr("required","required");
        $("#bzip").attr("required","required");
        $("#bcountry").attr("required","required");
        $("#bphone").attr("required","required");
        $("#cardnumber").attr("required","required");
        $("#vcsc").attr("required","required");
        $("#po_details").hide();
        $("#billingInfo").show();
        $('#taxExempt').hide();
        $("#po_num").removeAttr("required");
        var paragraph = document.getElementById("poNumberid");
        paragraph.innerHTML ="PO#";
      }else if(payment_type == "Purchase Order"){
        $("#credit_card_details").hide();
        $("#lastcard").hide();
        $("#cardnumber").removeAttr("required");
        $("#addcreditcarddet").removeAttr("required");
        $("#cname").removeAttr("required");
        $("#battn").attr("required","required");
        $("#bcompany").attr("required","required");
        $("#baddr1").attr("required","required");
        $("#bcity").attr("required","required");
        $("#bstate").attr("required","required");
        $("#bzip").attr("required","required");
        $("#bcountry").attr("required","required");
        $("#bphone").attr("required","required");
        $("#vcsc").removeAttr("required");
        $("#po_details").show();
        $("#billingInfo").show();
        $('#taxExempt').hide();
        $("#cyear").removeAttr("required");
        $("#po_num").attr("required","required");
        var paragraph = document.getElementById("poNumberid");
        paragraph.innerHTML =" PO# <span>*</span>";
      }
    });
  });
 
 </script>
 <script>
 $(document).ready(function() {
$(".tax_exempt").on("input",function(){
	$(".tax_exempt").not($(this)).val($(this).val());
})
})
 </script>
<script>
 
    function dis_check()
    {
    var discountcod=document.getElementById('discode').value;
    if(discountcod=='')
    exit;

  var dataString="discountcod="+discountcod;
    $.ajax({
    type: "POST",
    url: "/checkout/getDiscount",
    data: dataString,
    success: function(data){
   	//console.log(data);
    if(data=="Invalid Code" || data=="Discount Code Expired"){
    $("#discode").val(data);
    return false;  
    }else{
    	location.reload();
         }
      }
   });
      

    }

    function clearall(quantity,id)

    {
      var code=document.getElementById(id).value;
  
      if(code=="Invalid Code"){
      
      document.getElementById(id).value='' ; 
        
      }
      
    }
</script>
<script>
$('#copy_personnel').click(function() {
    if ($(this).is(':checked')) {
        var fullname = $("#sattn").val();
        var companyname = $("#scompany").val();
        var addr1 = $("#saddr1").val();
        var addr2 = $("#saddr2").val();
        var city = $("#scity").val();
        var state = $("#sstate").val();
        var country = $("#scountry").val();
        var zip = $("#szip").val();
        var tel = $("#sphone").val();

        copysbill(fullname,companyname,addr1,addr2,city,state,country,zip,tel);
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
        copysbill(fullname,companyname,addr1,addr2,city,state,country,zip,tel);
    }
  });
    function copysbill(fullname,companyname,addr1,addr2,city,state,country,zip,tel){
      $("#battn").val(fullname);
      $("#bcompany").val(companyname);
      $("#baddr1").val(addr1);
      $("#baddr2").val(addr2);
      $("#bcity").val(city);
      $("#bstate").val(state);
      //$("#bcountry").val(country);
      $('#bcountry').val(country).prop('selected', true);
      $("#bzip").val(zip);
      $("#bphone").val(tel);
       }
</script>
<script type="text/javascript">
function checkAcceptJs() {
  	var payment_type = $('#paymenttype').val(); 
	  if(payment_type == "Credit Card") {
		sendPaymentDataToAnet()
	  } else {
		document.getElementById("trsform").submit();
	  }
}
function sendPaymentDataToAnet() {
    	var authData = {};
        authData.clientKey = "5a2QNfwB7hUE9aX9vg23x82jRcK3JQrChck6bhGw8x8bNnN92gb3Z3CNh5Uu28ZB";
        authData.apiLoginID = "3vXhy9ctGU2t";

	    var cardData = {};
        cardData.cardNumber = document.getElementById("cardnumber").value;
        cardData.month = document.getElementById("cmonth").value;
        cardData.year = document.getElementById("cyear").value;
        cardData.cardCode = document.getElementById("vcsc").value;
		
		var secureData = {};
		secureData.authData = authData;
		secureData.cardData = cardData;
		Accept.dispatchData(secureData, responseHandler);

    function responseHandler(response) {
        if (response.messages.resultCode === "Error") {
            var i = 0;
            while (i < response.messages.message.length) {
                swal(response.messages.message[i].text)
                i = i + 1;
            }
        } else {
			useOpaqueData(response.opaqueData)
        }
    }
}
function useOpaqueData(responseData) {

	document.getElementById("trsform").submit();
}
function paymentFormUpdate(opaqueData) {
    document.getElementById("dataDescriptor").value = opaqueData.dataDescriptor;
    document.getElementById("dataValue").value = opaqueData.dataValue;

    // If using your own form to collect the sensitive data from the customer,
    // blank out the fields before submitting them to your server.
    document.getElementById("carnNumber").value = "";
    document.getElementById("cmonth").value = "";
    document.getElementById("cyear").value = "";
    document.getElementById("vcsc").value = "";

    document.getElementById("trsform").submit();
}
</script>