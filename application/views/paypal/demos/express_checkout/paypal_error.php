<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bioassay Systems - PayPal Error</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Angell EYE">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        #angelleye-logo { margin:10px 0; }
        thead th { background: #F4F4F4;  }
        th.center {
            text-align:center;
        }
        td.center{
            text-align:center;
        }
        #paypal_errors {
            margin-top:25px;
        }
        .general_message {
            margin: 20px 0 20px 0;
        }
        #angelleye-demo-digital-goods-success-msg {
            display:none;
        }
    </style>

	<!-- generic icon -->
	<link rel="icon" href="https://www.bioassaysys.com/favicon.ico" type="image/icon">
	
	<!-- Android -->
	<link rel="manifest" href="manifest.json" />
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
	
	
	
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-P4CBMLH');</script>
	<!-- End Google Tag Manager -->
	
	
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P4CBMLH"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <div id="header" class="row clearfix">
                <div class="col-md-6 column" style="width: unset;">
                    <div id="angelleye-logo">
                        <a href="/"><img class="img-responsive" alt="Bioassay" src="https://www.bioassaysys.com/images/logo.png"></a>
                    </div>
                </div>
            </div>
            <h2 align="center">PayPal Checkout - Payment Error</h2>
            
            <div class="well alert-danger" id="paypal_errors">
                <?php
                foreach($errors as $error)
                {
                    echo '<p>';
                    echo '<strong>Error Code:</strong> ' . $error[0]['L_ERRORCODE'];
                    echo '<br /><strong>Error Message:</strong> ' . $error[0]['L_LONGMESSAGE'];
                    echo '</p>';
                }
                ?>
            </div>
           
        </div>
    </div>
</div>
</body>
</html>