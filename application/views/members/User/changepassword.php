<?php 
	if(isset($personID))
	{
?>
<form action="/user/changepassword" method="post" name="regform">
	<section class="content-right">
		<article class="content-right-btm" style="margin-top:0px;">
			<div class="new-products" style="margin-top:0px;">
				<div class="new-products-title">
					<h1>
						<span>
							Change Password
						</span>
					</h1>
				</div>
				<div class="new-products-list">
					<div class="reg_left">
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
					<input type="hidden" name="request" value="<?php echo base64_encode($personID);?>">
					<div class="clear"> 
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								New Password <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<input name="passwrd" id="passwrd" type="password" onFocus="clrpsd()" required>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="reg_left">
						<div class="reg_a">
							<p>
								Confirm New Password <span>*</span>
							</p>
						</div>
						<div class="reg_b">
							<input name="passwrd1" id="passwrd1" type="password" onFocus="clrpsd2()" required>
						</div>
					</div>
					<div class="clear"> 
					</div>
					<div class="reg_left_btn">
						<input name="eest"  type="reset" value="Reset" class="button" style="color: red;">
						&nbsp;
						&nbsp;
						&nbsp;
						&nbsp;
						<input name="change_pass" type="submit" value="Submit" class="button">
					</div>
					<div class="clear">
						<br>
					</div>
				</div>
			</div>
		</article>
	</section>
</form>
<?php 
	} 
?>