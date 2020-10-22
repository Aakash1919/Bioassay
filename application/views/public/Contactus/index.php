<script src='https://www.google.com/recaptcha/api.js' async defer>
</script>
<section class="content-right">
	<div class="clear">
	</div>
	<article>
		<form action="/contactus" method="post" name="frmcontact" id="frmcontact">
			<div class="new-products" style="margin-top:0px;">
				<div class="new-products-title">
					<h1>
						<span>
							Contact Us
						</span>
					</h1>
				</div>
				<div class="new-products-list">
					<div style="padding: 15px;">
						<div class="new-products">
							BioAssay Systems highly values customers' input and comments on our products. We aspire to provide the highest possible quality and the most convenient bioassays and contract services to our valued customers. Your input is important and helpful for us as we strive to better serve you.
							<br />
							<br />
							<div>
								<p>
									BioAssay Systems
								</p>
								<p>
									3191 Corporate Place
								</p>
								<p>
									Hayward, CA 94545
								</p>
								<p>
									U. S. A.
								</p>
								<p>
									Tel: <a href="tel:+15107829988">+1-510-782-9988</a>
								</p>
								<p>
									Toll Free: <a href="tel:+18777823888">+1-877-782-3888</a>
								</p>
								<p>
									Fax: 510-782-1588
								</p>
								<p>
									Email: <a href="javascript:location='mailto:\u0069\u006e\u0066\u006f\u0040\u0062\u0069\u006f\u0061\u0073\u0073\u0061\u0079\u0073\u0079\u0073\u002e\u0063\u006f\u006d\u003f\u0073\u0075\u0062\u006a\u0065\u0063\u0074\u003d\u0042\u0069\u006f\u0041\u0073\u0073\u0061\u0079\u0020\u0049\u006e\u0071\u0075\u0069\u0072\u0079';void 0">&#105;&#110;&#102;&#111;&#64;&#98;&#105;&#111;&#97;&#115;&#115;&#97;&#121;&#115;&#121;&#115;&#46;&#99;&#111;&#109;</a>
								</p>
								<p>
									Website: <a href="https://www.bioassaysys.com">www.bioassaysys.com</a>
								</p>
							</div>
						</div>
						<div>
							<div class="services_page" style="padding-bottom:20px;">
							<p>
								For questions or quotation? Please submit the online form, or contact us at <a href="tel:+15107829988">+1-510-782-9988</a>.
							</p>
							</div>
							<?php 
								$response = $this->session->flashdata('response');
								if(!empty($response)){
							?>
							<div class="messagr" style="background-color: green;color: white;font-size: 14px;text-align: center;padding: 10px;">
								<?php 
									echo isset($response)?$response:'';
								?>
							</div>
							<?php 
								} 
							?>
							<?php 
								if(!empty($error)){
							?>
							<div class="messagr" style="background-color: red;color: white; font-size: 14px;text-align: center;padding: 10px;">
								<?php 
									echo isset($error)?$error:'';
								?>
							</div>
							<?php 
								} 
							?>
						

							<div class="reg_left">
								<div class="reg_a">
									Your Email:<span>*</span>
								</div>
								<div class="reg_b">
									<input name="email" id="email" type="email" value="<?php echo set_value('email'); ?>" required="required">
									<span class="error">
										<?php 
											echo form_error('email'); 
										?>
									</span>
								</div>
							</div>
							<div class="clear">
							</div>
							<div class="reg_left">
								<div class="reg_a">
									Your Name:<span>*</span>
								</div>
								<div class="reg_b">
									<input name="fname" id="fname" type="text" value="<?php echo set_value('fname'); ?>" required="required" >
									<span class="error">
										<?php 
											echo form_error('fname'); 
										?>
									</span>
								</div>
							</div>
							<div class="clear">
							</div>
							<div class="reg_left">
								<div class="reg_a">
									Subject:<span>*</span>
								</div>
								<div class="reg_b">
									<select name="subject1" id="subject1" class="reg_b_jump1" style="width:100%;" required="required">
										<option value="">
											-Please Select-
										</option>
										<option value="Technical Questions">
											Technical Questions
										</option>
										<option value="Customer Service">
											Customer Service
										</option>
										<option value="Collaboration">
											Collaboration
										</option>
										<option value="Services">
											Website Issues
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
									<textarea required="required" name="enquiry" style="height:100px; width: 100%; resize:none;" id="enquiry" ><?php echo set_value('enquiry'); ?></textarea>
									<span class="error">
										<?php 
											echo form_error('enquiry'); 
										?>
									</span>
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

							<div class="services_page">
							</div>

							<div class="clear">
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</article>
</section>
</div>
<!-- <script>
var onloadCallback = function() {
    grecaptcha.execute();
};

function setResponse(response) { 
    document.getElementById('captcha-response').value = response; 
}
</script> -->
<script type="text/javascript">
  $("form#frmcontact").submit(function(event) {

   var recaptcha =  grecaptcha.getResponse();
   
   if (recaptcha === "") {
      event.preventDefault();
      alert("Please check the recaptcha");
   }
});
</script>