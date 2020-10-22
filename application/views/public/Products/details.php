<?php

foreach ($item as $i) {
  $id = $i->product_id;
	$name = $i->name;
	$display_name = $i->name_display;
	$catalog_num = $i->catalog_num;
	$price = $i->price;
	$shipping_method = $i->shipping_method;
	$storage = $i->storage;
	$product_figure = $i->product_figure;
	$url = $i->url;

  $pov = $this->Products_Model->getOverview($id);

  if(!empty($pov)){
    foreach ($pov as $product_overview) {
	  $note = $product_overview->note;
      $protocol = $product_overview->protocol;
      $msds = $product_overview->msds;
	  $amazon = $product_overview->amazon;
	  $ebay = $product_overview->ebay;
    }
  }  
  ?>

<section class="content-area">
  <div class="left_content">
    <div class="prod_title">
      <h1><?php  if(!empty($name)){ $aa= mb_convert_encoding($name, "HTML-ENTITIES", "UTF-8");echo $aa;  } ?></h1>
    </div>
	<div class="desktop-hide">
		<div class="buynow" style="padding:2%;"> 
			<form action="/checkout/addtocart"  method="post"> 
        <?php echo mb_convert_encoding($name, "HTML-ENTITIES", "UTF-8");?><br>
        <span class="buynow_black"> Catalog No: </span> <?php echo stripslashes($catalog_num);?><br> 
        <div class="clear" style="padding-bottom:15px;"></div>
        <input type="hidden" name="product_id" value="<?php echo $id;?>">
        <input type="hidden" name="price" value="<?php echo stripslashes($price);?> ">
        <input type="hidden" name="catalog" value="<?php echo $catalog_num;?>">
        <input type="hidden" name="ship" value="<?php echo $shipping_method;?>">
        <input type="hidden" name="name" value="<?php echo mb_convert_encoding($display_name, "HTML-ENTITIES", "UTF-8");?>">
        <span class="buynow_black">Price:</span> $<?php echo stripslashes($price);?> &nbsp;&nbsp;&nbsp;<span class="buynow_black">Qty:</span> <input type="text" name="quantity" size="2" value="1" />    
        <input class="cart-icon" style="cursor:pointer;" type="submit" size="2" value="" >
        <div class="clear" style="padding-bottom:15px;"></div>
        <span class="buynow_black"><i>For orders of 10 or more kits, please call <a href="tel:+15107829988,1">+1-510-782-9988x1</a> or <a href="javascript:location='mailto:\u0069\u006e\u0066\u006f\u0040\u0062\u0069\u006f\u0061\u0073\u0073\u0061\u0079\u0073\u0079\u0073\u002e\u0063\u006f\u006d\u003f\u0073\u0075\u0062\u006a\u0065\u0063\u0074\u003d<?php echo ucfirst($name);?> Bulk Order ';void 0"> email us</a> for best pricing and/or bulk order</i>. </span><br><br>
        <span class="buynow_black">Shipping:</span> <?php echo stripslashes($shipping_method);?><br>
        <span class="buynow_black">Shipment:</span><?php echo ($shipping_method=='Free Shipping')?'USPS':'Fedex Service';?> <br />
				<span class="buynow_black">Delivery:</span><?php echo ($shipping_method=='Free Shipping')?' 2-5 days (Continental US only)':' 1-2 days (US), 3-6 days (Intl)';?>
						<br />
          <span class="buynow_black">Storage:</span> <?php echo stripslashes($storage);?><br>
        <div style="text-align: center;">
          <img src="/images/Product_pics/<?php echo $product_figure;?>" alt="<?php echo $display_name;?>" width="230" height="166">
        </div>
			</form> 
		</div>
	</div>
  <div id="mytabs" class="bs_pc_tab">
    <ul class="bs_css-tabs">
      <li><a id="t1" href="#product-overview">Product <br class="mobile-br">Overview</a></li>                                
      <li><a id="t2" href="#product-faq">Product <br class="mobile-br">FAQ</a></li>
      <li><a id="t3" href="#product-citations">Product <br class="mobile-br">Citations</a></li>
      <li><a id="t4" href="#assay-service">Assay <br class="mobile-br">Service</a></li>
    </ul>
  <div class="bs_css-panes">
    <div id="product-overview" class="tabbox">
      <div class="bs_tab_cont">
	  		<?php if(!empty($note)){ echo $note;?>
				  <br><br>
        <?php } ?>
        <?php if(!empty($protocol)){ ?>
          <a class="PDFbutton" href="/datasheet/<?php echo $protocol;?>" target="_blank">Protocol</a>
        <?php } ?>
        <?php if(!empty($msds)){ ?>
          <a class="PDFbutton" href="/datasheet/<?php echo $msds;?>" target="_blank">SDS</a>
        <?php } ?>
        <?php if(!empty($amazon)){ ?>
          <a href="<?php echo $amazon;?>" target="_blank"><img src="images/amazon-logo.png" alt="Available on Amazon" class="amazon" align="right" /></a>
        <?php } ?>
        <?php if(!empty($ebay)){ ?>
          <a href="<?php echo $ebay;?>" target="_blank"><img style="margin: 0px 20px;" src="images/ebay-logo.jpg" alt="Right now on eBay" class="ebay" align="right" /></a>
        <?php } ?>
        <?php if(!empty($product_overview->application1)){ ?>
					<h3 class="application">Application</h3>
          <ul class="point">
				<?php for($x=1; $x<=3; $x++) {
              $ao = "application".$x;
                  if(!empty($product_overview->$ao)) {
                    echo "<li>".($product_overview->$ao)."</li>";
                  }
              }?>
          </ul>
  			<?php } ?>
				<?php if(!empty($product_overview->keyfeature1)){ ?>
        <h3 class="application">Key Features</h3>
          <ul class="point">
            <?php for($xf=1; $xf<=5; $xf++) {
                    $kf = "keyfeature".$xf;
                    if(!empty($product_overview->$kf)){
                      echo "<li>".($product_overview->$kf)."</li>";
                    }
                  } ?>
          </ul>
        <?php } ?>
        <?php if(!empty($product_overview->method)){?>
          <h3 class="application">Method</h3>
          <ul class="point">
            <?php if(!empty($product_overview->method)) {?>
              <li> <?php echo $product_overview->method;?></li>
            <?php } ?>
          </ul>
        <?php } ?>
        <?php if(!empty($product_overview->samples)){?>
          <h3 class="application">Samples</h3>
          <ul class="point">
            <?php if(!empty($product_overview->samples)) {?>
              <li> <?php echo $product_overview->samples;?></li>
            <?php } ?>
          </ul>
        <?php } ?>
        <?php if(!empty($product_overview->species)){?>
          <h3 class="application">Species</h3>
          <ul class="point">
            <?php if(!empty($product_overview->species)) {?>
              <li> <?php echo $product_overview->species;?></li>
            <?php } ?>
          </ul>
        <?php } ?>
        <?php if(!empty($product_overview->procedure)){?>
          <h3 class="application">Procedure</h3>
          <ul class="point">
            <?php if(!empty($product_overview->procedure)) {?>
              <li> <?php echo $product_overview->procedure;?></li>
            <?php } ?>
          </ul>
        <?php } ?> 
        <?php if(!empty($product_overview->size)){?>
          <h3 class="application">Size</h3>
          <ul class="point">
            <?php if(!empty($product_overview->size)) {?>
              <li> <?php echo $product_overview->size;?></li>
            <?php } ?>
          </ul>
        <?php } ?>
        <?php if(!empty($product_overview->detection_limit)){?>
          <h3 class="application">Detection Limit</h3>
          <ul class="point">
            <?php if(!empty($product_overview->detection_limit)) {?>
              <li> <?php echo $product_overview->detection_limit;?></li>
            <?php } ?>
          </ul>
        <?php } ?>
        <?php if(!empty($product_overview->shelf_life)){?>
        <h3 class="application">Shelf Life</h3>
        <ul class="point">
          <?php if(!empty($product_overview->shelf_life)) {?>
            <li> <?php echo $product_overview->shelf_life;?></li>
          <?php } ?>
        </ul>
        <?php } ?>
        <?php if(!empty($product_overview->more_details)){?>
        <h3 class="application">More Details</h3>
        <ul class="point">
          <?php if(!empty($product_overview->more_details)) {?>
            <li> <?php echo $product_overview->more_details;?></li>
          <?php } ?>
        </ul>
        <?php } ?>
      </div>
    </div>  
    <div id="product-faq"  class="tabbox">
      <?php $faqdata = $this->Products_Model->getfaqbyid($id);
        if(!empty($faqdata)){
          foreach($faqdata as $faq) {

          }
        }
        if(!empty($faq)) { ?>
        <div class="bs_tab_cont">
        <div class="bs_tab_inside">
        <?php for($q=1; $q<=10; $q++) {
            $fq = "faq_q".$q;
            $fa = "faq_a".$q;
            if(!empty($faq->$fq)){
              echo "<h2>".($faq->$fq)."</h2>";
              echo $faq->$fa;
              echo "<br/><br/>";
            }
          } ?>
          <br/>
          For more detailed product information and questions, please feel free to <a href="javascript:location='mailto:\u0069\u006e\u0066\u006f\u0040\u0062\u0069\u006f\u0061\u0073\u0073\u0061\u0079\u0073\u0079\u0073\u002e\u0063\u006f\u006d\u003f\u0073\u0075\u0062\u006a\u0065\u0063\u0074\u003d<?php echo ucfirst($name);?>';void 0">Contact Us</a>. 
          Or for more general information regarding our assays, please refer to our <a href="https://www.bioassaysys.com/support/general_questions" target="_blank">General Questions</a>.
    </div>
    <?php } else {?>
    <div>No frequently asked questions for this new product. Please check back later.<br /><br />
        For more detailed product information and questions, please feel free to <a href="mailto:info@bioassaysys.com?subject=<?php echo ucfirst($name);?>">Contact Us.</a>
        Or for more general information regarding our assays, please refer to our <a href="https://www.bioassaysys.com/support/general-questions.html" target="_blank">General Questions</a>.<br />
    </div>
    <?php } ?>
  </div> 
</div>
<div id="product-citations" class="tabbox">
  <?php $cit_data = $this->Products_Model->getcitbyid($id); ?>
  <div class="bs_tab_cont">
    <div class="bs_tab_inside">
    <?php
    if(!empty($cit_data)) {
       foreach ($cit_data as $citt) {

       }
       for($q=1; $q<=50; $q++) {
         $cit = "cit".$q;
         if(!empty($citt->$cit)){
           echo $citt->$cit;
           echo "<br/>";
           echo "<br/>";
          }
        } ?>
      <br/>
      To find more recent publications, please <a target="_blank" rel="noopener" href="https://scholar.google.com/scholar?hl=en&q=%22bioassay+systems%22+AND+(<?php echo $catalog_num; ?>+OR+%22<?php echo $display_name; ?>%22+OR+%22<?php echo $name; ?>%22)" title="Citations"> click here.</a>
      <?php } else {?> 
      <div> No citations for this new product. Please check back later.<br />
        You may <a target="_blank" rel="noopener" href="https://scholar.google.com/scholar?hl=en&q=%22bioassay+systems%22+AND+(<?php echo $catalog_num; ?>+OR+%22<?php echo $display_name; ?>%22+OR+%22<?php echo $name; ?>%22)" title="Citations"> click here</a> to check if citations are available, but are not listed here yet.
      </div>
      <?php } ?>
      </div>
    </div>
  </div>   
  <div id="assay-service" class="tabbox">
    <div class="bs_tab_cont">
    If you or your labs do not have the equipment or scientists necessary to run this assay, BioAssay Systems can perform the service for you. 
    <br /> <br /> - Fast turnaround<br /> - Quality data<br /> - Low cost<br /> <br />
     <?php
      $s_data = $this->Products_Model->getservicesbyid($id);
      if(!empty($s_data)) {
        foreach ($s_data as $service) {

        }
        echo  'Our services include, but not limited to:<br /><br /> <ul class="point">';
        for($q=1; $q<=10; $q++) {
          $scit = "service".$q;
          if(!empty($service->$scit)){
            echo "<li>".$service->$scit."</li>";
          }
        }
        echo "</ul><br />";
      }?>
      Please <a href="javascript:location='mailto:\u0073\u0065\u0072\u0076\u0069\u0063\u0065\u0040\u0062\u0069\u006f\u0061\u0073\u0073\u0061\u0079\u0073\u0079\u0073\u002e\u0063\u006f\u006d\u003f\u0073\u0075\u0062\u006a\u0065\u0063\u0074\u003d<?php echo $display_name; ?>';void 0">email</a> or call <a href="tel:+15107829988,2">1-510-782-9988 x 2</a> to request assay service.
      </div>
    </div>
  </div>
  <?php } ?>
</div>
</div>
</section>
<script>
 // $( function() {
    var target = window.location.hash;
    var hash = location.hash.replace('#','');
    $("#mytabs").tabs({
      // create: function(event, ui) {
      //   window.location.hash = ui.panel.attr('id');
      //   window.scrollTo(0, 0);
      // },
      /*activate: function(event, ui) {
        window.location.hash = ui.newPanel.attr('id');
        window.scrollTo(0, 0);
        window.pageYOffset || document.documentElement.scrollTop;
        //window.pageYOffset
      }*/
    });
    
 // });

</script>