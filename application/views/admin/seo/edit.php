  <ul class="breadcrumb">
    <li><a href="<?php echo base_url();?>admin/dashboard/index">Dashboard</a></li>                    
    <li><a href="<?php echo base_url();?>admin/store/categories">Categories</a></li>
    <li class="active">Categories Edit</li>
  </ul>
  <?php 

  if(!empty($item)){
    foreach ($item as $i){
      $id = $i->id;
      $Name = $i->Name;
      $Title = $i->Title;
      $Description = $i->Description;
      
    }
  }
  ?>
  <div class="row">  
    <div class="panel panel-default">

      <div class="panel-heading">
        <h3 class="panel-title"><?php echo isset($PageTitle)?$PageTitle:"";?></h3>
      </div>
      
      <form action="<?php echo base_url()?>admin/seo/edit/<?php echo isset($id)?$id:'';?>" method="post">
        <div class="panel-body">
         <?php
         $r = $this->session->flashdata('response');
         if(isset($r)){?>
          <div class="alert <?php if($r['Response']==0){ echo 'alert-warning';}else{echo'alert-success';}?>"><?php echo $r['Message']?></div>
        <?php } ?>
        <input type="hidden" name="id" value="<?php echo isset($id)?$id:'';?>" />
      
        <div class="form-group">
          <label for="Name">Page Name :</label>
          <input type="text" class="form-control" id="pageName" placeholder="Page Name" name="pageName" title="Page Name" readonly="readonly" value="<?php echo isset($Name)?$Name:'';?>">
        </div>
        
        <div class="form-group">
          <label for="Keyword">Keywords:</label>
          <input type="text" class="form-control" id="Keyword" placeholder="Enter Keywords" name="Keyword" title="Enter Keyword" value="<?php echo isset($Title)?$Title:'';?>">
        </div>

        <div class="form-group">
          <label for="Description">Description :</label>
          <input type="text" class="form-control" id="Description" placeholder="Enter Page Description" name="Description" title="Enter Page Description" value="<?php echo isset($Description)?$Description:'';?>">
        </div>

    </div>
    <div class="panel-footer">
      <a href="<?php echo base_url();?>admin/seo/index" class="btn btn-info">Cancel</a>
      <button class="btn btn-primary pull-right" type="submit">Save</button>
    </div>
  </form>
</div>   
</div>