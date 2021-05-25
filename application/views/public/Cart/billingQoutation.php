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
//  $po_num = $_SESSION['PreviousInfo']['po_num'];
  $email=$_SESSION['PreviousInfo']['semail'];
  $address1=$_SESSION['PreviousInfo']['saddr1'];
  $address2 = $_SESSION['PreviousInfo']['saddr2'];
  $city=$_SESSION['PreviousInfo']['scity'];
  $state=$_SESSION['PreviousInfo']['sstate'];
  $zip=$_SESSION['PreviousInfo']['szip'];
  $country=$_SESSION['PreviousInfo']['scountry'];
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
  $stax1 = $_SESSION['PreviousInfo']['sales_tax_exempt_num1'];
  
}
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

					<!--
					<div class="reg_left" style="padding-top: 15px;">
						<div class="reg_a">
							<p>
								Promotion Code: 
							</p>
						</div>
						<div class="reg_cf1">
							<input name="discount" id="discode" type="text" style="text-align:center;width:150px" class="mycart_titleii" OnFocus="clearall(this.value,this.id);"  value="<?php //echo isset($promotioncode)?$promotioncode:'';?>">
							<input class="button" type="button" id="discode_" value="Submit" onClick="dis_check(this.value,this.id)" name="disn">
						</div>
						<div class="reg_left">
						<div class="reg_a">
						</div>
						<div class="reg_b">
						<?php 
							// $dis = $this->session->userdata('discount_data');
							// if(!empty($dis)){
							// foreach ($dis  as $d) {
							// 	$status = $d['Status'];
							// 	if($status == 'false'){
							// 		echo "<p style='margin-top:10px;'> <b>Invalid Code for ".$this->Products_Model->getname($d['Product_Id'])."</b></p>";
							// 		}
							// 		if($status == 'true'){
							// 	  $codedate = $d['Data'][0]->expirydate;
							// 	  if(empty($codedate)){
							// 			$codedate = date('Y-m-d',time());
							// 		}
							// 		$expd = strtotime($codedate);
							// 		$dtoday = time();
									
							// 		if( $dtoday > $expd ){
							// 			echo "<p> Code Expired for ".$this->Products_Model->getname($d['Product_Id'])."</p>";
							// 		}
							// 		}
							// 	}
								
							// }
						?>
					</div>
				</div>
						<div class="clear">
						</div>
					</div>
				-->
					<!-- Aakash Started here -->
					<?php 
						// $promotionCode = $this->session->userdata('PromotionCode');
						// if(isset($promotionCode))
						// {
					?>
					<!--
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
				-->
					<?php
						//} 
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
					<!--
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Payment Type<span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<select name="payment_type" id="paymenttype" class="reg_b_jump" required >
								<?php
									//if(!empty($uid))
									//{
								?>								 
								<option value="Purchase Order" <?php // if($paymenttype=="Purchase Order"){echo "selected";} ?>>
									Purchase Order
								</option>
								<option value="Credit Card" <?php //if($paymenttype=="Credit Card"){echo "selected";} ?>>
									Credit Card
								</option> 
								<option value="Paypal" <?php //if($paymenttype=="Paypal"){echo "selected";} ?>>
									Paypal
								</option>
								<?php
								//	}
								//	else
								//	{
								?>							  
								<option value="Credit Card" <?php //if($paymenttype=="Credit Card"){echo "selected";} ?>>
									Credit Card
								</option>  
								<option value="Paypal" <?php //if($paymenttype=="Paypal"){echo "selected";} ?>>
									Paypal
								</option>
								<?php
								//	}
								?>
							</select>
						  
						</div>
						<div id="pt" class="errcls">
						</div>
					</div>
				-->
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
					
					<div class="clear"> 
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p id="poNumberid">
								PO#
							</p>
						</div>
						<div class="reg_b">
							<input id="po_num" type="text" name="po_num" value="<?php // echo isset($po_num)?$po_num:'';?>">
						</div>
					</div>
					<div class="clear">
					</div>-->
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
					<div class="reg_left">
						<div class="reg_a">
							<p id="poNumberid">
								Tax Exempt ID
							</p>
						</div>
						<div class="reg_b">
							<input id="sales_tax_exempt_num1" type="text" name="sales_tax_exempt_num1" value="<?php echo isset($stax1)?$stax1:'';?>">
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
							<input name="bill_qtn" type="submit" value="Continue" class="button">
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
