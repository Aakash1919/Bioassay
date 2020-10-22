<ul class="breadcrumb">
    <li><a href="<?php echo base_url();?>admin/dashboard/index">Dashboard</a></li>
    <li class="active">Banner Add/Edit</li>
  </ul>
    <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">

        <div class="panel-heading">
          <h3 class="panel-title">Banner</h3>
        </div>
         <form action="/admin/banner/uploadImage" method="post" enctype="multipart/form-data">
          <div class="panel-body">
              <?php
           $r = $this->session->flashdata('response');
           if(isset($r)){?>
           <div class="alert <?php if($r['Response']==0){ echo 'alert-warning';}else{echo'alert-success';}?>"><?php echo $r['Message']?></div>
           <?php } ?>
             <?php 
              if(!empty($ImageBanner)){
                echo '<img src="'.base_url().'images/'.$ImageBanner.'" width="auto">';
              }

                ?>
          
             <div class="form-group">
            <label for="pImage">Banner Image</label>
           
             <input type="file" class="fileinput" id="pImage" placeholder="Banner Image" name="pImage" title="Banner Image">
            </div>
          </div>
          <div class="panel-footer">
          <button class="btn btn-primary pull-right" type="submit">Save</button>
        </div>
        </form>
        </div>
      </div>
    </div>