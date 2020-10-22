<section class="content-right">
	<article class="content-right-btm" style="margin-top:0px;">
		<div class="new-products" style="margin-top:0px;">
			<div class="new-products-title"><h1><span>My Cart</span></h1></div>
			<div class="new-products-list" style="width:100%;">
				<div class="mycart" id="cartdata">
					

				</div>
					<div class="clear"></div>
					<div style="height: 35px; padding-bottom: 20px; padding-right: 20px; padding-left: 20px; padding-top: 20px;">
						<?php //echo form_submit('', 'Update your Cart', 'class = button'); ?>
						<a style="float: right;" class="button" href="/checkout/checkout?fromCart=true"><strong>Checkout</strong></a></p>
					</div>
				</div>
			</div>
		</article>
</section>
<script type="text/javascript">
	jQuery(document).ready(function(){
		loadCart();
	});

	function loadCart(){
		var Message = '<p style="text-align:center;padding:10px;">loading.. Please wait</p>';
		jQuery("#cartdata").html(Message);
		var url = "/checkout/CartTable";
		jQuery.get( url, function( data ) {
			jQuery("#cartdata").html(data);
		});
	}
	jQuery(document).on('change','.UpdateCart',function(){
		var row = jQuery(this).attr('id');
		var quantity = jQuery(this).val();
		var url = "/checkout/UpdateCartRow";
		jQuery.post( url,{'row':row,'quantity':quantity}, function( data ) {
		  loadCart();
		});
	});
</script>