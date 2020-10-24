<script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
    $po_num = $PreviousInfo['po_num'];
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
    $battn= $PreviousInfo['battn'];
    $bcompany= $PreviousInfo['bcompany'];
    $baddr1= $PreviousInfo['baddr1'];
    $baddr2= $PreviousInfo['baddr2'];
    $bcity= $PreviousInfo['bcity'];
    $bstate= $PreviousInfo['bstate'];
    $bzip= $PreviousInfo['bzip'];
    $bcountry= $PreviousInfo['bcountry'];
    $bphone= $PreviousInfo['bphone'];
    $bfax= $PreviousInfo['bfax'];
    $cmnts= $PreviousInfo['cmnts'];
    $payment_type = $PreviousInfo['payment_type'];
    $cardnumber = $PreviousInfo['cardnumber'];
    $csc1 = $PreviousInfo['csc1'];
    $year = $PreviousInfo['year'];
    $month = $PreviousInfo['month'];
    @$cccheck = $PreviousInfo['cccheck'];
	$sales_tax_exempt_num = $PreviousInfo['sales_tax_exempt_num'];
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
	<form  method="post" name="regform" id="regform" action="/checkout/finalTransaction">
		<input type="hidden" name="cccheck" value="<?php echo isset($cccheck)?$cccheck:0; ?>">
		<input type="hidden" name="cardnumber" value="<?php echo isset($cardnumber)?base64_encode($cardnumber):'';?>">
		<input type="hidden" name="csc1" value="<?php echo isset($csc1)?base64_encode($csc1):'';?>">
		<input type="hidden" name="year" value="<?php echo isset($year)?base64_encode($year):'';?>">
		<input type="hidden" name="month" value="<?php echo isset($month)?base64_encode($month):'';?>">
		<input type="hidden" name="fedex_accnt" value="<?php echo isset($fedex)?$fedex:'';?>">
		<input type="hidden" name="fedex_service" value="<?php echo isset($fedexservice)?$fedexservice:'';?>">
		<input type="hidden" name="sattn" value="<?php echo isset($sattn)?$sattn:'';?>">
		<input type="hidden" name="scompany" value="<?php echo isset($scompany)?$scompany:'';?>">
		<input type="hidden" name="po_num" value="<?php echo isset($po_num)?$po_num:'';?>">
		<input type="hidden" name="saddr1" value="<?php echo isset($sddr1)?$sddr1:'';?>">
		<input type="hidden" name="saddr2" value="<?php echo isset($sddr2)?$sddr2:'';?>">
		<input type="hidden" name="scity" value="<?php echo isset($scity)?$scity:'';?>">
		<input type="hidden" name="sstate" value="<?php echo isset($sstate)?$sstate:'';?>">
		<input type="hidden" name="szip" value="<?php echo isset($szip)?$szip:'';?>">
		<input type="hidden" name="scountry" value="<?php echo isset($scountry)?$scountry:'';?>">
		<input type="hidden" name="sphone" value="<?php echo isset($sphone)?$sphone:'';?>">
		<input type="hidden" name="semail" value="<?php echo isset($semail)?$semail:'';?>">
		<input type="hidden" name="battn" value="<?php echo isset($battn)?$battn:'';?>">
		<input type="hidden" name="bcompany" value="<?php echo isset($bcompany)?$bcompany:'';?>">
		<input type="hidden" name="baddr1" value="<?php echo isset($baddr1)?$baddr1:'';?>">
		<input type="hidden" name="baddr2" value="<?php echo isset($baddr2)?$baddr2:'';?>">
		<input type="hidden" name="bcity" value="<?php echo isset($bcity)?$bcity:'';?>">
		<input type="hidden" name="bstate" value="<?php echo isset($bstate)?$bstate:'';?>">
		<input type="hidden" name="bzip" value="<?php echo isset($bzip)?$bzip:'';?>">
		<input type="hidden" name="bcountry" value="<?php echo isset($bcountry)?$bcountry:'';?>">
		<input type="hidden" name="bphone" value="<?php echo isset($bphone)?$bphone:'';?>">
		<input type="hidden" name="bfax" value="<?php echo isset($bfax)?$bfax:'';?>">
		<input type="hidden" name="cmnts" value="<?php echo isset($cmnts)?$cmnts:'';?>">
		<input type="hidden" name="payment_type" value="<?php echo isset($payment_type)?$payment_type:'';?>">
		<input type="hidden" name="sales_tax_exempt_num" value="<?php echo isset($sales_tax_exempt_num)?$sales_tax_exempt_num:'';?>">
		<input type="hidden" name="sales_tax_exempt_num1" value="<?php echo isset($sales_tax_exempt_num1)?$sales_tax_exempt_num1:'';?>">
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
									<?php 
										if(isset($payment_type) && $payment_type!="Paypal")
										{ 
									?>
								<div class="reg_left_no_pad">
									<div class="reg_a">
										<b>
											Bill to:
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
											echo isset($battn)?$battn:'';
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
											echo isset($bcompany)?$bcompany:'';
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
											echo isset($baddr1)?$baddr1:'';
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
											echo isset($baddr2)?$baddr2:'';
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
											echo isset($bcity)?$bcity:'';
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
											echo isset($bstate)?$bstate:'';
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
											echo isset($bzip)?$bzip:'';
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
											echo isset($bcountry)?$bcountry:'';
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
											echo isset($bphone)?$bphone:'';
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
											echo isset($bfax)?$bfax:'';
										?>
									</div>
								</div>
								<div class="clear">
								</div>
								<?php } ?>
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
										<input class="button" name="bill_chkout_qtn" id="bill_chkout_qtn" type="submit" value="Submit">
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
<script type="text/javascript">
  $("form#regform").submit(function(event) {
   
   var recaptcha = grecaptcha.getResponse();
   if (recaptcha === "") {
      event.preventDefault();
    swal('Please check the recaptcha');
   }
});
</script>
