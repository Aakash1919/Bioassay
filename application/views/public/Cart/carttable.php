<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr class="mycart_title">
		<th width="29%" scope="col">Product Name</th>
		<th width="14%" scope="col">Quantity</th>
		<th width="17%" scope="col">Unit Price</th>
		<th width="15%" scope="col">Total</th>
		<th class="update-remove" width="25%" scope="col">Update/Remove</th>
	</tr>
						<!-- <tr>
						        <th>QTY</th>
						        <th>Item Description</th>
						        <th style="text-align:right">Item Price</th>
						        <th style="text-align:right">Sub-Total</th>
						    </tr> -->

						    <?php $i = 1; ?>

						    <?php foreach ($this->cart->contents() as $items): ?>

						    	<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

						    	<tr class="mycart_title">
						    		<td>
						    			<?php echo $items['name']; ?>

						    			<?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

						    				<p>
						    					<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

						    						<strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

						    					<?php endforeach; ?>
						    				</p>

						    			<?php endif; ?>

						    		</td>
						    		<td><?php echo form_input(array('name' => $i.'[qty]', 'class'=>'UpdateCart', 'id'=>$items['rowid'], 'value' => $items['qty'], 'type'=>'number', 'maxlength' => '4', 'size' => '1', 'style' => 'text-align: center;width:50px;')); ?></td>

						    		<td><label><?php echo $this->cart->format_number($items['price']); ?></label></td>
						    		<td><label>$<?php echo $this->cart->format_number($items['subtotal']); ?></label></td>
						    		<td class="update-remove">
						    			<a href="/checkout/delete/?rowid=<?php echo $items['rowid'];?>"> <img src="/images/remove.png"></a>
						    		</td>
						    	</tr>

						    	<?php $i++; ?>

						    <?php endforeach; ?>

						    <tr>
						    	<td></td>
						    	<td></td>
						    	<td style="text-align: right; font-weight: bold; padding-top: 10px;"><strong>Total</strong></td>
						    	<td style="text-align: center; font-weight: bold; padding-top: 10px;">$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
						    </tr>

						</table>