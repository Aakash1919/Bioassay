<section class="content-area">
	<section class="content-right">
		<article class="content-right-btm" style="margin-top:0px;">
			<div class="new-products" style="margin-top:0px;">
				<div class="new-products-title">
					<h1>
						<span>
							Thanks
						</span>
					</h1>
				</div>
				<div class="new-products-list">
					<?php echo "<pre>"; print_r($this->session->userdata());echo "</pre>";?>
					<div style="padding: 15px;">
						<div>
							<h1>
								<span>
									Thank you very much for your order!
									<!--<br>-->
									<!--An email confirmation was sent to you at <?php echo $this->session->userdata('email');?>-->
								</span>
							</h1>
							<!--<br>-->
						</div>
						<?php
							//get flashdata
							$r = $this->session->flashdata('response');
							if(isset($r))
							{
								echo $r['Message'];
							} 
						?>
						<p>
							&nbsp;
						</p>
						<p>
							<a href="/products" class="button" >
								Continue Shopping
							</a>
						</p> 
						</br>
						<p>
							&nbsp;
						</p>
					</div>
				</div>
			</div>
		</article>
	</section>
</section>
