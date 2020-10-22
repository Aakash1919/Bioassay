  <?php
if(!empty($Services)){
  foreach ($Services as $s) {
      $id = $s->id;
      $title = $s->title;
      $content = $s->content;
      $seo_title = $s->seo_title;
      $seo_keyword = $s->seo_keyword;
      $seo_description = $s->seo_description;
  }
}
  ?>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url();?>admin/dashboard/index">Dashboard</a></li>                    
    <li><a href="<?php echo base_url();?>admin/Services/index">Manage Services</a></li>
    <li class="active">Add/Edit Services</li>
  </ul>
  <div class="row">
    <form action="/admin/services/edit" method="post">
      <input type="hidden" name="id" value="<?php echo isset($id)?$id:'';?>" />
      <div class="col-md-12">
        <div class="panel panel-default">

          <div class="panel-heading">
            <h3 class="panel-title">Basic Info</h3>
          </div>
           <?php
           $r = $this->session->flashdata('response');
           if(isset($r)){?>
           <div class="alert <?php if($r['Response']==0){ echo 'alert-warning';}else{echo'alert-success';}?>"><?php echo $r['Message']?></div>
           <?php } ?>
          <div class="panel-body">
         <div class="form-group">
              <label for="Title">Title</label>
              <input type="text" class="form-control" id="Title" placeholder="Title" name="Title" title="Meta Title" value="<?php echo isset($title)?$title:'';?>">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="panel panel-default">

          <div class="panel-heading">
            <h3 class="panel-title">Content</h3>
          </div>

          <div class="panel-body">
            <div class="form-group">
              <label for="pcategory">Content</label>
              <textarea class="form-control" id="Content"  name="pDescription" title="Product Descriptiond">
                <?php echo isset($content)?$content:'';?>
              </textarea>  
            </div>
            <br>
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
          <a href="<?php echo base_url();?>admin/services/index" class="btn btn-info">Cancel</a>
          <button class="btn btn-primary pull-right" type="submit">Save</button>
        </div>
       </div>
     </div>
   </form>
 </div>



 <script type="text/javascript" src="<?php echo base_url();?>theme/ckeditor/ckeditor.js"></script>
<!-- <script>
      $(document).ready(function() {
        CKEDITOR.replaceClass = 'Content';
      });
    </script> -->
    <script>
      CKEDITOR.replace( 'Content', {

        height: 300,
        filebrowserBrowseUrl : '<?php echo base_url();?>theme/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl : '<?php echo base_url();?>theme/ckfinder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl : '<?php echo base_url();?>theme/ckfinder/ckfinder.html?Type=Flash',
        filebrowserUploadUrl : '<?php echo base_url();?>theme/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl : '<?php echo base_url();?>theme/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl : '<?php echo base_url();?>theme/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
      });     
    </script>