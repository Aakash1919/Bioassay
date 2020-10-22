<ul class="breadcrumb">
    <li><a href="<?php echo base_url();?>admin/dashboard/index">Dashboard</a></li>
    <li class="active">Change Admin Password</li>
  </ul>
    <div class="row">
    <div class="col-md-6 col-lg-6 col-sm-12 col-xm-12">
      <div class="panel panel-default">

        <div class="panel-heading">
          <h3 class="panel-title">Change Password</h3>
        </div>
         <form action="/admin/users/changepassword" method="post">
          <div class="panel-body">
            <?php if(!empty($response)){ ?>
              <p><?php echo $response; ?></p>
            <?php } ?>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" placeholder="password" class="form-control">
            </div>
            <div class="form-group">
              <label for="confirm-password">Confirm Password</label>
              <input type="password" name="confirmpassword" id="confirm-password" placeholder="confirm password" class="form-control">
            </div>          
          </div>
          <div class="panel-footer">
          <button class="btn btn-primary pull-right" type="submit">Save</button>
        </div>
        </form>
        </div>
      </div>
    </div>