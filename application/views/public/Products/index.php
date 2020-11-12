<head>
<style>
.arrow {
  border: solid black;
  border-width: 0 3px 3px 0;
  display: inline-block;
  padding: 2px;
}
.up {
  transform: rotate(-135deg);
  -webkit-transform: rotate(-135deg);
}
.down {
  transform: rotate(45deg);
  -webkit-transform: rotate(45deg);
}
</style>
</head>
<section class="content-right">
	<article class="content-right-btm" style="margin-top:10px;">
	<?php echo isset($_GET['q'])?"Results for your search term '".$_GET['q']."':":''; ?>
	<?php echo "$count Product(s)\n found";?>.
	<div class="new-products" style="margin-top:0px;">
		<div class="new-products-title"><h1><span> <?php echo isset($category)?$category: 'Products Table'; ?></span></h1></div>
		<div class="new-products-list" id="productData">
			<?php $response = $this->session->flashdata('wrongproduct');
			if(!empty($response)){?>
				<style type="text/css">
					.wrongproduct {
						width: 98%;
						background-color: red;
						text-align: center;
						color: white;
						margin-top:15px;
						margin-bottom: 15px;
						padding: 10px;
					}
            		.wrongproduct h1{color: white;}
       			</style>
			<div class="wrongproduct"><h1><?php echo $response; ?></h1></div>
			<?php } ?>
			<!-- table will append here -->
		</div>
		<div id="pgn"><?php echo isset($links)?$links:'';?></div>
	</div>
</article>
</section>
<script type="text/javascript">
	jQuery(document).ready(function(){
		loadCart();
	});
	function loadCart(){
		var Message = '<p style="text-align:center;padding:10px;">loading.. Please wait</p>';
		jQuery("#productData").html(Message);
		var url = "/products/getTable<?php echo isset($_GET['q']) ? '?q='.$_GET['q'] : '' ?>";
		jQuery.get( url, function( data ) {
			jQuery("#productData").html(data);
			});
		}
</script>
<script>
jQuery(document).on('click','#productName',function(){	
	var url = "/products/getTable<?php echo isset($_GET['q']) ? '?q='.$_GET['q'] : '' ?>";
	jQuery.post( url,{'name':'name_display'}, function( data ) {
	jQuery("#productData").html(data);
	});
});
jQuery(document).on('click','#catalog_num',function(){	
	var url = "/products/getTable<?php echo isset($_GET['q']) ? '?q='.$_GET['q'] : '' ?>";
	jQuery.post( url,{'name':'catalog_num'}, function( data ) {
	jQuery("#productData").html(data);
	});
});
jQuery(document).on('click','#price',function(){	
	var url = "/products/getTable<?php echo isset($_GET['q']) ? '?q='.$_GET['q'] : '' ?>";
	jQuery.post( url,{'name':'price'}, function( data ) {
	jQuery("#productData").html(data);
	});
});
</script>