
<nav class="navigation-block">

	<div class="out-img-left"><img src="/images/nav-absalut-lef.jpg" width="6" height="45" alt=""></div>
	<div class="out-img-right"><img src="/images/nav-absalut-right.jpg" width="6" height="45" alt=""></div>

	<div class="navigation">

		<ul>
			<li><a href="/" <?php if($active=='Home'){ echo "class='act'";}?>>HOME</a></li>
			<li><img src="/images/nav-ddr.jpg" width="3" height="40" alt=""></li>
				<div id="ddtopmenubar1" class="mattblackmenu">						
					<li><a href="/products.html" <?php if($active=='Products'){ echo "class='act'";}?> rel="ddsubmenu1" >PRODUCTS</a></li>
				</div>			
			<li><img src="/images/nav-ddr.jpg" width="3" height="40" alt=""></li>
				<div id="ddtopmenubar2" class="mattblackmenu">						
					<li><a href="/services.html" <?php if($active=='Services'){ echo "class='act'";}?> rel="ddsubmenu2" >SERVICES</a></li>
				</div>
			<li><img src="/images/nav-ddr.jpg" width="3" height="40" alt=""></li>
			<li><a href="/order.html" <?php if($active=='Order'){ echo "class='act'";}?> >ORDER</a></li>
			<li><img src="/images/nav-ddr.jpg" width="3" height="40" alt=""></li>
			<li><a href="/distributor.html" <?php if($active=='Distributors'){ echo "class='act'";}?>>DISTRIBUTORS</a></li>
			<li><img src="/images/nav-ddr.jpg" width="3" height="40" alt=""></li>
				<div id="ddtopmenubar3" class="mattblackmenu">
					<li><a href="/support.html" <?php if($active=='Support'){ echo "class='act'";}?> rel="ddsubmenu3" >SUPPORT</a></li>
				</div>
			<li><img src="/images/nav-ddr.jpg" width="3" height="40" alt=""></li>
			<li><a href="/careers.html" <?php if($active=='Careers'){ echo "class='act'";}?> >CAREER</a></li>
			<li><img src="/images/nav-ddr.jpg" width="3" height="40" alt=""></li>
			<li><a href="/contactus.html" <?php if($active=='ContactUs'){ echo "class='act'";}?> >CONTACT US</a></li>
			<li><img src="/images/nav-ddr.jpg" width="3" height="40" alt=""></li>
		</ul>

	</div>
	<script type="text/javascript">
		ddlevelsmenu.setup("ddtopmenubar1", "topbar") //ddlevelsmenu.setup("mainmenuid", "topbar|sidebar")
		ddlevelsmenu.setup("ddtopmenubar2", "topbar") //ddlevelsmenu.setup("mainmenuid", "topbar|sidebar")
		ddlevelsmenu.setup("ddtopmenubar3", "topbar") //ddlevelsmenu.setup("mainmenuid", "topbar|sidebar")
	</script>



<ul id="ddsubmenu1" class="ddsubmenustyle">
		<li><a href="/products.html" >All Products</a></li>
		<li><a href="/products?caturl=Agriculture-Environment">Agriculture & Environment</a></li>
		<li><a href="/products?caturl=Blood-Urine-Chemistry">Blood & Urine Chemistry</a></li>
		<li><a href="/products?caturl=Cations-Anions">Cations & Anions</a></li>
		<li><a href="/products?caturl=Diabetes-Obesity">Diabetes & Obesity</a></li>
		<li><a href="/products?caturl=Enzyme-Activity">Enzyme Activity</a></li>
		<li><a href="/products?caturl=Food-Beverage-Analysis">Food & Beverage Analysis</a></li>
		<li><a href="/products?caturl=HTS-Reagents-Kits">HTS Reagents & Kits</a></li>
		<li><a href="/products?caturl=Inhibitor-HTS-Kits">Inhibitor HTS Kits</a></li>
		<li><a href="/products?caturl=Metabolism">Metabolism</a></li>
		<li><a href="/products?caturl=Oncology">Oncology</a></li>
		<li><a href="/products?caturl=Other-Reagents">Other Reagents</a></li>
		<li><a href="/products?caturl=Oxidative-Stress">Oxidative Stress</a></li>
		<li><a href="/products?caturl=Quick-Test-Strips">Quick Test Strips</a></li>
		<li><a href="/products?caturl=Signal-Transduction">Signal Transduction</a></li>
</ul>

<ul id="ddsubmenu2" class="ddsubmenustyle">
	<li><a href="/services.html" >Services Overview</a></li>
	<li><a href="/services/analytical-services.html" >Analytical Services</a></li>
	<li><a href="/services/assay-customization.html">Assay Customization</a></li>
	<li><a href="/services/assay-design-and-development.html">Assay Design and Development</a></li>
	<li><a href="/services/lead-discovery-services.html">Lead Discovery Services</a></li>
	<li><a href="/services/multiplex-assay-services.html">Multiplex Assay Services</a></li>
</ul>
<ul id="ddsubmenu3" class="ddsubmenustyle">
	<li><a href="/support.html" >Technical Support</a></li>
	<li><a href="/support/product-citations.html">Product Citations</a></li>
	<li><a href="/support/general-questions.html">General Questions</a></li>
	<li><a href="/support/troubleshooting.html">Troubleshooting</a></li>
	<li><a href="/support/training-videos.html">Training Videos</a></li>
	<li><a href="/support/news.html">News</a></li>

</ul>

<form method="get" action="/products/search">
	<div id="b" style="display:block; float:left; width:324px;" >
		<div class="search-block">
			<a href="#mobile_navi" class="mobile-display nav-bar-toggle"> <span>&#x2630;</span></a>
			<div class="search">
				<input name="q" id="q" type="text" placeholder="Search" class="searchii" value="<?php echo isset($_GET['q'])?$_GET['q']:'';?>">
				<div class=" desktop-display" style="float:right; padding-top:10px;">
					<input value="submit" type="image" src="/images/se.png" height="20" />
				</div>
					<input type="submit" value="&#128269;" style="color: #fff;" class="mobile-display search-btn"/> 
			</div>
		</div>
		<div class="radio-block" style="float:right; width:96px;">
			<ul>
				<li><input name="sitesearch" id="keyid1" value="www.bioassaysys.com" checked="checked" type="radio" class="radio" onclick="showm2('b')"> Keywords & Catalog #</li>
				<li><input name="sitesearch" id="siteid1" value="www" type="radio" class="radio-a"> Site</li>
			</ul>
		</div>
	</div>
</form>

	<div id="adop" style="display:none;" >


		<div class="search-block">
			<form action="https://www.google.com/search" method="get" onSubmit="Gsitesearch(this)">
				<div class="search">


					<input name="qfront" id="qfront" type="text" value="Search" class="searchii" onclick="chkthis1();"/>

					<div style="float:right; padding-top:10px;"><input type="image" src="/images/se.png" height="20" /></div></div>
					<input name="q" type="hidden" />
				</form>

			</div>
			<div class="radio-block" style="float:right; width:125px;">
				<ul>
					<li><input name="sitesearch" value="www.bioassaysys.com"  id="keyid" type="radio" class="radio" onclick="showm2('b')"> Keywords & Catalog #</li>
					<li><input name="sitesearch" id="siteid" value="www" type="radio" class="radio-a" onclick="showm1('adop')"> Site</li>
				</ul>
			</div>
		</div>




		<div class="clear"></div>
	</nav>

	<nav id="mobile_navi" class="mobile_navigation" style="display: none; ">

		<ul>
			<li><a href="/" <?php if($active=='Home'){ echo "class='act'";}?> >HOME</a></li>
			
			<li><a href="/products.html" <?php if($active=='Products'){ echo "class='act'";}?>   >PRODUCTS</a>
				<ul >
					<li><a href="/products.html" >All Products</a></li>
					<li><a href="/products?caturl=Agriculture-Environment">Agriculture & Environment</a></li>
					<li><a href="/products?caturl=Blood-Urine-Chemistry">Blood & Urine Chemistry</a></li>
					<li><a href="/products?caturl=Cations-Anions">Cations & Anions</a></li>
					<li><a href="/products?caturl=Diabetes-Obesity">Diabetes & Obesity</a></li>
					<li><a href="/products?caturl=Enzyme-Activity">Enzyme Activity</a></li>
					<li><a href="/products?caturl=Food-Beverage-Analysis">Food & Beverage Analysis</a></li>
					<li><a href="/products?caturl=HTS-Reagents-Kits">HTS Reagents & Kits</a></li>
					<li><a href="/products?caturl=Inhibitor-HTS-Kits">Inhibitor HTS Kits</a></li>
					<li><a href="/products?caturl=Metabolism">Metabolism</a></li>
					<li><a href="/products?caturl=Oncology">Oncology</a></li>
					<li><a href="/products?caturl=Other-Reagents">Other Reagents</a></li>
					<li><a href="/products?caturl=Oxidative-Stress">Oxidative Stress</a></li>
					<li><a href="/products?caturl=Quick-Test-Strips">Quick Test Strips</a></li>
					<li><a href="/products?caturl=Signal-Transduction">Signal Transduction</a></li>
				</ul>

			</li>
			
			
			<li><a href="/services.html" <?php if($active=='Services'){ echo "class='act'";}?>  >SERVICES</a>
				<ul >
					<li><a href="/services.html" >Services Overview</a></li>
					<li><a href="/services/analytical-services.html" >Analytical Services</a></li>
					<li><a href="/services/assay-customization.html">Assay Customization</a></li>
					<li><a href="/services/assay-design-and-development.html">Assay Design and Development</a></li>
					<li><a href="/services/lead-discovery-services.html">Lead Discovery Services</a></li>
					<li><a href="/services/multiplex-assay-services.html">Multiplex Assay Services</a></li>
				</ul>
			</li>

			
			<li><a href="/order.html" <?php if($active=='Order'){ echo "class='act'";}?> >ORDER</a></li>
			
			<li><a href="distributor.html"<?php if($active=='Distributors'){ echo "class='act'";}?> >DISTRIBUTORS</a></li>
			
			<li><a href="/support.html" <?php if($active=='Support'){ echo "class='act'";}?>  >SUPPORT</a>

				<ul>
					<li><a href="/support.html" >Technical Support</a></li>
					<li><a href="/support/product-citations.html">Product Citations</a></li>
					<li><a href="/support/general-questions.html">General Questions</a></li>
					<li><a href="/support/troubleshooting.html">Troubleshooting</a></li>
					<li><a href="/support/training-videos.html">Training Videos</a></li>
					<li><a href="/support/news.html">News</a></li> 

				</ul>
			</li>

			
			<li><a href="/careers.html" <?php if($active=='Careers'){ echo "class='act'";}?> >CAREER</a></li>
			
			<li><a href="/contactus.html" <?php if($active=='ContactUs'){ echo "class='act'";}?> >CONTACT US</a></li>
		</ul>

	</nav>
	<!--<div class="menu-2"><a href="/">Home></a></div>-->
	
</header>
<div class="clear"></div>
<?php
	$r = $this->session->flashdata('response');
	if(isset($r)){?>
			<div style="color: white;text-align: center;font-size: 16px;background: red;margin-bottom: 4px;"><?php echo $r['Message']?></div>
<?php } 
?>
