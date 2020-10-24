<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabTable">
	<tr  class="productListing-rowheading" vertical-align="middle">
		<th><div style="display: flex;align-items: center;padding-bottom: 5px;"><a href="#">Product Name  </a><p style="margin-left: auto;"><span ><button style="padding: 0px 3px;" class="asc" id="name"><i class="arrow up"></i></button><br><button style="padding: 0px 3px;"  class="desc" id="name"><i class="arrow down"></i></button></span></p></div></th>
		<th class="catalog-column"><div style="display: flex;align-items: center;padding-bottom: 5px;"><a href="#">Catalog #</a><p style="margin-left: auto;"><span ><button style="padding: 0px 3px;"  class="asc" id="catalog_num"><i class="arrow up"></i></button><br><button style="padding: 0px 3px;" class="desc" id="catalog_num"><i class="arrow down"></i></button></span></p></div></th>
		<th class="protocol-column"><a href="#">Protocol</a></th>
		<th class="msds-column"><a href="#">SDS</a></th>
		<th class="price-column"><div style="display: flex;align-items: center;padding-bottom: 5px;"><a href="#">Price ($)</a> <p style="margin-left: auto;"><span ><button style="padding: 0px 3px;" class="asc" id="price"><i class="arrow up"></i></button><br><button style="padding: 0px 3px;" class="desc" id="price"><i class="arrow down"></i></button></span></p></div></th>
		<th class="qty-column"><a href="#">QTY</a></th>
		<th><a href="#">Add to Cart</a></th>
	</tr>
<?php if (!empty($items)) {
    $count = 0;
    foreach ($items as $i) {
        $pov = $this->Products_Model->getOverview($i->product_id);
        if (!empty($pov)) {
            foreach ($pov as $pro_overview) {
                $protocol = $pro_overview->protocol;
                $msds = $pro_overview->msds;
            }
        }
        if ($count % 2 == 0) {
            $rowclass = "productListing-even";
        } else {
            $rowclass = "productListing-odd";
        } ?>
	<tr class="<?php echo $rowclass; ?>">
		<form action="/checkout/addtocart" method="post">
    		<input type="hidden" name="product_id" value="<?php echo $i->product_id; ?>">
			<input type="hidden" name="price" value="<?php echo $i->price; ?>">
			<input type="hidden" name="name" value="<?php echo $i->name_display; ?>">
			<input type="hidden" name="catalog" value="<?php echo $i->catalog_num; ?>">
			<input type="hidden" name="ship" value="<?php echo $i->shipping_method; ?>">
			<td><a href="/<?php echo mb_convert_encoding($i->url, "HTML-ENTITIES", "UTF-8"); ?>.html"><?php echo mb_convert_encoding($i->name_display, "HTML-ENTITIES", "UTF-8"); ?></a></td>
			<td class="catalog-column"><?php echo isset($i->catalog_num) ? $i->catalog_num : ""; ?></td>
			<td class="protocol-column">
			<?php if (!empty($protocol)) {
               echo '<a target="_blank" href="/datasheet/' . $protocol . '">Protocol</a>';
            }?>
			</td>
			<td class="msds-column">
                <?php if (!empty($msds)) {
                    echo '<a target="_blank" href="/datasheet/' . $msds . '">SDS</a>';
                }
                ?>
    		</td>
        	<td class="price-column"><?php echo isset($i->price) ? "$" . $i->price : '<a href="/support">inquire</a>'; ?></td>
    		<td class="qty-column"><input style="width: 30px; text-align: center;" type="number" value="1" name="quantity" min="1"></td>
			<td><button class="cartbtn"><img src="/images/cart.png"></button></td>
		</form>
	</tr>
    <?php   $count++;
    }
}?>
</table>
