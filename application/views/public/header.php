<!DOCTYPE HTML>
<html lang="en">
      <head>
        <meta charset="utf-8">
        <title><?php echo isset($active)?$active.' | ':""?>BioAssay Systems</title>
        <meta name="viewport"  content="width=device-width" />
        <meta name="description" content="<?php echo isset($description)?$description:'BioAssay Systems is a biotechnology company located in San Francisco Bay Area. Since 2003, BioAssay Systems develops, manufactures and markets innovative and high-quality assay solutions to satisfy the increasing demands of the life sciences industry.'?>">
        <meta name="keywords" content="<?php echo isset($keywords)?$keywords:'Assay Kit, Assay, Assays, Contract Research Organization, Contract Services, CRO, Analytical Services, Assay Development, Contract Work'?>">

		<link rel="preload" as="script" type="text/javascript" href="/theme/js/masterjs-min.js">
		<link rel="preload" as="style" type="text/css" href="/theme/css/mastercss-min.css">
		<link rel="preload" as="font" href="/theme/fonts/tahoma_2.woff" type="font/woff" crossorigin="anonymous">
		
		<!--Google Preconnects-->
		<link rel='preconnect' href='//www.googletagmanager.com' crossorigin='anonymous'/>
		<link rel='preconnect' href='//www.google-analytics.com' crossorigin='anonymous'/>
		<link rel='preconnect' href='//stats.g.doubleclick.net' crossorigin='anonymous'/>
		<link rel='preconnect' href='//www.google.com' crossorigin='anonymous'/>
		
		
		<!--LinkedIn Preconnects
		<link rel='preconnect' href='//px.ads.linkedin.com' crossorigin='anonymous'/>
		<link rel='preconnect' href='//snap.licdn.com' crossorigin='anonymous'/>
		-->
		<!--Facebook Preconnects
		<link rel='preconnect' href='//connect.facebook.net' crossorigin='anonymous'/>
		<link rel='preconnect' href='//www.facebook.com' crossorigin='anonymous'/>
		-->
		<!--Reddit Preconnects
		<link rel='preconnect' href='//alb.reddit.com' crossorigin='anonymous'/>
		<link rel='preconnect' href='//www.redditstatic.com' crossorigin='anonymous'/>
		-->
		
		<script type="text/javascript" src="/theme/js/masterjs-min.js"></script>
		<!--
        <script type="text/javascript" src="/theme/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="/theme/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="/theme/js/jquery.bxSlider.min.js"></script>
        <script type="text/javascript" src="/theme/js/jquery.pajinate.js"></script>
		<script type="text/javascript" src="/theme/js/jquery.mmenu.js"> </script>
		<script type="text/javascript" src="/theme/js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="/theme/ddlevelsfiles/ddlevelsmenu.js"></script>
		-->
		
		<link rel="stylesheet" type="text/css" href="/theme/css/mastercss-min.css">
		<link rel="stylesheet" type="text/css" href="/assets/theme/css/style.css">
        
		<!--
		<link rel="stylesheet" type="text/css" href="/theme/ddlevelsfiles/ddlevelsmenu-base.css">
        <link rel="stylesheet" type="text/css" href="/theme/ddlevelsfiles/ddlevelsmenu-topbar.css">        
        <link rel="stylesheet" type="text/css" href="/theme/css/responsive-devic.css">
        <link rel="stylesheet" type="text/css" href="/theme/css/jquery.mmenu.css">
        <link rel="stylesheet" type="text/css" href="/theme/css/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="/theme/css/tabs-no-images.css">
        <link rel="stylesheet" type="text/css" href="/theme/css/tabs-slideshow.css">
		-->
		

		
		<!-- generic icon -->
		<link rel="icon" href="https://www.bioassaysys.com/favicon.ico" type="image/icon">
		
		<!-- Android -->
		<link rel="manifest" href="/manifest.json" />
		<meta name="theme-color" content="#0072bb"/>

		<!-- iOS -->
		<link rel="apple-touch-icon" href="favicons/favicon-120.png">
		<link rel="apple-touch-icon" sizes="152x152" href="favicons/favicon-152.png">
		<link rel="apple-touch-icon" sizes="167x167" href="favicons/favicon-167.png">
		<link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
		
		<!-- Safari -->
		<link rel="mask-icon" href="favicons/mask-icon.svg" color="#3b3b3b">

		<!-- Windows 8 IE 10-->
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="favicons/favicon-144.png">

		<!-- Windows 8.1 + IE11 and above -->
		<meta name="msapplication-config" content="favicons/browserconfig.xml">
		
        <script type="text/javascript">
              
              $(document).ready(function(){
                $('#paging_container3').pajinate({
                  items_per_page : 5,
                  item_container_id : '.alt_content',
                  nav_panel_id : '.alt_page_navigation'
                  
                });
              }); 
        </script>
        <script type="text/javascript">
          $(function(){
          $('#slider1').bxSlider({
            auto: true,
            autoControls: false,
           pager: false,
          mode: 'horizontal'
          });
        }); 
        </script>
      
        <script type="text/javascript"> 
        $(document).ready(function(){
          $("nav#mobile_navi").mmenu({
             navbar     : {
              title     : "BioAssay Systems"
            } 
          });
          
        }); 
		</script>
          
		  
		<script type="text/javascript">
		 
		  $(document).ready(function(){
		 
			$("#siteid1").click(function () {

		  var wordval=$("#q").val();
		  //alert(wordval);
		  $("#qfront").val(wordval);

		  
		  
		  
			 });
			 
			$("#keyid").click(function () {
		 
		  var wordval=$("#qfront").val();
		  $("#q").val(wordval);
		   
			});
		  });
		</script>
		
		
		<?php if(!empty($prodname)){
			echo
				'<script type="application/ld+json">
				{
				  "@context" : "http://schema.org",
				  "@type" : "Product",
				  "name" : "'; 
				  echo $prodname;
				  echo'",
				  "image" : "https://www.bioassaysys.com/images/Product_pics/';
				  echo $prodfig;
				  echo '",
				  "description" : "';
				  echo $description;
				  echo'",
				  "mpn" : "';
				  echo $prodsku;
				  echo'",
				  "sku" : "';
				  echo $prodsku;
				  echo'",
				  "category" : "Business & Industrial > Science & Laboratory > Laboratory Supplies",
				  "brand" : {
					"@type" : "Brand",
					"name" : "BioAssay Systems",
					"logo" : "https://www.bioassaysys.com/favicons/favicon-512.png"
				  },
				  "offers" : {
					"@type" : "Offer",
					"availability": "InStock",
					"price" : "';
					echo $prodprice;
					echo '",
					"priceCurrency": "USD",
					"url": "https://www.bioassaysys.com/';
					echo $produrl;
					echo '.html"
				  }
				}
				</script>';
         } ?>
		
			<?php
				//get flashdata
				if(!empty($this->session->flashdata('ecommerce')))
				{ echo
					"<script>
		window.dataLayer = window.dataLayer || [];
		dataLayer.push({
			";
					echo $this->session->flashdata('ecommerce');
					echo
			"
		});
					</script>";
				}
			?>

		<!-- Google Tag Manager -->
		<script async>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-P4CBMLH');</script>
		<!-- End Google Tag Manager -->
		
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript" src="https://jstest.authorize.net/v1/Accept.js" charset="utf-8"></script>
	
</head>
<body class="homepage" id="topbody">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P4CBMLH"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<article class="main">
<header>
        <div class="header-top">
          <div class="logo"><a href="/"><img src="/images/logo-min.png" height="86" alt="BioAssay Systems Logo"></a></div>
          <div class="header-top-right">
            <div class="myaccount-block" id="cartno">
              <ul>
                <?php 
                $person_ids = $this->session->userdata('person_id');
               // echo $person_ids;
                if(isset($person_ids)){?>
                 <li class="myaccount-icon"><a href="/user/profileEdit"><?php echo $this->session->userdata('fullname');?></a></li> 
                <li>|</li>
                <li class="cart-icon" ><a href="/checkout.html">(<?php echo isset($cartcount)?$cartcount:'0';?>)</a></li>
                <li>|</li>
                <li><a href="/user/logout">logout</a></li>
              <?php }else{ ?>
                <li class="myaccount-icon"><a href="/user/register.html"></a></li>
                <li>|</li>
                <li class="cart-icon" ><a href="/checkout.html">(<?php echo isset($cartcount)?$cartcount:'0';?>)</a></li>
                <li>|</li>
                <li class="login-icon"><a href="/user/login.html">Login</a> </li>

                <li>|</li><li><a href="/support/news.html">Email Signup</a></li> 
              <?php } ?>
               

              </ul>
            </div>
            <div class="contact-section">
              <div class="contact"><a href="tel:+15107829988">+1-510-782-9988</a><span class="span-hide"> | </div></div>
              <div class="place-order"><a href="/order">Order Online</a> | <a href="https://www.fishersci.com/us/en/catalog/search/products?keyword=bioassay+systems" target="_blank" rel="noopener">Fisher</a> | <a href="https://us.vwr.com/store/search/searchResultList.jsp?_DARGS=/store/search/searchResultHybrid.jsp.1_AF&_dynSessConf=-5379919264298494113&_D%3Asfh_gotopage=+&view=EASY_VIEW&keyword=bioassay+systems&sfh_gotopage=submit&page=2" target="_blank" rel="noopener">VWR</a> |</div>
			</div>
            </div>
          </div>
          <div class="clear"></div>
