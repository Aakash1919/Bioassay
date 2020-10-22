<script src='https://www.google.com/recaptcha/api.js' async defer>
</script>
<form action="/support/sendSupportMessage" method="post" name="frmcontact" id="frmcontact">
	<section class="content-right">
		<article class="content-right-btm" style="margin-top:0px;">
			<div class="new-products" style="margin-top:0px;">
				<div class="new-products-title">
					<h1>
						<span>
							Technical Support
						</span>
					</h1>
				</div>
				<div class="new-products-list">
					<div style="padding: 15px;">
						<div class="contactus_page">
							<p>
								BioAssay Systems aspires to provide the highest possible quality and the best technical support to our valued customers.
							</p>
							<br>
							<ul style="width:500px; padding-left: 50px;">
								<li>
									<a href="/support/training_videos">
										Training Video
									</a>
								</li>
								<li>
									<a href="/support/product_citations">
										Product Citations
									</a>
								</li>
								<li>
									<a href="/support/general_questions">
										Frequently Asked Questions
									</a>
								</li>
								<li>
									<a href="/support/troubleshooting">
										Troubleshooting
									</a>
								</li>
							</ul>
							<div class="clear">
							</div>
							<div style="padding-bottom:20px;">
								<p>
									<span>For questions or quotation? </span>Please contact us by <a href="javascript:location='mailto:\u0069\u006e\u0066\u006f\u0040\u0062\u0069\u006f\u0061\u0073\u0073\u0061\u0079\u0073\u0079\u0073\u002e\u0063\u006f\u006d\u003f\u0073\u0075\u0062\u006a\u0065\u0063\u0074\u003d\u0042\u0069\u006f\u0041\u0073\u0073\u0061\u0079\u0020\u0049\u006e\u0071\u0075\u0069\u0072\u0079';void 0">email</a>, call us at <a href="tel:+18777829988">+1-510-782-9988</a>, or submit the online form.
								</p>
							</div>
							<div class="messagr">
								<?php 
									if(isset($_GET['ms'])){ 
										echo '<div class="message" style="background-color: red;color: white;font-size: 14px;text-align: center;padding: 10px;">Mail Not Sent</div>'; 
									}
								?>
							</div>
							<div class="messagr">
								<?php 
									if(isset($_GET['msc'])){ 
										echo '<div class="message" style="background-color: red;color: white;font-size: 14px;text-align: center;padding: 10px;">Captcha Verification Failed</div>'; 
									}
								?>
							</div>
							<div class="messagr">
								<?php 
									if(isset($_GET['msg'])){ 
										echo '<div class="message" style="background-color: green;color: white;font-size: 14px;text-align: center;padding: 10px;">Thank you. Mail Sent Successfully!</div>'; 
									}
								?>
							</div>

							<div class="reg_left">
								<div class="reg_a">
									Your Email:<span>*</span>
								</div>
								<div class="reg_b">
									<input name="email" id="email" type="email" required="required">
								</div>
							</div>
							<div class="clear">
							</div>
							<div class="reg_left">
								<div class="reg_a">
									Your Name:<span>*</span>
								</div>
								<div class="reg_b">
									<input name="fname" id="fname" required="required" type="text">
								</div>
							</div>
							<div class="clear">
							</div>
							<div class="reg_left">
								<div class="reg_a">
									Subject:<span>*</span>
								</div>
								<div class="reg_b">
									<select name="subject2" id="subject2" required="required" class="reg_b_jump1" style="width: 100%;">
										<option value="">
											-Please Select-
										</option>
										<option value="Assay Kits and Reagents">
											Assay Kits and Reagents
										</option>
										<option value="Equipment">
											Equipment
										</option>
										<option value="Services">
											Services
										</option>
										<option value="Other">
											Other
										</option>
									</select>
									<div id="selectbox">
									</div>
								</div>
							</div>
							<div class="clear">
							</div>
							<div class="clear">
							</div>
							<div class="reg_left">
								<div class="reg_a">
									Message:<span>*</span>
								</div>
								<div class="reg_b">
									<textarea name="enquiry" style="height:100px; width: 100%; resize:none;" id="enquiry" required="required"></textarea>
								</div>
							</div>
							<div class="clear">
							</div>
							<div class="reg_left">
								<div class="reg_a">
									<p>
										Please fill out this field <span>*</span>
									</p>
								</div>
								<div class="reg_b">
									<div class="g-recaptcha" data-size="compact" data-sitekey="<?php echo $capcha_site_id;?>">
									</div>
								</div>
							</div>
							<div class="reg_left">
								<div class="reg_a">
								</div>
								<div class="log_b">
									<input name="submit" type="submit" value="Send Message" class="button">
								</div>
							</div>
							<div class="clear">
							</div>
						</div>
						<div class="clear">
						</div>
					</div>
				</div>
			</div>
		</article>
	</section>
</form>
</div>
<div class="clear">
</div>
<script type="text/javascript">
  $("form#frmcontact").submit(function(event) {
   
   var recaptcha =  grecaptcha.getResponse();
   if (recaptcha === "") {
      event.preventDefault();
      alert("Please check the recaptcha");
   }
});
</script>