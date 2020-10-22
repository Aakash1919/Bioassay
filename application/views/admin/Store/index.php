  <ul class="breadcrumb">
    <li><a href="<?php echo base_url();?>admin/dashboard/index">Dashboard</a></li>                    
    <li class="active">Store</li>
</ul>

<div class="row">
                        <div class="col-md-11">
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo isset($PageTitle)?$PageTitle:"";?></h3>
                                  <!--   <form action="#" method="GET" enctype="multipart/form-data">
                                    <div class="col-md-6">
                                     <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="fa fa-search"></span>
                                        </div>
                                          <input type="text" name="search" type="search" class="form-control" placeholder="Search Name"/>
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                        </form>
                                         -->
                                         <a href="/admin/store/edit/category/" class="btn btn-primary pull-right"><span class="fa fa-plus-square-o"></span> Add</a>
                                    </div>
                                	</div>
                               		<!--  <label for="submit-form"  class="btn btn-danger pull-right lab" tabindex="0">Delete Selected</label> -->
                                    
                              
                                  <?php
						         $r = $this->session->flashdata('response');
						         if(isset($r)){?>
						          <div class="alert <?php if($r['Response']==0){ echo 'alert-warning';}else{echo'alert-success';}?>"><?php echo $r['Message']?></div>
						        <?php } ?>
								<?php if(!empty($items)){?>
                     <div class="panel panel-default">
                                <div class="panel-body panel-body-table">

                                 
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                	<!-- <th class="text-center" width="50"><input type="checkbox" id="checkAll" name="Allcheckbox"></th> -->
                                                	<th class="text-center" width="50">id</th>
                                                    <th>Category Name</th>
                                                    <th>Modify Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            	
                                            <?php foreach ($items as $i){?>                                            
                                                <tr id="trow_1">
                                                  <td class="text-center"><?php echo $i->category_id;?></td>
                                                    <td><?php echo $i->category;?></td>
                                                    <td><strong><?php echo $i->mod_date;?></strong></td>
                                                    <td>
                                                        <a href="/admin/store/edit/category/<?php echo $i->category_id;?>" class="btn btn-default btn-rounded btn-condensed btn-sm"><span class="fa fa-pencil"></span></a>
                                                        <a href="/admin/store/delete/category/<?php echo $i->category_id;?>" class="btn btn-danger btn-rounded btn-condensed btn-sm"><span class="fa fa-times"></span></a>
                                                    </td>
                                                </tr>
                                              <?php } ?> 
                                           
                                            </tbody>
                                        </table>
                                    </div>                                
									
                  </div>
                                
                                <?php echo isset($links)?$links:'';?>
                              
                          
 <?php }else{?>
 			<div class="panel-body">
 				<div class="alert alert-warning">Sorry No Data found!</div>
 			</div>
 <?php }?>
   						</div>                                                
    </div> 
                       
                   <!--  <script type="text/javascript">
                             $("#checkAll").click(function () {
                                 $('input:checkbox').not(this).prop('checked', this.checked);
                             });
                    </script> -->
                   