
<script type="text/javascript">
jQuery(document).ready(function() {
//alert("hai");
jQuery('#menu1').change(function() {
  //alert("hai111");
  var pid=$('#menu1').val();
  
  var dataString="pid="+pid;
  //alert(dataString);
$.ajax({
type: "POST",
url: "/support/get_ajax",
data: dataString,
success: function(data){
//alert(data);
  $("#ajaxdiv").html(data);
  }
});

});
  
});

</script> 
<script type="text/javascript">
jQuery(document).ready(function() {
//alert("hai");
jQuery('#menu2').change(function() {
  //alert("hai111");
  var pid=$('#menu2').val();
  
  var dataString="pid="+pid;
  //alert(dataString);
$.ajax({
type: "POST",
url: "/support/get_ajax",
data: dataString,
success: function(data){
//alert(data);
  $("#ajaxdiv").html(data);
  }
});

});
  
});

</script> 
<script type="text/javascript">
jQuery(document).ready(function() {
//alert("hai");
jQuery('#menu3').change(function() {
  //alert("hai111");
  var pid=$('#menu3').val();
  
  var dataString="pid="+pid;
  //alert(dataString);
$.ajax({
type: "POST",
url: "/support/get_ajax",
data: dataString,
success: function(data){
//alert(data);
  $("#ajaxdiv").html(data);
  }
});

});
  
});

</script>  
<section class="content-right">
  <article class="content-right-btm" style="margin-top:0px;">

    <div class="new-products" style="margin-top:0px;">
  <div class="new-products-title"><h1><span>Product Citations</span></h1></div>
<div class="new-products-list">
<div style="padding: 15px;">

<p>&nbsp;</p>
<p>Please note: publications for some new products may not be available yet. Please check back later.<br />
You could also perform a quick <a href="http://scholar.google.com/?hl=en" target="_blank" rel="noopener">keyword search</a> by using our product catalog number, for example, "DIUR-500" for Urea Assay Kit.</p> </br>

<p>&nbsp;</p>
<td align="left" valign="top"><table id="table9" border="0" cellpadding="0" cellspacing="0" width="743">
          <tbody><tr> <td width="100%;">

<table width="100%" border="0" align="center">

<tbody>
<tr>
<td width="200"><form name="jump1">
<div style="text-align: left;"><span class="textbold_orange">A to C </span></div>
<p align="left">
<select id="menu1" name="menu1" style="width:120px;">
<option value="javascript:void(0);" selected="selected">Choose One</option>
<?php
if(!empty($ct1)){
foreach($ct1 as $RESULT){
?>

<option value="<?php echo $RESULT['product_id'];?>"><?php echo $RESULT['name_display'];?></option>

<?php }}?>
</select>

</p>
</form>
</td>

<td width="200"><form name="jump2">
<div style="text-align: left;"><span class="textbold_orange">D to M </span></div>
<p align="left">
<select id="menu2" name="menu2" style="width:120px;">
<option  value="javascript:void(0);" selected="selected">Choose One</option>

<?php
if(!empty($ct1)){
foreach($ct2 as $RESULT){
?>

<option value="<?php echo $RESULT['product_id'];?>"><?php echo $RESULT['name_display'];?></option>

<?php } }?>

</select>

</p>
</form></td>

<td width="200"><form name="jump3">
<div style="text-align: left;"><span class="textbold_orange">N to Z </span></div>
<p align="left">
<select id="menu3" name="menu3" style="width:120px;">
<option  value="javascript:void(0);"  selected="selected">Choose One</option>

<?php
if(!empty($ct1)){
foreach($ct3 as $RESULT){
?>

<option value="<?php echo $RESULT['product_id'];?>"><?php echo $RESULT['name_display'];?></option>

<?php } }?>



</select>
<!--<input id="ajax3" value="GO" type="button">-->
</p>
</form></td>
</tr>

</tbody></table> 

        

<br><br><br>

<div id="ajaxdiv" style="color:#666;">




</div>





            </td></tr>
          </tbody></table>
          <br>
</td>
      </tr><tr>
        <td colspan="5">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="5">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="5" align="center">&nbsp;</td>
      </tr>
    </tbody></table></td>
  </tr>
</tbody></table>
</div>
</div>
</section>
</div>
<div class="clear"> </div>