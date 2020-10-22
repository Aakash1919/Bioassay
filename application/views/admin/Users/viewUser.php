  <?php
  if(!empty($userDetails)){
    foreach ($userDetails as $ud) {
    $full_name = $ud->full_name;
    $tel = $ud->tel;
    $fax = $ud->fax;
    $email = $ud->email;
    $company = $ud->company;
    $address = $ud->address_1.' '.$ud->address_2;
    $city = $ud->city;
    $state = $ud->state;
    $zip = $ud->zip;
    $country = $ud->country;
    $billing_name = $ud->billing_name;
    $billing_co_name = $ud->billing_co_name;
    $billing_address = $ud->billing_address_1.' '.$ud->billing_address_2;;
    $billing_city = $ud->billing_city;
    $billing_state = $ud->billing_state;
    $billing_zip = $ud->billing_zip;
    $billing_country = $ud->billing_country;
    $billing_tel = $ud->billing_tel;
    $billing_fax = $ud->billing_fax;
    $shipping_name = $ud->shipping_name;
    $shipping_co_name = $ud->shipping_co_name;
    $shipping_address = $ud->shipping_address_1.' '.$ud->shipping_address_2;
    $shipping_city = $ud->shipping_city;
    $shipping_state = $ud->shipping_state;
    $shipping_zip = $ud->shipping_zip;
    $shipping_country = $ud->shipping_country;
    $shipping_tel = $ud->shipping_tel;
    $shipping_email = $ud->shipping_email;
    $mod_date = $ud->mod_date;
    }
  }
  ?>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url();?>admin/dashboard/index">Dashboard</a></li>                    
    <li><a href="<?php echo base_url();?>admin/users/index">Users</a></li>
    <li class="active">View User</li>
  </ul>
    <div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6">
      <div class="panel panel-default">

        <div class="panel-heading">
          <h3 class="panel-title">Personal Info</h3>
        </div>
          <div class="panel-body">
            <div class="form-group">
            <label for="pcategory">Name:</label>
              <?php echo isset($full_name)?$full_name:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Telephone:</label>
              <?php echo isset($tel)?$tel:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Fax:</label>
              <?php echo isset($fax)?$fax:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Email:</label>
              <?php echo isset($email)?$email:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Company:</label>
              <?php echo isset($company)?$company:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Address:</label>
              <?php echo isset($address)?$address:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">City:</label>
              <?php echo isset($city)?$city:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">State:</label>
              <?php echo isset($state)?$state:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Zipcode:</label>
              <?php echo isset($zip)?$zip:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Country:</label>
              <?php echo isset($country)?$country:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">mod_date:</label>
              <?php echo isset($mod_date)?$mod_date:'';?>
          </div>

          </div>
        </div>
      </div>
    </div>
    <div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6">
      <div class="panel panel-default">

        <div class="panel-heading">
          <h3 class="panel-title">Billing Info</h3>
        </div>
          <div class="panel-body">
            <div class="form-group">
            <label for="pcategory">Billing Name :</label>
              <?php echo isset($billing_name)?$billing_name:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Billing company :</label>
              <?php echo isset($billing_co_name)?$billing_co_name:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Billing Address :</label>
              <?php echo isset($billing_address)?$billing_address:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Billing City :</label>
              <?php echo isset($billing_city)?$billing_city:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Billing State :</label>
              <?php echo isset($billing_state)?$billing_state:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Billing Zipcode :</label>
              <?php echo isset($billing_zip)?$billing_zip:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Billing Country:</label>
              <?php echo isset($billing_country)?$billing_country:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Billing Telephone:</label>
              <?php echo isset($billing_tel)?$billing_tel:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Billing Fax:</label>
              <?php echo isset($billing_fax)?$billing_fax:'';?>
          </div>

          </div>
        </div>
      </div>
    </div>
    <div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6">
      <div class="panel panel-default">

        <div class="panel-heading">
          <h3 class="panel-title">Shipping Info</h3>
        </div>
          <div class="panel-body">
            <div class="form-group">
            <label for="pcategory">Shipping Name:</label>
              <?php echo isset($shipping_name)?$shipping_name:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Shipping Company:</label>
              <?php echo isset($shipping_co_name)?$shipping_co_name:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Shipping Address:</label>
              <?php echo isset($shipping_address)?$shipping_address:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Shipping City :</label>
              <?php echo isset($shipping_city)?$shipping_city:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Shipping State:</label>
              <?php echo isset($shipping_state)?$shipping_state:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Shipping Zipcode:</label>
              <?php echo isset($shipping_zip)?$shipping_zip:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Shipping Country:</label>
              <?php echo isset($shipping_country)?$shipping_country:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Shipping Telephone:</label>
              <?php echo isset($shipping_tel)?$shipping_tel:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Shipping Email:</label>
              <?php echo isset($shipping_email)?$shipping_email:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Mod Date:</label>
              <?php echo isset($mod_date)?$mod_date:'';?>
          </div>
          </div>
        </div>
      </div>
    </div>