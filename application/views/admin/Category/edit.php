 <?php
 if (!empty($item)) {
   foreach ($item as $i) {
    $cID = $i->id;
     $title = $i->title;
     $Description = $i->description;
   }
 }
 ?>
 <ul class="breadcrumb">
  <li><a href="<?php echo base_url();?>admin/dashboard/index">Dashboard</a></li>                    
  <li><a href="<?php echo base_url();?>admin/category/index">Main Category Deytails</a></li>
  <li class="active">Main Category Add/Edit</li>
</ul>
<div class="row">

  <div class="col-md-12">
    <div class="panel panel-default">

      <div class="panel-heading">
        <h3 class="panel-title">Main Category Details</h3>
      </div>
      <?php
                     $r = $this->session->flashdata('response');
                     if(isset($r)){?>
                      <div class="alert <?php if($r['Response']==0){ echo 'alert-warning';}else{echo'alert-success';}?>"><?php echo $r['Message']?></div>
                    <?php } ?>
      <form action="/admin/category/edit" method="post" enctype="multipart/form-data">
         <input type="hidden" name="id" value="<?php echo isset($cID)?$cID:'';?>" />
        <div class="panel-body">
          <div class="form-group">
            <label for="title">Title:</label>
             <input type="text" class="form-control" id="title" placeholder="Category Title" name="title" title="Category Title" value="<?php echo isset($title)?$title:'';?>">
            </div>
          <div class="form-group">
            <label for="Content">Description:</label>
            <textarea class="form-control " id="Content"  name="Description" title="General Questions">
              <?php echo isset($Description)?$Description:'';?>
            </textarea>
          </div>
          <br>
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