<form method="post" name="login_form" id="login_form" action="/user/forgot">
	<section class="content-right">
		<article class="content-right-btm" style="margin-top:0px;">
			<div class="new-products" style="margin-top:0px;">
				<div class="new-products-title">
					<h1>
						<span>
							Forgot Password
						</span>
					</h1>
				</div>
				<div class="new-products-list">
					<div class="reg_left">
						<div class="reg_a">
						</div>
						<div class="reg_b">
						</div>
					</div>
					<div class="reg_right">
						<div class="reg_a">
						</div>
						<div class="reg_b">
						</div>
					</div>
					<div class="clear"> 
					</div>
					<div class="reg_left">
						<div class="reg_a">
						</div>
						<div class="reg_b">	
							<?php 
								if(isset($responseGreen))
								{
							?>
							<div  style="color: green!important;">
								<?php 
									echo isset($response)?$response:'';
								?>
							</div>
							<?php 
								}
								else
								{ 
							?>
							<div  style="color: red!important;">
								<?php 
									echo isset($response)?$response:'';
								?>
							</div>
							<?php 
								} 
							?>
						</div>
					</div>
					<div class="clear">
					</div>
				
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Email:
							</p>
						</div>
						<div class="reg_b">
							<input name="email" id="email" type="text">
						</div>
					</div>
					<div class="reg_right">
						<div class="reg_a">
						</div>
						<div class="log_b">
						</div>
					</div>
					<div class="clear">
					</div>

					<div class="reg_left">
						<div class="reg_a">
						</div>
						<div class="reg_b_buttons">
							<input name="forgot" type="submit" value="Submit" class="button">
						</div>
					</div>
					<div class="reg_right">
						<div class="log_a">
							<!--
								<a href="register.php?action=create">
									Register
								</a>
							-->
						</div>
						<div class="reg_b">
						</div>
					</div>
					<div class="clear">
					</div>
				</div>
			</div>
		</article>
	</section>
</form>
</div>