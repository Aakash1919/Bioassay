  <?php
  if(!empty($productDetails)){
    foreach ($productDetails as $pd) {
    $pID = $pd->product_id;
    @$pCatID=$pd->category_id;
    $name = $pd->name;
    $url = $pd->url;
    $name_display = $pd->name_display;
    $price = $pd->price;
    $catalog_num = $pd->catalog_num;
    @$size = $pd->size;
    @$citations = $pd->citations;
    $discountcode = $pd->discountcode;
    $discountpercent = $pd->discountpercent;
    $shipping_method = $pd->shipping_method;
    $seo_title = $pd->seo_title;
    $seo_keyword = $pd->seo_keyword;
    $seo_description = $pd->seo_description;
    $expirydate = $pd->expirydate;
    @$keywords = $pd->keywords;
    @$description = $pd->description;
    @$protocol = $pd->protocol;
    @$msds = $pd->msds;
    $shipment = $pd->shipment;
    $storage = $pd->storage;
    $product_figure = $pd->product_figure;
    $mod_date = $pd->mod_date;
    @$faq = $pd->faq;
    @$general = $pd->general;
    @$service = $pd->service;
      
    }

  }
  ?>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url();?>admin/dashboard/index">Dashboard</a></li>                    
    <li><a href="<?php echo base_url();?>admin/store/products">Products</a></li>
    <li class="active">Product Add/Edit</li>
  </ul>
    <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">

        <div class="panel-heading">
          <h3 class="panel-title">Basic Category Info</h3>
        </div>
         <form action="/admin/store/edit/products/" method="post" enctype="multipart/form-data">
          <div class="panel-body">
            <div class="form-group">
            <label for="pcategory">Parent Category</label>
            <select type="text" class="form-control" id="pcategory"  name="pcategory" title="Parent Category">
              
           <?php
          if(!empty($parentCategory))
          {
            foreach ($parentCategory as $pc) {
          
          ?>
          <option value="<?php echo $pc->category_id;?>" <?php if(!empty($pCatID) && $pCatID==$pc->category_id){echo 'selected="selected"';}?>><?php echo $pc->category;?></option>
      <?php } } ?>
            </select>
          </div>
          </div>
        </div>
      </div>
    <div class="col-md-12">
      <div class="panel panel-default">

        <div class="panel-heading">
          <h3 class="panel-title">Product Info</h3>
        </div>

       
          <div class="panel-body">
           <?php
           $r = $this->session->flashdata('response');
           if(isset($r)){?>
           <div class="alert <?php if($r['Response']==0){ echo 'alert-warning';}else{echo'alert-success';}?>"><?php echo $r['Message']?></div>
           <?php } ?>
           <input type="hidden" name="id" value="<?php echo isset($pID)?$pID:'';?>" />
           <div class="form-group">
            <label for="pName">Product Name</label>
            <input type="text" class="form-control" id="pName" placeholder="Product Name" name="pName" title="Product Name" value="<?php echo isset($name)?$name:'';?>">
          </div>

          <div class="form-group">
            <label for="Url">URL</label>
            <input type="text" class="form-control" id="Url" placeholder="Url" name="Url" title="Enter URL" value="<?php echo isset($url)?$url:'';?>">
          </div>

          <div class="form-group">
            <label for="pDisplayName">Product Display Name</label>
            <input type="text" class="form-control" id="pDisplayName" placeholder="Enter Product Display Name" name="pDisplayName" title="Product Display Name" value="<?php echo isset($name_display)?$name_display:'';?>">
          </div>
        </div>
    </div>                                                
</div>
    <div class="col-md-12">
      <div class="panel panel-default">

        <div class="panel-heading">
          <h3 class="panel-title">Product Description</h3>
        </div>

          <div class="panel-body">
             <div class="form-group">
            <label for="Content1">Product Description</label>
            <textarea class="form-control Content" id="Content1"  name="pDescription" title="Product Descriptiond">
              <?php echo isset($description)?$description:'';?>
            </textarea>
          </div>       
          <br>                  
          <div class="form-group">
            <label for="RPrice">Regular Price (in $)</label>
             <input type="text" class="form-control" id="RPrice" placeholder="Enter Product Price" name="pPrice" title="Product Price" value="<?php echo isset($price)?$price:'';?>">
            </div>
              <div class="form-group">
            <label for="relatedProducts">Related Products</label>
            <select type="text" class="form-control" id="relatedProducts"  name="relatedProducts[]" title="Related Products" multiple="multiple">
               <?php
          if(!empty($relatedProducts))
          {
            foreach ($relatedProducts as $rp) {
          
          ?>
          <option value="<?php echo $rp->product_id;?>"><?php echo $rp->name;?></option>
      <?php } } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="catalog">Catalog#</label>
             <input type="text" class="form-control" id="catalog" placeholder="Catalog Number" name="catalog" title="Catalog" value="<?php echo isset($catalog_num)?$catalog_num:'';?>">
            </div>
            <div class="form-group">
            <label for="pSize">Size</label>
             <input type="text" class="form-control" id="pSize" placeholder="Enter Product Size" name="pSize" title="Product Size" value="<?php echo isset($size)?$size:'';?>">
            </div>
            <div class="form-group">
            <label for="pStorage">Storage</label>
             <input type="text" class="form-control" id="pStorage" placeholder="" name="pStorage" title="Storage" value="<?php echo isset($storage)?$storage:'';?>">
            </div>
              <div class="form-group">
            <label for="pImage">Product Image</label>
            <?php echo isset($product_figure)?'<img src="'.base_url().'/images/Product_pics/'.$product_figure.'" width="auto">':'';?>
          
             <input type="file" class="fileinput" id="pImage" placeholder="Product Image" name="pImage" title="Product Image">
            </div>
              <div class="form-group">
            <label for="keyForSearching">Keywords for searching</label>
             <input type="text" class="form-control" id="keyForSearching" placeholder="Keywords" name="keyForSearching" title="Keyword For Searching" value="<?php echo isset($keywords)?$keywords:'';?>">
            </div>
              <div class="form-group">
            <label for="sMethod">Shipping Method</label>
             <input type="text" class="form-control" id="sMethod" placeholder="Shipping Method" name="sMethod" title="Shipping Method" value="<?php echo isset($shipping_method)?$shipping_method:'';?>">
            </div>
              <div class="form-group">
            <label for="citation">Citations:</label>
            <textarea class="form-control Content" id="citation"  name="citation" title="Citations">
              <?php echo isset($citations)?$citations:'';?>
            </textarea>
          </div> 
          <br>
          <div class="form-group">
            <label for="Shipment">Shipment:</label>
             <input type="text" class="form-control" id="Shipment" placeholder="Shipment" name="Shipment" title="Shipment" value="<?php echo isset($shipment)?$shipment:'';?>">
            </div>
            <div class="form-group">
            <label for="pdf">Download PDF file:</label>
             <input type="file" class="fileinput" id="pdf" placeholder="PDF File" name="pdf" title="PDF file" value="">
            </div>
            <div class="form-group">
            <label for="FAQ">FAQ:</label>
            <textarea class="form-control Content" id="FAQ"  name="FAQ" title="FAQ">
              <?php echo isset($faq)?$faq:'';?>
            </textarea>
          </div>
          <br>
          <div class="form-group">
            <label for="GQuestions">General Questions:</label>
            <textarea class="form-control Content" id="GQuestions"  name="GQuestions" title="General Questions">
              <?php echo isset($general)?$general:'';?>
            </textarea>
          </div>
          <br>
          <div class="form-group">
            <label for="DiscountCode">Discount Code</label>
             <input type="text" class="form-control" id="DiscountCode" placeholder="Enter Discount Code" name="DiscountCode" title="Enter Discount Code" value="<?php echo isset($discountcode)?$discountcode:'';?>">
            </div>
            <div class="form-group">
            <label for="DiscountPercent">Discount %:</label>
             <input type="text" class="form-control" id="DiscountPercent" placeholder="Enter Discount Percent" name="DiscountPercent" title="Discount Percent" value="<?php echo isset($discountpercent)?$discountpercent:'';?>">
            </div>

            <div class="form-group">
            <label for="date">Date(YYYY-MM-DD)</label>
             <input type="text" class="form-control" id="date" placeholder="YYYY-MM-DD" name="date" title="Date" value="<?php echo isset($date)?$date:'';?>">
            </div>
            <div class="form-group">
            <label for="eDate">Expiry Date</label>
             <input type="text" class="form-control" id="eDate" placeholder="Enter Expiry Date" name="eDate" title="Expiry Date" value="<?php echo isset($expirydate)?$expirydate:'';?>">
            </div>
            <div class="form-group">
            <label for="MetaTitle">Meta Title</label>
             <input type="text" class="form-control" id="MetaTitle" placeholder="Meta Title" name="MetaTitle" title="Meta Title" value="<?php echo isset($seo_title)?$seo_title:'';?>">
            </div>
            
            <div class="form-group">
            <label for="MetaKeywords">Meta Keyword</label>
             <input type="text" class="form-control" id="MetaKeywords" placeholder="Enter Meta Keywords" name="MetaKeywords" title="Meta Keywords" value="<?php echo isset($seo_keyword)?$seo_keyword:'';?>">
            </div>
            
            <div class="form-group">
            <label for="MetaDescription">Meta Description:</label>
             <input type="text" class="form-control" id="MetaDescription" placeholder="Enter Meta Description" name="MetaDescription" title="Meta Description" value="<?php echo isset($seo_description)?$seo_description:'';?>">
            </div>
            
          </div>
            <div class="panel-footer">
          <a href="<?php echo base_url();?>admin/store/products" class="btn btn-info">Cancel</a>
          <button class="btn btn-primary pull-right" type="submit">Save</button>
        </div>
      </form>
        </div>
      </div>
    </div>
<script type="text/javascript" src="<?php echo base_url();?>theme/ckeditor/ckeditor.js"></script>
<!-- <script>
      $(document).ready(function() {
        CKEDITOR.replaceClass = 'Content';
      });
    </script> -->
  <script>
    CKEDITOR.replaceAll( 'Content', {
           
      height: 300,
      filebrowserBrowseUrl : '<?php echo base_url();?>theme/ckfinder/ckfinder.html',
          filebrowserImageBrowseUrl : '<?php echo base_url();?>theme/ckfinder/ckfinder.html?Type=Images',
          filebrowserFlashBrowseUrl : '<?php echo base_url();?>theme/ckfinder/ckfinder.html?Type=Flash',
          filebrowserUploadUrl : '<?php echo base_url();?>theme/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
          filebrowserImageUploadUrl : '<?php echo base_url();?>theme/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
          filebrowserFlashUploadUrl : '<?php echo base_url();?>theme/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
  });     
  </script>
  <style type="text/css">
    #cke_2_floatingtools{display: none;}
    #cke_1_floatingtools{display: none;}
    #cke_4_floatingtools{display: none;}
    #cke_3_floatingtools{display: none;}
  </style>