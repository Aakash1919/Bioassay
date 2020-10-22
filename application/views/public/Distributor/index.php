<section class="content-right">
	<article class="content-right-btm" style="margin-top:0px;">
		<div class="new-products" style="margin-top:0px;">
			<div class="new-products-title">
				<h1>
					<span>
						Global Distributors
					</span>
				</h1>
			</div>
			<div class="new-products-list">
				<div style="padding: 15px;">
					<p>
						BioAssay Systems welcomes distributors from all over the world. Please <a href="javascript:location='mailto:\u0069\u006e\u0066\u006f\u0040\u0062\u0069\u006f\u0061\u0073\u0073\u0061\u0079\u0073\u0079\u0073\u002e\u0063\u006f\u006d\u003f\u0073\u0075\u0062\u006a\u0065\u0063\u0074\u003d\u0044\u0069\u0073\u0074\u0072\u0069\u0062\u0075\u0074\u006f\u0072\u0020\u0049\u006e\u0071\u0075\u0069\u0072\u0079';void 0">contact us</a>. We encourage oversea customers to contact the following distributors for ordering information. If your country is not listed, you could order directly from us.
					</p>
					</br>
					<table id="table9" border="0" cellpadding="0" cellspacing="0" style="text-align: center;">
						<tbody>
							<tr>
								<td>
									<table width="100%" border="0" align="center">
										<tbody>
											<tr>
												<td style="padding: 10px;">
													<form name="jump5">
														<p align="left">
															<select id="menu5" name="menu5" style="width:115px;">
																<option value="javascript:void(0);" selected="selected">
																	AMERICAS
																</option>
																<?php
																	if(!empty($AmericaDistributor)){
																		foreach($AmericaDistributor as $AD){
																?>
																<option value="<?php echo $AD['distributor_id'];?>">
																	<?php echo $AD['country'];?>
																</option>
																<?php
																		}
																	}
																?>
															</select>
														</p>
													</form>
												</td>

												<td style="padding: 10px;">
													<form name="jump6">
														<p align="left">
															<select id="menu6" name="menu6" style="width:115px;">
																<option value="javascript:void(0);" selected="selected">
																	EUROPE
																</option>
																<?php
																	if(!empty($EuropeDistributor)){
																		foreach($EuropeDistributor as $AD){
																?>
																<option value="<?php echo $AD['distributor_id'];?>">
																	<?php echo $AD['country'];?>
																</option>
																<?php
																		}
																	}
																?>
															</select>
														</p>
													</form>
												</td>

												<td style="padding: 10px;">
													<form name="jump7">
														<p align="left">
															<select id="menu7" name="menu7" style="width:115px;">
																<option value="javascript:void(0);" selected="selected">
																	ASIA/PACIFIC
																</option>
																<?php
																	if(!empty($AsiaDistributor)){
																		foreach($AsiaDistributor as $AD){
																?>
																<option value="<?php echo $AD['distributor_id'];?>">
																	<?php echo $AD['country'];?>
																</option>    
																<?php
																		}
																	}
																?>
															</select>
														</p>
													</form>
												</td>

												<td style="padding: 10px;">
													<form name="jump8">
														<p align="left">
															<select id="menu8" name="menu8" style="width:115px;">
																<option value="javascript:void(0);" selected="selected">
																	MIDDLE EAST
																</option>
																<?php
																	if(!empty($MiddleEastDistributor)){
																		foreach($MiddleEastDistributor as $AD){
																?>
																<option value="<?php echo $AD['distributor_id'];?>">
																	<?php echo $AD['country'];?>
																</option>    
																<?php
																		}
																	}
																?>
															</select>
														</p>
													</form>
												</td>

												<td style="padding: 10px;">
													<form name="jump9">
														<p align="left">
															<select id="menu9" name="menu9" style="width:115px;">
																<option value="javascript:void(0);" selected="selected">
																	AFRICA
																</option>
																<?php
																	if(!empty($AfricaDistributor)){
																		foreach($AfricaDistributor as $AD){
																?>
																<option value="<?php echo $AD['distributor_id'];?>">
																	<?php echo $AD['country'];?>
																</option>
																<?php
																		}
																	}
																?>
															</select>
														</p>
													</form>
												</td>
											</tr>
										</tbody>
									</table> 
								</td>
							</tr>
						</tbody>
					</table>
					<br>
					<div style="width: 100%;">
						<div style="width: 35%; display: inline-block;">
						</div>													
						<div id="ajaxdiv" style="font-size:12px; color:#666; width: 40%; display: inline-block;">
						</div>
						<div style="width: 25%; display: inline-block;">
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>
</section>
</div>
<div class="clear">
</div>

<script type="text/javascript">
$(function(){
  $('#slider1').bxSlider({
    auto: true,
    autoControls: false,
	 pager: false,
	mode: 'horizontal'
  });
});
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<script src="js/showHide.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function(){

$('.hide').hide();
$('.show_hide').click(function(){
	
	var rel =$(this).attr('rel');
	
	if ($('.hide').hasClass("active")) {
		$('.hide').removeClass("active");
        $('.hide').css('display', 'none');
    }
	$('#'+rel).addClass("active");
	$('#'+rel).fadeIn('fast');
});
   /*$('.show_hide').showHide({			 
		speed: 1000,  // speed you want the toggle to happen	
		easing: '',  // the animation effect you want. Remove this line if you dont want an effect and if you haven't included jQuery UI
		changeText: 0, // if you dont want the button text to change, set this to 0
		showText: 'View',// the button text to show when a div is closed
		hideText: 'Close' // the button text to show when a div is open
					 
	}); 
*/



});

</script>
<script type="text/javascript">
jQuery(document).ready(function() {
jQuery('#menu5').change(function() {
	var did=$('#menu5').val();
	var dataString="did="+did;
$.ajax({
type: "POST",
url: "/distributor/getDistributor",
data: dataString,
success: function(data){
	$("#ajaxdiv").html(data);
	}
});
});
});

</script>
<script type="text/javascript">
jQuery(document).ready(function() {
jQuery('#menu6').change(function() {
	var did=$('#menu6').val();
	var dataString="did="+did;
$.ajax({
type: "POST",
url: "/distributor/getDistributor",
data: dataString,
success: function(data){
	$("#ajaxdiv").html(data);
	}
});
});
});

</script>
<script type="text/javascript">
jQuery(document).ready(function() {
jQuery('#menu7').change(function() {
	var did=$('#menu7').val();
	var dataString="did="+did;
$.ajax({
type: "POST",
url: "/distributor/getDistributor",
data: dataString,
success: function(data){
	$("#ajaxdiv").html(data);
	}
});
});
});

</script>
<script type="text/javascript">
jQuery(document).ready(function() {
jQuery('#menu8').change(function() {
	var did=$('#menu8').val();
	var dataString="did="+did;
$.ajax({
type: "POST",
url: "/distributor/getDistributor",
data: dataString,
success: function(data){
	$("#ajaxdiv").html(data);
	}
});
});
});

</script>
<script type="text/javascript">
jQuery(document).ready(function() {
jQuery('#menu9').change(function() {
	var did=$('#menu9').val();
	var dataString="did="+did;
$.ajax({
type: "POST",
url: "/distributor/getDistributor",
data: dataString,
success: function(data){
	$("#ajaxdiv").html(data);
	}
});
});
});

</script>