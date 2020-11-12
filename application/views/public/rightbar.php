<?php
foreach ($item as $i) {
	$id = $i->product_id;
	$name = $i->name;
	//$description = $i->description;
	//$faq = $i->faq;
	//$citations = $i->citations;
	$display_name = $i->name_display;
	$catalog_num = $i->catalog_num;
	//$service = $i->service;
	$price = $i->price;
	$shipping_method = $i->shipping_method;
	$storage = $i->storage;
	$product_figure = $i->product_figure;
	$url = $i->url;
	$inStock = $i->in_stock;
}
?>

<div class="prod_sidebar">
	<div class="mobile-hide">
		<div class="buynow">
			<span class="buynow_red" style="border:bold;font-size:1.5em;font-style:italic; font-weight:bold;">Buy Now!!!</span><br> 
			<form action="/checkout/addtocart"  method="post"> 
					<?php echo mb_convert_encoding($name, "HTML-ENTITIES", "UTF-8");?><br>
					<span class="buynow_black"> Catalog No: </span> <?php echo stripslashes($catalog_num);?><br> 
					<div class="clear" style="padding-bottom:15px;"></div>
					<input type="hidden" name="product_id" value="<?php echo $id;?>">
					<input type="hidden" name="price" value="<?php echo stripslashes($price);?> ">
					<input type="hidden" name="catalog" value="<?php echo $catalog_num;?>">
					<input type="hidden" name="ship" value="<?php echo $shipping_method;?>">
					<input type="hidden" name="name" value="<?php echo mb_convert_encoding($display_name, "HTML-ENTITIES", "UTF-8");?>">
					<span class="buynow_black">Price:</span> $<?php echo stripslashes($price);?> &nbsp;&nbsp;&nbsp;
					<?php if(isset($inStock) && $inStock=='n'){ ?>
					<span class="buynow_black">Out Of Stock</span>
					<?php }else { ?>
					<span class="buynow_black">Qty:</span> <input type="text" name="quantity" size="2" value="1" />    
					<input class="cart-icon" style="cursor:pointer;" type="submit" size="2" value="" >
					<?php } ?>
					<div class="clear" style="padding-bottom:15px;"></div>
					<span class="buynow_black"><i>For orders of 10 or more kits, please call <a href="tel:+15107829988,1">+1-510-782-9988x1</a> or <a href="javascript:location='mailto:\u0069\u006e\u0066\u006f\u0040\u0062\u0069\u006f\u0061\u0073\u0073\u0061\u0079\u0073\u0079\u0073\u002e\u0063\u006f\u006d\u003f\u0073\u0075\u0062\u006a\u0065\u0063\u0074\u003d<?php echo ucfirst($name);?> Bulk Order ';void 0"> email us</a> for best pricing and/or bulk order</i>. </span><br><br>

					<span class="buynow_black">Shipping:</span> <?php echo stripslashes($shipping_method);?><br>
					<span class="buynow_black">Shipment:</span><?php echo ($shipping_method=='Free Shipping')?'USPS':'Fedex Service';?> <br />
					<span class="buynow_black">Delivery:</span><?php echo ($shipping_method=='Free Shipping')?' 2-5 days (Continental US only)':' 1-2 days (US), 3-6 days (Intl)';?>
						<br />
					<span class="buynow_black">Storage:</span> <?php echo stripslashes($storage);?><br>
							<img src="/images/Product_pics/<?php echo $product_figure;?>" alt="<?php echo $display_name;?>" width="230" height="166" >
			  
			
			</form> 
		</div>
	</div>

  <br/>
           <div class="product-overview">
				<div class="product-overview-title" style="align:left;padding-left:3px;"><h2>Related Products</h2></div>
					<div class="listing">

										<ul> 
										<?php 
										foreach ($item as $i) {
											$related = $i->related_products;
										}

										if(!empty($related)){
											$related_products = explode(",", $related);
											
											foreach ($related_products as $r => $value) {
												$product = $this->Products_Model->GetByProductId($value);
												foreach ($product as $p ) { ?>
													<li>
												
										 				<a href="<?php echo $p->url;?>.html"><?php echo mb_convert_encoding($p->name_display, "HTML-ENTITIES", "UTF-8");?></a>

										 	
													</li>
												<?php	
												}
											}
										} ?>


										</ul>
					</div>
<br/>
<span class="buynow_red" style="border:bold;font-size:1.2em;font-style:italic; font-weight:bold;">Why BioAssay Systems?</span><br /><br />

<div class="buynow">
		<span class="textbold_orange">Expert Technical Support</span><br /><span class="buynow_black">Technical support provided by the very scientists that develop the assays.<br /><br />

		<span class="textbold_orange">Quality and User-friendly</span><br />Products are extensively tested and validated prior to release so researchers need little-to-no time for assay optimization.<br /><br />

		<span class="textbold_orange">Competitive Prices</span><br />Because we develop and manufacture the products, our prices are lower than competitors on the market<br /><br />

		<span class="textbold_orange">Expansive Catalogue</span><br />With over 200 different products, acquire all your assay kit needs in one order.<br /><br />

		<span class="textbold_orange">Trusted Globally</span><br />Products used by clients worldwide with distributors in over 60 countries.</span><br /><br />
           
  </div>
</div>
</div>
  <div class="clear"> </div>
