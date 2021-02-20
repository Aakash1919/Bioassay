<?php
$PreviousInfo = $this->session->userdata('PreviousInfo');
$cart=$this->cart->contents();
$discountamount = 0;
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
$personID = $this->session->userdata('person_id');
if(!empty($PreviousInfo)){
    $fedex = $PreviousInfo['fedex_accnt'];
    $fedexservice = $PreviousInfo['fedex_service'];
    //$po_num = $PreviousInfo['po_num'];
    $sattn= $PreviousInfo['sattn'];
    $scompany= $PreviousInfo['scompany'];
    $sddr1= $PreviousInfo['saddr1'];
    $saddr2= $PreviousInfo['saddr2'];
    $scity= $PreviousInfo['scity'];
    $sstate= $PreviousInfo['sstate'];
    $szip= $PreviousInfo['szip'];
    $scountry= $PreviousInfo['scountry'];
    $sphone= $PreviousInfo['sphone'];
    $semail= $PreviousInfo['semail'];
    $cmnts= $PreviousInfo['cmnts'];
   // $payment_type = $PreviousInfo['payment_type'];
    $sales_tax_exempt_num1 = $PreviousInfo['sales_tax_exempt_num1'];
}
$cart=$this->cart->contents();
$cn = $scountry;



if(!empty($personID)){
  $bqr = '';
  if($cn!="United States"){
    $BoxTitle = "Confirm Quotation Request";
    $bqr = true;
  }else{
    $BoxTitle = "Confirm Order";
    $bqr = false;
  }
}else{
  $bqrg = '';
  if($cn!="United States"){
    $bqrg = true;
    $BoxTitle = "Guest Checkout Quotation Request";
   }else{
     $bqrg = false;
    $BoxTitle = "Guest Checkout";
  }
  
}
?>
<form method="post" action="https://test.authorize.net/payment/payment" id="formAuthorizeNetPopup" name="formAuthorizeNetPopup" target="iframeAuthorizeNet" style="display:none;">
	<input type="hidden" id="popupToken" name="token" value="Replace with form token from getHostedPaymentPageResponse" />
</form>   
<section class="content-area">
	<form  method="post" name="regform" id="regform" action="<?php echo isset($authToken)?'https://test.authorize.net/payment/payment':'/checkout/finalTransaction'; ?>">
		<input type="hidden" name="token" id="authToken" value="<?php echo isset($authToken)?$authToken:0; ?>">
		<input type="hidden" name="fedex_accnt" value="<?php echo isset($fedex)?$fedex:'';?>">
		<input type="hidden" name="fedex_service" value="<?php echo isset($fedexservice)?$fedexservice:'';?>">
		<input type="hidden" name="sattn" value="<?php echo isset($sattn)?$sattn:'';?>">
		<input type="hidden" name="scompany" value="<?php echo isset($scompany)?$scompany:'';?>">
		<input type="hidden" name="po_num" id="input_po_num" value="<?php echo isset($po_num)?$po_num:'';?>">
		<input type="hidden" name="saddr1" value="<?php echo isset($sddr1)?$sddr1:'';?>">
		<input type="hidden" name="saddr2" value="<?php echo isset($saddr2)?$saddr2:'';?>">
		<input type="hidden" name="scity" value="<?php echo isset($scity)?$scity:'';?>">
		<input type="hidden" name="sstate" value="<?php echo isset($sstate)?$sstate:'';?>">
		<input type="hidden" name="szip" value="<?php echo isset($szip)?$szip:'';?>">
		<input type="hidden" name="scountry" value="<?php echo isset($scountry)?$scountry:'';?>">
		<input type="hidden" name="sphone" value="<?php echo isset($sphone)?$sphone:'';?>">
		<input type="hidden" name="semail" value="<?php echo isset($semail)?$semail:'';?>">
		<input type="hidden" name="cmnts" value="<?php echo isset($cmnts)?$cmnts:'';?>">
		<input type="hidden" name="payment_type" id="payment_type" value="<?php echo isset($payment_type)?$payment_type:'';?>">
		<input type="hidden" id="sales_tax_exempt_num1" name="sales_tax_exempt_num1" value="<?php echo isset($sales_tax_exempt_num1)?$sales_tax_exempt_num1:'';?>">
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
					<div class="new-products-list"> 
						<?php
							//get flashdata
							$r = $this->session->flashdata('response');
							if(isset($r))
							{
						?>
						<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js">
						</script>

						<script>
						$(document).ready(function(){
						  swal("<?php echo $r['Message']?>");
						})
						</script>
						<!-- <span style="color:red; font-size:20px;">
								<strong>
									<?php 
										echo $r['Message'];
									?>
								</strong>
							</span> 
						-->
						<?php 
							} 
						?>
						<table width="100%"style=" border: 1px solid #333; text-align:center; font-family:Tahoma, Geneva, sans-serif;font-size:14px;">
							<tr style="background:#589d3f; border:1px solid #333;"border="0" bordercolor="#333333">
								<td style="height:30px;border-right:1px solid #333">
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
									} 
								?>
								<tr style="border-bottom:solid 1px #333;">
									<td colspan="5" style="height:30px;text-align:right;border-right:1px solid #333;padding-right:8px;">
										Subtotal  
									</td>
									<td>
										$<?php 
											echo isset($cart)?$this->cart->format_number($this->cart->total()):''; 
										?>
									</td>
								</tr>
								<?php 
									//Billing qoutation request gusest
									if(isset($bqrg) && $bqrg==true)
									{
								?>
								<tr style="border-bottom:solid 1px #333;">
									<td colspan="5" style="height:30px;text-align:right;border-right:1px solid #333;padding-right:8px;">
										Shipping and Handling  
									</td>
									<td>
										TBD
									</td>
								</tr>
								<?php 
									if(!empty($discountamount)) 
										{ 
								?>
								<tr style="border-bottom:solid 1px #333;">
									<td colspan="5" style="height:30px;text-align:right;border-right:1px solid #333;padding-right:8px;">
										Discount  
									</td>
									<td>
										-$<?php 
											echo isset($discountamount)?number_format($discountamount,2):'0.00'; 
										?>
									</td>
								</tr>
								<?php 
										}
								?>
								<tr style="border-bottom:solid 1px #333;">
									<td colspan="5" style="height:30px;text-align:right;border-right:1px solid #333;padding-right:8px;">
										Total  
									</td>
									<td>
										TBD
									</td>
								</tr>
								<?php
									}
									if(isset($bqrg) && $bqrg==false)
									{
								?>
								<tr style="border-bottom:solid 1px #333;">
									<td colspan="5" style="height:30px;text-align:right;border-right:1px solid #333;padding-right:8px;">
										Shipping and Handling  
									</td>
									<td>
										$<?php 
											echo isset($shippingfee)?number_format($shippingfee,2):'0.00'; 
										?>
									</td>
								</tr>
								<tr style="border-bottom:solid 1px #333;">
									<td colspan="5" style="height:30px;text-align:right;border-right:1px solid #333;padding-right:8px;">
										Tax  
									</td>
									<td>
										$<?php if(!empty($sales_tax_exempt_num)){
											echo '0.00';
										} else {
											echo isset($tax)?number_format((float)$tax,2):'0.00'; 
											}
										?>
									</td>
								</tr>
								<?php 
										if(!empty($discountamount)) 
										{
								?>
								<tr style="border-bottom:solid 1px #333;">
									<td colspan="5" style="height:30px;text-align:right;border-right:1px solid #333;padding-right:8px;">
										Discount  
									</td>
									<td>
										-$<?php 
											echo isset($discountamount)?number_format($discountamount,2):'0.00'; 
										?>
									</td>
								</tr>
								<?php 
										} 
								?>
								<tr style="border-bottom:solid 1px #333;">
									<td colspan="5" style="height:30px;text-align:right;border-right:1px solid #333;padding-right:8px;">
										Total  
									</td>
									<td>
										$<?php 
											echo isset($total)?number_format($total,2):''; 
										?>
									</td>
								</tr>
  
								<?php
									}
									if(isset($bqr) && $bqr==false)
									{

								?>
								<tr style="border-bottom:solid 1px #333;">
									<td colspan="5" style="height:30px;text-align:right;border-right:1px solid #333;padding-right:8px;">
										Shipping and Handling  
									</td>
									<td>
										$<?php 
											echo isset($shippingfee)?number_format($shippingfee,2):'0.00'; 
										?>
									</td>
								</tr>
								<tr style="border-bottom:solid 1px #333;">
									<td colspan="5" style="height:30px;text-align:right;border-right:1px solid #333;padding-right:8px;">
										Tax  
									</td>
									<td>
										$<?php if(!empty($sales_tax_exempt_num)){
											echo '0.00';
										} else {
											echo isset($tax)?number_format((float)$tax,2):'0.00'; 
											}
										?>
									</td>
								</tr>
								<?php 
										if(!empty($discountamount)) 
										{
								?>
								<tr style="border-bottom:solid 1px #333;">
									<td colspan="5" style="height:30px;text-align:right;border-right:1px solid #333;padding-right:8px;">
										Discount  
									</td>
									<td>
										-$<?php 
											echo isset($discountamount)?number_format($discountamount,2):'0.00'; 
										?>
									</td>
								</tr>
								<?php 
										} 
								?>
								<tr style="border-bottom:solid 1px #333;">
									<td colspan="5" style="height:30px;text-align:right;border-right:1px solid #333;padding-right:8px;">
										Total  
									</td>
									<td>
										$<?php 
											echo isset($total)?number_format($total,2):''; 
										?>
									</td>
								</tr>
								<?php
									}
									if(isset($bqr) && $bqr==true)
									{
								?>
								<tr style="border-bottom:solid 1px #333;">
									<td colspan="5" style="height:30px;text-align:right;border-right:1px solid #333;padding-right:8px;">
										Note: Customer is responsible for customs clearance and any applicable taxes  
									</td>
									<td>
										Shipping Cost TBD
									</td>
								</tr>
  
								<?php
									}
								?>
						</table>
						<div class="clear"> 
						</div>
						<div>

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
					<div>

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
								<option value="Purchase Order" <?php  if($paymenttype=="Purchase Order"){echo "selected";} ?>>
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
								<option value="">Please Select Payment Method</option>							  
								<option value="Credit Card">
									Credit Card
								</option>  
								<option value="Paypal">
									Paypal
								</option>
								<option value="Purchase Order">Purchase Order</option>
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
					<div id ="po_details" style="display: none" >
						<div class="reg_left"> 
							<div class="reg_a">
								<p>PO Number <span>* </span></p>
							</div>
							<div class="reg_b">
								<input name="po_num" id="po_num" type="text" value="">
							</div>
						</div>
						<div class="clear"></div>
						<div class="reg_left">
							<div class="reg_a"></div>
							<div class="reg_b">
								<b>Bill to:</b>
							</div>
						</div>
						<div class="clear"></div>
						<div class="reg_left"> 
							<div class="reg_a">
								<p>Attn <span>* </span></p>
							</div>
							<div class="reg_b">
								<input name="battn" id="battn" type="text" value="" required>
							</div>
						</div>
						<div class="clear"></div>
						<div class="reg_left"> 
							<div class="reg_a">
								<p>Company Name <span>* </span></p>
							</div>
							<div class="reg_b">
								<input name="bcompany" id="bcompany" type="text" value="" required>
							</div>
						</div>
						<div class="clear"></div>
						<div class="reg_left"> 
							<div class="reg_a">
								<p>Address 1 <span>* </span></p>
							</div>
							<div class="reg_b">
								<input name="baddr1" id="baddr1" type="text" value="" required>
							</div>
						</div>
						<div class="clear"></div>
						<div class="reg_left"> 
							<div class="reg_a">
								<p>Address 2<span>* </span></p>
							</div>
							<div class="reg_b">
								<input name="baddr2" id="baddr2" type="text" value="">
							</div>
						</div>
						<div class="clear"></div>
						<div class="reg_left"> 
							<div class="reg_a">
								<p>City <span>* </span></p>
							</div>
							<div class="reg_b">
								<input name="bcity" id="bcity" type="text" value="" required>
							</div>
						</div>
						<div class="clear"></div>
						<div class="reg_left"> 
							<div class="reg_a">
								<p>State <span>* </span></p>
							</div>
							<div class="reg_b">
								<input name="bstate" id="bstate" type="text" value="" required>
							</div>
						</div>
						<div class="clear"></div>
						<div class="reg_left"> 
							<div class="reg_a">
								<p>Zip <span>* </span></p>
							</div>
							<div class="reg_b">
								<input name="bzip" id="bzip" type="text" value="" required>
							</div>
						</div>
						<div class="clear"></div>
						<div class="reg_left"> 
							<div class="reg_a">
								<p>Country <span>* </span></p>
							</div>
							<div class="reg_b">
								<select name="bcountry" id="bcountry"  class="reg_b_jump" required>
									<option value=""> --- Choose country --- </option>
									<?php foreach ($countries as $k => $value) {
												echo '<option value="'.$value.'">'.$value.'</option>';
									}?>
								</select>
							</div>
						</div>
						<div class="clear"></div>
						<div class="reg_left"> 
							<div class="reg_a">
								<p>Tel <span>* </span></p>
							</div>
							<div class="reg_b">
								<input name="bphone" id="bphone" type="text" value="" required>
							</div>
						</div>
						<div class="clear"></div>
						<div class="reg_left"> 
							<div class="reg_a">
								<p>Fax <span>* </span></p>
							</div>
							<div class="reg_b">
								<input name="bfax" id="bfax" type="text" value="" >
							</div>
						</div>
						<div class="clear"></div>
						
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
							<input id="tax_exempt_id" type="text" name="tax_exempt_id" value="">
						</div>
					</div> 
					<div class="clear">
					</div>
					</div>
					<!-- Aakash ended here --> 
						</div>
						<div style="padding: 15px;">
							<div id="cc_divp">
								<div class="reg_left_no_pad"> 
								<?php 
									echo !empty($fedex)?'<div class="reg_a"><p>Carrier info: </p></div><div class="reg_b">'.$fedex.'</div></div>':'';
								?>
								
								<div class="clear">
								</div>
						

								<div class="reg_left_no_pad">
									<div class="reg_cf">
										<input type="hidden" name="fulltotal"  id="fulltotal" value="">
									</div>
								</div>
								<div class="clear"> 
								</div>
								<div id="ajxdiv">
								</div>
								<div class="clear">
								<br>
								</div>
								<div class="reg_left_no_pad">
									<div class="reg_a">
										<b>
											Ship to:
										</b>
									</div>
								</div>
								<div class="clear">
								</div>
								<div class="reg_left_no_pad"> 
									<div class="reg_a">
									</div>
									<div class="reg_b">
										<?php 
											echo isset($sattn)?$sattn:'';
										?>
									</div>
								</div>
								<div class="clear">
								</div>
								<div class="reg_left_no_pad">
									<div class="reg_a">
									</div>
									<div class="reg_b">
										<?php 
											echo isset($scompany)?$scompany:'';
										?>
									</div>
								</div>
								<div class="clear">
								</div>
								<div class="reg_left_no_pad">
									<div class="reg_a">
									</div>
									<div class="reg_b">
										<?php 
											echo isset($sddr1)?$sddr1:'';
										?>
									</div>
								</div>
								<div class="clear">
								</div>
								<div class="reg_left_no_pad">
									<div class="reg_a">
									</div>
									<div class="reg_b">
										<?php 
											echo isset($saddr2)?$saddr2:'';
										?>
									</div>
								</div>
								<div class="clear">
								</div>
								<div class="reg_left_no_pad">
									<div class="reg_a">
									</div>
									<div class="reg_b">
										<?php 
											echo isset($scity)?$scity:'';
										?>
									</div>
								</div>
								<div class="clear">
								</div>
								<div class="reg_left_no_pad">
									<div class="reg_a">
									</div>
									<div class="reg_b">
										<?php 
											echo isset($sstate)?$sstate:'';
										?>
									</div>
								</div>
								<div class="clear">
								</div>
								<div class="reg_left_no_pad">
									<div class="reg_a">
									</div>
									<div class="reg_b">
										<?php 
											echo isset($szip)?$szip:'';
										?>
									</div>
								</div>
								<div class="clear">
								</div>
								<div class="reg_left_no_pad">
									<div class="reg_a">
									</div>
									<div class="reg_b">
										<?php 
											echo isset($scountry)?$scountry:'';
										?>
									</div>
								</div>
								<div class="clear">
								</div>
								<div class="reg_left_no_pad">
									<div class="reg_a">
									</div>
									<div class="reg_b">
										<?php 
											echo isset($sphone)?$sphone:'';
										?>
									</div>
								</div>
								<div class="clear">
								</div>
								<div class="reg_left_no_pad">
									<div class="reg_a">
									</div>
									<div class="reg_b">
										<?php 
											echo isset($semail)?$semail:'';
										?>
									</div>
								</div>
								<div class="clear">
								<br>

								</div>
									<div class="reg_left_no_pad">
									<div class="reg_a">
										<p>
											Notes (e.g. special handling):
										</p>
									</div>
									<div class="reg_b">
										<?php 
											echo isset($cmnts)?$cmnts:'';
										?>
									</div>
								</div>
								<div class="clear">
								</div>
								<div class="reg_left_no_pad" style="padding-top:5px;">
									<div class="reg_a">
										<p>
											Please fill out this field <span>*</span>  
										</p>
									</div>
									<div class="reg_b">
										<div class="g-recaptcha" data-size="compact" data-sitekey="<?php echo isset($captcha_site_key)?$captcha_site_key:'';?>">
										</div>
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
								<br>
								<div class="reg_left">
									<div class="reg_a">
									</div>
									<div class="reg_b_buttons">
										<a href="/checkout/<?php echo isset($personID)?'checkout':'guestcheckout'; ?>">
											<input class="button" style="color: red;" type="button" value="Go back">
										</a>
										&nbsp;
										&nbsp;
										&nbsp;
										&nbsp; 
										<input class="button" name="bill_chkout_qtn" id="bill_chkout_qtn" type="button" value="Submit">
									</div>
								</div>
							</div>
							<div id="msgbox">
							</div>
							<br>
							<br>
							<div class="clear">
							</div>
						</div>
					</div>
				</div>
			</article>
		</section>
		<div class="clear">
		</div>
	</form>
</section>
<div id="wait" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;"><img src='/images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
<?= isset($hostedAccessPaymentPage) ? $hostedAccessPaymentPage : ''?>
<?= isset($paypalHostedAccessPaymentPage) ? $paypalHostedAccessPaymentPage : ''?>

