<section class="content-right">
	<article class="content-right-btm" style="margin-top:0px;">
		<div class="new-products" style="margin-top:0px;">
			<div class="new-products-title">
				<h1>
					<span>
						Login
					</span>
				</h1>
			</div>
			<div class="new-products-list">
				<div style="height:280px;">
					<div id="login">
						<div id="login-left" style="width: 50%; height: 220px; float: left; padding-top: 20px; padding-left: 10%;">
							<form method="POST" action="/user/login" > 
								<!--     id="login_form" form id-->
								<div class="clear">
								</div>
								<div>
									<div style="display: inline-block; width: 180px;">
										<div class="clear">
										</div>
										<div>
											<div style="text-align: left; padding-bottom: 20px;">
												<input type="hidden" name="fromcart" value="<?php echo isset($_GET)?$this->input->get('fromcart'):'';?>">								
												<p>Email:</p>						
												<input name="email" id="email" type="text" value="<?php echo set_value('email'); ?>">
											</div>
										</div>
										<div class="clear">
										</div>
										<div>
											<div style="text-align: left; padding-bottom: 10px;">
												<p>Password:</p>
												<input name="pswd" id="pswd" type="password" <?php echo set_value('pswd'); ?>>
											</div>
										</div>
										<div style="text-align: left;">
											<a href="/user/forgot.html">Forgot Password?</a>
										</div>
										<div class="clear">
											<br>
										</div>
										<div style="text-align: left;">
											<input class="button" name="logn" type="submit" value="Login">
										</div>
										<div  style="color: red!important; text-align: left; padding-bottom: 5px; padding-top: 5px;">
											<?php 
												echo validation_errors(); 
											?>
											<?php 
												echo isset($response)?$response:'';
											?>
											<?php 
												if(isset($_GET['msg']))
												{ 
													echo '<font color="red">login failed..</font>'; 
												} 
											?>
										</div>									
									</div>
								</div>
							</form>
						</div>
						<div id="login-right" style="width: 35%; height: 220px; float: right;  padding-top: 20px;">
							<div class="clear">
							</div>
							<div>
								<div>
									<p> Don't have an account with us?
									<br>
									Register one now.</p>
									<br>
									<a class="button" href="/user/register">Register</a>
									<br>
									<br>
									<br>
								</div>
									<!-- <a href="/user/forgot">Forgot Password?</a>
									<a href="/user/register">Register</a>  -->
								<div class="clear">
								</div>
								<div>
									<?php 
										if(!empty($this->cart->contents())){
									?>
										<p>Or continue to checkout<p>
										<br>
										<a class="button" href="/checkout/guestcheckout">Guest Checkout</a>
									<?php 
										} 
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>
</section>