<!--<script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
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
// echo "<pre>";
// print_r($PreviousInfo);
// echo "</pre>";
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
<section class="content-area">
	<form  method="post" name="regform" id="regform" action="<?php echo isset($authToken)?'https://test.authorize.net/payment/payment':'/checkout/finalTransaction'; ?>">
		<input type="hidden" name="token" id="authToken" value="<?php echo isset($authToken)?$authToken:0; ?>">
		<input type="hidden" name="cccheck" value="<?php echo isset($cccheck)?$cccheck:0; ?>">
		<input type="hidden" name="cardnumber" value="<?php echo isset($cardnumber)?base64_encode($cardnumber):'';?>">
		<input type="hidden" name="csc1" value="<?php echo isset($csc1)?base64_encode($csc1):'';?>">
		<input type="hidden" name="year" value="<?php echo isset($year)?base64_encode($year):'';?>">
		<input type="hidden" name="month" value="<?php echo isset($month)?base64_encode($month):'';?>">
		<input type="hidden" name="fedex_accnt" value="<?php echo isset($fedex)?$fedex:'';?>">
		<input type="hidden" name="fedex_service" value="<?php echo isset($fedexservice)?$fedexservice:'';?>">
		<input type="hidden" name="sattn" value="<?php echo isset($sattn)?$sattn:'';?>">
		<input type="hidden" name="scompany" value="<?php echo isset($scompany)?$scompany:'';?>">
		<input type="hidden" name="po_num" id="input_po_num" value="<?php echo isset($po_num)?$po_num:'';?>">
		<input type="hidden" name="saddr1" value="<?php echo isset($sddr1)?$sddr1:'';?>">
		<input type="hidden" name="saddr2" value="<?php echo isset($sddr2)?$sddr2:'';?>">
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
								<p>
									PO Number <span>* </span>
								</p>
							</div>
							<div class="reg_b">
								<input name="po_num" id="po_num" type="text" value="" onFocus="clrpo()">
							</div>
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
								<?php 
									if(isset($payment_type) && $payment_type=="Paypal")
									{
								?>
								 <div class="reg_left_no_pad"> 
									 <div class="reg_a">
										<p>
											Payment Type: 
										</p>
									</div>
									<div class="reg_b">
										Paypal
									</div>
								</div>
								<div class="clear"> 
								</div>
								 <div class="reg_left_no_pad"> 
									 <div class="reg_a">
										<p>
											PO Number: 
										</p>
									</div>
									<div class="reg_b">
										<?php 
											echo isset($po_num)?$po_num:'';
										?>
									</div>
								</div>
								<div class="clear"> 
								</div>
								<div class="reg_left_no_pad"> 
									<div class="reg_a">
										<p>
											Fedex Service Type: 
										</p>
									</div>
									<div class="reg_b">
										<?php 
											echo isset($fedexservice)?$fedexservice:'';
										?>
									</div>
								</div>
								<div class="clear">
								<div class="reg_left_no_pad">
									<div class="reg_a">
										<p>
										Tax Exemption Number: 
										</p>
									</div>
									<div class="reg_b">
										<?php 
											echo isset($sales_tax_exempt_num1)?$sales_tax_exempt_num1:'';
										?>
									</div>
								</div>
								<div class="clear">
								<br>
								</div>
								<?php 
									}  
								?>

								<?php 
									if(isset($payment_type) && $payment_type=="Purchase Order")
									{ 
								?>
								<div class="reg_left_no_pad"> 
									<div class="reg_a">
										<p>
											Payment Type: 
										</p>
									</div>
									<div class="reg_b">
										Purchase Order
									</div>
								</div>
								<div class="clear">
								</div>
								<div class="reg_left_no_pad"> 
									<div class="reg_a">
										<p>
											PO Number: 
										</p>
									</div>
									<div class="reg_b">
										<?php 
											echo isset($po_num)?$po_num:'';
										?>
									</div>
								</div>
								<div class="clear">
								</div>
								<div class="reg_left_no_pad"> 
									<div class="reg_a">
										<p>
											Fedex Service Type: 
										</p>
									</div>
									<div class="reg_b">
										<?php 
											echo isset($fedexservice)?$fedexservice:'';
										?>
									</div>
								</div>
								<div class="clear">
								<div class="reg_left_no_pad">
									<div class="reg_a">
										<p>
										Tax Exemption Number: 
										</p>
									</div>
									<div class="reg_b">
										<?php 
											echo isset($sales_tax_exempt_num)?$sales_tax_exempt_num:'';
										?>
									</div>
								</div>
								<div class="clear">
								<br>
								</div>
								<?php 
									}
								?>


								<?php 
									if(isset($payment_type) && $payment_type=="Credit Card")
									{ 
								?>
								<div class="reg_left_no_pad"> 
									<div class="reg_a">
										<p>
											Payment Type: 
										</p>
									</div>
									<div class="reg_b">
										Credit Card
									</div>
								</div>
								<div class="clear">
								</div>
								<div class="reg_left_no_pad"> 
									<div class="reg_a">
										<p>
											PO Number: 
										</p>
									</div>
									<div class="reg_b">
										<?php 
											echo isset($po_num)?$po_num:'';
										?>
									</div>
								</div>
								<div class="clear">
								</div>
								<div class="reg_left_no_pad"> 
									<div class="reg_a">
										<p>
											Fedex Service Type: 
										</p>
									</div>
									<div class="reg_b">
										<?php 
											echo isset($fedexservice)?$fedexservice:'';
										?>
									</div>
								</div>
								<div class="clear">
								<div class="reg_left_no_pad">
									<div class="reg_a">
										<p>
										Tax Exemption Number: 
										</p>
									</div>
									<div class="reg_b">
										<?php 
											echo isset($sales_tax_exempt_num)?$sales_tax_exempt_num:'';
										?>
									</div>
								</div>
								<div class="clear">
								<br>
								</div>
								<?php }  ?>

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
										<input class="button" name="bill_chkout_qtn" id="bill_chkout_qtn" type="submit" value="Submit" disabled="disabled">
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
<script type="text/javascript">
  $("form#regform").submit(function(event) {
   
   // var recaptcha = grecaptcha.getResponse();
   // if (recaptcha === "") {
   //    event.preventDefault();
   //  swal('Please check the recaptcha');
   // }
   var payment_type = jQuery(this).val();
   if(payment_type == "Purchase Order"){
   	//input_po_num
   	var po_number = jQuery("#po_num").val();
   	jQuery("#input_po_num").val(po_number);
   	//tax_exempt_id
   	var tax_exempt_id = jQuery("#tax_exempt_id").val();
   	jQuery("#sales_tax_exempt_num1").val(tax_exempt_id);
   }
});

 
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
    jQuery(document).on('change',"#paymenttype",function(){
    	jQuery("#payment_type").val("");
    	var payment_type = jQuery(this).val();
    	console.log(payment_type); 
    	//
    	if(payment_type == "Purchase Order"){
    		jQuery("#po_details").toggle();
    		jQuery("#regform").attr("action", "/checkout/finalTransaction");
    		jQuery("#po_num").attr("required",true);
    		jQuery("#bill_chkout_qtn").val("Submit Order");
    	}else{
    		jQuery("#po_details").css('display','none');
    		if(payment_type == "Credit Card"){
    			jQuery("#wait").css("display", "block");
    			jQuery("#bill_chkout_qtn").attr("disabled",true);
    			jQuery.get( "/checkout/GetAuthToken", function( data ) {
				  jQuery("#po_num").attr("required",false);
				  var result = jQuery.parseJSON(data);
				  jQuery("input#authToken").val(result.AuthToken);
				  jQuery("#regform").attr("action", result.Url);
				});
				jQuery("#bill_chkout_qtn").attr("disabled",false);
				jQuery("#wait").css("display", "none");
    		}else{
    			jQuery("#regform").attr("action", "/checkout/finalTransaction");
    			jQuery("#po_num").attr("required",false);
    		}
    		jQuery("#bill_chkout_qtn").val("Continue");
    	}
    	//payment_type
    	jQuery("#payment_type").val(payment_type);
    	jQuery("#bill_chkout_qtn").attr("disabled",false);
    });
</script>
