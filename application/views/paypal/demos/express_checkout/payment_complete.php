<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="content-area">
    <section class="content-right">
        <article class="content-right-btm" style="margin-top:0px;">
            <div class="new-products">
				<div class="new-products-title">
					<h1><span>Review order</span></h1>
				</div>
				<div class="new-products-list"> 
					<table width="100%"style="margin: 0px 0px 4% 0px; border: 1px solid #333; text-align:center; font-family:Tahoma, Geneva, sans-serif;font-size:14px;">
						<tr style="background:#589d3f; border:1px solid #333;"border="0" bordercolor="#333333">
                            <td style="border-right:1px solid #333;">ID</td>
                            <td style="height:30px;border-right:1px solid #333">Product Name</td>
                            <td style="height:30px;border-right:1px solid #333">Catalog No</td>
				    		<td style="border-right:1px solid #333;">Price</td>
					    	<td style="border-right:1px solid #333;">QTY</td>
							<td style="border-right:1px solid #333;">Total</td>
                        </tr>
                        <?php 
                        $discountamount = $this->session->userdata('discountamount');
                        $ProductCart = $this->cart->contents();
                        foreach($ProductCart as $cart_item) { ?>
						<tr style="border-bottom:1px solid #333;">
							<td style="height:20px; border-right:1px solid #333;"><?php echo $cart_item['id']; ?></td>
                            <td style="border-right:1px solid #333;"><?php echo $cart_item['name']; ?></td>
							<td style="border-right:1px solid #333;"><?php echo $cart_item['catalog']; ?></td> 
							<td style="border-right:1px solid #333;">$<?php echo number_format($cart_item['price'],2); ?></td>
							<td style="border-right:1px solid #333;"><?php echo $cart_item['qty']; ?></td>
							<td style="border-right:1px solid #333;"> $<?php echo round($cart_item['qty'] * $cart_item['price'],2); ?></td>
                        </tr>
                        <?php } ?>
						<tr style="border-bottom:solid 1px #333;">
							<td colspan="5" style="height:30px;text-align:right;border-right:1px solid #333;padding-right:8px;">Subtotal</td>
							<td>$<?php if(!empty($discountamount)){
                                echo number_format($this->cart->total(),2) - number_format($discountamount,2); 
                            }else{
                                echo number_format($this->cart->total(),2); 
                            }?></td>
						</tr>
						<tr style="border-bottom:solid 1px #333;">
							<td colspan="5" style="height:30px;text-align:right;border-right:1px solid #333;padding-right:8px;">Shipping</td>
							<td>$<?php echo number_format($cart['shopping_cart']['shipping'],2); ?></td>
                        </tr>
                        <tr style="border-bottom:solid 1px #333;">
							<td colspan="5" style="height:30px;text-align:right;border-right:1px solid #333;padding-right:8px;">Handling</td>
							<td>$<?php echo number_format($cart['shopping_cart']['handling'],2); ?></td>
						</tr>
						<tr style="border-bottom:solid 1px #333;">
                            <td colspan="5" style="height:30px;text-align:right;border-right:1px solid #333;padding-right:8px;">Tax</td>
                            <td>$<?php echo number_format($cart['shopping_cart']['tax'],2); ?></td>
                        </tr>
                        <?php if(!empty($discountamount)){?>
                        <tr style="border-bottom:solid 1px #333;">
                            <td colspan="5" style="height:30px;text-align:right;border-right:1px solid #333;padding-right:8px;">Discount</td>
                            <td>$<?php echo $discountamount; ?></td>
                        </tr>
                        <?php } ?>
                        <tr style="border-bottom:solid 1px #333;">
						    <td colspan="5" style="height:30px;text-align:right;border-right:1px solid #333;padding-right:8px;">Grand Total</td>
						    <td>$<?php echo $cart['shopping_cart']['grand_total']; ?></td>
						</tr>
					</table>
				    <div class="clear"></div>
			   
                    <div class="reg_left_no_pad">
                        <div class="reg_a">
                            <b>Bill to:</b>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="reg_left_no_pad"> 
                        <div class="reg_a">
                        </div>
                        <div class="reg_b">
                            <?php echo $cart['first_name'] . ' ' . $cart['last_name']; ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="reg_left_no_pad">
                        <div class="reg_a">
                        </div>
                        <div class="reg_b">
                            <?php echo $cart['email']; ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="reg_left_no_pad">
                        <div class="reg_a">
                        </div>
                        <div class="reg_b">
                            <?php echo $cart['phone_number']; ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="reg_left_no_pad">
                        <div class="reg_a">
                            <b>Ship to:</b>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="reg_left_no_pad"> 
                        <div class="reg_a">
                        </div>
                        <div class="reg_b">
                            <?php echo $cart['shipping_name']; ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="reg_left_no_pad">
                        <div class="reg_a">
                        </div>
                        <div class="reg_b">
                            <?php echo $cart['shipping_street'].', '.$cart['shipping_city']; ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="reg_left_no_pad">
                        <div class="reg_a">
                        </div>
                        <div class="reg_b">
                            <?php echo $cart['shipping_state'].' '. $cart['shipping_zip'] . '<br />'.$cart['shipping_country_name']; ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="reg_left" style="margin-top:4%;">
                        <div class="reg_a"></div>
                        <div class="reg_b_buttons">
                            <a class="button" href="/">Back To shop</a>								
                        </div>
                    </div>
                </div>
		    </div>
        </article>
	</section>	
</section>