  <ul class="breadcrumb">
    <li><a href="<?php echo base_url();?>admin/dashboard/index">Dashboard</a></li>                    
    <li><a href="<?php echo base_url();?>admin/store/categories">Categories</a></li>
    <li class="active">Categories Edit</li>
  </ul>
  <?php 

  if(!empty($item)){
    foreach ($item as $i){
      $pCatID = $i->catid;
      $categoryID = $i->category_id;
      $subCategory = $i->category;
    }
  }
  ?>
  <div class="row">  
    <div class="panel panel-default">

      <div class="panel-heading">
        <h3 class="panel-title"><?php echo isset($PageTitle)?$PageTitle:"";?></h3>
      </div>
      
      <form action="<?php echo base_url()?>admin/store/edit/category/<?php echo isset($categoryID)?$categoryID:'';?>" method="post">
        <div class="panel-body">
         <?php
         $r = $this->session->flashdata('response');
         if(isset($r)){?>
          <div class="alert <?php if($r['Response']==0){ echo 'alert-warning';}else{echo'alert-success';}?>"><?php echo $r['Message']?></div>
        <?php } ?>
        <input type="hidden" name="id" value="<?php echo isset($categoryID)?$categoryID:'';?>" />
        
         <div class="form-group">
        <label for="pCategory">Parent Category:</label>
        <select  class="form-control" id="pCategory"  name="pCategory" title="Parent Category">
        	<?php
        	if(!empty($parentCategory))
        	{
        		foreach ($parentCategory as $pc) {
        	
        	?>
          <option value="<?php echo $pc->id;?>" <?php if(!empty($pCatID) && $pCatID==$pc->id){echo 'selected="selected"';}?>><?php echo $pc->title;?></option>
      <?php } } ?>
        </select>
      </div>
        <div class="form-group">
          <label for="subCategory">Sub Category Name :</label>
          <input type="text" class="form-control" id="subCategory" placeholder="Sub Category Name" name="subCategory" title="Sub Category Name" value="<?php echo isset($subCategory)?$subCategory:'';?>">
        </div>
      
    </div>
    <div class="panel-footer">
      <a href="<?php echo base_url();?>admin/store/categories" class="btn btn-info">Cancel</a>
      <button class="btn btn-primary pull-right" type="submit">Save</button>
    </div>
  </form>
</div>   
</div>