<div class="clear"> </div>



<div class="clear"> </div>

<section class="content-bottom">



</section> 

</section>





<div class="clear"></div>

</article>

<footer>

	<div class="container">

		<div class="footer-block">

			<div style="width: 100%; padding-top: 7px; text-align: center;">

				<span>

					<a href="https://www.facebook.com/Bioassay.Systems.LLC" target="_blank" rel="noopener"><img src="/images/facebook-min.png" width="35" height="35" alt="Facebook"></a>

					<a href="https://twitter.com/BioAssaySystems" target="_blank" rel="noopener"><img src="/images/twitter-min.png" width="35" height="35" alt="Twitter"></a>

					<a href="https://www.linkedin.com/company/bioassay-systems/" target="_blank" rel="noopener"><img src="/images/linkedin-min.png" width="35" height="35" alt="LinkedIn"></a>

					<a href="https://www.scienceexchange.com/labs/bioassay-systems/" target="_blank" rel="noopener"><img src="/images/scienceexchange-min.png" width="35" height="35" alt="ScienceExchange"></a>

					<a href="https://app.scientist.com/domain_switcher?redirect=/providers/d935e2de-1754-4c66-ad61-8c52fc0b49c8" target="_blank" rel="noopener"><img src="/images/scientist2-min.png" width="35" height="35" alt="Scientist"></a>

				</span>

			</div>

			<div class="social">

				<div style="width: 60%; text-align: center; display: inline-block; padding-left: 20%; padding-right: 20%;">

					<div style="font-size: 0.82em; padding-top: 10px;">

						<a href="/" style="color:#fff;">HOME</a> -

						<a href="/products.html" style="color:#fff;">PRODUCTS</a> -

						<a href="/services.html"   style="color:#fff;">SERVICES</a> -

						<a  href="/order.html"  style="color:#fff;">ORDER</a> - 

						<a  href="/distributor.html" style="color:#fff;">DISTRIBUTORS</a> -

						<a href="/support.html" style="color:#fff;">SUPPORT</a> -

						<a href="/careers.html"  style="color:#fff;">CAREER</a> -

						<a  href="/contactus.html"  style="color:#fff;">CONTACT US</a> - 

						<a  href="tel:+15107829988"  style="color:#fff;">+1-510-782-9988</a>

					</div>

					<!--footer_nav_bottom-->

					<div style="color:#fff; font-family: TahomaRegular, sans serif; font-size:0.82em; padding-top:5px; width: 80%; padding-left: 10%; padding-right: 10%;">

						BioAssay Systems is committed to producing innovative, high-quality and cost-effective products and to providing expert technical service to our valued customers.

					</div>

					<div style="color:#fff; font-family: TahomaRegular, sans serif; font-size:0.82em; padding-top:5px; padding-bottom: 10px;">

						&copy; <?php echo date("Y"); ?> BioAssay Systems. All rights reserved

					</div>

				</div>

				<!--

				<div style="width: 20%; float: left; position: relative; top: 0px; left: 0px;">

					<div style="padding-top: 10px;">

						<ul>

							<li>

								<img src="/images/RapidSSL_SEAL-90x50.gif" width="72" height="40" alt="">

							</li>

							<li>

								<img src="/images/authorize.png" width="59" height="46" alt="">

							</li>

						</ul>

					</div>

				</div>

				<div style="width: 20%; float: right; position: relative; top: 0px; right: 0px;">

					<div style="padding-top: 10px;">

						<ul>

							<li>

								<img src="/images/paypal-logo.png" width="50" height="50" alt="">

							</li>

							<li>

								<img src="/images/VisaMasterCardAmexDiscover.png" width="86" height="54" alt="">

							</li>

						</uL>

					</div>

				</div>

				-->

			</div>

		</div>

	</div>
    <div class="shadow">

		<img src="/images/shadow.png" width="1020" height="28" alt="">

	</div>
	
</footer>
<?php echo $cookieStatus;?>
<?php if(!isset($cookieStatus) || $cookieStatus=='false'){?>	
	<div id="MyMessage" style="text-align: center;z-index: 999;position:sticky;width:100%;bottom: 0;padding:25px 0;background-color: #06b;color: white;font-size: 18px;">
     <div>
     	<p style="line-height: 30px;">This website uses cookies to ensure you get the best experience on our website. <button style="font-size: 16px;padding: 2px 10px;cursor: pointer;border-radius: 5px;border:none;margin-left: 5px;" id="acceptcookies">Accept</button></p>
     </div>
     <div>
     	
     </div>
	</div>
	<script type="text/javascript">
		jQuery(document).on('click','#acceptcookies',function(){
			var url = "/home/cookieset";
			jQuery.post( url,{'status':'true'}, function( data ) {
				jQuery("#MyMessage").css('display','none');
		});
		});
	</script>
<?php } ?>	
</body>

<style>

  .seal{float:right;}

  .seal li{float:left;margin:10px 10px;}

</style>

</html>